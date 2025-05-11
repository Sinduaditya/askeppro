@extends('layouts.app')

@section('title', 'Edit Data Pasien')

@section('styles')
<style>
    /* Modern Header Section */
    .page-header {
        background: linear-gradient(135deg, #1e88e5 0%, #5e35b1 100%);
        border-radius: 15px;
        padding: 1.75rem;
        margin-bottom: 2rem;
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

    .page-header .row {
        position: relative;
        z-index: 2;
    }

    .page-title {
        font-weight: 700;
        position: relative;
        margin-bottom: 0.5rem;
    }

    .patient-record-badge {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        font-size: 0.9rem;
    }

    .patient-record-badge i {
        margin-right: 0.5rem;
        opacity: 0.8;
    }

    /* Form Card */
    .form-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        background: white;
        margin-bottom: 2rem;
    }

    .form-header {
        padding: 1.5rem 1.75rem;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
    }

    .form-header-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(30, 136, 229, 0.1), rgba(94, 53, 177, 0.1));
        color: #5e35b1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-right: 1rem;
    }

    .form-body {
        padding: 1.75rem;
    }

    /* Form Controls */
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #374151;
        font-size: 0.95rem;
    }

    .form-label-icon {
        margin-right: 0.5rem;
        opacity: 0.7;
    }

    .form-control, .form-select {
        padding: 0.75rem 1rem;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        font-size: 1rem;
        box-shadow: none;
        transition: all 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #1e88e5;
        box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.15);
        outline: none;
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #ff5252;
        box-shadow: none;
    }

    .form-control.is-invalid:focus, .form-select.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(255, 82, 82, 0.15);
    }

    .required-indicator {
        color: #ff5252;
        margin-left: 0.15rem;
    }

    .form-text {
        font-size: 0.85rem;
        color: #6B7280;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
    }

    .form-text i {
        margin-right: 0.4rem;
        color: #5e35b1;
    }

    .invalid-feedback {
        margin-top: 0.5rem;
        font-size: 0.85rem;
        color: #ff5252;
        display: flex;
        align-items: flex-start;
    }

    .invalid-feedback i {
        margin-right: 0.4rem;
        margin-top: 0.2rem;
        flex-shrink: 0;
    }

    /* Custom Alert */
    .alert-custom {
        border: none;
        border-radius: 15px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
    }

    .alert-danger {
        background-color: rgba(255, 82, 82, 0.1);
        color: #e53935;
    }

    .alert-icon {
        margin-right: 1rem;
        font-size: 1.5rem;
        line-height: 1;
    }

    .alert-content {
        flex: 1;
    }

    .alert-heading {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    /* Button Styling */
    .buttons-container {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
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
        font-size: 1rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #1e88e5 0%, #5e35b1 100%);
        border: none;
        box-shadow: 0 5px 15px rgba(30, 136, 229, 0.25);
    }

    .btn-primary:hover, .btn-primary:focus {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 136, 229, 0.35);
    }

    .btn-outline-secondary {
        border: 1px solid #dee2e6;
        color: #64748b;
        background: transparent;
    }

    .btn-outline-secondary:hover {
        background: #f5f7fa;
        color: #334155;
        border-color: #c4c9d0;
    }

    .btn-danger {
        background: linear-gradient(135deg, #f44336, #d32f2f);
        border: none;
        box-shadow: 0 5px 15px rgba(244, 67, 54, 0.25);
    }

    .btn-danger:hover, .btn-danger:focus {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(244, 67, 54, 0.35);
    }

    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .page-header {
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .patient-record-badge {
            display: flex;
            margin-bottom: 0.5rem;
        }

        .form-body {
            padding: 1.25rem;
        }

        .buttons-container {
            flex-direction: column-reverse;
        }

        .buttons-container .btn {
            width: 100%;
            justify-content: center;
        }

        .page-header .col-md-6:last-child {
            margin-top: 0.75rem;
        }
    }

    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
        animation: fadeIn 0.5s ease forwards;
    }

    .delay-1 {
        animation-delay: 0.1s;
    }

    .delay-2 {
        animation-delay: 0.2s;
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header fade-in">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="page-title">Edit Data Pasien</h1>
                <div class="patient-record-badge">
                    <i class="fas fa-fingerprint"></i> {{ $patient->medical_record_number }}
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('patients.index') }}" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left"></i>Kembali ke Daftar Pasien
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-xl-8 mx-auto">
            @if ($errors->any())
                <div class="alert-custom alert-danger fade-in">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="alert-content">
                        <h5 class="alert-heading">Terdapat {{ count($errors) }} kesalahan pada form</h5>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="form-card fade-in delay-1">
                <div class="form-header">
                    <div class="form-header-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h5 class="mb-0">Informasi Pasien</h5>
                </div>

                <div class="form-body">
                    <form action="{{ route('patients.update', $patient) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user form-label-icon"></i>Nama Lengkap<span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $patient->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="medical_record_number" class="form-label">
                                    <i class="fas fa-fingerprint form-label-icon"></i>Nomor Rekam Medis<span class="required-indicator">*</span>
                                </label>
                                <input type="text" name="medical_record_number" id="medical_record_number" class="form-control @error('medical_record_number') is-invalid @enderror" value="{{ old('medical_record_number', $patient->medical_record_number) }}" readonly>
                                @error('medical_record_number')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>Nomor rekam medis tidak dapat diubah
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birth_date" class="form-label">
                                    <i class="fas fa-calendar-alt form-label-icon"></i>Tanggal Lahir<span class="required-indicator">*</span>
                                </label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $patient->birth_date) }}" required>
                                @error('birth_date')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender" class="form-label">
                                    <i class="fas fa-venus-mars form-label-icon"></i>Jenis Kelamin<span class="required-indicator">*</span>
                                </label>
                                <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                                    <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>
                                        <i class="fas fa-mars"></i> Laki-laki
                                    </option>
                                    <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>
                                        <i class="fas fa-venus"></i> Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="blood_type" class="form-label">
                                    <i class="fas fa-tint form-label-icon"></i>Golongan Darah
                                </label>
                                <select name="blood_type" id="blood_type" class="form-select @error('blood_type') is-invalid @enderror">
                                    <option value="" disabled>-- Pilih Golongan Darah --</option>
                                    <option value="A" {{ old('blood_type', $patient->blood_type ?? '') == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('blood_type', $patient->blood_type ?? '') == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('blood_type', $patient->blood_type ?? '') == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('blood_type', $patient->blood_type ?? '') == 'O' ? 'selected' : '' }}>O</option>
                                    <option value="Unknown" {{ old('blood_type', $patient->blood_type ?? '') == 'Unknown' ? 'selected' : '' }}>Tidak Diketahui</option>
                                </select>
                                @error('blood_type')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="form-label">
                                    <i class="fas fa-home form-label-icon"></i>Alamat
                                </label>
                                <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $patient->address ?? '') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="notes" class="form-label">
                                    <i class="fas fa-notes-medical form-label-icon"></i>Catatan Medis
                                </label>
                                <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror" placeholder="Contoh: Riwayat alergi, kondisi khusus, dll.">{{ old('notes', $patient->notes ?? '') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-triangle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="buttons-container">
                                <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i>Kembali
                                </a>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Danger Zone Card -->
            <div class="form-card fade-in delay-2">
                <div class="form-header" style="border-bottom: 1px solid #ffebee;">
                    <div class="form-header-icon" style="background: rgba(244, 67, 54, 0.1); color: #f44336;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h5 class="mb-0" style="color: #e53935;">Zona Berbahaya</h5>
                </div>

                <div class="form-body">
                    <p class="text-muted">Tindakan di bawah ini dapat berdampak serius dan tidak dapat dipulihkan. Pastikan Anda yakin sebelum melanjutkan.</p>

                    <form action="{{ route('patients.destroy', $patient) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pasien ini? Semua data terkait akan ikut terhapus dan tidak dapat dipulihkan.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>Hapus Data Pasien
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add validation styles to fields with values
        document.querySelectorAll('.form-control, .form-select').forEach(field => {
            if (field.value && field.required) {
                field.classList.add('is-valid');
            }
        });

        // Add event listeners for validation feedback
        document.querySelectorAll('.form-control, .form-select').forEach(field => {
            field.addEventListener('change', function() {
                if (this.required) {
                    if (this.value) {
                        this.classList.add('is-valid');
                        this.classList.remove('is-invalid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                }
            });
        });
    });
</script>
@endsection
