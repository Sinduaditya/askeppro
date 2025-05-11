@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-container">
        <div class="row">
            <div class="col-12 mb-4">
                <h1 class="page-title fade-in">
                    <div class="step-circle">2</div>
                    Diagnosis Keperawatan
                </h1>
                <div class="page-subtitle fade-in delay-1">
                    Pilih satu atau beberapa diagnosis berdasarkan tanda & gejala yang dipilih
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10">
                <form action="{{ route('askep.saveDiagnosis', $case->id) }}" method="POST" id="diagnosisForm">
                    @csrf

                    <div class="alert alert-info mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        Anda dapat memilih lebih dari satu diagnosis untuk pasien ini. Pilih salah satu sebagai diagnosis utama.
                    </div>

                    <div class="diagnosis-list fade-in delay-2">
                        @foreach($results as $result)
                        <div class="diagnosis-card mb-3 {{ $result['status'] == 'memenuhi' ? 'diagnosis-match' : 'diagnosis-partial' }}">
                            <div class="card-body p-3">
                                <div class="form-check">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="diagnosis-code">{{ $result['diagnosis']->code }}</div>
                                            <div class="diagnosis-name">{{ $result['diagnosis']->name }}</div>
                                        </div>
                                        <div class="match-badge {{ $result['status'] == 'memenuhi' ? 'match-success' : 'match-warning' }}">
                                            {{ number_format($result['percent'], 0) }}%
                                        </div>
                                    </div>

                                    <div class="diagnosis-details mt-2">
                                        <div class="match-status">
                                            <i class="fas {{ $result['status'] == 'memenuhi' ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-warning' }}"></i>
                                            {{ $result['status'] == 'memenuhi' ? 'Memenuhi kriteria diagnosis' : 'Sebagian memenuhi kriteria' }}
                                        </div>
                                        <div class="symptoms-count mt-1">
                                            <small>Gejala utama terpenuhi: {{ $result['matched'] }}/{{ $result['total'] }}</small>
                                        </div>
                                    </div>

                                    <div class="mt-3 d-flex align-items-center">
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
                                            <label class="form-check-label" for="primary{{ $result['diagnosis']->id }}">
                                                Jadikan diagnosis utama
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="buttons-container fade-in delay-3 mt-4">
                        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                            <i class="fas fa-check-circle"></i> Simpan Diagnosis
                        </button>
                    </div>
                </form>
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

        // Fungsi untuk update state dari radio button
        function updateRadioState() {
            let anyChecked = false;

            checkboxes.forEach(checkbox => {
                const diagId = checkbox.value;
                const radio = document.getElementById('primary' + diagId);

                if (checkbox.checked) {
                    anyChecked = true;
                    radio.disabled = false;
                } else {
                    radio.disabled = true;
                    radio.checked = false;
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

            // Update submit button state
            updateSubmitButtonState();
        }

        // Function to enable/disable submit button
        function updateSubmitButtonState() {
            const anyChecked = document.querySelectorAll('.diagnosis-checkbox:checked').length > 0;
            const anyRadioChecked = document.querySelectorAll('.primary-diagnosis-radio:checked').length > 0;

            submitBtn.disabled = !(anyChecked && anyRadioChecked);
        }

        // Event listener untuk checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateRadioState);
        });

        // Event listener untuk radio button
        radioInputs.forEach(radio => {
            radio.addEventListener('change', updateSubmitButtonState);
        });

        // Inisialisasi state
        updateRadioState();
    });
</script>
@endsection
