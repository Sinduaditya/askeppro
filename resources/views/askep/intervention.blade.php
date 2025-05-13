<!-- filepath: e:\Joki\upi_joki\AskepPro\askeppro\resources\views\askep\intervention.blade.php -->
@extends('layouts.app')

@section('title', 'Intervensi Keperawatan - AskepPro')

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

    /* Info Alert */
    .alert-info {
        background-color: #e7f3fd;
        border-left: 5px solid #1e88e5;
        color: #0c63e4;
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        align-items: flex-start;
        box-shadow: 0 3px 10px rgba(13, 110, 253, 0.05);
    }

    .alert-info i {
        font-size: 1.25rem;
        margin-right: 0.75rem;
        margin-top: 0.25rem;
    }

    /* Diagnosis Cards */
    .diagnosis-card {
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 2rem;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .diagnosis-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .diagnosis-card.primary {
        border-top: 4px solid #1e88e5;
    }

    .diagnosis-card.secondary {
        border-top: 4px solid #6c757d;
    }

    .diagnosis-header {
        padding: 1.25rem;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .diagnosis-title {
        display: flex;
        align-items: center;
    }

    .diagnosis-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.5rem;
    }

    .primary .diagnosis-icon {
        background: rgba(30, 136, 229, 0.1);
        color: #1e88e5;
    }

    .secondary .diagnosis-icon {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }

    .diagnosis-name {
        margin: 0;
        font-weight: 600;
        color: #334155;
    }

    .diagnosis-code {
        color: #64748b;
        margin: 0.25rem 0 0 0;
        font-size: 0.9rem;
    }

    .diagnosis-badge {
        align-self: flex-start;
        padding: 0.35rem 0.75rem;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: auto;
    }

    .badge-primary {
        background: #e7f3fd;
        color: #1e88e5;
    }

    /* Interventions Container */
    .interventions-container {
        padding: 1.5rem;
    }

    .interventions-title {
        font-weight: 600;
        color: #334155;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .interventions-title i {
        margin-right: 0.75rem;
        color: #1e88e5;
    }

    /* Interventions Table */
    .interventions-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 1rem;
    }

    .interventions-table th {
        background: #f8fafc;
        color: #334155;
        font-weight: 600;
        text-align: left;
        padding: 1rem;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }

    .interventions-table th:first-child {
        border-left: 1px solid #e2e8f0;
        border-top-left-radius: 10px;
    }

    .interventions-table th:last-child {
        border-right: 1px solid #e2e8f0;
        border-top-right-radius: 10px;
    }

    .interventions-table td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .interventions-table tr:last-child td {
        border-bottom: 1px solid #e2e8f0;
    }

    .interventions-table tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
        border-left: 1px solid #e2e8f0;
    }

    .interventions-table tr:last-child td:last-child {
        border-bottom-right-radius: 10px;
        border-right: 1px solid #e2e8f0;
    }

    .interventions-table td:not(:last-child) {
        border-right: 1px solid #f1f5f9;
    }

    .interventions-table tr:hover td {
        background-color: #f8fafc;
    }

    .interventions-table tr.selected td {
        background-color: #f0f7ff;
    }

    /* Custom Checkbox */
    .custom-checkbox-container {
        position: relative;
        height: 24px;
        width: 24px;
        margin: 0 auto;
    }

    .custom-checkbox {
        height: 24px;
        width: 24px;
        min-width: 24px;
        border: 2px solid #cbd5e1;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }

    .custom-checkbox:hover {
        border-color: #1e88e5;
        background-color: #f0f7ff;
    }

    .intervention-checkbox {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .custom-checkbox .checkmark {
        display: none;
        color: white;
        font-size: 0.8rem;
    }

    .intervention-checkbox:checked ~ .custom-checkbox {
        background-color: #1e88e5;
        border-color: #1e88e5;
    }

    .intervention-checkbox:checked ~ .custom-checkbox .checkmark {
        display: block;
    }

    /* Intervention Details */
    .intervention-name {
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.25rem;
        cursor: pointer;
    }

    .intervention-code {
        font-weight: 600;
        color: #1e88e5;
        font-size: 0.9rem;
    }

    .intervention-description {
        color: #64748b;
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

    /* Sidebar */
    .sidebar-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 1.5rem;
        border: 1px solid #e2e8f0;
    }

    .sidebar-header {
        background: #f8fafc;
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .sidebar-title {
        font-weight: 600;
        color: #334155;
        margin-bottom: 0;
        display: flex;
        align-items: center;
    }

    .sidebar-title i {
        margin-right: 0.5rem;
        color: #1e88e5;
    }

    .sidebar-body {
        padding: 1rem;
    }

    .selected-count {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1rem;
        background: #f1f5f9;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .count-label {
        font-weight: 500;
        color: #334155;
    }

    .count-value {
        font-weight: 600;
        color: #1e88e5;
    }

    /* Action Buttons */
    .buttons-container {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #e2e8f0;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s;
    }

    .btn i {
        margin-right: 0.5rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #1e88e5 0%, #5e35b1 100%);
        border: none;
        color: white;
        box-shadow: 0 5px 15px rgba(30, 136, 229, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 136, 229, 0.3);
    }

    .btn-primary:disabled {
        opacity: 0.7;
        transform: none;
        cursor: not-allowed;
    }

    .btn-outline-secondary {
        border: 1px solid #cbd5e1;
        background: transparent;
        color: #64748b;
    }

    .btn-outline-secondary:hover {
        background: #f8fafc;
        color: #334155;
        border-color: #94a3b8;
    }

    /* Buttons in sidebar */
    .d-grid .btn {
        margin-bottom: 0.5rem;
        justify-content: center;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        color: #64748b;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        color: #cbd5e1;
    }

    .empty-title {
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
    }

    .empty-message {
        max-width: 300px;
        margin: 0 auto;
    }

    /* Filter Controls */
    .filter-controls {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

    .search-container {
        flex-grow: 1;
        position: relative;
    }

    .search-container i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        font-size: 0.95rem;
    }

    .search-input:focus {
        outline: none;
        border-color: #1e88e5;
        box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.15);
    }

    .filter-button {
        padding: 0.75rem 1.25rem;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        color: #334155;
        font-weight: 600;
        display: flex;
        align-items: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .filter-button i {
        margin-right: 0.5rem;
    }

    .filter-button:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }

    .select-all-btn {
        background: #e7f3fd;
        color: #1e88e5;
        border-color: #bfdbfe;
    }

    .select-all-btn:hover {
        background: #dbeafe;
        border-color: #93c5fd;
    }

    /* Animations */
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

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .sidebar-card {
            margin-top: 2rem;
        }
    }

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
            margin-bottom: 1rem;
        }

        .progress-step {
            min-width: 75px;
        }

        .buttons-container {
            flex-direction: column;
            gap: 0.75rem;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .filter-controls {
            flex-direction: column;
            align-items: stretch;
        }
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
                        <div class="step-circle">5</div>
                        Intervensi Keperawatan
                    </h1>
                    <p class="page-subtitle">Pilih intervensi yang sesuai untuk setiap diagnosis keperawatan</p>
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
            <div class="progress-step active">
                <div class="step-number">5</div>
                <div class="step-label">Intervensi</div>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger fade-in delay-2 mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(isset($diagnosisData) && count($diagnosisData) > 0)
            <div class="row">
                <div class="col-lg-9">
                    <div class="alert alert-info mb-4 fade-in delay-2">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            <strong>Tentukan Intervensi Keperawatan</strong><br>
                            Pilih minimal satu intervensi untuk setiap diagnosis. Intervensi ini akan menjadi panduan tindakan keperawatan Anda.
                        </div>
                    </div>

                    <form action="{{ route('askep.saveIntervention', $case->id) }}" method="POST" id="interventionForm">
                        @csrf

                        @foreach($diagnosisData as $diagnosisId => $data)
                            <div class="diagnosis-card mb-4 fade-in delay-2 {{ $data['is_primary'] ? 'primary' : 'secondary' }}"
                                 id="diagnosis-section-{{ $diagnosisId }}">

                                <div class="diagnosis-header">
                                    <div class="diagnosis-title">
                                        <div class="diagnosis-icon">
                                            <i class="fas fa-stethoscope"></i>
                                        </div>
                                        <div>
                                            <h5 class="diagnosis-name">{{ $data['diagnosis']->name }}</h5>
                                            <p class="diagnosis-code">{{ $data['diagnosis']->code }}</p>
                                        </div>
                                        @if ($data['is_primary'])
                                            <span class="diagnosis-badge badge-primary">Diagnosis Utama</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="interventions-container">
                                    <div class="filter-controls mb-3">
                                        <div class="search-container">
                                            <i class="fas fa-search"></i>
                                            <input type="text" class="search-input"
                                                placeholder="Cari intervensi..."
                                                data-diagnosis="{{ $diagnosisId }}"
                                                aria-label="Cari intervensi">
                                        </div>
                                        <button type="button" class="filter-button select-all-btn" data-diagnosis="{{ $diagnosisId }}">
                                            <i class="fas fa-check-square"></i>
                                            Pilih Semua
                                        </button>
                                    </div>

                                    <h6 class="interventions-title">
                                        <i class="fas fa-clipboard-list"></i>
                                        Intervensi untuk {{ $data['diagnosis']->name }}
                                    </h6>

                                    <div class="table-responsive">
                                        <table class="interventions-table" id="intervention-table-{{ $diagnosisId }}">
                                            <thead>
                                                <tr>
                                                    <th width="5%" class="text-center">Pilih</th>
                                                    <th width="15%">Kode</th>
                                                    <th>Intervensi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data['interventions'] as $intervention)
                                                    <tr class="{{ in_array($intervention->id, $data['selected_interventions']) ? 'selected' : '' }}"
                                                        data-intervention="{{ $intervention->id }}">
                                                        <td class="text-center">
                                                            <label class="custom-checkbox-container">
                                                                <input class="intervention-checkbox" type="checkbox"
                                                                    name="diagnosis_interventions[{{ $diagnosisId }}][]"
                                                                    value="{{ $intervention->id }}"
                                                                    data-diagnosis="{{ $diagnosisId }}"
                                                                    id="intervention_{{ $diagnosisId }}_{{ $intervention->id }}"
                                                                    {{ in_array($intervention->id, $data['selected_interventions']) ? 'checked' : '' }}>
                                                                <div class="custom-checkbox">
                                                                    <i class="fas fa-check checkmark"></i>
                                                                </div>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <span class="intervention-code">
                                                                {{ $intervention->code }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="intervention-name">
                                                                {{ $intervention->name }}
                                                            </div>
                                                            @if($intervention->description)
                                                                <p class="intervention-description">
                                                                    {{ $intervention->description }}
                                                                </p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="buttons-container fade-in delay-3">
                            <a href="{{ route('askep.outcome', $case->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Luaran
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save"></i> Simpan & Lanjutkan
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-3">
                    <div class="sidebar-card fade-in delay-2">
                        <div class="sidebar-header">
                            <h5 class="sidebar-title">
                                <i class="fas fa-clipboard-check"></i>
                                Ringkasan
                            </h5>
                        </div>
                        <div class="sidebar-body">
                            <div class="mb-3">
                                <div class="selected-count">
                                    <div class="count-label">Diagnosis</div>
                                    <div class="count-value">{{ count($diagnosisData) }}</div>
                                </div>
                                <div class="selected-count">
                                    <div class="count-label">Intervensi dipilih</div>
                                    <div class="count-value" id="selectedInterventionsCount">0</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" form="interventionForm" class="btn btn-primary" id="sidebarSubmitBtn">
                                    <i class="fas fa-save"></i> Simpan & Lanjutkan
                                </button>
                                <a href="{{ route('askep.outcome', $case->id) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-card fade-in delay-3">
                        <div class="sidebar-header">
                            <h5 class="sidebar-title">
                                <i class="fas fa-user-injured"></i>
                                Informasi Pasien
                            </h5>
                        </div>
                        <div class="sidebar-body">
                            <div class="mb-3">
                                <strong>Nama:</strong> {{ $case->patient->name }}
                            </div>
                            <div class="mb-3">
                                <strong>No. RM:</strong> {{ $case->patient->medical_record_number ?? 'Belum ada nomor rekam medis' }}
                            </div>
                            <div class="mb-3">
                                <strong>Jenis Kelamin:</strong>
                                {{ $case->patient->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state fade-in delay-2">
                <div class="empty-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h4 class="empty-title">Tidak Ada Diagnosis</h4>
                <p class="empty-message">Belum ada diagnosis yang dipilih. Silakan kembali ke langkah sebelumnya.</p>
                <a href="{{ route('askep.diagnosis', $case->id) }}" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Diagnosis
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selected interventions counter
    const selectedInterventionsCount = document.getElementById('selectedInterventionsCount');
    const submitBtn = document.getElementById('submitBtn');
    const sidebarSubmitBtn = document.getElementById('sidebarSubmitBtn');
    const checkboxes = document.querySelectorAll('.intervention-checkbox');

    // Fungsi untuk mengupdate counter
    function updateSelectedCount() {
        const selectedCount = document.querySelectorAll('.intervention-checkbox:checked').length;
        if (selectedInterventionsCount) {
            selectedInterventionsCount.textContent = selectedCount;
        }

        // Validasi per diagnosis section
        const diagnosisSections = document.querySelectorAll('.diagnosis-card');
        let allValid = true;

        diagnosisSections.forEach(section => {
            const diagnosisId = section.id.replace('diagnosis-section-', '');
            const diagnosisCheckboxes = section.querySelectorAll('.intervention-checkbox:checked');

            if (diagnosisCheckboxes.length === 0) {
                allValid = false;
                section.classList.add('diagnosis-error');
            } else {
                section.classList.remove('diagnosis-error');
            }
        });

        if (submitBtn) submitBtn.disabled = !allValid;
        if (sidebarSubmitBtn) sidebarSubmitBtn.disabled = !allValid;
    }

    // Add event listeners to checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Highlight row when selected
            const row = this.closest('tr');
            if (this.checked) {
                row.classList.add('selected');
            } else {
                row.classList.remove('selected');
            }

            updateSelectedCount();
        });
    });

    // Make row clickable to select checkbox
    document.querySelectorAll('.interventions-table tr').forEach(row => {
        row.addEventListener('click', function(e) {
            // Skip if clicked on checkbox
            if (e.target.tagName === 'INPUT' ||
                e.target.closest('.custom-checkbox')) {
                return;
            }

            const checkbox = this.querySelector('.intervention-checkbox');
            if (checkbox) {
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event('change'));
            }
        });
    });

    // Search functionality
    document.querySelectorAll('.search-input').forEach(searchInput => {
        searchInput.addEventListener('input', function() {
            const diagnosisId = this.getAttribute('data-diagnosis');
            const tableId = 'intervention-table-' + diagnosisId;
            const table = document.getElementById(tableId);

            if (!table) return;

            const searchTerm = this.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('.intervention-name').textContent.toLowerCase();
                const code = row.querySelector('.intervention-code').textContent.toLowerCase();
                const description = row.querySelector('.intervention-description')?.textContent.toLowerCase() || '';

                if (name.includes(searchTerm) || code.includes(searchTerm) || description.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    // Select all functionality
    document.querySelectorAll('.select-all-btn').forEach(button => {
        button.addEventListener('click', function() {
            const diagnosisId = this.getAttribute('data-diagnosis');
            const section = document.getElementById('diagnosis-section-' + diagnosisId);

            if (!section) return;

            const checkboxes = section.querySelectorAll('.intervention-checkbox:not(:checked)');
            const isSelecting = checkboxes.length > 0;

            if (isSelecting) {
                // Select all visible checkboxes (not hidden by search)
                section.querySelectorAll('.intervention-checkbox').forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    if (row.style.display !== 'none') {
                        checkbox.checked = true;
                        row.classList.add('selected');
                    }
                });

                this.innerHTML = '<i class="fas fa-times-square"></i> Hapus Semua';
                this.classList.remove('select-all-btn');
                this.classList.add('filter-button', 'clear-all-btn');
            } else {
                // Deselect all
                section.querySelectorAll('.intervention-checkbox:checked').forEach(checkbox => {
                    checkbox.checked = false;
                    checkbox.closest('tr').classList.remove('selected');
                });

                this.innerHTML = '<i class="fas fa-check-square"></i> Pilih Semua';
                this.classList.add('select-all-btn');
                this.classList.remove('clear-all-btn');
            }

            updateSelectedCount();
        });
    });

    // Form validation before submit
    document.getElementById('interventionForm')?.addEventListener('submit', function(e) {
        const diagnosisSections = document.querySelectorAll('.diagnosis-card');
        let isValid = true;
        let firstInvalidSection = null;

        diagnosisSections.forEach(section => {
            const diagnosisName = section.querySelector('.diagnosis-name').textContent;
            const checkboxes = section.querySelectorAll('.intervention-checkbox:checked');

            if (checkboxes.length === 0) {
                isValid = false;
                if (!firstInvalidSection) firstInvalidSection = section;

                section.classList.add('diagnosis-error');
                showToast(`Pilih minimal satu intervensi untuk diagnosis "${diagnosisName}"`, 'error');
            }
        });

        if (!isValid) {
            e.preventDefault();

            if (firstInvalidSection) {
                firstInvalidSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    // Helper function to show toast notifications
    function showToast(message, type = 'info') {
        // Check if toastr is available
        if (typeof toastr !== 'undefined') {
            toastr[type](message);
        } else {
            alert(message);
        }
    }

    // Initialize the counter
    updateSelectedCount();

    // Add diagnosis-error class styling
    document.head.insertAdjacentHTML('beforeend', `
        <style>
            .diagnosis-error {
                box-shadow: 0 0 0 2px #ef4444 !important;
            }
            .diagnosis-error .diagnosis-header {
                background-color: #fee2e2;
            }
        </style>
    `);
});
</script>
@endsection
