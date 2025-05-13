<!-- filepath: e:\Joki\upi_joki\AskepPro\askeppro\resources\views\askep\diagnosis.blade.php -->
@extends('layouts.app')

@section('title', 'Diagnosis Keperawatan - AskepPro')

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
            align-items: center;
            box-shadow: 0 3px 10px rgba(13, 110, 253, 0.05);
        }

        .alert-info i {
            font-size: 1.25rem;
            margin-right: 0.75rem;
        }

        /* Diagnosis Cards */
        .diagnosis-list {
            margin-bottom: 2rem;
        }

        .diagnosis-card {
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            position: relative;
            border: none;
        }

        .diagnosis-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
        }

        .diagnosis-match {
            background-color: #f0fdf4;
            border-left: 5px solid #4ade80;
            box-shadow: 0 3px 10px rgba(74, 222, 128, 0.15);
        }

        .diagnosis-partial {
            background-color: #fefce8;
            border-left: 5px solid #facc15;
            box-shadow: 0 3px 10px rgba(250, 204, 21, 0.15);
        }

        .card-body {
            padding: 1.25rem !important;
        }

        .diagnosis-code {
            font-weight: 700;
            color: #1e88e5;
            margin-bottom: 0.25rem;
        }

        .diagnosis-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        .match-badge {
            font-weight: 700;
            font-size: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 30px;
        }

        .match-success {
            background-color: #d1fadf;
            color: #166534;
        }

        .match-warning {
            background-color: #fef9c3;
            color: #854d0e;
        }

        .diagnosis-details {
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            padding: 0.75rem;
        }

        .match-status {
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .match-status i {
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        .symptoms-list {
            margin-top: 0.75rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            max-height: 60px;
            overflow: hidden;
            position: relative;
            transition: max-height 0.3s;
        }

        .symptoms-list.expanded {
            max-height: 500px;
        }

        .symptom-badge {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            color: #334155;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            white-space: nowrap;
        }

        .symptom-matched {
            background-color: #dcfce7;
            border-color: #86efac;
            color: #166534;
        }

        .symptom-unmatched {
            opacity: 0.6;
        }

        .show-more {
            color: #1e88e5;
            font-weight: 500;
            cursor: pointer;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            margin-top: 0.25rem;
        }

        .show-more i {
            margin-left: 0.25rem;
            transition: transform 0.3s;
        }

        .show-more.active i {
            transform: rotate(180deg);
        }

        /* Selection Controls */
        .selection-controls {
            background-color: white;
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            border: 1px solid #e2e8f0;
        }

        .form-check-input {
            width: 1.25em;
            height: 1.25em;
            margin-top: 0.15em;
        }

        .form-check-input:checked {
            background-color: #1e88e5;
            border-color: #1e88e5;
        }

        .form-check-label {
            font-weight: 500;
            margin-left: 0.25rem;
        }

        .primary-diagnosis-radio:disabled+.form-check-label {
            opacity: 0.6;
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

        /* Sidebar */
        .sidebar-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
            position: sticky;
            top: 1rem;
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

        .selected-diagnosis {
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .selected-diagnosis:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .selected-code {
            font-weight: 600;
            color: #1e88e5;
            font-size: 0.875rem;
        }

        .selected-name {
            font-weight: 500;
            color: #334155;
        }

        .primary-badge {
            font-size: 0.75rem;
            background: #1e88e5;
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 20px;
            margin-left: 0.5rem;
            font-weight: 600;
        }

        /* Empty state */
        .empty-selection {
            text-align: center;
            padding: 1.5rem;
            color: #64748b;
        }

        .empty-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #cbd5e1;
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
                position: static;
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
                            <div class="step-circle">3</div>
                            Diagnosis Keperawatan
                        </h1>
                        <p class="page-subtitle">Pilih satu atau beberapa diagnosis berdasarkan tanda & gejala yang dipilih
                        </p>
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
                <div class="progress-step active">
                    <div class="step-number">3</div>
                    <div class="step-label">Diagnosis</div>
                </div>
                <div class="progress-step">
                    <div class="step-number">4</div>
                    <div class="step-label">Luaran</div>
                </div>
                <div class="progress-step">
                    <div class="step-number">5</div>
                    <div class="step-label">Intervensi</div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="alert alert-info mb-4 fade-in delay-2">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            <strong>Diagnosis Keperawatan</strong><br>
                            Anda dapat memilih lebih dari satu diagnosis untuk pasien ini. Pilih salah satu sebagai
                            diagnosis utama.
                        </div>
                    </div>

                    <form action="{{ route('askep.saveDiagnosis', $case->id) }}" method="POST" id="diagnosisForm">
                        @csrf
                        <div class="diagnosis-list">
                            @foreach ($results as $result)
                                <div class="diagnosis-card mb-4 fade-in delay-2 {{ $result['status'] == 'memenuhi' ? 'diagnosis-match' : 'diagnosis-partial' }}"
                                    id="diagnosis-card-{{ $result['diagnosis']->id }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <div class="diagnosis-code">{{ $result['diagnosis']->code }}</div>
                                                <div class="diagnosis-name">{{ $result['diagnosis']->name }}</div>
                                            </div>
                                            <div
                                                class="match-badge {{ $result['status'] == 'memenuhi' ? 'match-success' : 'match-warning' }}">
                                                {{ number_format($result['percent'], 0) }}% Cocok
                                            </div>
                                        </div>

                                        <div class="diagnosis-details mb-3">
                                            <div class="match-status">
                                                <i
                                                    class="fas {{ $result['status'] == 'memenuhi' ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-warning' }}"></i>
                                                {{ $result['status'] == 'memenuhi' ? 'Memenuhi kriteria diagnosis' : 'Sebagian memenuhi kriteria' }}
                                                <span class="ms-2 text-secondary small">
                                                    ({{ $result['matched'] }}/{{ $result['total'] }} gejala utama)
                                                </span>
                                            </div>

                                            <div class="symptoms-list mt-3"
                                                id="symptoms-list-{{ $result['diagnosis']->id }}">
                                                @foreach ($result['symptoms']['matched'] as $symptom)
                                                    <span class="symptom-badge symptom-matched">
                                                        <i class="fas fa-check-circle me-1"></i>
                                                        {{ $symptom }}
                                                    </span>
                                                @endforeach

                                                @foreach ($result['symptoms']['unmatched'] as $symptom)
                                                    <span class="symptom-badge symptom-unmatched">
                                                        <i class="fas fa-times-circle me-1"></i>
                                                        {{ $symptom }}
                                                    </span>
                                                @endforeach
                                            </div>

                                            @if (count($result['symptoms']['matched']) + count($result['symptoms']['unmatched']) > 3)
                                                <div class="show-more" id="show-more-{{ $result['diagnosis']->id }}">
                                                    Lihat semua gejala <i class="fas fa-chevron-down"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="selection-controls">
                                            <!-- Checkbox untuk memilih diagnosis -->
                                            <div class="form-check me-4">
                                                <input class="form-check-input diagnosis-checkbox" type="checkbox"
                                                    name="diagnosis_ids[]" value="{{ $result['diagnosis']->id }}"
                                                    id="diag{{ $result['diagnosis']->id }}">
                                                <label class="form-check-label" for="diag{{ $result['diagnosis']->id }}">
                                                    Pilih diagnosis ini
                                                </label>
                                            </div>

                                            <!-- Radio untuk diagnosis primer -->
                                            <div class="form-check">
                                                <input class="form-check-input primary-diagnosis-radio" type="radio"
                                                    name="primary_diagnosis" value="{{ $result['diagnosis']->id }}"
                                                    id="primary{{ $result['diagnosis']->id }}" disabled>
                                                <label class="form-check-label"
                                                    for="primary{{ $result['diagnosis']->id }}">
                                                    Jadikan diagnosis utama
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-card fade-in delay-2">
                        <div class="sidebar-header">
                            <h5 class="sidebar-title">
                                <i class="fas fa-clipboard-list"></i>
                                Diagnosis Terpilih
                            </h5>
                        </div>
                        <div class="sidebar-body" id="selected-diagnosis-container">
                            <div class="empty-selection" id="empty-selection">
                                <div class="empty-icon">
                                    <i class="fas fa-clipboard"></i>
                                </div>
                                <p>Belum ada diagnosis yang dipilih</p>
                                <small class="text-muted">Pilih satu atau lebih diagnosis dari daftar</small>
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
                                <strong>No. RM:</strong>
                                {{ $case->patient->medical_record_number ?? 'Belum ada nomor rekam medis' }}
                            </div>
                            <div class="mb-3">
                                <strong>Jenis Kelamin:</strong>
                                {{ $case->patient->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                            <div class="mb-3">
                                <strong>Tanda & Gejala:</strong>
                                <span class="badge bg-primary">{{ count($case->symptoms) }} dipilih</span>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" form="diagnosisForm" class="btn btn-primary" id="submitBtn" disabled>
                                    <i class="fas fa-check-circle"></i> Simpan & Lanjutkan
                                </button>
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
            const checkboxes = document.querySelectorAll('.diagnosis-checkbox');
            const radioInputs = document.querySelectorAll('.primary-diagnosis-radio');
            const submitBtn = document.getElementById('submitBtn');
            const selectedContainer = document.getElementById('selected-diagnosis-container');
            const emptySelection = document.getElementById('empty-selection');

            // Event handler untuk show more/less gejala
            document.querySelectorAll('.show-more').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.id.replace('show-more-', '');
                    const symptomsList = document.getElementById('symptoms-list-' + id);

                    symptomsList.classList.toggle('expanded');

                    if (symptomsList.classList.contains('expanded')) {
                        this.innerHTML = 'Sembunyikan gejala <i class="fas fa-chevron-up"></i>';
                        this.classList.add('active');
                    } else {
                        this.innerHTML = 'Lihat semua gejala <i class="fas fa-chevron-down"></i>';
                        this.classList.remove('active');
                    }
                });
            });

            // Fungsi untuk update state dari radio button
            function updateRadioState() {
                let anyChecked = false;

                checkboxes.forEach(checkbox => {
                    const diagId = checkbox.value;
                    const radio = document.getElementById('primary' + diagId);
                    const card = document.getElementById('diagnosis-card-' + diagId);

                    if (checkbox.checked) {
                        anyChecked = true;
                        radio.disabled = false;
                        card.classList.add('selected');
                    } else {
                        radio.disabled = true;
                        radio.checked = false;
                        card.classList.remove('selected');
                    }
                });

                // Jika hanya ada satu checkbox yang dicentang, otomatis pilih sebagai primary
                if (anyChecked) {
                    const checked = document.querySelectorAll('.diagnosis-checkbox:checked');
                    if (checked.length === 1) {
                        const diagId = checked[0].value;
                        const radio = document.getElementById('primary' + diagId);
                        radio.checked = true;
                    }
                }

                updateSelectedDiagnoses();

                // Update submit button state
                updateSubmitButtonState();
            }

            // Function to enable/disable submit button
            function updateSubmitButtonState() {
                const anyChecked = document.querySelectorAll('.diagnosis-checkbox:checked').length > 0;
                const anyRadioChecked = document.querySelectorAll('.primary-diagnosis-radio:checked').length > 0;

                submitBtn.disabled = !(anyChecked && anyRadioChecked);
            }

            // Function to update the selected diagnoses sidebar
            function updateSelectedDiagnoses() {
                const selectedCheckboxes = document.querySelectorAll('.diagnosis-checkbox:checked');
                const primaryDiagnosis = document.querySelector('.primary-diagnosis-radio:checked');

                // Clear previous content
                selectedContainer.innerHTML = '';

                if (selectedCheckboxes.length === 0) {
                    selectedContainer.appendChild(emptySelection);
                    return;
                }

                // Add each selected diagnosis to the sidebar
                selectedCheckboxes.forEach(checkbox => {
                    const diagId = checkbox.value;
                    const diagCard = document.getElementById('diagnosis-card-' + diagId);
                    const diagCode = diagCard.querySelector('.diagnosis-code').textContent;
                    const diagName = diagCard.querySelector('.diagnosis-name').textContent;
                    const isPrimary = primaryDiagnosis && primaryDiagnosis.value === diagId;

                    const diagElement = document.createElement('div');
                    diagElement.className = 'selected-diagnosis';
                    diagElement.innerHTML = `
                    <div class="selected-code">${diagCode}</div>
                    <div class="selected-name">
                        ${diagName}
                        ${isPrimary ? '<span class="primary-badge">Utama</span>' : ''}
                    </div>
                `;

                    selectedContainer.appendChild(diagElement);
                });
            }

            // Event listener untuk checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateRadioState);
            });

            // Event listener untuk radio button
            radioInputs.forEach(radio => {
                radio.addEventListener('change', function() {
                    updateSubmitButtonState();
                    updateSelectedDiagnoses();
                });
            });

            // Form validation before submit
            document.getElementById('diagnosisForm').addEventListener('submit', function(e) {
                const anyChecked = document.querySelectorAll('.diagnosis-checkbox:checked').length > 0;
                const anyRadioChecked = document.querySelectorAll('.primary-diagnosis-radio:checked')
                    .length > 0;

                if (!anyChecked || !anyRadioChecked) {
                    e.preventDefault();
                    alert('Pilih minimal satu diagnosis dan tentukan diagnosis utama');
                }
            });

            // Highlight selected card
            function addCardSelectionEffect() {
                document.querySelectorAll('.diagnosis-card').forEach(card => {
                    card.addEventListener('click', function(e) {
                        // Ignore clicks on form elements
                        if (e.target.type === 'checkbox' || e.target.type === 'radio' ||
                            e.target.tagName === 'LABEL' || e.target.closest('.show-more')) {
                            return;
                        }

                        // Find the checkbox in this card and toggle it
                        const checkbox = this.querySelector('.diagnosis-checkbox');
                        checkbox.checked = !checkbox.checked;
                        checkbox.dispatchEvent(new Event('change'));
                    });
                });
            }

            // Initialize
            updateRadioState();
            addCardSelectionEffect();
        });
    </script>
@endsection
