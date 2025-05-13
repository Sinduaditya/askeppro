<!-- filepath: e:\Joki\upi_joki\AskepPro\askeppro\resources\views\askep\evaluation.blade.php -->
@extends('layouts.app')

@section('title', 'Evaluasi Asuhan Keperawatan - AskepPro')

@section('styles')
    <style>
        /* Base Layout & Container */
        .page-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header Styling */
        .page-header {
            background: linear-gradient(135deg, #1e88e5 0%, #5e35b1 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            color: white;
            box-shadow: 0 5px 15px rgba(30, 136, 229, 0.2);
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 80%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(-30deg);
            pointer-events: none;
            z-index: 1;
        }

        .page-title {
            display: flex;
            align-items: center;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .step-circle {
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 1rem;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .page-subtitle {
            opacity: 0.9;
            margin-bottom: 0;
            font-weight: 400;
            position: relative;
            z-index: 2;
            padding-left: 3.5rem;
        }

        /* Progress Tracker */
        .progress-tracker {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .progress-tracker::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #e2e8f0;
            transform: translateY(-50%);
        }

        .progress-step {
            position: relative;
            z-index: 1;
            padding: 0 0.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .step-number {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            margin-bottom: 0.5rem;
            border: 2px solid #e2e8f0;
            color: #64748b;
        }

        .step-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #64748b;
        }

        .progress-step.completed .step-number {
            background: #4caf50;
            border-color: #4caf50;
            color: white;
        }

        .progress-step.active .step-number {
            background: #1e88e5;
            border-color: #1e88e5;
            color: white;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.2);
        }

        .progress-step.active .step-label {
            color: #1e88e5;
        }

        /* Card Styling */
        .evaluation-card {
            background: #ffffff;
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .evaluation-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header-custom {
            background: #f8fafc;
            padding: 1.25rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title-custom {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0;
            display: flex;
            align-items: center;
        }

        .card-title-custom i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            color: #1e88e5;
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        .card-info {
            background: #ebf5ff;
            border-left: 4px solid #3b82f6;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        /* Info Alert */
        .alert-info-custom {
            background-color: #e7f3fd;
            border-left: 5px solid #1e88e5;
            color: #0c63e4;
            border-radius: 10px;
            padding: 1.25rem;
            display: flex;
            align-items: flex-start;
            box-shadow: 0 3px 10px rgba(13, 110, 253, 0.05);
            margin-bottom: 1.5rem;
        }

        .alert-info-custom i {
            font-size: 1.5rem;
            margin-right: 1rem;
            margin-top: 0.25rem;
        }

        .alert-info-custom h5 {
            color: #0c63e4;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .alert-info-custom p {
            margin-bottom: 0.25rem;
        }

        /* Table Styling */
        .table-custom {
            width: 100%;
            margin-bottom: 1.5rem;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .table-custom th {
            background: #f8fafc;
            color: #334155;
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-custom td {
            padding: 1rem;
            vertical-align: top;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Form Elements */
        .form-label-custom {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-text-custom {
            color: #64748b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-control-custom {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control-custom:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.15);
            outline: none;
        }

        .form-select-custom {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-select-custom:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.15);
            outline: none;
        }

        /* Badges */
        .badge-custom {
            padding: 0.5rem 0.85rem;
            font-weight: 600;
            font-size: 0.75rem;
            border-radius: 30px;
        }

        .badge-primary {
            background-color: #e7f3fd;
            color: #1e88e5;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-warning {
            background-color: #fef9c3;
            color: #854d0e;
        }

        .badge-secondary {
            background-color: #f1f5f9;
            color: #64748b;
        }

        .badge-value {
            display: inline-block;
            width: 28px;
            height: 28px;
            line-height: 28px;
            text-align: center;
            border-radius: 50%;
            font-weight: 600;
        }

        .badge-value-1 {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .badge-value-2 {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-value-3 {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .badge-value-4 {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-value-5 {
            background-color: #c7d2fe;
            color: #4338ca;
        }

        /* Button Styling */
        .btn-custom {
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }

        .btn-custom i {
            margin-right: 0.5rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #1e88e5 0%, #5e35b1 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 10px rgba(30, 136, 229, 0.2);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30, 136, 229, 0.3);
            color: white;
        }

        .btn-outline-secondary-custom {
            border: 1px solid #cbd5e1;
            background: transparent;
            color: #64748b;
        }

        .btn-outline-secondary-custom:hover {
            background: #f8fafc;
            color: #334155;
            border-color: #94a3b8;
        }

        /* Radio buttons styled as toggle buttons */
        .radio-button-group {
            display: flex;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 0 0 1px #e2e8f0;
        }

        .radio-button-label {
            background-color: white;
            color: #64748b;
            padding: 0.75rem 1.25rem;
            text-align: center;
            margin: 0;
            transition: background 0.3s, color 0.3s;
            cursor: pointer;
            border-right: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .radio-button-label:last-child {
            border-right: none;
        }

        .radio-button-label i {
            margin-right: 0.5rem;
        }

        .radio-button-input {
            display: none;
        }

        .radio-button-input:checked+.radio-button-label.achieved {
            background-color: #4caf50;
            color: white;
        }

        .radio-button-input:checked+.radio-button-label.not-achieved {
            background-color: #ff9800;
            color: white;
        }

        .radio-button-input:checked+.radio-button-label.partial {
            background-color: #2196f3;
            color: white;
        }

        /* Example Card */
        .example-card {
            background-color: #f8fafc;
            border-radius: 10px;
            border: 1px dashed #cbd5e1;
            margin-top: 1.5rem;
        }

        .example-header {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px dashed #cbd5e1;
        }

        .example-icon {
            background-color: rgba(30, 136, 229, 0.1);
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e88e5;
            margin-right: 0.75rem;
        }

        .example-title {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.4s ease forwards;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        .delay-3 {
            animation-delay: 0.3s;
        }

        /* Responsive */
        @media (max-width: 767.98px) {
            .page-header {
                padding: 1.25rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .progress-tracker {
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }

            .progress-step {
                min-width: 80px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.75rem;
            }

            .action-buttons .btn-custom {
                width: 100%;
                justify-content: center;
            }
        }

        /* Add hover feedback to form elements */
        .form-control-custom:hover,
        .form-select-custom:hover {
            border-color: #cbd5e1;
        }

        /* Visual indicator for required fields */
        .required-indicator {
            color: #ef4444;
            margin-left: 0.25rem;
        }

        /* SOAP labels styling */
        .soap-label {
            font-weight: 600;
            color: #1e88e5;
            display: block;
            margin-bottom: 0.25rem;
        }

        /* Implementation status */
        .implementation-status {
            display: flex;
            align-items: center;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 0.5rem;
        }

        .status-done {
            background-color: #4caf50;
        }

        .status-pending {
            background-color: #9ca3af;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="page-container">
            <!-- Page Header -->
            <div class="page-header fade-in">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-title">
                            <div class="step-circle">7</div>
                            Evaluasi Asuhan Keperawatan
                        </h1>
                        <p class="page-subtitle">Evaluasi hasil intervensi dan status luaran keperawatan</p>
                    </div>
                </div>
            </div>

            <!-- Progress Tracker -->
            <div class="progress-tracker fade-in delay-1">
                <div class="progress-step completed">
                    <div class="step-number">1</div>
                    <div class="step-label">Pasien</div>
                </div>
                <div class="progress-step completed">
                    <div class="step-number">2</div>
                    <div class="step-label">Tanda & Gejala</div>
                </div>
                <div class="progress-step completed">
                    <div class="step-number">3</div>
                    <div class="step-label">Diagnosis</div>
                </div>
                <div class="progress-step completed">
                    <div class="step-number">4</div>
                    <div class="step-label">Luaran</div>
                </div>
                <div class="progress-step completed">
                    <div class="step-number">5</div>
                    <div class="step-label">Intervensi</div>
                </div>
                <div class="progress-step completed">
                    <div class="step-number">6</div>
                    <div class="step-label">Implementasi</div>
                </div>
                <div class="progress-step active">
                    <div class="step-number">7</div>
                    <div class="step-label">Evaluasi</div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Info Alert -->
                    <div class="alert-info-custom fade-in delay-2">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            <h5>Diagnosis dan Penyebab</h5>
                            <p><strong>Diagnosis Utama:</strong> {{ $case->diagnosis->code }} - {{ $case->diagnosis->name }}
                            </p>
                            <p><strong>Penyebab:</strong> {{ $case->cause ?? 'Belum ditentukan' }}</p>
                        </div>
                    </div>

                    <!-- SOAP Evaluation Form -->
                    <div class="evaluation-card fade-in delay-2">
                        <div class="card-header-custom">
                            <h5 class="card-title-custom">
                                <i class="fas fa-notes-medical"></i>
                                Evaluasi Format SOAP
                            </h5>
                            <span class="badge-custom badge-primary">Tahap Final</span>
                        </div>
                        <div class="card-body-custom">
                            <form action="{{ route('askep.saveEvaluation', $case->id) }}" method="POST"
                                id="evaluationForm">
                                @csrf

                                <div class="mb-4">
                                    <label for="evaluation_time" class="form-label-custom">
                                        Waktu Evaluasi <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-custom" id="evaluation_time"
                                            name="evaluation_time" placeholder="Contoh: 08.00 WIB"
                                            value="{{ now()->format('H:i') }} WIB" required>
                                    </div>
                                </div>

                                <div class="table-responsive mb-4">
                                    <table class="table-custom">
                                        <thead>
                                            <tr>
                                                <th width="20%">ELEMEN</th>
                                                <th>EVALUASI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="subjective" class="soap-label">S (Subjective)</label>
                                                    <div class="form-text-custom">Keluhan pasien</div>
                                                </td>
                                                <td>
                                                    <textarea class="form-control form-control-custom" id="subjective" name="subjective" rows="2"
                                                        placeholder="Contoh: &quot;Nyerinya sekarang tinggal sedikit, Bu.&quot;"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="objective" class="soap-label">O (Objective)</label>
                                                    <div class="form-text-custom">Hasil pengamatan</div>
                                                </td>
                                                <td>
                                                    <textarea class="form-control form-control-custom" id="objective" name="objective" rows="2"
                                                        placeholder="Contoh: Skala nyeri 3/10, pasien tampak rileks."></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="assessment" class="soap-label">A (Assessment)</label>
                                                    <div class="form-text-custom">Evaluasi kondisi pasien</div>
                                                </td>
                                                <td>
                                                    <textarea class="form-control form-control-custom" id="assessment" name="assessment" rows="2"
                                                        placeholder="Contoh: Nyeri berkurang, intervensi efektif."></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="plan" class="soap-label">P (Plan)</label>
                                                    <div class="form-text-custom">Rencana tindak lanjut</div>
                                                </td>
                                                <td>
                                                    <textarea class="form-control form-control-custom" id="plan" name="plan" rows="2"
                                                        placeholder="Contoh: Lanjutkan kompres tiap 4 jam. Evaluasi ulang sore hari."></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Outcome Evaluation -->
                                <div class="evaluation-card mb-4">
                                    <div class="card-header-custom">
                                        <h5 class="card-title-custom">
                                            <i class="fas fa-chart-line"></i>
                                            Evaluasi Luaran Keperawatan
                                        </h5>
                                    </div>
                                    <div class="card-body-custom">
                                        @if ($case->outcomes->isEmpty())
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                Belum ada luaran yang didefinisikan
                                            </div>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table-custom">
                                                    <thead>
                                                        <tr>
                                                            <th>Luaran Keperawatan</th>
                                                            <th width="15%" class="text-center">Nilai Awal</th>
                                                            <th width="15%" class="text-center">Target</th>
                                                            <th width="20%" class="text-center">Hasil Akhir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($case->outcomes as $outcome)
                                                            <tr>
                                                                <td>
                                                                    <div class="fw-semibold">{{ $outcome->name }}</div>
                                                                </td>
                                                                <td class="text-center">
                                                                    <span
                                                                        class="badge-value badge-value-{{ $outcome->initial_value }}">
                                                                        {{ $outcome->initial_value }}
                                                                    </span>
                                                                </td>
                                                                <td class="text-center">
                                                                    <span
                                                                        class="badge-value badge-value-{{ $outcome->target_value }}">
                                                                        {{ $outcome->target_value }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <select name="outcome_results[{{ $outcome->id }}]"
                                                                        class="form-select-custom" required>
                                                                        <option value="" disabled selected>Pilih
                                                                            hasil</option>
                                                                        <option value="1">1 - Sangat Buruk</option>
                                                                        <option value="2">2 - Buruk</option>
                                                                        <option value="3">3 - Cukup</option>
                                                                        <option value="4">4 - Baik</option>
                                                                        <option value="5">5 - Sangat Baik</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mt-4">
                                                <label class="form-label-custom">Status Luaran <span
                                                        class="required-indicator">*</span></label>
                                                <div class="radio-button-group">
                                                    <input type="radio" class="radio-button-input" name="result"
                                                        id="result_achieved" value="tercapai" required>
                                                    <label class="radio-button-label achieved" for="result_achieved">
                                                        <i class="fas fa-check-circle"></i> Tercapai
                                                    </label>

                                                    <input type="radio" class="radio-button-input" name="result"
                                                        id="result_partial" value="tercapai sebagian">
                                                    <label class="radio-button-label partial" for="result_partial">
                                                        <i class="fas fa-adjust"></i> Tercapai Sebagian
                                                    </label>

                                                    <input type="radio" class="radio-button-input" name="result"
                                                        id="result_not_achieved" value="belum tercapai">
                                                    <label class="radio-button-label not-achieved"
                                                        for="result_not_achieved">
                                                        <i class="fas fa-times-circle"></i> Belum Tercapai
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('askep.implementation', $case->id) }}"
                                        class="btn-custom btn-outline-secondary-custom">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn-custom btn-primary-custom">
                                        <i class="fas fa-save"></i> Selesaikan Askep
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <!-- Implementation Notes -->
                    <div class="evaluation-card fade-in delay-3">
                        <div class="card-header-custom">
                            <h5 class="card-title-custom">
                                <i class="fas fa-clipboard-list"></i>
                                Catatan Implementasi Tindakan
                            </h5>
                        </div>
                        <div class="card-body-custom">
                            @if ($case->implementations->isEmpty())
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Belum ada tindakan yang diimplementasikan
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table-custom">
                                        <thead>
                                            <tr>
                                                <th>Tindakan</th>
                                                <th width="15%">Waktu</th>
                                                <th width="15%" class="text-center">Status</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($case->implementations as $implementation)
                                                <tr>
                                                    <td>
                                                        <div class="fw-bold text-primary">
                                                            {{ $implementation->intervention->code }}</div>
                                                        <div>{{ $implementation->intervention->name }}</div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        @if ($implementation->waktu)
                                                            <i class="fas fa-clock me-1 text-muted"></i>
                                                            {{ $implementation->waktu }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="implementation-status">
                                                            <div
                                                                class="status-dot {{ $implementation->performed ? 'status-done' : 'status-pending' }}">
                                                            </div>
                                                            <span
                                                                class="badge-custom {{ $implementation->performed ? 'badge-success' : 'badge-secondary' }}">
                                                                {{ $implementation->performed ? 'Dilakukan' : 'Belum' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $implementation->notes ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- SOAP Example Card -->
                    <div class="example-card fade-in delay-3">
                        <div class="example-header">
                            <div class="example-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h6 class="example-title">Contoh Format Evaluasi SOAP</h6>
                        </div>
                        <div class="card-body-custom">
                            <div class="table-responsive">
                                <table class="table-custom">
                                    <thead>
                                        <tr>
                                            <th width="15%">WAKTU</th>
                                            <th width="20%">ELEMEN</th>
                                            <th width="65%">EVALUASI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="4">08.00 WIB</td>
                                            <td><span class="soap-label">S (Subjective)</span></td>
                                            <td>"Nyerinya sekarang tinggal sedikit, Bu."</td>
                                        </tr>
                                        <tr>
                                            <td><span class="soap-label">O (Objective)</span></td>
                                            <td>Skala nyeri 3/10, pasien tampak rileks.</td>
                                        </tr>
                                        <tr>
                                            <td><span class="soap-label">A (Assessment)</span></td>
                                            <td>Nyeri berkurang, intervensi efektif.</td>
                                        </tr>
                                        <tr>
                                            <td><span class="soap-label">P (Plan)</span></td>
                                            <td>Lanjutkan kompres tiap 4 jam. Evaluasi ulang sore hari.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const form = document.getElementById('evaluationForm');

            form.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredElements = form.querySelectorAll('[required]');

                requiredElements.forEach(el => {
                    if (!el.value.trim()) {
                        isValid = false;
                        el.classList.add('is-invalid');

                        // Add error feedback if it doesn't exist
                        if (!el.nextElementSibling || !el.nextElementSibling.classList.contains(
                                'invalid-feedback')) {
                            const feedback = document.createElement('div');
                            feedback.classList.add('invalid-feedback');
                            feedback.textContent = 'Bagian ini harus diisi';
                            el.parentNode.insertBefore(feedback, el.nextElementSibling);
                        }
                    } else {
                        el.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();

                    // Scroll to the first invalid element
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.focus();
                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });

            // Clear validation errors when user starts typing
            form.querySelectorAll('input, textarea, select').forEach(el => {
                el.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                });
            });

            // Add tooltip hint on hover for rating values
            const ratingValues = {
                "1": "Sangat Buruk - Memerlukan intervensi segera",
                "2": "Buruk - Jauh dari target yang diharapkan",
                "3": "Cukup - Masih memerlukan pengawasan",
                "4": "Baik - Mendekati target yang diharapkan",
                "5": "Sangat Baik - Target tercapai sepenuhnya"
            };

            document.querySelectorAll('.badge-value').forEach(badge => {
                const value = badge.textContent.trim();
                badge.title = ratingValues[value] || "";
            });

            // Make outcome result selects show colors based on selection
            document.querySelectorAll('select[name^="outcome_results"]').forEach(select => {
                select.addEventListener('change', function() {
                    const value = this.value;

                    // Remove all existing classes
                    this.classList.remove('bg-value-1', 'bg-value-2', 'bg-value-3', 'bg-value-4',
                        'bg-value-5');

                    // Add the appropriate class
                    if (value) {
                        this.classList.add(`bg-value-${value}`);
                    }

                    // Auto select result status based on outcomes
                    updateResultStatus();
                });
            });

            function updateResultStatus() {
                // Don't auto-select if user has already made a choice
                if (document.querySelector('.radio-button-input:checked')) return;

                const selects = document.querySelectorAll('select[name^="outcome_results"]');
                let allFilled = true;
                let totalValue = 0;
                let targetTotal = 0;

                selects.forEach(select => {
                    if (!select.value) {
                        allFilled = false;
                        return;
                    }

                    const outcomeId = select.name.match(/\[(\d+)\]/)[1];
                    const targetBadge = select.closest('tr').querySelector(
                    '.badge-value-5'); // Assuming 5 is highest
                    const targetValue = targetBadge ? parseInt(targetBadge.textContent.trim()) : 5;

                    totalValue += parseInt(select.value);
                    targetTotal += targetValue;
                });

                if (allFilled) {
                    const percentage = (totalValue / targetTotal) * 100;

                    if (percentage >= 90) {
                        document.getElementById('result_achieved').checked = true;
                    } else if (percentage >= 50) {
                        document.getElementById('result_partial').checked = true;
                    } else {
                        document.getElementById('result_not_achieved').checked = true;
                    }
                }
            }

            // Add this style to make select highlight based on value
            document.head.insertAdjacentHTML('beforeend', `
            <style>
                .bg-value-1 { background-color: #fee2e2 !important; color: #b91c1c; }
                .bg-value-2 { background-color: #fef3c7 !important; color: #92400e; }
                .bg-value-3 { background-color: #f3f4f6 !important; color: #4b5563; }
                .bg-value-4 { background-color: #d1fae5 !important; color: #065f46; }
                .bg-value-5 { background-color: #c7d2fe !important; color: #4338ca; }

                .is-invalid {
                    border-color: #ef4444 !important;
                    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
                    background-repeat: no-repeat;
                    background-position: right calc(0.375em + 0.1875rem) center;
                    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
                }

                .invalid-feedback {
                    display: block;
                    width: 100%;
                    margin-top: 0.25rem;
                    font-size: 0.875em;
                    color: #ef4444;
                }
            </style>
        `);
        });
    </script>
@endsection
