<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::paginate(3);
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'medical_record_number' => 'nullable|string|max:50|unique:patients',
            'blood_type' => 'nullable|string',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $patientData = $request->all();
        $patientData['user_id'] = auth()->id();
        Patient::create($patientData);
        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil ditambahkan');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'blood_type' => 'nullable|string',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil diperbarui');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index');
    }

    public function history(Patient $patient)
    {
        $cases = $patient->askepCases()->with('diagnosis', 'outcomes', 'evaluation')->get();
        return view('patients.history', compact('patient', 'cases'));
    }
}
