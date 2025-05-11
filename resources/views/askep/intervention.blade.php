@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Intervensi Keperawatan (SIKI)</h5>
                <span class="badge bg-primary">Tahap 4/6</span>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('askep.saveIntervention', $case->id) }}" method="POST">
                @csrf

                @if(isset($diagnosisData) && count($diagnosisData) > 0)
                    @foreach($diagnosisData as $diagnosisId => $data)
                        <div class="diagnosis-section mb-4">
                            <div class="alert {{ $data['is_primary'] ? 'alert-primary' : 'alert-info' }}">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-stethoscope fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="alert-heading">
                                            {{ $data['diagnosis']->code }} - {{ $data['diagnosis']->name }}
                                            @if($data['is_primary'])
                                                <span class="badge bg-primary ms-2">Diagnosis Utama</span>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <h6 class="mb-3">Pilih Intervensi untuk {{ $data['diagnosis']->name }}</h6>

                            <div class="table-responsive mb-4">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">Pilih</th>
                                            <th width="15%">Kode</th>
                                            <th>Intervensi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['interventions'] as $intervention)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="diagnosis_interventions[{{ $diagnosisId }}][]"
                                                            value="{{ $intervention->id }}"
                                                            id="intervention_{{ $diagnosisId }}_{{ $intervention->id }}"
                                                            {{ in_array($intervention->id, $data['selected_interventions']) ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td>{{ $intervention->code }}</td>
                                                <td>
                                                    <label for="intervention_{{ $diagnosisId }}_{{ $intervention->id }}">
                                                        {{ $intervention->name }}
                                                        @if($intervention->description)
                                                            <p class="text-muted small mb-0">{{ $intervention->description }}</p>
                                                        @endif
                                                    </label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('askep.outcome', $case->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan & Lanjutkan
                        </button>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Tidak ditemukan diagnosis yang dipilih. Silakan kembali ke langkah sebelumnya.
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('askep.diagnosis', $case->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Diagnosis
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Kode JavaScript tambahan jika diperlukan
});
</script>
@endsection
