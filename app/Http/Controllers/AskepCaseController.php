<?php

namespace App\Http\Controllers;

use App\Models\AskepCase;
use App\Models\CaseImplementation;
use App\Models\Diagnosis;
use App\Models\Etiology;
use App\Models\Evaluation;
use App\Models\Intervention;
use App\Models\OutcomeStandard;
use App\Models\Patient;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class AskepCaseController extends Controller
{
    public function create(Patient $patient)
    {
        $symptoms = Symptom::all();
        return view('askep.symptoms', compact('patient', 'symptoms'));
    }

    public function storeSymptoms(Request $request)
    {
        // Validate the request
        $request->validate([
            'patient_id' => 'required',
            'symptoms' => 'required|array|min:1',
        ]);

        // Log the received data for debugging
        Log::info('Receiving symptoms submission', [
            'patient_id' => $request->patient_id,
            'symptoms' => $request->symptoms,
        ]);

        // Create the case
        $case = AskepCase::create([
            'patient_id' => $request->patient_id,
            'status' => AskepCase::STATUS_IN_PROGRESS,
        ]);

        // Sync the symptoms with the case
        $case->symptoms()->sync($request->symptoms);

        // Redirect to diagnosis page with case ID
        return redirect()->route('askep.diagnosis', $case->id);
    }

    public function showDiagnosis($id)
    {
        $case = AskepCase::with('symptoms')->findOrFail($id);
        $symptomIds = $case->symptoms->pluck('id')->toArray();
        $diagnoses = Diagnosis::with(['symptoms', 'etiologies'])->get();

        $results = [];
        foreach ($diagnoses as $diagnosis) {
            $mainIds = $diagnosis->symptoms->pluck('id')->toArray();
            $matched = array_intersect($mainIds, $symptomIds);
            $matchedCount = count($matched);
            $totalCount = count($mainIds);
            $percent = $totalCount ? ($matchedCount / $totalCount) * 100 : 0;

            $results[] = [
                'diagnosis' => $diagnosis,
                'matched' => $matchedCount, // Add this line
                'total' => $totalCount, // Add this line
                'percent' => $percent,
                'status' => $percent >= 80 ? 'memenuhi' : 'tidak',
            ];
        }

        // Sort by percentage (highest first)
        usort($results, function ($a, $b) {
            return $b['percent'] <=> $a['percent'];
        });

        return view('askep.diagnosis', compact('case', 'results'));
    }

    public function saveDiagnosis(Request $request, $id)
    {
        $request->validate([
            'diagnosis_ids' => 'required|array|min:1',
            'diagnosis_ids.*' => 'exists:diagnosis,id',
            'primary_diagnosis' => 'required|exists:diagnosis,id',
        ]);

        $case = AskepCase::findOrFail($id);

        // Set primary diagnosis pada kolom diagnosis_id untuk backward compatibility
        $case->diagnosis_id = $request->primary_diagnosis;
        $case->save();

        // Hapus semua diagnosis yang ada sebelumnya
        $case->diagnoses()->detach();

        // Tambahkan diagnosis baru
        foreach ($request->diagnosis_ids as $diagnosisId) {
            $isPrimary = $diagnosisId == $request->primary_diagnosis;
            $case->diagnoses()->attach($diagnosisId, ['is_primary' => $isPrimary]);
        }

        return redirect()->route('askep.outcome', $case->id);
    }

    public function showOutcome($id)
    {
        try {
            // Ambil kasus dengan eager loading untuk mengurangi queries
            $case = AskepCase::with(['diagnoses', 'diagnosis', 'patient'])->findOrFail($id);

            // Siapkan array untuk menyimpan data outcomes dan etiologies per diagnosis
            $diagnosisData = [];

            // Ambil semua diagnosa yang dipilih (baik primer maupun sekunder)
            $selectedDiagnoses = $case->diagnoses;

            // Jika tidak ada diagnosa yang dipilih melalui relasi many-to-many,
            // gunakan diagnosa yang dipilih melalui kolom diagnosis_id (backward compatibility)
            if ($selectedDiagnoses->isEmpty() && $case->diagnosis) {
                $selectedDiagnoses = collect([$case->diagnosis]);
            }

            // Jika masih tidak ada diagnosis, redirect kembali dengan pesan error
            if ($selectedDiagnoses->isEmpty()) {
                return redirect()->route('askep.diagnosis', $case->id)->with('error', 'Silakan pilih diagnosis terlebih dahulu.');
            }

            // Log untuk debugging
            Log::info('Selected diagnoses', [
                'case_id' => $id,
                'diagnoses_count' => $selectedDiagnoses->count(),
                'diagnosis_ids' => $selectedDiagnoses->pluck('id'),
            ]);

            // Loop untuk setiap diagnosis dan ambil data terkait
            foreach ($selectedDiagnoses as $diagnosis) {
                // Ambil etiologies untuk diagnosis ini
                $etiologies = Etiology::where('diagnosis_id', $diagnosis->id)->get();

                // Ambil outcomes untuk diagnosis ini
                $outcomes = OutcomeStandard::where('diagnosis_id', $diagnosis->id)->get();

                // Tambahkan ke array dengan diagnosis ID sebagai key
                $diagnosisData[$diagnosis->id] = [
                    'diagnosis' => $diagnosis,
                    'etiologies' => $etiologies,
                    'outcomes' => $outcomes,
                    'is_primary' => $diagnosis->pivot ? $diagnosis->pivot->is_primary : $diagnosis->id == $case->diagnosis_id,
                ];

                Log::info('Diagnosis data', [
                    'diagnosis_id' => $diagnosis->id,
                    'etiologies_count' => $etiologies->count(),
                    'outcomes_count' => $outcomes->count(),
                    'is_primary' => $diagnosisData[$diagnosis->id]['is_primary'],
                ]);
            }

            return view('askep.outcome', compact('case', 'diagnosisData'));
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Error in showOutcome method', [
                'case_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect dengan pesan error
            return redirect()
                ->route('askep.diagnosis', $id)
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function saveOutcome(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'diagnosis_etiology' => 'required|array',
                'diagnosis_etiology.*' => 'exists:etiologies,id',
                'outcome_ids' => 'required|array',
                'initial_values' => 'required|array',
                'target_values' => 'required|array',
            ]);

            $case = AskepCase::findOrFail($id);

            // Hapus outcomes yang ada sebelumnya
            $case->outcomes()->delete();

            // Simpan etiology untuk diagnosis utama saja
            if (isset($request->diagnosis_etiology[$case->diagnosis_id])) {
                $etiologyId = $request->diagnosis_etiology[$case->diagnosis_id];
                $etiology = Etiology::find($etiologyId);

                if ($etiology) {
                    $case->etiology_id = $etiologyId;
                    $case->cause = $etiology->description;
                    $case->save();
                }
            }

            // Loop untuk setiap diagnosis
            foreach ($request->outcome_ids as $diagnosisId => $outcomeIds) {
                // Loop untuk setiap outcome yang dipilih
                foreach ($outcomeIds as $index => $outcomeId) {
                    // Ambil nilai awal dan target
                    $initialValue = $request->initial_values[$diagnosisId][$index] ?? null;
                    $targetValue = $request->target_values[$diagnosisId][$index] ?? null;

                    // Validasi nilai
                    if (!$initialValue || !$targetValue) {
                        continue;
                    }

                    // Ambil data outcome standard
                    $outcomeStandard = OutcomeStandard::find($outcomeId);

                    // Simpan outcome
                    if ($outcomeStandard) {
                        $case->outcomes()->create([
                            'diagnosis_id' => $diagnosisId,
                            'outcome_standard_id' => $outcomeId,
                            'name' => $outcomeStandard->name,
                            'initial_value' => $initialValue,
                            'target_value' => $targetValue,
                        ]);
                    }
                }
            }

            return redirect()->route('askep.intervention', $id)->with('success', 'Luaran keperawatan berhasil disimpan');
        } catch (\Exception $e) {
            Log::error('Error saving outcomes', [
                'case_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showIntervention($id)
    {
        $case = AskepCase::with(['diagnoses', 'patient', 'outcomes'])->findOrFail($id);

        // Ambil semua diagnosa yang dipilih
        $selectedDiagnoses = $case->diagnoses;

        // Jika tidak ada diagnosa dari relasi many-to-many, gunakan diagnosis_id
        if ($selectedDiagnoses->isEmpty() && $case->diagnosis) {
            $selectedDiagnoses = collect([$case->diagnosis]);
        }

        $diagnosisData = [];

        // Siapkan data intervensi untuk setiap diagnosis
        foreach ($selectedDiagnoses as $diagnosis) {
            // Ambil intervensi untuk diagnosis ini
            try {
                $interventions = Intervention::where('diagnosis_id', $diagnosis->id)->orderBy('order')->get();
            } catch (\Exception $e) {
                $interventions = Intervention::where('diagnosis_id', $diagnosis->id)->get();
            }

            // Tentukan apakah ini diagnosis primer atau tidak
            $isPrimary = $diagnosis->pivot ? $diagnosis->pivot->is_primary : $diagnosis->id == $case->diagnosis_id;

            // Tambahkan ke array data
            $diagnosisData[$diagnosis->id] = [
                'diagnosis' => $diagnosis,
                'interventions' => $interventions,
                'is_primary' => $isPrimary,
                'selected_interventions' => [],
            ];

            // Periksa interventions yang sudah diimplementasikan
            foreach ($case->implementations as $implementation) {
                if ($interventions->contains('id', $implementation->intervention_id)) {
                    $diagnosisData[$diagnosis->id]['selected_interventions'][] = $implementation->intervention_id;
                }
            }
        }

        return view('askep.intervention', compact('case', 'diagnosisData'));
    }

    public function saveIntervention(Request $request, $id)
    {
        $request->validate([
            'diagnosis_interventions' => 'required|array',
            'diagnosis_interventions.*' => 'array',
            'diagnosis_interventions.*.*' => 'exists:interventions,id',
        ]);

        $case = AskepCase::findOrFail($id);

        // Hapus implementations yang sudah ada
        $case->implementations()->delete();

        // Simpan interventions yang baru
        $implementationsData = [];

        foreach ($request->diagnosis_interventions as $diagnosisId => $interventionIds) {
            foreach ($interventionIds as $interventionId) {
                $implementationsData[] = [
                    'intervention_id' => $interventionId,
                    'performed' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        $case->implementations()->createMany($implementationsData);

        return redirect()->route('askep.implementation', $case->id)->with('success', 'Intervensi berhasil disimpan');
    }

    public function showImplementation($id)
    {
        $case = AskepCase::with(['diagnoses', 'patient', 'implementations.intervention'])->findOrFail($id);

        return view('askep.implementation', compact('case'));
    }

    public function saveImplementation(Request $request, $id)
    {
        try {
            $case = AskepCase::findOrFail($id);

            // Modifikasi validasi
            $validationRules = [
                'implementations' => 'required|array',
                'implementations.*.id' => 'required|exists:interventions,id',
                'implementations.*.waktu' => 'nullable|string',
                'implementations.*.notes' => 'nullable|string',
                // Hapus validasi performed karena akan diolah secara manual
            ];

            $request->validate($validationRules);

            // Log request untuk debugging jika perlu
            Log::info('Implementation data', ['data' => $request->all()]);

            foreach ($request->implementations as $index => $data) {
                // Cari implementation yang sudah ada atau buat yang baru
                $implementation = $case->implementations()->where('intervention_id', $data['id'])->first();

                // Konversi performed ke boolean eksplisit
                $performedValue = isset($data['performed']) ? true : false;

                $updateData = [
                    'performed' => $performedValue,
                    'waktu' => $data['waktu'] ?? null,
                    'notes' => $data['notes'] ?? null,
                ];

                if ($implementation) {
                    // Update implementation yang sudah ada
                    $implementation->update($updateData);
                } else {
                    // Buat implementation baru
                    $case->implementations()->create(array_merge(['intervention_id' => $data['id']], $updateData));
                }
            }

            return redirect()->route('askep.evaluation', $id)->with('success', 'Implementasi tindakan berhasil disimpan');
        } catch (\Exception $e) {
            Log::error('Error in saveImplementation', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showEvaluation($id)
    {
        $case = AskepCase::with(['diagnosis', 'patient', 'implementations.intervention', 'outcomes'])->findOrFail($id);

        return view('askep.evaluation', compact('case'));
    }

    public function saveEvaluation(Request $request, $id)
    {
        $case = AskepCase::findOrFail($id);

        $request->validate([
            'result' => 'required|in:' . Evaluation::RESULT_ACHIEVED . ',' . Evaluation::RESULT_NOT_ACHIEVED,
            'outcome_results' => 'required|array',
            'outcome_results.*' => 'required|integer|min:1|max:5',
            'evaluation_time' => 'required|string',
            'subjective' => 'nullable|string',
            'objective' => 'nullable|string',
            'assessment' => 'nullable|string',
            'plan' => 'nullable|string',
        ]);

        // Validasi hasil akhir terhadap target
        $allAchieved = true;
        $outcomes = $case->outcomes;

        foreach ($request->outcome_results as $outcomeId => $finalValue) {
            $outcome = $outcomes->find($outcomeId);
            if ($outcome) {
                if ($finalValue < $outcome->target_value) {
                    $allAchieved = false;
                    break;
                }
            }
        }

        // Simpan evaluasi ke database langsung pada kolom yang sesuai
        $case->evaluation()->create([
            'result' => $request->result,
            // Tidak lagi menyimpan sebagai JSON di notes
            'notes' => '', // Kosongkan notes karena akan menggunakan kolom terpisah
            'evaluation_time' => $request->evaluation_time,
            'subjective' => $request->subjective,
            'objective' => $request->objective,
            'assessment' => $request->assessment,
            'plan' => $request->plan,
        ]);

        // Update nilai akhir setiap outcome
        foreach ($request->outcome_results as $outcomeId => $finalValue) {
            $outcome = $case->outcomes()->find($outcomeId);
            if ($outcome) {
                $outcome->update(['final_value' => $finalValue]);
            }
        }

        // Update status askep menjadi selesai
        $case->update(['status' => AskepCase::STATUS_COMPLETED]);

        return redirect()->route('patients.history', $case->patient_id)->with('success', 'Asuhan keperawatan telah selesai');
    }

    public function saveEtiology(Request $request, $id)
    {
        $request->validate([
            'etiology_ids' => 'required|array|min:1',
            'etiology_ids.*' => 'exists:etiologies,id',
        ]);

        $case = AskepCase::findOrFail($id);

        return redirect()->route('askep.outcome', $case->id);
    }

    public function printReport($id)
    {
        $case = AskepCase::with(['patient', 'diagnosis', 'symptoms', 'outcomes.outcomeStandard', 'implementations.intervention', 'evaluation'])->findOrFail($id);

        // Validasi data sebelum passing ke view
        foreach ($case->outcomes as $outcome) {
            if (!$outcome->outcomeStandard) {
                // Log error atau tambahkan informasi default
                Log::warning("Outcome ID {$outcome->id} tidak memiliki OutcomeStandard");
            }
        }

        foreach ($case->implementations as $implementation) {
            if (!$implementation->intervention) {
                Log::warning("Implementation ID {$implementation->id} tidak memiliki Intervention");
            }
        }

        // Lanjutkan dengan kode yang ada
        $pdf = Pdf::loadView('reports.askep_report', compact('case'));
        $pdf->setPaper('a4', 'portrait');
        $filename = 'AskepReport_' . $case->patient->medical_record . '_' . date('Ymd_His') . '.pdf';
        return $pdf->download($filename);
    }

    public function getReportData($id)
    {
        $case = AskepCase::with(['patient', 'diagnosis', 'symptoms', 'implementations.intervention', 'outcomes.outcomeStandard', 'evaluation'])->findOrFail($id);

        return view('reports.askep_report_content', compact('case'));
    }
}
