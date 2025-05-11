@extends('layouts.app')

@section('title', 'Implementasi Tindakan Keperawatan')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Implementasi Tindakan Keperawatan</h5>
                    <span class="badge bg-primary">Tahap 5/6</span>
                </div>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('askep.saveImplementation', $case->id) }}" method="POST">
                    @csrf

                    @if ($case->implementations->isEmpty())
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Belum ada intervensi yang dipilih. Silakan kembali dan pilih intervensi terlebih dahulu.
                        </div>
                    @else
                        <h5 class="mb-3">Catat Implementasi Tindakan</h5>
                        <p class="text-muted mb-4">Centang tindakan yang telah dilakukan dan berikan catatan implementasi
                            bila perlu.</p>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="30%">Tindakan</th>
                                        <th width="15%">Waktu</th>
                                        <th width="10%">Status</th>
                                        <th width="40%">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($case->implementations as $index => $implementation)
                                        <input type="hidden" name="implementations[{{ $index }}][id]"
                                            value="{{ $implementation->intervention_id }}">
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="fw-bold">{{ $implementation->intervention->code }}</div>
                                                {{ $implementation->intervention->name }}
                                            </td>
                                            <td>
                                                <input type="text" name="implementations[{{ $index }}][waktu]"
                                                    class="form-control" value="{{ $implementation->waktu ?? '' }}"
                                                    placeholder="08.00 WIB">
                                            </td>
                                            <!-- Ubah bagian input checkbox seperti berikut -->
                                            <td class="text-center">
                                                <div class="form-check form-switch d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="implementations[{{ $index }}][performed]"
                                                        id="performed{{ $implementation->id }}" value="1"
                                                    {{ $implementation->performed ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="performed{{ $implementation->id }}">
                                                        <span
                                                            class="badge bg-{{ $implementation->performed ? 'success' : 'secondary' }} ms-2">
                                                            {{ $implementation->performed ? 'Dilakukan' : 'Belum' }}
                                                        </span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <textarea name="implementations[{{ $index }}][notes]" class="form-control" rows="2"
                                                    placeholder="Tambahkan catatan pelaksanaan...">{{ $implementation->notes }}</textarea>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('askep.intervention', $case->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        @if (!$case->implementations->isEmpty())
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan & Lanjutkan
                            </button>
                        @endif
                    </div>
                </form>

                <!-- Format tampilan contoh implementasi sesuai gambar -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Contoh Format Implementasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="15%">WAKTU</th>
                                        <th width="45%">TINDAKAN</th>
                                        <th width="40%">KETERANGAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>08.00 WIB</td>
                                        <td>Memberikan kompres hangat 15 menit</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>10.00 WIB</td>
                                        <td>Membimbing napas dalam</td>
                                        <td>-</td>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.form-check-input');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const label = this.nextElementSibling.querySelector('.badge');

                    if (this.checked) {
                        label.classList.remove('bg-secondary');
                        label.classList.add('bg-success');
                        label.textContent = 'Dilakukan';
                    } else {
                        label.classList.remove('bg-success');
                        label.classList.add('bg-secondary');
                        label.textContent = 'Belum';
                    }
                });
            });
        });
    </script>
@endsection
