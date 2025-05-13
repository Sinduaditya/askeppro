@extends('layouts.app')

@section('title', 'Tambah Pasien Baru')

@section('styles')
    <style>
        /* Modern Form Card */
        .page-header {
            background: linear-gradient(135deg, #1e88e5 0%, #5e35b1 100%);
            border-radius: 15px;
            padding: 1.5rem 2rem;
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
        }

        .page-header h1 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0;
            position: relative;
        }

        .page-header p {
            margin-top: 0.5rem;
            margin-bottom: 0;
            opacity: 0.9;
        }

        .form-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s;
            background: #ffffff;
        }

        .form-card .card-header {
            background: #fff;
            color: #333;
            padding: 1.5rem 1.5rem 0;
            border-bottom: none;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
            max-width: 180px;
        }

        .step-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #f5f7fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: #78909c;
            position: relative;
            z-index: 2;
            transition: all 0.3s;
        }

        .step.active .step-icon {
            background: linear-gradient(135deg, #1e88e5, #5e35b1);
            color: white;
            box-shadow: 0 5px 15px rgba(30, 136, 229, 0.3);
        }

        .step.completed .step-icon {
            background: #4caf50;
            color: white;
        }

        .step-text {
            margin-top: 0.75rem;
            font-weight: 500;
            font-size: 0.85rem;
            color: #78909c;
            text-align: center;
        }

        .step.active .step-text {
            color: #1e88e5;
            font-weight: 600;
        }

        .step-connector {
            position: absolute;
            top: 25px;
            height: 2px;
            width: 100%;
            background: #e0e0e0;
            left: -50%;
        }

        .step:first-child .step-connector {
            display: none;
        }

        .step.active .step-connector,
        .step.completed .step-connector {
            background: #1e88e5;
        }

        .form-card .card-body {
            padding: 2.5rem;
        }

        .form-section {
            margin-bottom: 2.5rem;
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 0.6s ease-out forwards;
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #f5f7fa;
            display: flex;
            align-items: center;
        }

        .section-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            font-size: 1.25rem;
            background: linear-gradient(135deg, rgba(30, 136, 229, 0.1), rgba(94, 53, 177, 0.1));
            color: #5e35b1;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-float-label {
            position: relative;
        }

        .input-float-label label {
            position: absolute;
            pointer-events: none;
            left: 3.25rem;
            /* Adjust for icon width */
            top: 0.75rem;
            transition: 0.2s ease all;
            font-size: 0.95rem;
            color: #78909c;
        }

        .input-float-label input:focus~label,
        .input-float-label input:not(:placeholder-shown)~label,
        .input-float-label select:focus~label,
        .input-float-label select:valid~label,
        .input-float-label textarea:focus~label,
        .input-float-label textarea:not(:placeholder-shown)~label {
            top: -0.75rem;
            left: 1rem;
            font-size: 0.75rem;
            padding: 0 0.25rem;
            background: white;
            color: #1e88e5;
            font-weight: 600;
            z-index: 10;
        }

        .form-control,
        .form-select {
            padding: 0.75rem 1rem;
            padding-left: 3rem;
            /* Space for icon */
            border-radius: 10px;
            border: 1px solid #dee2e6;
            font-size: 1rem;
            box-shadow: none;
            transition: all 0.3s;
            height: auto;
            background-clip: padding-box;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.15);
            outline: none;
        }

        textarea.form-control {
            height: auto;
        }

        .input-icon {
            position: absolute;
            top: 0.75rem;
            left: 1rem;
            color: #78909c;
            font-size: 1.15rem;
            transition: all 0.3s;
        }

        .input-float-label input:focus~.input-icon,
        .input-float-label select:focus~.input-icon,
        .input-float-label textarea:focus~.input-icon {
            color: #1e88e5;
        }

        .required-indicator {
            color: #ff5252;
            margin-left: 0.15rem;
        }

        .form-hint {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: #78909c;
            display: flex;
            align-items: center;
        }

        .form-hint i {
            margin-right: 0.35rem;
            color: #5e35b1;
        }

        .invalid-feedback {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: #ff5252;
            display: flex;
            align-items: flex-start;
        }

        .invalid-feedback i {
            margin-right: 0.4rem;
            margin-top: 0.2rem;
        }

        /* Button Styling */
        .actions-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f0f0f0;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }

        .btn i {
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e88e5 0%, #5e35b1 100%);
            border: none;
            box-shadow: 0 5px 15px rgba(30, 136, 229, 0.25);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 136, 229, 0.35);
        }

        .btn-outline-secondary {
            border: 1px solid #dee2e6;
            color: #78909c;
            background: transparent;
        }

        .btn-outline-secondary:hover {
            background: #f5f7fa;
            color: #455a64;
            border-color: #c4c9d0;
        }

        /* Validation Styling */
        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #ff5252;
            background-image: none;
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(255, 82, 82, 0.15);
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1.25rem;
        }

        .alert-danger {
            background-color: rgba(255, 82, 82, 0.1);
            color: #ff5252;
        }

        .alert .alert-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .page-header {
                padding: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .page-header h1 {
                font-size: 1.5rem;
            }

            .form-card .card-body {
                padding: 1.5rem;
            }

            .form-section {
                margin-bottom: 2rem;
            }

            .form-section-title {
                font-size: 1.1rem;
            }

            .step-indicator {
                overflow-x: auto;
                padding-bottom: 1rem;
            }

            .step {
                min-width: 110px;
            }

            .btn {
                width: 100%;
            }

            .actions-area {
                flex-direction: column-reverse;
                gap: 1rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Accessibility Improvements */
        *:focus {
            outline: 2px solid rgba(30, 136, 229, 0.5);
            outline-offset: 2px;
        }

        /* Form validation indicators */
        .validation-icon {
            position: absolute;
            right: 1rem;
            top: 0.85rem;
            display: none;
            font-size: 1.1rem;
        }

        .form-control.is-valid~.validation-icon.valid {
            display: block;
            color: #4CAF50;
        }

        .form-control.is-invalid~.validation-icon.invalid {
            display: block;
            color: #ff5252;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-lg-11 col-xl-9 mx-auto">
                <div class="page-header fade-in">
                    <h1>Tambah Pasien Baru</h1>
                    <p>Form registrasi pasien baru untuk sistem asuhan keperawatan digital</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger fade-in mb-4" role="alert">
                        <div class="d-flex align-items-start">
                            <div class="alert-icon me-3">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Terdapat {{ count($errors) }} kesalahan pada form</h5>
                                <ul class="mb-0 ps-4">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-card mb-4 fade-in">
                    <div class="card-header">
                        <div class="step-indicator">
                            <div class="step active">
                                <div class="step-connector"></div>
                                <div class="step-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <span class="step-text">Identitas Pasien</span>
                            </div>
                            <div class="step">
                                <div class="step-connector"></div>
                                <div class="step-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <span class="step-text">Data Personal</span>
                            </div>
                            <div class="step">
                                <div class="step-connector"></div>
                                <div class="step-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <span class="step-text">Konfirmasi</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form id="patientForm" action="{{ route('patients.store') }}" method="POST">
                            @csrf

                            <div id="form-section-1" class="form-section" style="animation-delay: 0.1s">
                                <h3 class="form-section-title">
                                    <div class="section-icon"><i class="fas fa-id-card"></i></div>
                                    Informasi Identitas
                                </h3>

                                <div class="row g-4">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <div class="input-float-label">
                                                <i class="fas fa-user input-icon"></i>
                                                <input type="text" id="name" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" placeholder=" " required>
                                                <label for="name">Nama Lengkap<span
                                                        class="required-indicator">*</span></label>
                                                <i class="fas fa-check-circle validation-icon valid"></i>
                                                <i class="fas fa-exclamation-circle validation-icon invalid"></i>
                                            </div>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- filepath: resources/views/patients/create.blade.php -->
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-float-label">
                                                <i class="fas fa-fingerprint input-icon"></i>
                                                <input type="text" id="medical_record_number"
                                                    name="medical_record_number"
                                                    class="form-control @error('medical_record_number') is-invalid @enderror"
                                                    value="{{ old('medical_record_number') }}" placeholder=" ">
                                                <!-- Atribut required dihapus -->
                                                <label for="medical_record_number">Nomor Rekam Medis</label>
                                                <i class="fas fa-check-circle validation-icon valid"></i>
                                                <i class="fas fa-exclamation-circle validation-icon invalid"></i>
                                            </div>
                                            @error('medical_record_number')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-hint">
                                                <i class="fas fa-info-circle"></i>
                                                Format yang disarankan: RM-YYYYMMDD-XXX (opsional)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="form-section-2" class="form-section" style="animation-delay: 0.3s">
                                <h3 class="form-section-title">
                                    <div class="section-icon"><i class="fas fa-user-circle"></i></div>
                                    Data Personal
                                </h3>

                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-float-label">
                                                <i class="fas fa-calendar-alt input-icon"></i>
                                                <input type="date" id="birth_date" name="birth_date"
                                                    class="form-control @error('birth_date') is-invalid @enderror"
                                                    value="{{ old('birth_date') }}" required>
                                                <label for="birth_date">Tanggal Lahir<span
                                                        class="required-indicator">*</span></label>
                                            </div>
                                            @error('birth_date')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-float-label">
                                                <i class="fas fa-venus-mars input-icon"></i>
                                                <select id="gender" name="gender"
                                                    class="form-select @error('gender') is-invalid @enderror" required>
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                                        Laki-laki</option>
                                                    <option value="female"
                                                        {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan
                                                    </option>
                                                </select>
                                                <label for="gender">Jenis Kelamin<span
                                                        class="required-indicator">*</span></label>
                                            </div>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-float-label">
                                                <i class="fas fa-tint input-icon"></i>
                                                <select id="blood_type" name="blood_type"
                                                    class="form-select @error('blood_type') is-invalid @enderror">
                                                    <option value="" disabled
                                                        {{ old('blood_type') ? '' : 'selected' }}>Pilih Golongan Darah
                                                    </option>
                                                    <option value="A"
                                                        {{ old('blood_type') == 'A' ? 'selected' : '' }}>A</option>
                                                    <option value="B"
                                                        {{ old('blood_type') == 'B' ? 'selected' : '' }}>B</option>
                                                    <option value="AB"
                                                        {{ old('blood_type') == 'AB' ? 'selected' : '' }}>AB</option>
                                                    <option value="O"
                                                        {{ old('blood_type') == 'O' ? 'selected' : '' }}>O</option>
                                                    <option value="Unknown"
                                                        {{ old('blood_type') == 'Unknown' ? 'selected' : '' }}>Tidak
                                                        Diketahui</option>
                                                </select>
                                                <label for="blood_type">Golongan Darah</label>
                                            </div>
                                            @error('blood_type')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-float-label">
                                                <i class="fas fa-home input-icon"></i>
                                                <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" rows="3"
                                                    placeholder=" ">{{ old('address') }}</textarea>
                                                <label for="address">Alamat Lengkap</label>
                                            </div>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-float-label">
                                                <i class="fas fa-notes-medical input-icon"></i>
                                                <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3"
                                                    placeholder=" ">{{ old('notes') }}</textarea>
                                                <label for="notes">Catatan Medis</label>
                                            </div>
                                            @error('notes')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-hint">
                                                <i class="fas fa-info-circle"></i>
                                                Isi dengan riwayat alergi, kondisi khusus, atau catatan penting
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="actions-area">
                                <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i>Kembali ke Daftar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>Simpan Data Pasien
                                </button>
                            </div>
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
            // Form validation visual enhancement
            const formInputs = document.querySelectorAll('.form-control, .form-select');
            formInputs.forEach(input => {
                // Set initial state based on existing values
                if (input.value) {
                    input.classList.add('is-valid');
                }

                // Add validation on change
                input.addEventListener('change', function() {
                    if (this.value && this.required) {
                        this.classList.add('is-valid');
                        this.classList.remove('is-invalid');
                    } else if (this.required) {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                });

                // Special handling for dates
                if (input.type === 'date') {
                    input.addEventListener('input', function() {
                        if (this.value) {
                            this.classList.add('is-valid');
                        } else {
                            this.classList.remove('is-valid');
                        }
                    });
                }
            });

            // Handle floating labels for date inputs (special case)
            const dateInput = document.getElementById('birth_date');
            const dateLabel = dateInput.parentNode.querySelector('label');

            if (dateInput.value) {
                dateLabel.style.top = '-0.75rem';
                dateLabel.style.left = '1rem';
                dateLabel.style.fontSize = '0.75rem';
                dateLabel.style.backgroundColor = 'white';
                dateLabel.style.padding = '0 0.25rem';
            }

            dateInput.addEventListener('change', function() {
                if (this.value) {
                    dateLabel.style.top = '-0.75rem';
                    dateLabel.style.left = '1rem';
                    dateLabel.style.fontSize = '0.75rem';
                    dateLabel.style.backgroundColor = 'white';
                    dateLabel.style.padding = '0 0.25rem';
                } else {
                    dateLabel.style = '';
                }
            });

            // Handle radio buttons validation visual cues
            const genderRadios = document.querySelectorAll('input[name="gender"]');
            genderRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        genderRadios.forEach(r => {
                            r.classList.remove('is-invalid');
                        });
                    }
                });
            });

            // Mobile responsive adjustments
            const adjustFormForMobile = () => {
                const isMobile = window.innerWidth < 768;
                const actionButtons = document.querySelectorAll('.actions-area .btn');

                if (isMobile) {
                    actionButtons.forEach(btn => {
                        btn.style.justifyContent = 'center';
                    });
                } else {
                    actionButtons.forEach(btn => {
                        btn.style.justifyContent = '';
                    });
                }
            };

            // Run on load and resize
            adjustFormForMobile();
            window.addEventListener('resize', adjustFormForMobile);
        });
    </script>
@endsection
