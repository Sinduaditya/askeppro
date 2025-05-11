@extends('layouts.app')

@section('title', 'Evaluasi Asuhan Keperawatan')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Evaluasi Asuhan Keperawatan</h5>
                <span class="badge bg-primary">Tahap 6/6</span>
            </div>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-info-circle fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading">Diagnosis dan Penyebab</h5>
                        <p class="mb-0"><strong>Diagnosis Utama:</strong> {{ $case->diagnosis->code }} - {{ $case->diagnosis->name }}</p>
                        <p class="mb-0"><strong>Penyebab:</strong> {{ $case->cause ?? 'Belum ditentukan' }}</p>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Evaluasi Format SOAP</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('askep.saveEvaluation', $case->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="evaluation_time" class="form-label">Waktu Evaluasi</label>
                            <input type="text" class="form-control" id="evaluation_time" name="evaluation_time"
                                placeholder="Contoh: 08.00 WIB" value="{{ now()->format('H:i') }} WIB" required>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="20%">ELEMEN</th>
                                        <th>EVALUASI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label for="subjective" class="form-label mb-0">S (Subjective)</label>
                                            <div class="small text-muted">Keluhan pasien</div>
                                        </td>
                                        <td>
                                            <textarea class="form-control" id="subjective" name="subjective" rows="2"
                                                placeholder="Contoh: &quot;Nyerinya sekarang tinggal sedikit, Bu.&quot;"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="objective" class="form-label mb-0">O (Objective)</label>
                                            <div class="small text-muted">Hasil pengamatan</div>
                                        </td>
                                        <td>
                                            <textarea class="form-control" id="objective" name="objective" rows="2"
                                                placeholder="Contoh: Skala nyeri 3/10, pasien tampak rileks."></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="assessment" class="form-label mb-0">A (Assessment)</label>
                                            <div class="small text-muted">Evaluasi kondisi pasien</div>
                                        </td>
                                        <td>
                                            <textarea class="form-control" id="assessment" name="assessment" rows="2"
                                                placeholder="Contoh: Nyeri berkurang, intervensi efektif."></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="plan" class="form-label mb-0">P (Plan)</label>
                                            <div class="small text-muted">Rencana tindak lanjut</div>
                                        </td>
                                        <td>
                                            <textarea class="form-control" id="plan" name="plan" rows="2"
                                                placeholder="Contoh: Lanjutkan kompres tiap 4 jam. Evaluasi ulang sore hari."></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Evaluasi Luaran Keperawatan</h6>
                            </div>
                            <div class="card-body">
                                @if($case->outcomes->isEmpty())
                                    <p class="text-muted">Belum ada luaran yang didefinisikan</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Luaran</th>
                                                    <th width="15%">Nilai Awal</th>
                                                    <th width="15%">Target Nilai</th>
                                                    <th width="15%">Hasil Akhir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($case->outcomes as $outcome)
                                                    <tr>
                                                        <td>{{ $outcome->name }}</td>
                                                        <td class="text-center">
                                                            <span class="badge bg-secondary">{{ $outcome->initial_value }}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge bg-info">{{ $outcome->target_value }}</span>
                                                        </td>
                                                        <td>
                                                            <select name="outcome_results[{{ $outcome->id }}]" class="form-select" required>
                                                                <option value="" disabled selected>Pilih</option>
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

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label d-block">Status Luaran <span class="text-danger">*</span></label>
                                                <div class="btn-group" role="group">
                                                    <input type="radio" class="btn-check" name="result" id="result_achieved" value="{{ \App\Models\Evaluation::RESULT_ACHIEVED }}" autocomplete="off" required>
                                                    <label class="btn btn-outline-success" for="result_achieved">
                                                        <i class="fas fa-check-circle me-2"></i>Tercapai
                                                    </label>

                                                    <input type="radio" class="btn-check" name="result" id="result_not_achieved" value="{{ \App\Models\Evaluation::RESULT_NOT_ACHIEVED }}" autocomplete="off">
                                                    <label class="btn btn-outline-warning" for="result_not_achieved">
                                                        <i class="fas fa-times-circle me-2"></i>Belum Tercapai
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('askep.implementation', $case->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Selesaikan Askep
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Catatan Implementasi Tindakan</h6>
                </div>
                <div class="card-body">
                    @if($case->implementations->isEmpty())
                        <p class="text-muted">Belum ada tindakan yang diimplementasikan</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tindakan</th>
                                        <th width="15%">Waktu</th>
                                        <th width="15%">Status</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($case->implementations as $implementation)
                                        <tr>
                                            <td>
                                                <div class="fw-bold">{{ $implementation->intervention->code }}</div>
                                                {{ $implementation->intervention->name }}
                                            </td>
                                            <td>{{ $implementation->waktu ?? '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $implementation->performed ? 'success' : 'secondary' }}">
                                                    {{ $implementation->performed ? 'Dilakukan' : 'Belum' }}
                                                </span>
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

            <!-- Format tampilan contoh evaluasi SOAP -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Contoh Format Evaluasi SOAP</h6>
                </div>
                <div class="card-body">
                    <h6>Evaluasi:</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%">WAKTU</th>
                                    <th width="20%">ELEMEN</th>
                                    <th width="65%">EVALUASI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="4">08.00 WIB</td>
                                    <td>S (Subjective)</td>
                                    <td>"Nyerinya sekarang tinggal sedikit, Bu."</td>
                                </tr>
                                <tr>
                                    <td>O (Objective)</td>
                                    <td>Skala nyeri 3/10, pasien tampak rileks.</td>
                                </tr>
                                <tr>
                                    <td>A (Assessment)</td>
                                    <td>Nyeri berkurang, intervensi efektif.</td>
                                </tr>
                                <tr>
                                    <td>P (Plan)</td>
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
@endsection
