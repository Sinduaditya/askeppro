@extends('layouts.app')

@section('title', 'Daftar Pasien')

@section('styles')
    <style>
        .patient-header {
            background: linear-gradient(120deg, #1e88e5, #5e35b1);
            padding: 2.5rem 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .patient-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 60%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(-30deg);
        }

        .patient-header h1 {
            color: white;
            font-weight: 700;
            margin-bottom: 0;
            position: relative;
            z-index: 1;
        }

        .patient-card {
            border: none;
            border-radius: 15px;
            transition: all 0.25s ease;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            background-color: #fff;
        }

        .patient-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .patient-avatar {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.4rem;
            font-weight: 600;
            margin-right: 1rem;
            position: relative;
        }

        .patient-avatar.male {
            background: linear-gradient(135deg, #2196f3, #1565c0);
        }

        .patient-avatar.female {
            background: linear-gradient(135deg, #f06292, #c2185b);
        }

        .patient-status {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
        }

        .patient-status-badge {
            padding: 0.5rem 0.6rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-available {
            background-color: rgba(76, 175, 80, 0.15);
            color: #4CAF50;
        }

        .status-care {
            background-color: rgba(255, 152, 0, 0.15);
            color: #FF9800;
        }

        .patient-info {
            padding: 1.5rem;
        }

        .patient-name {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #37474f;
        }

        .patient-mr {
            font-size: 0.9rem;
            color: #607d8b;
            font-weight: 500;
        }

        .patient-details {
            display: flex;
            flex-wrap: wrap;
            margin-top: 1.25rem;
        }

        a {
            text-decoration: none;
        }

        .patient-detail-item {
            padding: 0.5rem 1rem;
            background: #f5f7fa;
            border-radius: 8px;
            margin-right: 0.75rem;
            margin-bottom: 0.75rem;
            font-size: 0.85rem;
        }

        .detail-label {
            font-weight: 500;
            color: #607d8b;
            margin-right: 0.25rem;
        }

        .detail-value {
            font-weight: 600;
            color: #37474f;
        }

        .gender-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .badge-male {
            background-color: rgba(33, 150, 243, 0.15);
            color: #2196F3;
        }

        .badge-female {
            background-color: rgba(233, 30, 99, 0.15);
            color: #E91E63;
        }

        .gender-icon {
            margin-right: 0.35rem;
        }

        .patient-actions {
            padding: 1rem;
            background-color: #f8f9fa;
            border-top: 1px solid #eee;
            z-index: 5;
            position: relative;
        }

        .btn-action {
            padding: 0.5rem;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            position: relative;
        }

        .btn-view {
            background-color: rgba(33, 150, 243, 0.15);
            color: #2196F3;
        }

        .btn-view:hover {
            background-color: #2196F3;
            color: white;
        }

        .btn-askep {
            background-color: rgba(76, 175, 80, 0.15);
            color: #4CAF50;
        }

        .btn-askep:hover {
            background-color: #4CAF50;
            color: white;
        }

        .btn-edit {
            background-color: rgba(255, 152, 0, 0.15);
            color: #FF9800;
        }

        .btn-edit:hover {
            background-color: #FF9800;
            color: white;
        }

        .btn-delete {
            background-color: rgba(244, 67, 54, 0.15);
            color: #F44336;
        }

        .btn-delete:hover {
            background-color: #F44336;
            color: white;
        }

        .action-tooltip {
            position: relative;
        }

        .action-tooltip:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 5px;
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 10;
            pointer-events: none;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background-color: #f9fafb;
            border-radius: 15px;
        }

        .empty-image {
            max-width: 180px;
            margin-bottom: 1.5rem;
            opacity: 0.7;
        }

        .btn-add-patient {
            background: linear-gradient(135deg, #1e88e5 0%, #5e35b1 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: white;
            box-shadow: 0 4px 15px rgba(30, 136, 229, 0.3);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            position: relative;
            z-index: 5;
        }

        .btn-add-patient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 136, 229, 0.4);
            color: white;
        }

        .btn-add-patient i {
            margin-right: 0.5rem;
        }

        .pagination-container {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .pagination-navigation {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .pagination-info {
            color: #455a64;
            font-size: 0.9rem;
            text-align: center;
            padding: 0.5rem;
        }

        .pagination-arrows {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 400px;
        }

        .pagination-nav-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            background: #fff;
            border: 1px solid #dee2e6;
            color: #37474f;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.2s;
            min-width: 180px;
        }

        .pagination-nav-btn.prev {
            color: #455a64;
        }

        .pagination-nav-btn.next {
            color: #1e88e5;
        }

        .pagination-nav-btn:hover {
            background: #f5f7fa;
            border-color: #c1c9d0;
        }

        .pagination-nav-btn.disabled {
            opacity: 0.6;
            pointer-events: none;
            cursor: default;
        }

        .pagination-nav-btn i {
            font-size: 1.5rem;
        }

        .pagination-nav-btn.prev i {
            margin-right: 0.5rem;
        }

        .pagination-nav-btn.next i {
            margin-left: 0.5rem;
        }

        .pagination-numbers {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .page-num-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 4px;
            background: #fff;
            border: 1px solid #dee2e6;
            color: #37474f;
            text-decoration: none;
            transition: all 0.2s;
        }

        .page-num-btn:hover {
            background: #f5f7fa;
        }

        .page-num-btn.active {
            background: #fff;
            color: #1e88e5;
            border-color: #dee2e6;
            font-weight: 600;
        }

        @media (max-width: 576px) {
            .pagination-arrows {
                flex-direction: column;
                gap: 0.75rem;
                align-items: center;
            }

            .pagination-nav-btn {
                min-width: 150px;
            }
        }

        .page-link {
            border-radius: 8px;
            margin: 0 0.15rem;
            border: none;
            color: #37474f;
            padding: 0.5rem 0.85rem;
        }

        .page-link:hover {
            background-color: #e3f2fd;
            color: #1e88e5;
        }

        .page-item.active .page-link {
            background-color: #1e88e5;
            color: white;
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

        .patient-card {
            animation: fadeIn 0.5s ease forwards;
            padding-bottom: 1rem;
        }

        /* Responsive styles */
        @media (max-width: 767.98px) {
            .patient-header {
                padding: 1.5rem 1rem;
            }

            .patient-card {
                margin-bottom: 1rem;
            }

            .patient-actions {
                display: flex;
                justify-content: center;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="patient-header">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h1>Data Pasien</h1>
                </div>
                <div class="col-md-6 text-md-end">
                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'perawat')
                        <a href="{{ route('patients.create') }}" class="btn-add-patient">
                            <i class="fas fa-plus-circle"></i>Tambah Pasien Baru
                        </a>
                    @endif
                </div>
            </div>
        </div>



        @if ($patients->count() > 0)
            <div class="row">
                @foreach ($patients as $index => $patient)
                    <div class="col-lg-6 col-xl-4" style="animation-delay: {{ $index * 0.05 }}s">
                        <div class="patient-card">
                            <div class="position-relative">
                                <div class="patient-info">
                                    <!-- Patient Header - Made more compact on mobile -->
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="patient-avatar {{ $patient->gender == 'male' ? 'male' : 'female' }} me-2">
                                                {{ substr($patient->name, 0, 1) }}
                                            </div>
                                            <div class="flex-grow-1">
                                                <h4 class="patient-name mb-0">{{ $patient->name }}</h4>
                                                <div class="patient-mr">{{ $patient->medical_record_number }}</div>
                                            </div>
                                        </div>

                                        <!-- Status Badge - Now full width on mobile -->
                                        <div class="w-100 text-start">
                                            @php
                                                $activeCase = $patient->askepCases()->where('status', 'proses')->first();
                                            @endphp

                                            @if ($activeCase)
                                                <span class="patient-status-badge status-care d-inline-block">
                                                    <i class="fas fa-procedures me-1"></i> Dalam Perawatan
                                                </span>
                                            @else
                                                <span class="patient-status-badge status-available d-inline-block">
                                                    <i class="fas fa-check-circle me-1"></i> Tersedia
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Patient Details - Made scrollable on mobile -->
                                    <div class="patient-details mt-3 d-flex flex-wrap">
                                        <div class="patient-detail-item mb-2">
                                            <span class="detail-label">Usia:</span>
                                            <span class="detail-value">{{ \Carbon\Carbon::parse($patient->birth_date)->age }} tahun</span>
                                        </div>

                                        <div class="patient-detail-item mb-2">
                                            <span class="detail-label">Tgl Lahir:</span>
                                            <span class="detail-value">{{ \Carbon\Carbon::parse($patient->birth_date)->format('d/m/Y') }}</span>
                                        </div>

                                        <div class="patient-detail-item mb-2">
                                            <span class="gender-badge {{ $patient->gender == 'male' ? 'badge-male' : 'badge-female' }}">
                                                <i class="fas fa-{{ $patient->gender == 'male' ? 'mars' : 'venus' }} gender-icon"></i>
                                                {{ $patient->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons - Made full width on mobile -->
                                <div class="patient-actions">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="d-flex mb-2 mb-sm-0">
                                            <a href="{{ route('patients.history', $patient) }}"
                                               class="btn-action btn-view action-tooltip me-2"
                                               data-tooltip="Riwayat">
                                                <i class="fas fa-history"></i>
                                            </a>

                                            @if (!$activeCase)
                                                <a href="{{ route('askep.create', $patient) }}"
                                                   class="btn-action btn-askep action-tooltip me-2"
                                                   data-tooltip="Buat Askep">
                                                    <i class="fas fa-stethoscope"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('patients.edit', $patient) }}"
                                               class="btn-action btn-edit action-tooltip me-2"
                                               data-tooltip="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>

                                        <div>
                                            <button type="button"
                                                    class="btn-action btn-delete action-tooltip"
                                                    data-tooltip="Hapus"
                                                    onclick="confirmDelete({{ $patient->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $patient->id }}"
                                                  action="{{ route('patients.destroy', $patient) }}"
                                                  method="POST"
                                                  style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (method_exists($patients, 'links'))
                <div class="pagination-container">
                    <div class="pagination-navigation">
                        <!-- Current page info -->
                        <div class="pagination-info">
                            Showing {{ $patients->firstItem() ?: 0 }} to {{ $patients->lastItem() ?: 0 }} of
                            {{ $patients->total() }} results
                        </div>

                        <!-- Page numbers -->
                        <div class="pagination-numbers">
                            @for ($i = 1; $i <= $patients->lastPage(); $i++)
                                <a href="{{ $patients->url($i) }}"
                                    class="page-num-btn {{ $patients->currentPage() == $i ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                        </div>

                        <!-- Previous/Next arrows -->
                        <div class="pagination-arrows">
                            <a href="{{ $patients->previousPageUrl() }}"
                                class="pagination-nav-btn prev {{ $patients->onFirstPage() ? 'disabled' : '' }}">
                                <i class="fas fa-chevron-left"></i>
                                <span>« Previous</span>
                            </a>

                            <a href="{{ $patients->nextPageUrl() }}"
                                class="pagination-nav-btn next {{ !$patients->hasMorePages() ? 'disabled' : '' }}">
                                <span>Next »</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="empty-state">
                <img src="https://cdn-icons-png.flaticon.com/512/2748/2748558.png" alt="No patients" class="empty-image">
                <h3 class="mb-3">Belum ada data pasien</h3>
                <p class="text-muted mb-4">Tambahkan pasien baru untuk memulai asuhan keperawatan</p>
                <a href="{{ route('patients.create') }}" class="btn-add-patient">
                    <i class="fas fa-plus-circle"></i>Tambah Pasien Baru
                </a>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <!-- Include SweetAlert if not already included -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Ensure SweetAlert is available or provide fallback
        function confirmDelete(patientId) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Anda yakin ingin menghapus data pasien ini? Semua data askep yang terkait juga akan terhapus.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#F44336',
                    cancelButtonColor: '#78909c',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + patientId).submit();
                    }
                });
            } else {
                // Fallback if SweetAlert isn't loaded
                if (confirm(
                    'Anda yakin ingin menghapus data pasien ini? Semua data askep yang terkait juga akan terhapus.')) {
                    document.getElementById('delete-form-' + patientId).submit();
                }
            }
        }

        // Enhance clickability of buttons
        document.addEventListener('DOMContentLoaded', function() {
            try {
                // Animation for patient cards
                const patientCards = document.querySelectorAll('.patient-card');
                patientCards.forEach((card, index) => {
                    card.style.opacity = '0';

                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100 + (index * 50));
                });

                // Ensure all buttons are properly clickable
                const actionButtons = document.querySelectorAll('.btn-action, .btn-add-patient');
                actionButtons.forEach(button => {
                    button.style.cursor = 'pointer';
                    button.style.position = 'relative';
                    button.style.zIndex = '5';
                });

                // Fix any tooltip overlapping issues
                const tooltips = document.querySelectorAll('.action-tooltip');
                tooltips.forEach(tooltip => {
                    const tooltipElement = tooltip.querySelector('::after');
                    if (tooltipElement) {
                        tooltipElement.style.pointerEvents = 'none';
                    }
                });
            } catch (error) {
                console.error("Animation error:", error);
            }
        });
    </script>
@endsection
