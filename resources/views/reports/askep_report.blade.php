<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Asuhan Keperawatan - {{ $case->patient->name ?? 'Pasien' }}</title>
    <style>
        @page {
            margin: 2cm;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #333;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .watermark {
            position: fixed;
            top: 45%;
            left: 25%;
            opacity: 0.07;
            z-index: -1000;
            transform: rotate(-45deg);
            font-size: 80pt;
            color: #2c3e50;
            font-weight: bold;
        }

        .report-header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 3px solid #3498db;
            margin-bottom: 25px;
        }

        .logo {
            margin-bottom: 10px;
            text-align: center;
        }

        .logo img {
            height: 50px;
        }

        .report-title {
            font-size: 20pt;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .report-subtitle {
            font-size: 12pt;
            color: #7f8c8d;
        }

        .report-date {
            font-size: 10pt;
            color: #7f8c8d;
            margin-top: 5px;
        }

        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 14pt;
            font-weight: bold;
            color: #2c3e50;
            padding-bottom: 8px;
            border-bottom: 2px solid #3498db;
            margin-bottom: 15px;
        }

        .patient-info {
            display: flex;
            flex-wrap: wrap;
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .patient-photo {
            width: 15%;
            text-align: center;
        }

        .patient-details {
            width: 85%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 0;
        }

        .info-table td {
            padding: 5px 10px;
            vertical-align: top;
        }

        .data-table {
            border: 1px solid #bdc3c7;
            width: 100%;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #bdc3c7;
            padding: 8px;
            text-align: left;
        }

        .data-table th {
            background-color: #edf2f7;
            color: #2c3e50;
            font-weight: bold;
        }

        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .data-table tr:hover {
            background-color: #f1f5f9;
        }

        .soap-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 15px;
            margin-bottom: 15px;
        }

        .soap-item {
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            padding: 15px;
            background-color: #f8fafc;
        }

        .soap-label {
            font-weight: bold;
            color: #2c3e50;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
            margin-bottom: 8px;
        }

        .soap-content {
            font-size: 10pt;
            white-space: pre-line;
        }

        .status-pill {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 12px;
            font-size: 9pt;
            font-weight: bold;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-not-completed {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            font-size: 10pt;
        }

        .signature-block {
            float: right;
            width: 200px;
            text-align: center;
        }

        .sign-date {
            margin-bottom: 50px;
        }

        .sign-name {
            border-top: 1px solid #333;
            padding-top: 5px;
            font-weight: bold;
        }

        .clearfix {
            clear: both;
        }

        .page-break {
            page-break-after: always;
        }

        .box-container {
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f8fafc;
        }

        .evaluation-summary {
            background-color: #f0f7ff;
            border-left: 4px solid #3498db;
            padding: 10px 15px;
            margin-bottom: 15px;
        }

        .evaluation-result {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: bold;
            margin-top: 10px;
        }

        .text-muted {
            color: #6c757d;
            font-size: 0.9em;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="watermark">ASKEPPRO</div>
    <div class="report-header">
        <div class="logo">
            <!-- Ganti dengan logo yang sesuai -->
            <strong>ASKEPPRO</strong>
        </div>
        <div class="report-title">LAPORAN ASUHAN KEPERAWATAN</div>
        <div class="report-subtitle">Dokumentasi Profesional Asuhan Keperawatan</div>
        <div class="report-date">Tanggal Cetak: {{ now()->format('d F Y - H:i') }}</div>
    </div>

    <div class="section">
        <div class="section-title">DATA PASIEN</div>
        <div class="box-container">
            <table class="info-table">
                <tr>
                    <td width="25%"><strong>Nomor Rekam Medis</strong></td>
                    <td width="25%">: {{ $case->patient->medical_record_number ?? '-' }}</td>
                    <td width="25%"><strong>Tanggal Asuhan</strong></td>
                    <td width="25%">: {{ is_object($case->created_at) ? $case->created_at->format('d-m-Y') : date('d-m-Y', strtotime($case->created_at)) }}</td>
                </tr>
                <tr>
                    <td><strong>Nama Pasien</strong></td>
                    <td>: {{ $case->patient->name ?? '-' }}</td>
                    <td><strong>Usia</strong></td>
                    <td>: {{ is_object($case->patient->birth_date) ? $case->patient->birth_date->age : '-' }} tahun</td>
                </tr>
                <tr>
                    <td><strong>Jenis Kelamin</strong></td>
                    <td>: {{ $case->patient->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td><strong>Tanggal Lahir</strong></td>
                    <td>: {{ is_object($case->patient->birth_date) ? $case->patient->birth_date->format('d-m-Y') : $case->patient->birth_date }}</td>
                </tr>
                <tr>
                    <td><strong>Alamat</strong></td>
                    <td colspan="3">: {{ $case->patient->address ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Status</strong></td>
                    <td colspan="3">:
                        @if($case->status == "selesai")
                            <span class="status-pill status-completed">Selesai</span>
                        @elseif($case->status == "proses")
                            <span class="status-pill status-pending">Dalam Proses</span>
                        @else
                            <span class="status-pill">{{ $case->status }}</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Bagian Diagnosis & Gejala -->
<div class="section">
    <div class="section-title">DIAGNOSIS & GEJALA</div>
    <div class="box-container">
        <h3 style="margin-top: 0; color: #2c3e50;">Diagnosis Keperawatan</h3>

        @if($case->diagnoses && $case->diagnoses->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="75%">Diagnosis</th>
                        <th width="20%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($case->diagnoses as $index => $diagnosis)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $diagnosis->name }}</td>
                            <td class="text-center">
                                @if($diagnosis->pivot && $diagnosis->pivot->is_primary)
                                    <span class="status-pill status-completed">Utama</span>
                                @else
                                    <span class="status-pill status-pending">Sekunder</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #6c757d; font-style: italic;">Belum ada diagnosis yang ditetapkan</p>
        @endif

        <h3 style="color: #2c3e50;">Penyebab (Etiologi)</h3>
        <p>{{ $case->cause ?? '-' }}</p>

        <h3 style="color: #2c3e50;">Gejala yang Teridentifikasi</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="80%">Gejala</th>
                    <th width="15%">Jenis</th>
                </tr>
            </thead>
            <tbody>
                @forelse($case->symptoms as $index => $symptom)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $symptom->name ?? '-' }}</td>
                        <td class="text-center">
                            @if($symptom->pivot && $symptom->pivot->is_main)
                                <span class="status-pill status-completed">Utama</span>
                            @else
                                <span class="status-pill status-pending">Pendukung</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data gejala</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Luaran Keperawatan -->
<div class="section">
    <div class="section-title">LUARAN KEPERAWATAN</div>
    <div class="box-container">
        @if($case->diagnoses && $case->diagnoses->count() > 0)
            @foreach($case->diagnoses as $diagnosis)
                <div class="diagnosis-section" style="margin-bottom: 20px;">
                    <h3 style="color: #2c3e50; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px;">
                        {{ $diagnosis->name }}
                        @if($diagnosis->pivot && $diagnosis->pivot->is_primary)
                            <span class="status-pill status-completed" style="font-size: 9pt; margin-left: 10px;">Utama</span>
                        @else
                            <span class="status-pill status-pending" style="font-size: 9pt; margin-left: 10px;">Sekunder</span>
                        @endif
                    </h3>

                    @php
                        $diagnosisOutcomes = $case->outcomes->where('diagnosis_id', $diagnosis->id);
                    @endphp

                    @if($diagnosisOutcomes->count() > 0)
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="40%">Luaran</th>
                                    <th width="15%">Nilai Awal</th>
                                    <th width="15%">Target</th>
                                    <th width="15%">Nilai Akhir</th>
                                    <th width="10%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($diagnosisOutcomes as $index => $outcome)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $outcome->name ?? '-' }}</td>
                                        <td class="text-center">{{ $outcome->initial_value ?? '-' }}</td>
                                        <td class="text-center">{{ $outcome->target_value ?? '-' }}</td>
                                        <td class="text-center">{{ $outcome->final_value ?? '-' }}</td>
                                        <td class="text-center">
                                            @if(isset($outcome->final_value) && isset($outcome->target_value))
                                                @if($outcome->final_value >= $outcome->target_value)
                                                    <span class="status-pill status-completed">Tercapai</span>
                                                @else
                                                    <span class="status-pill status-not-completed">Belum</span>
                                                @endif
                                            @else
                                                <span class="status-pill status-pending">Belum</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Tidak ada data luaran untuk diagnosis ini</p>
                    @endif
                </div>
            @endforeach
        @elseif($case->outcomes && $case->outcomes->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="40%">Luaran</th>
                        <th width="15%">Nilai Awal</th>
                        <th width="15%">Target</th>
                        <th width="15%">Nilai Akhir</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($case->outcomes as $index => $outcome)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $outcome->name ?? '-' }}</td>
                            <td class="text-center">{{ $outcome->initial_value ?? '-' }}</td>
                            <td class="text-center">{{ $outcome->target_value ?? '-' }}</td>
                            <td class="text-center">{{ $outcome->final_value ?? '-' }}</td>
                            <td class="text-center">
                                @if(isset($outcome->final_value) && isset($outcome->target_value))
                                    @if($outcome->final_value >= $outcome->target_value)
                                        <span class="status-pill status-completed">Tercapai</span>
                                    @else
                                        <span class="status-pill status-not-completed">Belum</span>
                                    @endif
                                @else
                                    <span class="status-pill status-pending">Belum</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-muted">Belum ada luaran keperawatan yang ditetapkan</p>
        @endif
    </div>
</div>

<!-- Intervensi & Implementasi -->
<div class="section">
    <div class="section-title">INTERVENSI & IMPLEMENTASI</div>
    <div class="box-container">
        @if($case->diagnoses && $case->diagnoses->count() > 0)
            @foreach($case->diagnoses as $diagnosis)
                <div class="diagnosis-section" style="margin-bottom: 20px;">
                    <h3 style="color: #2c3e50; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px;">
                        {{ $diagnosis->name }}
                        @if($diagnosis->pivot && $diagnosis->pivot->is_primary)
                            <span class="status-pill status-completed" style="font-size: 9pt; margin-left: 10px;">Utama</span>
                        @else
                            <span class="status-pill status-pending" style="font-size: 9pt; margin-left: 10px;">Sekunder</span>
                        @endif
                    </h3>

                    @php
                        // Filter implementasi berdasarkan diagnosis_id atau intervention.diagnosis_id
                        $diagnosisImplementations = $case->implementations->filter(function($implementation) use ($diagnosis) {
                            return ($implementation->diagnosis_id == $diagnosis->id) ||
                                  ($implementation->intervention && $implementation->intervention->diagnosis_id == $diagnosis->id);
                        });
                    @endphp

                    @if($diagnosisImplementations->count() > 0)
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="40%">Intervensi</th>
                                    <th width="15%">Status</th>
                                    <th width="20%">Waktu</th>
                                    <th width="20%">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($diagnosisImplementations as $index => $implementation)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ optional($implementation->intervention)->name ?? 'Data tidak tersedia' }}</td>
                                        <td class="text-center">
                                            @if($implementation->performed)
                                                <span class="status-pill status-completed">Dilakukan</span>
                                            @else
                                                <span class="status-pill status-not-completed">Belum</span>
                                            @endif
                                        </td>
                                        <td>{{ $implementation->waktu ?? '-' }}</td>
                                        <td>{{ $implementation->notes ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Tidak ada data implementasi untuk diagnosis ini</p>
                    @endif
                </div>
            @endforeach
        @elseif($case->implementations && $case->implementations->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="40%">Intervensi</th>
                        <th width="15%">Status</th>
                        <th width="20%">Waktu</th>
                        <th width="20%">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($case->implementations as $index => $implementation)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ optional($implementation->intervention)->name ?? 'Data tidak tersedia' }}</td>
                            <td class="text-center">
                                @if($implementation->performed)
                                    <span class="status-pill status-completed">Dilakukan</span>
                                @else
                                    <span class="status-pill status-not-completed">Belum</span>
                                @endif
                            </td>
                            <td>{{ $implementation->waktu ?? '-' }}</td>
                            <td>{{ $implementation->notes ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-muted">Belum ada data implementasi</p>
        @endif
    </div>
</div>

<!-- Evaluasi (SOAP) - Tidak berubah dari sebelumnya -->
<div class="section">
    <div class="section-title">EVALUASI (SOAP)</div>
    <div class="box-container">
        @if($case->evaluation)
            @php
                // Parse SOAP data jika tersimpan sebagai JSON
                $soapData = null;
                try {
                    if (!empty($case->evaluation->notes) && is_string($case->evaluation->notes)) {
                        $soapData = json_decode($case->evaluation->notes, true);
                    }
                } catch(\Exception $e) {
                    $soapData = null;
                }

                // Ambil waktu evaluasi dari kolom terpisah atau dari JSON
                $evaluationTime = $case->evaluation->evaluation_time ?? ($soapData['time'] ?? '-');

                // Ambil data SOAP dari kolom terpisah atau dari JSON
                $subjective = $case->evaluation->subjective ?? ($soapData['subjective'] ?? null);
                $objective = $case->evaluation->objective ?? ($soapData['objective'] ?? null);
                $assessment = $case->evaluation->assessment ?? ($soapData['assessment'] ?? null);
                $plan = $case->evaluation->plan ?? ($soapData['plan'] ?? null);

                // Cek apakah ada data SOAP
                $hasSOAP = !empty($subjective) || !empty($objective) || !empty($assessment) || !empty($plan);
            @endphp

            <div class="evaluation-summary">
                <strong>Waktu Evaluasi:</strong> {{ $evaluationTime }}
                <div class="evaluation-result {{ $case->evaluation->result == 'tercapai' ? 'status-completed' : 'status-not-completed' }}">
                    {{ $case->evaluation->result == 'tercapai' ? 'Tujuan Tercapai' : 'Tujuan Belum Tercapai' }}
                </div>
            </div>

            @if($hasSOAP)
                <div class="soap-grid">
                    <div class="soap-item">
                        <div class="soap-label">S (Subjective)</div>
                        <div class="soap-content">{{ $subjective ?? '-' }}</div>
                    </div>

                    <div class="soap-item">
                        <div class="soap-label">O (Objective)</div>
                        <div class="soap-content">{{ $objective ?? '-' }}</div>
                    </div>

                    <div class="soap-item">
                        <div class="soap-label">A (Assessment)</div>
                        <div class="soap-content">{{ $assessment ?? '-' }}</div>
                    </div>

                    <div class="soap-item">
                        <div class="soap-label">P (Plan)</div>
                        <div class="soap-content">{{ $plan ?? '-' }}</div>
                    </div>
                </div>
            @else
                <p>{{ $case->evaluation->notes ?: 'Tidak ada detail evaluasi SOAP' }}</p>
            @endif
        @else
            <div style="text-align: center; padding: 30px 0;">
                <p style="color: #6c757d; font-style: italic;">Belum ada evaluasi yang dilakukan</p>
            </div>
        @endif
    </div>
</div>

    <div class="footer">
        <div class="signature-block">
            <div class="sign-date">Tanggal: {{ now()->format('d F Y') }}</div>
            <div class="sign-name">AskepPro</div>
        </div>
        <div class="clearfix"></div>
    </div>

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, sans-serif", "normal");
                    $size = 10;
                    $pageText = "Halaman " . $PAGE_NUM . " dari " . $PAGE_COUNT;
                    $y = 15;
                    $x = 520;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
    </script>
</body>

</html>
