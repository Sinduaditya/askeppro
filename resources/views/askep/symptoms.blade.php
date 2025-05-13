<!-- filepath: e:\Joki\upi_joki\AskepPro\askeppro\resources\views\askep\symptoms.blade.php -->
@extends('layouts.app')

@section('title', 'Pilih Gejala Pasien')

@section('styles')
    <style>
        /* Page Layout */
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
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .page-subtitle {
            opacity: 0.9;
            margin-bottom: 0;
            font-weight: 400;
            position: relative;
            z-index: 2;
        }

        /* Progress Bar */
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

        .progress-step.active .step-number {
            background: #1e88e5;
            border-color: #1e88e5;
            color: white;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.2);
        }

        .progress-step.active .step-label {
            color: #1e88e5;
        }

        .progress-step.completed .step-number {
            background: #4caf50;
            border-color: #4caf50;
            color: white;
        }

        /* Search and Filter */
        .search-container {
            margin-bottom: 1.5rem;
        }

        .search-input {
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.15);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.1rem;
            opacity: 0.7;
        }

        /* Symptoms Cards */
        .symptoms-container {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 0.5rem;
            margin-bottom: 1.5rem;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .symptoms-container::-webkit-scrollbar {
            width: 6px;
        }

        .symptoms-container::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .symptoms-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .symptoms-container::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .symptoms-category {
            position: sticky;
            top: 0;
            background: #f8fafc;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
            z-index: 10;
        }

        .symptom-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.2s;
        }

        .symptom-item:last-child {
            border-bottom: none;
        }

        .symptom-item:hover {
            background-color: #f8fafc;
        }

        .symptom-code {
            font-weight: 600;
            margin-right: 0.5rem;
            color: #1e88e5;
        }

        /* Custom Checkbox */
        .custom-checkbox {
            display: flex;
            align-items: flex-start;
            cursor: pointer;
            user-select: none;
        }

        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            height: 22px;
            width: 22px;
            min-width: 22px;
            border: 2px solid #cbd5e1;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            transition: all 0.2s;
            position: relative;
            top: 1px;
        }

        .custom-checkbox:hover .checkmark {
            border-color: #1e88e5;
            background-color: #f0f7ff;
        }

        .custom-checkbox input:checked~.checkmark {
            background-color: #1e88e5;
            border-color: #1e88e5;
        }

        .checkmark:after {
            content: '';
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked~.checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .symptom-label {
            line-height: 1.4;
        }

        /* Selected Symptoms Summary */
        .selected-symptoms {
            background: #f8fafc;
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .selected-count {
            font-weight: 600;
            color: #334155;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .count-badge {
            background: #1e88e5;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 0.75rem;
        }

        .selected-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .symptom-pill {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 0.35rem 0.75rem;
            font-size: 0.875rem;
            color: #334155;
            display: inline-flex;
            align-items: center;
        }

        .remove-symptom {
            margin-left: 0.5rem;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #f1f5f9;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 0.7rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .remove-symptom:hover {
            background: #fee2e2;
            color: #ef4444;
        }

        /* Action Buttons */
        .buttons-container {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
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

        /* Patient Info Card */
        .patient-card {
            background: white;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .patient-info {
            display: flex;
            align-items: center;
        }

        .patient-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            font-weight: 600;
            color: white;
            margin-right: 1rem;
        }

        .patient-avatar.male {
            background: linear-gradient(135deg, #2196f3, #1565c0);
        }

        .patient-avatar.female {
            background: linear-gradient(135deg, #f06292, #c2185b);
        }

        .patient-name {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.25rem;
        }

        .patient-record {
            font-size: 0.875rem;
            color: #64748b;
        }

        /* Responsive adjustments */
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

        /* Sembunyikan filter kategori */
        .filter-container {
            display: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="page-container">
            <!-- Page Header -->
            <div class="page-header fade-in">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="page-title">Pilih Tanda dan Gejala</h1>
                        <p class="page-subtitle">Identifikasi tanda dan gejala yang dialami pasien untuk menentukan diagnosis
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
                <div class="progress-step active">
                    <div class="step-number">2</div>
                    <div class="step-label">Tanda & Gejala</div>
                </div>
                <div class="progress-step">
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
                <div class="col-lg-4">
                    <!-- Patient Info -->
                    <div class="patient-card fade-in delay-1">
                        <div class="patient-info">
                            <div class="patient-avatar {{ $patient->gender == 'male' ? 'male' : 'female' }}">
                                {{ substr($patient->name, 0, 1) }}
                            </div>
                            <div>
                                <h5 class="patient-name">{{ $patient->name }}</h5>
                                <div class="patient-record">
                                    <i class="fas fa-fingerprint me-1"></i> {{ $patient->medical_record_number ?? 'Belum ada nomor rekam medis' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Selected Symptoms -->
                    <div class="selected-symptoms fade-in delay-2">
                        <div class="selected-count">
                            <div class="count-badge" id="selectedCount">0</div>
                            <span>Tanda & Gejala Terpilih</span>
                        </div>
                        <div class="selected-pills" id="selectedSymptoms">
                            <div class="text-muted" id="emptySelection">Belum ada gejala yang dipilih</div>
                        </div>
                    </div>

                    <form action="{{ route('askep.storeSymptoms') }}" method="POST" id="symptomsForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <input type="hidden" name="symptoms[]" value="" disabled id="dummy-symptom">

                        <div class="buttons-container fade-in delay-3">
                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                                <i class="fas fa-stethoscope"></i>Lanjut ke Diagnosis
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-8">
                    <!-- Search Input -->
                    <div class="search-container position-relative fade-in delay-2">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" id="searchSymptoms"
                            placeholder="Cari tanda dan gejala...">
                    </div>

                    <!-- Symptoms List -->
                    <div class="symptoms-container fade-in delay-3">
                        <div class="symptoms-category">
                            <i class="fas fa-list-ul me-2"></i>Daftar Tanda dan Gejala
                        </div>

                        @foreach ($symptoms as $symptom)
                            <div class="symptom-item">
                                <label class="custom-checkbox">
                                    <input type="checkbox" name="symptoms[]" value="{{ $symptom->id }}"
                                        id="symptom{{ $symptom->id }}" class="symptom-checkbox">
                                    <span class="checkmark"></span>
                                    <span class="symptom-label">
                                        <span class="symptom-code">{{ $symptom->code }}</span>
                                        {{ $symptom->name }}
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.symptom-checkbox');
            const selectedCount = document.getElementById('selectedCount');
            const selectedSymptoms = document.getElementById('selectedSymptoms');
            const emptySelection = document.getElementById('emptySelection');
            const searchInput = document.getElementById('searchSymptoms');
            const symptomItems = document.querySelectorAll('.symptom-item');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('symptomsForm');

            // Handle checkbox changes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectedSymptoms();
                    filterSymptoms();
                });
            });

            // Handle search input if it exists
            if (searchInput) {
                searchInput.addEventListener('input', filterSymptoms);
            }

            function updateSelectedSymptoms() {
                const selected = Array.from(checkboxes).filter(cb => cb.checked);
                selectedCount.textContent = selected.length;

                // Enable/disable submit button
                submitBtn.disabled = selected.length === 0;

                // Update pills display
                selectedSymptoms.innerHTML = '';

                if (selected.length === 0) {
                    selectedSymptoms.appendChild(emptySelection);
                    return;
                }

                selected.forEach(item => {
                    const symptomId = item.id.replace('symptom', '');
                    const symptomText = item.closest('label').querySelector('.symptom-label').textContent
                        .trim();
                    const pillElement = document.createElement('div');
                    pillElement.className = 'symptom-pill';
                    pillElement.dataset.id = symptomId;
                    pillElement.innerHTML = `
                    ${symptomText}
                    <span class="remove-symptom" data-id="${symptomId}">
                        <i class="fas fa-times"></i>
                    </span>
                `;
                    selectedSymptoms.appendChild(pillElement);
                });

                // Add event listeners to remove pills
                document.querySelectorAll('.remove-symptom').forEach(removeBtn => {
                    removeBtn.addEventListener('click', function() {
                        const id = this.dataset.id;
                        document.getElementById('symptom' + id).checked = false;
                        updateSelectedSymptoms();
                        filterSymptoms();
                    });
                });
            }

            function filterSymptoms() {
                const searchTerm = searchInput && searchInput.value ? searchInput.value.toLowerCase() : '';

                symptomItems.forEach(item => {
                    const symptomText = item.querySelector('.symptom-label').textContent.toLowerCase();
                    const isSearchMatch = searchTerm === '' || symptomText.includes(searchTerm);

                    if (isSearchMatch) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            // Add form submission handler
            form.addEventListener('submit', function(event) {
                // Prevent the default submission initially
                event.preventDefault();

                // Check if at least one symptom is selected
                const selectedSymptoms = Array.from(checkboxes).filter(cb => cb.checked);

                if (selectedSymptoms.length === 0) {
                    alert('Silahkan pilih minimal satu gejala');
                    return false;
                }

                // Clear any previously added hidden fields
                const oldHiddenFields = document.querySelectorAll('.temp-symptom-field');
                oldHiddenFields.forEach(field => field.remove());

                // Add selected symptoms as hidden fields to the form
                selectedSymptoms.forEach(symptom => {
                    const hiddenField = document.createElement('input');
                    hiddenField.type = 'hidden';
                    hiddenField.name = 'symptoms[]';
                    hiddenField.value = symptom.value;
                    hiddenField.className = 'temp-symptom-field';
                    form.appendChild(hiddenField);
                });

                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                submitBtn.disabled = true;

                // Now submit the form with the added hidden fields
                form.submit();
            });

            // Initialize
            updateSelectedSymptoms();
        });
    </script>
@endsection
