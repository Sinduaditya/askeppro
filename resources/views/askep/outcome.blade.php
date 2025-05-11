@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tentukan Luaran Keperawatan (SLKI)</h5>
                    <span class="badge bg-primary">Tahap 3/6</span>
                </div>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('askep.saveOutcome', $case->id) }}" method="POST">
                    @csrf

                    @if (isset($diagnosisData) && count($diagnosisData) > 0)
                        @foreach ($diagnosisData as $diagnosisId => $data)
                            <div class="diagnosis-section mb-4">
                                <div class="alert {{ $data['is_primary'] ? 'alert-primary' : 'alert-info' }}">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-stethoscope fa-2x"></i>
                                        </div>
                                        <div>
                                            <h5 class="alert-heading">
                                                {{ $data['diagnosis']->code }} - {{ $data['diagnosis']->name }}
                                                @if ($data['is_primary'])
                                                    <span class="badge bg-primary ms-2">Diagnosis Utama</span>
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Pilih Penyebab / Faktor yang Berhubungan</label>
                                    <select name="diagnosis_etiology[{{ $diagnosisId }}]" class="form-select" required>
                                        <option value="">-- Pilih Penyebab --</option>
                                        @foreach ($data['etiologies'] as $etiology)
                                            <option value="{{ $etiology->id }}">{{ $etiology->description }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <h6 class="mt-4 mb-3">Luaran Keperawatan untuk {{ $data['diagnosis']->name }}</h6>

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%">Pilih</th>
                                                <th>Luaran Keperawatan</th>
                                                <th width="15%">Nilai Awal</th>
                                                <th width="15%">Target Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['outcomes'] as $index => $outcome)
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input outcome-checkbox" type="checkbox"
                                                                name="outcome_ids[{{ $diagnosisId }}][]"
                                                                value="{{ $outcome->id }}"
                                                                id="outcome_{{ $diagnosisId }}_{{ $outcome->id }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="outcome_{{ $diagnosisId }}_{{ $outcome->id }}">
                                                            {{ $outcome->name }}
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <select name="initial_values[{{ $diagnosisId }}][]"
                                                            class="form-select outcome-select" disabled>
                                                            <option value="">-</option>
                                                            <option value="1">1 - Menurun</option>
                                                            <option value="2">2 - Cukup Menurun</option>
                                                            <option value="3">3 - Sedang</option>
                                                            <option value="4">4 - Cukup Meningkat</option>
                                                            <option value="5">5 - Meningkat</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="target_values[{{ $diagnosisId }}][]"
                                                            class="form-select outcome-select" disabled>
                                                            <option value="">-</option>
                                                            <option value="1">1 - Menurun</option>
                                                            <option value="2">2 - Cukup Menurun</option>
                                                            <option value="3">3 - Sedang</option>
                                                            <option value="4">4 - Cukup Meningkat</option>
                                                            <option value="5">5 - Meningkat</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Tidak ada diagnosis yang dipilih. Silakan kembali dan pilih diagnosis terlebih dahulu.
                        </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('askep.diagnosis', $case->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        @if (isset($diagnosisData) && count($diagnosisData) > 0)
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i> Simpan & Lanjutkan
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk meng-enable/disable dropdown selects
            const toggleSelects = function(checkbox) {
                const row = checkbox.closest('tr');
                const selects = row.querySelectorAll('.outcome-select');

                selects.forEach(select => {
                    select.disabled = !checkbox.checked;
                    if (checkbox.checked) {
                        select.required = true;
                    } else {
                        select.required = false;
                        select.value = "";
                    }
                });
            };

            // Event listener untuk checkboxes
            document.querySelectorAll('.outcome-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    toggleSelects(this);
                });
            });

            // Form validation before submit
            document.getElementById('submitBtn')?.addEventListener('click', function(e) {
                let isValid = false;

                // Check if at least one outcome is selected for each diagnosis
                document.querySelectorAll('.diagnosis-section').forEach(section => {
                    const checkboxes = section.querySelectorAll('.outcome-checkbox:checked');
                    if (checkboxes.length > 0) {
                        isValid = true;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Pilih minimal satu luaran keperawatan untuk setiap diagnosis');
                }
            });
        });
    </script>
@endsection
