@extends('layouts.app')

@section('title', 'Riwayat Asuhan Keperawatan')

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
            box-shadow: 0 8px 20px rgba(30, 136, 229, 0.25);
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

        .btn-outline-light {
            border-color: rgba(255, 255, 255, 0.7);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover,
        .btn-outline-light:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: white;
            color: white;
            transform: translateY(-2px);
        }

        .page-title {
            font-weight: 700;
            position: relative;
            margin-bottom: 0.5rem;
            word-break: break-word;
        }

        /* Patient Card */
        .patient-profile-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            position: relative;
            background-color: #fff;
        }

        .patient-profile-card:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }

        .profile-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(240, 240, 240, 0.8);
            position: relative;
        }

        .patient-name {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: #2d3748;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .patient-avatar {
            min-width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: 600;
            margin-right: 1rem;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .patient-avatar.male {
            background: linear-gradient(135deg, #2196f3, #1565c0);
        }

        .patient-avatar.female {
            background: linear-gradient(135deg, #f06292, #c2185b);
        }

        .gender-badge {
            font-size: 0.8rem;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            margin-left: 1rem;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .badge-male {
            background-color: rgba(33, 150, 243, 0.15);
            color: #2196F3;
        }

        .badge-female {
            background-color: rgba(233, 30, 99, 0.15);
            color: #E91E63;
        }

        .profile-body {
            padding: 1.5rem;
        }

        .detail-item {
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            transform: translateX(5px);
        }

        .detail-label {
            font-weight: 600;
            color: #64748b;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .detail-label i {
            margin-right: 0.5rem;
            opacity: 0.7;
            width: 18px;
            text-align: center;
        }

        .detail-value {
            font-weight: 500;
            color: #334155;
            word-wrap: break-word;
        }

        .med-notes {
            background: #f8fafc;
            border-left: 3px solid #e2e8f0;
            padding: 1rem;
            border-radius: 0 8px 8px 0;
            margin-top: 0.5rem;
            word-wrap: break-word;
            transition: all 0.3s ease;
        }

        .med-notes:hover {
            border-left-color: #1e88e5;
            background: rgba(30, 136, 229, 0.05);
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        /* Timeline Section */
        .history-section {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            background-color: #fff;
            transition: all 0.3s;
        }

        .history-section:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .history-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(240, 240, 240, 0.8);
            background: white;
            display: flex;
            align-items: center;
        }

        .history-header i {
            font-size: 1.25rem;
            margin-right: 0.75rem;
            color: #1e88e5;
        }

        .history-body {
            padding: 1.5rem;
            background: #fff;
        }

        .timeline {
            position: relative;
            padding-left: 2rem;
            margin-left: 1rem;
            list-style-type: none;
            margin-bottom: 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 2px;
            background: linear-gradient(to bottom, #1e88e5 0%, #5e35b1 100%);
            border-radius: 1px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 2.5rem;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-point {
            position: absolute;
            left: -2.25rem;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.2);
            transition: all 0.3s ease;
            z-index: 2;
        }

        .timeline-item:hover .timeline-point {
            transform: scale(1.2);
        }

        .timeline-point.completed {
            background: #4caf50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }

        .timeline-point.in-progress {
            background: #ff9800;
            box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.2);
        }

        .case-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s;
            margin-bottom: 0;
        }

        .case-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .case-header {
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(240, 240, 240, 0.8);
            flex-wrap: wrap;
            gap: 0.75rem;
            background: rgba(248, 250, 252, 0.5);
        }

        .case-timestamp {
            display: flex;
            align-items: center;
            color: #64748b;
            font-size: 0.875rem;
        }

        .case-timestamp i {
            margin-right: 0.5rem;
            opacity: 0.7;
            flex-shrink: 0;
        }

        .case-status {
            padding: 0.4rem 0.85rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            white-space: nowrap;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .case-status i {
            margin-right: 0.5rem;
        }

        .status-completed {
            background: rgba(76, 175, 80, 0.15);
            color: #4caf50;
        }

        .status-in-progress {
            background: rgba(255, 152, 0, 0.15);
            color: #ff9800;
        }

        .case-body {
            padding: 1.5rem;
        }

        .case-section {
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .case-section:hover {
            transform: translateY(-3px);
        }

        .case-section:last-child {
            margin-bottom: 0;
        }

        .case-section-title {
            font-weight: 600;
            color: #334155;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .case-section-title i {
            margin-right: 0.75rem;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .diagnosis-icon {
            background: linear-gradient(135deg, #2196f3, #1565c0);
        }

        .outcome-icon {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
        }

        .evaluation-icon {
            background: linear-gradient(135deg, #ff9800, #e65100);
        }

        .diagnosis-item {
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
            margin-bottom: 1rem;
            word-break: break-word;
            transition: all 0.3s ease;
            border-left: 3px solid #e2e8f0;
        }

        .diagnosis-item:hover {
            border-left-color: #2196f3;
            background: rgba(33, 150, 243, 0.05);
        }

        .diagnosis-name {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.25rem;
            word-break: break-word;
        }

        .diagnosis-code {
            font-size: 0.875rem;
            color: #64748b;
            display: flex;
            align-items: center;
        }

        .diagnosis-code i {
            margin-right: 0.5rem;
            opacity: 0.7;
        }

        .badge-counter {
            padding: 0.4rem 0.85rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-right: 0.75rem;
            margin-bottom: 0.5rem;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .badge-counter:hover {
            transform: translateY(-2px);
        }

        .badge-counter i {
            margin-right: 0.5rem;
        }

        .badge-outcomes {
            background: rgba(76, 175, 80, 0.15);
            color: #4caf50;
        }

        .badge-interventions {
            background: rgba(33, 150, 243, 0.15);
            color: #2196f3;
        }

        .case-footer {
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid rgba(240, 240, 240, 0.8);
            background: rgba(248, 250, 252, 0.5);
        }

        .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s;
        }

        .btn i {
            margin-right: 0.5rem;
            flex-shrink: 0;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e88e5, #5e35b1);
            border: none;
            box-shadow: 0 5px 15px rgba(30, 136, 229, 0.2);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(30, 136, 229, 0.3);
        }

        .btn-outline-primary {
            border: 1px solid #1e88e5;
            color: #1e88e5;
        }

        .btn-outline-primary:hover {
            background: rgba(30, 136, 229, 0.05);
            border-color: #1e88e5;
            color: #1e88e5;
            transform: translateY(-3px);
        }

        .btn-success {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            border: none;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.2);
        }

        .btn-success:hover,
        .btn-success:focus {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.3);
        }

        .btn-outline-dark {
            border: 1px solid #64748b;
            color: #64748b;
            background: transparent;
        }

        .btn-outline-dark:hover {
            background: rgba(100, 116, 139, 0.05);
            color: #334155;
            transform: translateY(-3px);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .text-muted {
            word-wrap: break-word;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            transition: all 0.3s ease;
        }

        .empty-state:hover {
            transform: translateY(-5px);
        }

        .empty-icon {
            width: 140px;
            max-width: 100%;
            margin-bottom: 1.5rem;
            opacity: 0.6;
            transition: all 0.3s ease;
        }

        .empty-state:hover .empty-icon {
            opacity: 0.8;
            transform: scale(1.05);
        }

        .empty-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        .empty-subtitle {
            color: #64748b;
            margin-bottom: 1.5rem;
        }

        /* SOAP Modal Styling */
        .avatar-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .avatar-circle:hover {
            transform: scale(1.1);
        }

        .soap-card {
            border: 1px solid rgba(0,0,0,.075);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 16px rgba(0,0,0,.05);
            margin-bottom: 1.25rem;
            transition: all 0.3s ease;
        }

        .soap-card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,.1);
            transform: translateY(-3px);
        }

        .soap-card-header {
            padding: 14px 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .soap-card-header i {
            margin-right: 10px;
        }

        .soap-card-body {
            padding: 18px;
            min-height: 160px;
            background-color: white;
            white-space: pre-line;
            border-top: 1px solid rgba(0,0,0,.05);
        }

        .nav-pills .nav-link {
            border-radius: 8px;
            margin: 0 4px;
            padding: 12px 16px;
            font-weight: 500;
            color: #495057;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link:hover {
            background-color: rgba(30, 136, 229, 0.05);
            transform: translateY(-2px);
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #1e88e5, #5e35b1);
            color: white;
            box-shadow: 0 4px 10px rgba(30, 136, 229, 0.2);
        }

        .modal-content {
            border-radius: 16px;
            border: none;
            overflow: hidden;
        }

        .modal-header.bg-gradient-primary {
            background: linear-gradient(135deg, #1e88e5, #5e35b1);
            border-bottom: none;
            padding: 1.5rem;
        }

        .modal-body {
            padding: 1.75rem;
        }

        .modal-footer {
            padding: 1rem 1.75rem;
            border-top: 1px solid rgba(0,0,0,.05);
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .patient-profile-card {
                margin-bottom: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
                width: 100%;
                justify-content: center;
                margin-bottom: 0.5rem;
            }

            .action-buttons .btn:last-child {
                margin-bottom: 0;
            }
        }

        @media (max-width: 767.98px) {
            .page-header {
                padding: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .header-actions {
                margin-top: 1rem;
                width: 100%;
                text-align: center;
            }

            .header-actions .btn {
                width: 100%;
            }

            .profile-header {
                padding: 1.25rem;
                text-align: center;
            }

            .profile-header .d-flex {
                flex-direction: column;
                align-items: center;
            }

            .patient-name {
                flex-direction: column;
                text-align: center;
                margin-top: 0.75rem;
            }

            .patient-avatar {
                margin: 0 auto 1rem;
            }

            .gender-badge {
                margin: 0.75rem auto 0;
            }

            .profile-body {
                padding: 1.25rem;
            }

            .timeline {
                padding-left: 1.5rem;
                margin-left: 0.5rem;
            }

            .timeline-point {
                left: -1.75rem;
            }

            .case-header {
                padding: 1rem 1.25rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .case-header .case-status {
                align-self: flex-start;
            }

            .case-body {
                padding: 1.25rem;
            }

            .case-footer {
                padding: 1rem 1.25rem;
            }

            .case-footer .btn {
                width: 100%;
            }

            /* Fix for small screens */
            .case-section-row .col-md-4 {
                margin-bottom: 1.5rem;
            }

            .case-section-row .col-md-4:last-child {
                margin-bottom: 0;
            }

            /* SOAP modal adjustments */
            .nav-pills .nav-link {
                padding: 10px 12px;
                font-size: 0.9rem;
            }

            .nav-pills .nav-item {
                width: 50%;
                margin-bottom: 8px;
            }

            .nav-pills {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 575.98px) {
            .page-header {
                padding: 1rem;
                border-radius: 10px;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .history-header,
            .history-body {
                padding: 1rem;
            }

            .patient-avatar {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .timeline {
                padding-left: 1.25rem;
                margin-left: 0.25rem;
            }

            .timeline-point {
                width: 12px;
                height: 12px;
                left: -1.5rem;
            }

            .diagnosis-item {
                padding: 0.75rem;
            }

            .case-section-title i {
                width: 28px;
                height: 28px;
                font-size: 0.9rem;
            }

            .badge-counter {
                width: 100%;
                justify-content: center;
                margin-right: 0;
            }

            /* SOAP modal further adjustments */
            .nav-pills .nav-item {
                width: 100%;
            }

            .soap-card-body {
                min-height: 120px;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
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
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="page-header animate-fade-in-up">
            <div class="row align-items-center">
                <div class="col-md-6 mb-md-0 mb-3">
                    <h1 class="page-title">
                        <i class="fas fa-history me-2"></i>Riwayat Asuhan Keperawatan
                    </h1>
                </div>
                <div class="col-md-6 text-md-end header-actions">
                    <a href="{{ route('patients.index') }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Pasien
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Patient Information -->
            <div class="col-lg-4">
                <div class="patient-profile-card animate-fade-in-up delay-1">
                    <div class="profile-header">
                        <div class="d-flex align-items-center">
                            <div class="patient-avatar {{ $patient->gender == 'male' ? 'male' : 'female' }}">
                                {{ substr($patient->name, 0, 1) }}
                            </div>
                            <div>
                                <h2 class="patient-name">
                                    {{ $patient->name }}
                                </h2>
                                <div class="text-muted">
                                    <i class="fas fa-id-card me-1"></i>{{ $patient->medical_record_number }}
                                </div>
                                <span class="gender-badge {{ $patient->gender == 'male' ? 'badge-male' : 'badge-female' }}">
                                    <i class="fas fa-{{ $patient->gender == 'male' ? 'mars' : 'venus' }} me-1"></i>
                                    {{ $patient->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="profile-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-birthday-cake"></i>Tanggal Lahir
                                    </div>
                                    <div class="detail-value">
                                        {{ \Carbon\Carbon::parse($patient->birth_date)->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-user-clock"></i>Usia
                                    </div>
                                    <div class="detail-value">{{ \Carbon\Carbon::parse($patient->birth_date)->age }} tahun
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-tint"></i>Golongan Darah
                                    </div>
                                    <div class="detail-value">{{ $patient->blood_type ?? 'Tidak Diketahui' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-clipboard-list"></i>Jumlah Kasus
                                    </div>
                                    <div class="detail-value">
                                        <span class="badge bg-primary rounded-pill">{{ $cases->count() }}</span>
                                    </div>
                                </div>
                            </div>

                            @if ($patient->address)
                                <div class="col-12">
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-map-marker-alt"></i>Alamat
                                        </div>
                                        <div class="detail-value">{{ $patient->address }}</div>
                                    </div>
                                </div>
                            @endif

                            @if ($patient->notes)
                                <div class="col-12">
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-sticky-note"></i>Catatan Medis
                                        </div>
                                        <div class="med-notes">{{ $patient->notes }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('askep.create', $patient) }}" class="btn btn-success">
                                <i class="fas fa-plus-circle me-2"></i>Buat Askep Baru
                            </a>
                            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-outline-dark">
                                <i class="fas fa-user-edit me-2"></i>Edit Data Pasien
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Case History Timeline -->
            <div class="col-lg-8">
                <div class="history-section animate-fade-in-up delay-2">
                    <div class="history-header">
                        <i class="fas fa-calendar-alt"></i>
                        <h4 class="mb-0">Riwayat Asuhan Keperawatan</h4>
                    </div>

                    <div class="history-body">
                        @if ($cases->count() > 0)
                            <div class="timeline">
                                @foreach ($cases as $index => $case)
                                    <div class="timeline-item" style="animation-delay: {{ 0.3 + $index * 0.1 }}s">
                                        <div
                                            class="timeline-point {{ $case->status == 'selesai' ? 'completed' : 'in-progress' }}">
                                        </div>

                                        <div class="case-card">
                                            <div class="case-header">
                                                <div class="case-timestamp">
                                                    <i class="far fa-calendar-alt"></i>
                                                    {{ $case->created_at->format('d M Y, H:i') }}
                                                </div>

                                                <div
                                                    class="case-status {{ $case->status == 'selesai' ? 'status-completed' : 'status-in-progress' }}">
                                                    <i
                                                        class="fas fa-{{ $case->status == 'selesai' ? 'check-circle' : 'spinner fa-pulse' }} me-1"></i>
                                                    {{ $case->status == 'selesai' ? 'Selesai' : 'Dalam Proses' }}
                                                </div>
                                            </div>

                                            <div class="case-body">
                                                <div class="row case-section-row">
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="case-section">
                                                            <div class="case-section-title">
                                                                <i class="fas fa-stethoscope diagnosis-icon"></i>
                                                                Diagnosis
                                                            </div>

                                                            @if ($case->diagnosis)
                                                                <div class="diagnosis-item">
                                                                    <div class="diagnosis-name">
                                                                        {{ $case->diagnosis->name }}</div>
                                                                    <div class="diagnosis-code">
                                                                        <i class="fas fa-tag"></i>
                                                                        Kode: {{ $case->diagnosis->code }}
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="text-muted">
                                                                    <i class="fas fa-info-circle me-1"></i>
                                                                    Diagnosis belum ditentukan
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="case-section">
                                                            <div class="case-section-title">
                                                                <i class="fas fa-clipboard-check outcome-icon"></i>
                                                                Luaran & Intervensi
                                                            </div>

                                                            @if ($case->outcomes->count() > 0)
                                                                <div>
                                                                    <span class="badge-counter badge-outcomes">
                                                                        <i class="fas fa-check-circle"></i>
                                                                        {{ $case->outcomes->count() }} Luaran
                                                                    </span>

                                                                    <span class="badge-counter badge-interventions">
                                                                        <i class="fas fa-tasks"></i>
                                                                        {{ $case->implementations->count() }} Intervensi
                                                                    </span>
                                                                </div>
                                                            @else
                                                                <div class="text-muted">
                                                                    <i class="fas fa-info-circle me-1"></i>
                                                                    Belum ada luaran dan intervensi
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="case-section">
                                                            <div class="case-section-title">
                                                                <i class="fas fa-chart-line evaluation-icon"></i>
                                                                Evaluasi
                                                            </div>

                                                            @if ($case->evaluation)
                                                                <div
                                                                    class="case-status {{ $case->evaluation->result == 'tercapai' ? 'status-completed' : 'status-in-progress' }}">
                                                                    <i class="fas fa-{{ $case->evaluation->result == 'tercapai' ? 'check-double' : 'hourglass-half' }} me-1"></i>
                                                                    {{ $case->evaluation->result == 'tercapai' ? 'Tercapai' : 'Belum Tercapai' }}
                                                                </div>

                                                                <div class="soap-summary mt-2">
                                                                    @if ($case->evaluation->evaluation_time)
                                                                        <div class="soap-time mb-2 d-flex flex-wrap gap-2">
                                                                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">
                                                                                <i class="far fa-calendar-alt me-1"></i>
                                                                                {{ \Carbon\Carbon::parse($case->evaluation->evaluation_time)->format('d M Y') }}
                                                                            </span>
                                                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                                                                <i class="far fa-clock me-1"></i>
                                                                                {{ \Carbon\Carbon::parse($case->evaluation->evaluation_time)->format('H:i') }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="soap-time mb-2">
                                                                            <span class="badge bg-light text-muted px-3 py-2">
                                                                                <i class="fas fa-exclamation-circle me-1"></i>Waktu belum diatur
                                                                            </span>
                                                                        </div>
                                                                    @endif

                                                                    <button class="btn btn-sm btn-primary mt-2 w-100"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#soapDetailModal{{ $case->id }}">
                                                                        <i class="fas fa-file-medical me-2"></i>Lihat Detail SOAP
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="text-muted">
                                                                    <i class="fas fa-info-circle me-1"></i>
                                                                    Belum ada evaluasi
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="case-footer">
                                                @if ($case->status == 'proses')
                                                    @if (!$case->diagnosis_id)
                                                        <a href="{{ route('askep.diagnosis', $case->id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-arrow-right"></i>Lanjutkan Askep
                                                        </a>
                                                    @elseif($case->outcomes->count() == 0)
                                                        <a href="{{ route('askep.outcome', $case->id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-arrow-right"></i>Lanjutkan Askep
                                                        </a>
                                                    @elseif($case->implementations->count() == 0)
                                                        <a href="{{ route('askep.intervention', $case->id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-arrow-right"></i>Lanjutkan Askep
                                                        </a>
                                                    @elseif(!$case->evaluation)
                                                        <a href="{{ route('askep.evaluation', $case->id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-arrow-right"></i>Lanjutkan Askep
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="#" class="btn btn-outline-primary"
                                                        onclick="printReport({{ $case->id }})">
                                                        <i class="fas fa-print me-2"></i>Cetak Laporan
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state animate-fade-in-up delay-3">
                                <img src="https://cdn-icons-png.flaticon.com/512/3588/3588294.png" alt="No history"
                                    class="empty-icon">
                                <h3 class="empty-title">Belum ada riwayat asuhan keperawatan</h3>
                                <p class="empty-subtitle">Pasien ini belum memiliki riwayat asuhan keperawatan</p>
                                <a href="{{ route('askep.create', $patient) }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Mulai Askep Baru
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SOAP Detail Modal -->
    @foreach ($cases as $case)
        @if ($case->evaluation)
            <div class="modal fade" id="soapDetailModal{{ $case->id }}" tabindex="-1"
                aria-labelledby="soapDetailModalLabel{{ $case->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary text-white">
                            <h5 class="modal-title fw-bold" id="soapDetailModalLabel{{ $case->id }}">
                                <i class="fas fa-clipboard-check me-2"></i>Detail Evaluasi SOAP
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <!-- Evaluation Information -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="position-relative">
                                        <div class="avatar-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                                            <i class="fas fa-calendar-check fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="fw-bold mb-1">Evaluasi pada</h6>
                                        @if ($case->evaluation->evaluation_time)
                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge rounded-pill bg-light text-dark border px-3 py-2 d-flex align-items-center">
                                                    <i class="far fa-calendar-alt me-2 text-primary"></i>
                                                    {{ \Carbon\Carbon::parse($case->evaluation->evaluation_time)->isoFormat('D MMMM Y') }}
                                                </span>
                                                <span class="badge rounded-pill bg-light text-dark border px-3 py-2 d-flex align-items-center">
                                                    <i class="far fa-clock me-2 text-primary"></i>
                                                    {{ \Carbon\Carbon::parse($case->evaluation->evaluation_time)->format('H:i') }} WIB
                                                </span>
                                            </div>
                                        @else
                                            <span class="badge rounded-pill bg-light text-muted border px-3 py-2">
                                                <i class="fas fa-exclamation-circle me-2"></i>Waktu belum diatur
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="position-relative">
                                        <div class="avatar-circle {{ $case->evaluation->result == 'tercapai' ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning' }} d-flex align-items-center justify-content-center">
                                            <i class="fas {{ $case->evaluation->result == 'tercapai' ? 'fa-check-circle' : 'fa-hourglass-half' }} fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="fw-bold mb-1">Status Evaluasi</h6>
                                        <span class="badge rounded-pill {{ $case->evaluation->result == 'tercapai' ? 'bg-success' : 'bg-warning' }} px-3 py-2">
                                            {{ $case->evaluation->result == 'tercapai' ? 'Tercapai' : 'Belum Tercapai' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- SOAP Tabs -->
                            <ul class="nav nav-pills nav-fill mb-4" id="soapTab{{ $case->id }}" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="subjective-tab{{ $case->id }}" data-bs-toggle="pill"
                                        data-bs-target="#subjective{{ $case->id }}" type="button" role="tab" aria-selected="true">
                                        <i class="fas fa-comment-medical me-2"></i>Subjective
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="objective-tab{{ $case->id }}" data-bs-toggle="pill"
                                        data-bs-target="#objective{{ $case->id }}" type="button" role="tab" aria-selected="false">
                                        <i class="fas fa-microscope me-2"></i>Objective
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="assessment-tab{{ $case->id }}" data-bs-toggle="pill"
                                        data-bs-target="#assessment{{ $case->id }}" type="button" role="tab" aria-selected="false">
                                        <i class="fas fa-stethoscope me-2"></i>Assessment
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="plan-tab{{ $case->id }}" data-bs-toggle="pill"
                                        data-bs-target="#plan{{ $case->id }}" type="button" role="tab" aria-selected="false">
                                        <i class="fas fa-clipboard-list me-2"></i>Plan
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content p-0" id="soapTabContent{{ $case->id }}">
                                <!-- Subjective Tab -->
                                <div class="tab-pane fade show active" id="subjective{{ $case->id }}" role="tabpanel">
                                    <div class="soap-card">
                                        <div class="soap-card-header bg-primary bg-opacity-10">
                                            <i class="fas fa-comment-medical text-primary"></i> S (Subjective)
                                        </div>
                                        <div class="soap-card-body">
                                            @if ($case->evaluation->subjective)
                                                {{ $case->evaluation->subjective }}
                                            @else
                                                <p class="text-muted fst-italic">Tidak ada data subjektif yang tercatat</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Objective Tab -->
                                <div class="tab-pane fade" id="objective{{ $case->id }}" role="tabpanel">
                                    <div class="soap-card">
                                        <div class="soap-card-header bg-info bg-opacity-10">
                                            <i class="fas fa-microscope text-info"></i> O (Objective)
                                        </div>
                                        <div class="soap-card-body">
                                            @if ($case->evaluation->objective)
                                                {{ $case->evaluation->objective }}
                                            @else
                                                <p class="text-muted fst-italic">Tidak ada data objektif yang tercatat</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Assessment Tab -->
                                <div class="tab-pane fade" id="assessment{{ $case->id }}" role="tabpanel">
                                    <div class="soap-card">
                                        <div class="soap-card-header bg-warning bg-opacity-10">
                                            <i class="fas fa-stethoscope text-warning"></i> A (Assessment)
                                        </div>
                                        <div class="soap-card-body">
                                            @if ($case->evaluation->assessment)
                                                {{ $case->evaluation->assessment }}
                                            @else
                                                <p class="text-muted fst-italic">Tidak ada penilaian yang tercatat</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Plan Tab -->
                                <div class="tab-pane fade" id="plan{{ $case->id }}" role="tabpanel">
                                    <div class="soap-card">
                                        <div class="soap-card-header bg-success bg-opacity-10">
                                            <i class="fas fa-clipboard-list text-success"></i> P (Plan)
                                        </div>
                                        <div class="soap-card-body">
                                            @if ($case->evaluation->plan)
                                                {{ $case->evaluation->plan }}
                                            @else
                                                <p class="text-muted fst-italic">Tidak ada rencana yang tercatat</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Tutup
                            </button>
                            @if ($case->status == 'proses')
                                <a href="{{ route('askep.evaluation', $case->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>Edit Evaluasi
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Apply animation to timeline items
            const timelineItems = document.querySelectorAll('.timeline-item');
            timelineItems.forEach((item, index) => {
                item.classList.add('animate-fade-in-up');
                item.style.animationDelay = `${0.3 + (index * 0.1)}s`;
            });

            // Fix for any horizontal overflow issues
            document.querySelectorAll('.text-muted, .detail-value, .diagnosis-name').forEach(element => {
                if (element.offsetWidth > element.parentElement.offsetWidth) {
                    element.style.wordBreak = 'break-word';
                }
            });

            // Initialize tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            if (tooltipTriggerList.length > 0 && typeof bootstrap !== 'undefined') {
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
            }
        });

        function printReport(caseId) {
            window.open('/askep/' + caseId + '/print', '_blank');
        }
    </script>
@endsection
