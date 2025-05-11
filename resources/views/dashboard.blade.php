@extends('layouts.app')

@section('title', 'Dashboard - AskepPro')

@section('styles')
    <style>
        .stat-card {
            border-radius: 15px;
            border: none;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.2);
        }

        .welcome-feature {
            transition: all 0.3s;
            border-radius: 15px;
            overflow: hidden;
        }

        .welcome-feature:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.4rem;
        }

        .activity-table th {
            font-weight: 600;
            color: #4a5568;
            border-top: none;
            border-bottom: 2px solid #e2e8f0;
        }

        .activity-table td {
            vertical-align: middle;
        }

        .patient-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(45deg, #6366f1, #818cf8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 10px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-completed {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .status-ongoing {
            background-color: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .status-draft {
            background-color: rgba(99, 102, 241, 0.1);
            color: #6366f1;
        }

        .dashboard-header {
            position: relative;
            background: linear-gradient(120deg, #1e88e5, #5e35b1);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(-30deg);
        }

        .dashboard-header h1 {
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .dashboard-header p {
            margin-bottom: 0;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .dashboard-header .btn {
            background-color: white;
            color: #5e35b1;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .dashboard-header .btn:hover {
            background-color: #f8f9fa;
        }

        .empty-state {
            padding: 3rem 1.5rem;
            text-align: center;
            background-color: #f9fafb;
            border-radius: 15px;
        }

        .empty-icon {
            height: 80px;
            width: 80px;
            background: rgba(107, 114, 128, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #6b7280;
            margin: 0 auto 1.5rem;
        }

        .card-header-tabs {
            margin: -1rem -1rem 0;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6b7280;
            padding: 1rem 1.5rem;
        }

        .nav-tabs .nav-link.active {
            color: #1e88e5;
            font-weight: 600;
            border-bottom: 2px solid #1e88e5;
            background: transparent;
        }

        .nav-tabs .nav-item {
            margin-bottom: -1px;
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .stat-card {
                margin-bottom: 1rem;
            }

            .dashboard-header {
                padding: 1.5rem;
            }

            .dashboard-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="dashboard-header">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h1>Selamat Datang, {{ auth()->user()->name }}</h1>
                    <p class="mt-2">Kelola asuhan keperawatan dengan mudah dan sesuai standar SDKI, SLKI, dan SIKI</p>
                </div>
                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'perawat')
                        <a href="{{ route('patients.create') }}" class="btn btn-lg">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Pasien Baru
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Card Total Pasien -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-blue text-white h-100">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h6 class="text-uppercase mb-1 opacity-75">Total Pasien</h6>
                        <div class="d-flex align-items-baseline">
                            <h2 class="display-5 fw-bold mb-0">{{ $totalPatients }}</h2>
                            <span class="ms-2 badge bg-white bg-opacity-25">+3 minggu ini</span>
                        </div>
                        <div class="progress mt-3" style="height: 6px">
                            <div class="progress-bar bg-white bg-opacity-50" role="progressbar" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('patients.index') }}"
                            class="text-white d-flex align-items-center text-decoration-none">
                            <span>Lihat Semua Pasien</span>
                            <i class="fas fa-arrow-right ms-auto"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Total Kasus Askep -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-green text-white h-100">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h6 class="text-uppercase mb-1 opacity-75">Total Kasus Askep</h6>
                        <div class="d-flex align-items-baseline">
                            <h2 class="display-5 fw-bold mb-0">{{ $totalCases }}</h2>
                            <span class="ms-2 badge bg-white bg-opacity-25">{{ round(($totalCases / $totalPatients) * 100) }}%
                                pasien</span>
                        </div>
                        <div class="progress mt-3" style="height: 6px">
                            <div class="progress-bar bg-white bg-opacity-50" role="progressbar"
                                style="width: {{ $totalPatients > 0 ? ($totalCases / $totalPatients) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('patients.index') }}"
                            class="text-white d-flex align-items-center text-decoration-none">
                            <span>Lihat Detail Kasus</span>
                            <i class="fas fa-arrow-right ms-auto"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Panduan -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card bg-gradient-purple text-white h-100">
                    <div class="card-body">
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h6 class="text-uppercase mb-1 opacity-75">Panduan Standar</h6>
                        <div class="d-flex align-items-center mt-2">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="badge bg-white bg-opacity-25 me-2">SDKI</div>
                                    <small>Standar Diagnosis Keperawatan</small>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="badge bg-white bg-opacity-25 me-2">SLKI</div>
                                    <small>Standar Luaran Keperawatan</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="badge bg-white bg-opacity-25 me-2">SIKI</div>
                                    <small>Standar Intervensi Keperawatan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('guide.index') }}"
                            class="text-white d-flex align-items-center text-decoration-none">
                            <span>Akses Panduan</span>
                            <i class="fas fa-arrow-right ms-auto"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Fitur Aplikasi -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card shadow-sm mb-4 border-0 rounded-3">
                    <div class="card-header p-3 bg-white border-bottom-0">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active fw-medium" id="features-tab" data-bs-toggle="tab"
                                    data-bs-target="#features" type="button">
                                    <i class="fas fa-th-large me-2"></i>Fitur Aplikasi
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link fw-medium" id="flow-tab" data-bs-toggle="tab"
                                    data-bs-target="#flow" type="button">
                                    <i class="fas fa-stream me-2"></i>Alur Kerja
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Tab Fitur Aplikasi -->
                            <div class="tab-pane fade show active" id="features">
                                <div class="row g-3">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="welcome-feature p-4 border rounded bg-white hover-shadow">
                                            <div class="d-flex align-items-center">
                                                <div class="feature-icon bg-primary bg-gradient text-white me-3">
                                                    <i class="fas fa-notes-medical"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 fw-bold">Pengkajian Gejala</h5>
                                                    <p class="text-muted mb-0 small">Identifikasi gejala pasien berdasarkan
                                                        standar SDKI</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="welcome-feature p-4 border rounded bg-white hover-shadow">
                                            <div class="d-flex align-items-center">
                                                <div class="feature-icon bg-success bg-gradient text-white me-3">
                                                    <i class="fas fa-diagnoses"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 fw-bold">Diagnosis</h5>
                                                    <p class="text-muted mb-0 small">Penentuan diagnosis keperawatan sesuai
                                                        gejala</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="welcome-feature p-4 border rounded bg-white hover-shadow">
                                            <div class="d-flex align-items-center">
                                                <div class="feature-icon bg-warning bg-gradient text-white me-3">
                                                    <i class="fas fa-bullseye"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 fw-bold">Luaran Keperawatan</h5>
                                                    <p class="text-muted mb-0 small">Penetapan luaran berdasarkan standar
                                                        SLKI</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="welcome-feature p-4 border rounded bg-white hover-shadow">
                                            <div class="d-flex align-items-center">
                                                <div class="feature-icon bg-info bg-gradient text-white me-3">
                                                    <i class="fas fa-clipboard-list"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 fw-bold">Intervensi</h5>
                                                    <p class="text-muted mb-0 small">Perencanaan tindakan sesuai standar
                                                        SIKI</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="welcome-feature p-4 border rounded bg-white hover-shadow">
                                            <div class="d-flex align-items-center">
                                                <div class="feature-icon bg-secondary bg-gradient text-white me-3">
                                                    <i class="fas fa-procedures"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 fw-bold">Implementasi</h5>
                                                    <p class="text-muted mb-0 small">Pelaksanaan dan pencatatan tindakan
                                                        keperawatan</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="welcome-feature p-4 border rounded bg-white hover-shadow">
                                            <div class="d-flex align-items-center">
                                                <div class="feature-icon bg-dark bg-gradient text-white me-3">
                                                    <i class="fas fa-chart-pie"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 fw-bold">Evaluasi</h5>
                                                    <p class="text-muted mb-0 small">Penilaian hasil intervensi keperawatan
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Alur Kerja -->
                            <div class="tab-pane fade" id="flow">
                                <div class="workflow-container py-3">
                                    <div class="row g-4">
                                        <div class="col-6 col-md-4 col-lg">
                                            <div class="workflow-step position-relative text-center">
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                    style="width:60px; height:60px; box-shadow: 0 0 15px rgba(13, 110, 253, 0.2);">
                                                    <i class="fas fa-user-check fa-lg"></i>
                                                </div>
                                                <h6 class="fw-bold">Pengkajian</h6>
                                                <small class="text-muted d-block">Identifikasi masalah</small>
                                                <div class="workflow-arrow d-none d-lg-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4 col-lg">
                                            <div class="workflow-step position-relative text-center">
                                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                    style="width:60px; height:60px; box-shadow: 0 0 15px rgba(25, 135, 84, 0.2);">
                                                    <i class="fas fa-stethoscope fa-lg"></i>
                                                </div>
                                                <h6 class="fw-bold">Diagnosis</h6>
                                                <small class="text-muted d-block">Analisis data</small>
                                                <div class="workflow-arrow d-none d-lg-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4 col-lg">
                                            <div class="workflow-step position-relative text-center">
                                                <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                    style="width:60px; height:60px; box-shadow: 0 0 15px rgba(255, 193, 7, 0.2);">
                                                    <i class="fas fa-clipboard-list fa-lg"></i>
                                                </div>
                                                <h6 class="fw-bold">Perencanaan</h6>
                                                <small class="text-muted d-block">Strategi tindakan</small>
                                                <div class="workflow-arrow d-none d-lg-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-lg">
                                            <div class="workflow-step position-relative text-center">
                                                <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                    style="width:60px; height:60px; box-shadow: 0 0 15px rgba(13, 202, 240, 0.2);">
                                                    <i class="fas fa-heartbeat fa-lg"></i>
                                                </div>
                                                <h6 class="fw-bold">Implementasi</h6>
                                                <small class="text-muted d-block">Tindakan keperawatan</small>
                                                <div class="workflow-arrow d-none d-lg-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-lg">
                                            <div class="workflow-step position-relative text-center">
                                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                                    style="width:60px; height:60px; box-shadow: 0 0 15px rgba(108, 117, 125, 0.2);">
                                                    <i class="fas fa-chart-line fa-lg"></i>
                                                </div>
                                                <h6 class="fw-bold">Evaluasi</h6>
                                                <small class="text-muted d-block">Hasil intervensi</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Mobile workflow indicator (visible only on small screens) -->
                                    <div class="d-block d-lg-none mt-4">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 20%"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 20%"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 20%"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4 pt-2">
                                        <a href="{{ route('guide.index') }}" class="btn btn-primary px-4 py-2">
                                            <i class="fas fa-book-open me-2"></i>Pelajari Detail Alur Kerja
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-history me-2 text-primary"></i>Aktivitas Terbaru
                        </h5>
                        <a href="{{ route('patients.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-list me-1"></i>Lihat Semua
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($totalPatients > 0)
                            <div class="table-responsive">
                                <table class="table activity-table">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 200px;">Pasien</th>
                                            <th style="min-width: 120px;">Status</th>
                                            <th style="min-width: 120px;">Tanggal</th>
                                            <th style="min-width: 100px;" class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentActivities ?? [] as $activity)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="patient-avatar">
                                                            {{ substr($activity->patient->name ?? 'U', 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $activity->patient->name ?? 'Unknown' }}
                                                            </h6>
                                                            <small
                                                                class="text-muted">{{ $activity->patient->medical_record_number ?? 'No RM' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- Bagian yang perlu diubah di sekitar baris 537-551 -->
                                                <td>
                                                    @if ($activity->status == 'selesai')
                                                        <span class="status-badge status-completed">
                                                            <i class="fas fa-check-circle me-1"></i>Selesai
                                                        </span>
                                                    @elseif($activity->status == 'proses')
                                                        <span class="status-badge status-ongoing">
                                                            <i class="fas fa-spinner me-1"></i>Proses
                                                        </span>
                                                    @else
                                                        <span class="status-badge status-draft">
                                                            <i class="fas fa-file me-1"></i>Draft
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <i class="far fa-calendar-alt me-1 text-muted"></i>
                                                    {{ $activity->created_at->format('d M Y') }}
                                                </td>
                                                <td class="text-end">
                                                    <div class="btn-group">
                                                        <a href="{{ route('askep.print', $activity->id) }}"
                                                            class="btn btn-sm btn-outline-secondary"
                                                            data-bs-toggle="tooltip" title="Cetak Dokumen">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-4">
                                                    <div class="empty-state p-3">
                                                        <div class="empty-icon bg-light">
                                                            <i class="fas fa-clipboard-list text-secondary"></i>
                                                        </div>
                                                        <h6 class="mt-3">Belum Ada Aktivitas Terbaru</h6>
                                                        <p class="text-muted small mb-3">Aktivitas terbaru akan muncul di
                                                            sini setelah Anda membuat asuhan keperawatan</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state p-4">
                                <div class="empty-icon bg-light">
                                    <i class="fas fa-user-nurse text-primary"></i>
                                </div>
                                <h5 class="mt-3 fw-bold">Belum Ada Data Pasien</h5>
                                <p class="text-muted mb-4">Tambahkan pasien baru untuk mulai menggunakan aplikasi</p>
                                <a href="{{ route('patients.create') }}" class="btn btn-primary px-4 py-2">
                                    <i class="fas fa-user-plus me-2"></i>Tambah Pasien Baru
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <style>
        /* Background gradients for cards */
        .bg-gradient-blue {
            background: linear-gradient(45deg, #1e88e5, #42a5f5);
        }

        .bg-gradient-green {
            background: linear-gradient(45deg, #43a047, #66bb6a);
        }

        .bg-gradient-purple {
            background: linear-gradient(45deg, #5e35b1, #7e57c2);
        }

        /* Workflow arrows */
        .workflow-arrow {
            position: absolute;
            top: 30px;
            right: -40px;
            width: 40px;
            height: 2px;
            background-color: #e0e0e0;
        }

        .workflow-arrow:after {
            content: '';
            position: absolute;
            right: 0;
            top: -4px;
            width: 0;
            height: 0;
            border-top: 5px solid transparent;
            border-left: 10px solid #e0e0e0;
            border-bottom: 5px solid transparent;
        }
    </style>

    <script>
        // Initialize tabs
        document.addEventListener('DOMContentLoaded', function() {
            var tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
            tabEls.forEach(function(tabEl) {
                tabEl.addEventListener('shown.bs.tab', function(event) {
                    // Animation for tab content
                    event.target.querySelector('.tab-pane.active').classList.add('fade-in');
                });
            });
        });
    </script>
@endsection
