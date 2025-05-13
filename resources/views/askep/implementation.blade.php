<!-- filepath: e:\Joki\upi_joki\AskepPro\askeppro\resources\views\askep\implementation.blade.php -->
@extends('layouts.app')

@section('title', 'Implementasi Tindakan Keperawatan - AskepPro')

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

    /* Card Styling */
    .main-card {
        background: #ffffff;
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .card-header-custom {
        background: #f8fafc;
        padding: 1.25rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .card-title-custom {
        font-weight: 600;
        color: #334155;
        margin-bottom: 0;
        display: flex;
        align-items: center;
    }

    .card-title-custom i {
        margin-right: 0.75rem;
        font-size: 1.25rem;
        color: #1e88e5;
    }

    .card-body-custom {
        padding: 1.5rem;
    }

    /* Info Alert */
    .alert-info-custom {
        background-color: #e7f3fd;
        border-left: 5px solid #1e88e5;
        color: #0c63e4;
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        align-items: flex-start;
        box-shadow: 0 3px 10px rgba(13, 110, 253, 0.05);
        margin-bottom: 1.5rem;
    }

    .alert-info-custom i {
        font-size: 1.25rem;
        margin-right: 0.75rem;
        margin-top: 0.25rem;
    }

    .alert-warning-custom {
        background-color: #fefce8;
        border-left: 5px solid #facc15;
        color: #854d0e;
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        align-items: center;
        box-shadow: 0 3px 10px rgba(250, 204, 21, 0.1);
    }

    .alert-warning-custom i {
        font-size: 1.25rem;
        margin-right: 0.75rem;
    }

    /* Table Styling */
    .implementation-table {
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-bottom: 1.5rem;
    }

    .implementation-table th {
        background: #f8fafc;
        color: #334155;
        font-weight: 600;
        padding: 1rem;
    }

    .implementation-table td {
        padding: 1rem;
        vertical-align: middle;
        border-color: #f1f5f9;
    }

    .implementation-table tbody tr {
        transition: all 0.2s;
    }

    .implementation-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Intervention Details */
    .intervention-name {
        font-weight: 600;
        color: #334155;
    }

    .intervention-code {
        font-weight: 500;
        color: #1e88e5;
        margin-bottom: 0.25rem;
    }

    /* Form Elements */
    .form-control-custom {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.65rem 1rem;
        transition: all 0.2s;
    }

    .form-control-custom:focus {
        border-color: #1e88e5;
        box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.15);
    }

    .form-time {
        position: relative;
    }

    .form-time i {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
    }

    .form-notes {
        resize: none;
    }

    /* Toggle Switch */
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: #4caf50;
    }

    input:focus + .toggle-slider {
        box-shadow: 0 0 1px #4caf50;
    }

    input:checked + .toggle-slider:before {
        transform: translateX(30px);
    }

    .status-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.75rem;
    }

    .status-done {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background-color: #f1f5f9;
        color: #64748b;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
    }

    .btn-custom {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s;
    }

    .btn-custom i {
        margin-right: 0.5rem;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1e88e5 0%, #5e35b1 100%);
        border: none;
        color: white !important;
        box-shadow: 0 5px 15px rgba(30, 136, 229, 0.2);
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 136, 229, 0.3);
    }

    .btn-outline-secondary-custom {
        border: 1px solid #cbd5e1;
        background: transparent;
        color: #64748b !important;
    }

    .btn-outline-secondary-custom:hover {
        background: #f8fafc;
        color: #334155 !important;
        border-color: #94a3b8;
    }

    /* Example Card */
    .example-card {
        background-color: #f8fafc;
        border-radius: 10px;
        border: 1px dashed #cbd5e1;
    }

    .example-card-header {
        border-bottom: 1px dashed #cbd5e1;
        padding: 1rem;
        display: flex;
        align-items: center;
    }

    .example-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: rgba(30, 136, 229, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
    }

    .example-icon i {
        color: #1e88e5;
        font-size: 1.25rem;
    }

    .example-title {
        font-weight: 600;
        color: #334155;
        margin-bottom: 0;
    }

    .example-table {
        margin-bottom: 0;
    }

    .example-table th {
        background: rgba(241, 245, 249, 0.5);
    }

    .example-table td, .example-table th {
        padding: 0.75rem 1rem;
    }

    /* Animation */
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
    @media (max-width: 767.98px) {
        .progress-tracker {
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .progress-step {
            min-width: 80px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.75rem;
        }

        .action-buttons .btn-custom {
            width: 100%;
            justify-content: center;
        }

        .toggle-switch {
            margin: 0 auto;
        }

        .status-badge {
            display: block;
            margin: 0.5rem auto 0;
            text-align: center;
            max-width: 100px;
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
                        <div class="step-circle">6</div>
                        Implementasi Tindakan
                    </h1>
                    <p class="page-subtitle">Catat pelaksanaan tindakan keperawatan yang telah dilakukan</p>
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
            <div class="progress-step completed">
                <div class="step-number">5</div>
                <div class="step-label">Intervensi</div>
            </div>
            <div class="progress-step active">
                <div class="step-number">6</div>
                <div class="step-label">Implementasi</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Main Card -->
                <div class="main-card fade-in delay-2">
                    <div class="card-header-custom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title-custom">
                                <i class="fas fa-clipboard-check"></i>
                                Implementasi Tindakan Keperawatan
                            </h5>
                            <span class="badge bg-primary">Tahap 6/7</span>
                        </div>
                    </div>
                    <div class="card-body-custom">
                        @if (session('error'))
                            <div class="alert alert-danger mb-4">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="alert-info-custom mb-4">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <strong>Panduan Implementasi</strong><br>
                                Catat setiap implementasi tindakan keperawatan yang telah dilakukan dengan waktu pelaksanaan, status, dan catatan jika diperlukan.
                            </div>
                        </div>

                        <form action="{{ route('askep.saveImplementation', $case->id) }}" method="POST" id="implementationForm">
                            @csrf

                            @if ($case->implementations->isEmpty())
                                <div class="alert-warning-custom mb-4">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div>
                                        <strong>Belum ada intervensi yang dipilih</strong><br>
                                        Silakan kembali dan pilih intervensi terlebih dahulu.
                                    </div>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table implementation-table">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">No</th>
                                                <th width="30%">Tindakan</th>
                                                <th width="15%">Waktu</th>
                                                <th width="15%" class="text-center">Status</th>
                                                <th width="35%">Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($case->implementations as $index => $implementation)
                                                <tr class="implementation-row {{ $implementation->performed ? 'implemented' : '' }}">
                                                    <input type="hidden" name="implementations[{{ $index }}][id]"
                                                        value="{{ $implementation->intervention_id }}">

                                                    <td class="text-center">{{ $index + 1 }}</td>

                                                    <td>
                                                        <div class="intervention-code">{{ $implementation->intervention->code }}</div>
                                                        <div class="intervention-name">{{ $implementation->intervention->name }}</div>
                                                    </td>

                                                    <td>
                                                        <div class="form-time">
                                                            <input type="text"
                                                                name="implementations[{{ $index }}][waktu]"
                                                                class="form-control form-control-custom"
                                                                value="{{ $implementation->waktu ?? '' }}"
                                                                placeholder="08.00 WIB">
                                                            <i class="fas fa-clock"></i>
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="d-flex flex-column align-items-center">
                                                            <label class="toggle-switch">
                                                                <input class="implementation-checkbox" type="checkbox"
                                                                    name="implementations[{{ $index }}][performed]"
                                                                    id="performed{{ $implementation->id }}"
                                                                    value="1"
                                                                    data-index="{{ $index }}"
                                                                    {{ $implementation->performed ? 'checked' : '' }}>
                                                                <span class="toggle-slider"></span>
                                                            </label>
                                                            <span class="status-badge mt-2 {{ $implementation->performed ? 'status-done' : 'status-pending' }}"
                                                                id="status-badge-{{ $index }}">
                                                                {{ $implementation->performed ? 'Dilakukan' : 'Belum' }}
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <textarea
                                                            name="implementations[{{ $index }}][notes]"
                                                            class="form-control form-control-custom form-notes"
                                                            rows="2"
                                                            placeholder="Tambahkan catatan pelaksanaan...">{{ $implementation->notes }}</textarea>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Summary Box -->
                                <div class="card mb-4" style="border-radius: 10px; border: 1px solid #e2e8f0;">
                                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                                        <div>
                                            <span class="text-muted">Total Intervensi:</span>
                                            <strong>{{ $case->implementations->count() }}</strong>
                                        </div>
                                        <div>
                                            <span class="text-muted">Telah Dilakukan:</span>
                                            <strong id="implemented-count">{{ $case->implementations->where('performed', 1)->count() }}</strong>
                                        </div>
                                        <div>
                                            <span class="text-muted">Belum Dilakukan:</span>
                                            <strong id="not-implemented-count">{{ $case->implementations->where('performed', 0)->count() }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="action-buttons">
                                <a href="{{ route('askep.intervention', $case->id) }}" class="btn btn-outline-secondary-custom">
                                    <i class="fas fa-arrow-left"></i>Kembali ke Intervensi
                                </a>
                                @if (!$case->implementations->isEmpty())
                                    <button type="submit" class="btn btn-primary-custom">
                                        Simpan
                                    </button>
                                @endif
                            </div>
                        </form>

                        <!-- Example Card -->
                        <div class="example-card mt-4 fade-in delay-3">
                            <div class="example-card-header">
                                <div class="example-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h6 class="example-title">Contoh Format Implementasi</h6>
                            </div>
                            <div class="card-body-custom">
                                <div class="table-responsive">
                                    <table class="table example-table">
                                        <thead>
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
                                                <td>Pasien mengatakan nyeri berkurang dari skala 6 menjadi 3</td>
                                            </tr>
                                            <tr>
                                                <td>10.00 WIB</td>
                                                <td>Membimbing napas dalam</td>
                                                <td>Pasien dapat melakukan dengan benar setelah dicontohkan 2x</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
        const checkboxes = document.querySelectorAll('.implementation-checkbox');
        let implementedCount = document.getElementById('implemented-count');
        let notImplementedCount = document.getElementById('not-implemented-count');

        function updateCounts() {
            let implemented = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) implemented++;
            });

            if (implementedCount) {
                implementedCount.textContent = implemented;
                notImplementedCount.textContent = checkboxes.length - implemented;
            }
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const index = this.getAttribute('data-index');
                const statusBadge = document.getElementById(`status-badge-${index}`);
                const row = this.closest('.implementation-row');

                if (this.checked) {
                    statusBadge.textContent = 'Dilakukan';
                    statusBadge.classList.remove('status-pending');
                    statusBadge.classList.add('status-done');
                    row.classList.add('implemented');
                } else {
                    statusBadge.textContent = 'Belum';
                    statusBadge.classList.remove('status-done');
                    statusBadge.classList.add('status-pending');
                    row.classList.remove('implemented');
                }

                updateCounts();
            });
        });

        // Time input enhancement - optional datepicker integration


        // Add row highlight effect when interacting with any form element in the row
        document.querySelectorAll('.implementation-table textarea, .implementation-table input').forEach(element => {
            element.addEventListener('focus', function() {
                this.closest('tr').classList.add('active-row');
            });

            element.addEventListener('blur', function() {
                this.closest('tr').classList.remove('active-row');
            });
        });

        // Add CSS for active row highlighting
        const style = document.createElement('style');
        style.textContent = `
            .implementation-row.active-row {
                background-color: #f0f7ff !important;
                transition: background-color 0.3s ease;
            }
            .implementation-row.implemented {
                background-color: #f9fafb;
            }
        `;
        document.head.appendChild(style);

        // Initialize the counter
        updateCounts();
    });
</script>
@endsection
