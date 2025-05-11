@extends('layouts.app')

@section('title', 'Panduan Penggunaan - AskepPro')

@section('styles')
<style>
    :root {
        --primary-color: #1e88e5;
        --secondary-color: #5e35b1;
        --success-color: #43a047;
        --warning-color: #fb8c00;
        --danger-color: #e53935;
        --purple-color: #8e24aa;
        --dark-color: #546e7a;
        --light-bg: #f5f9fc;
        --card-shadow: 0 5px 15px rgba(0,0,0,0.05);
        --card-hover-shadow: 0 10px 25px rgba(0,0,0,0.1);
        --border-radius: 12px;
        --transition: all 0.25s ease;
    }

    body {
        scroll-padding-top: 80px;
    }

    .guide-section {
        transition: var(--transition);
        scroll-margin-top: 80px;
        margin-bottom: 2rem;
    }

    .guide-card {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        height: 100%;
        transition: var(--transition);
        background-color: #fff;
    }

    .guide-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-3px);
    }

    .guide-card .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: #fff;
        font-weight: 600;
        border-bottom: none;
        padding: 1rem 1.25rem;
        font-size: 1.1rem;
    }

    .guide-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: var(--border-radius);
        padding: 2.5rem 2rem;
        margin-bottom: 2.5rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .guide-header::before, .guide-header::after {
        content: '';
        position: absolute;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .guide-header::before {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -100px;
    }

    .guide-header::after {
        width: 200px;
        height: 200px;
        bottom: -100px;
        left: -100px;
    }

    .guide-header h1 {
        position: relative;
        z-index: 1;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .toc-wrapper {
        transition: var(--transition);
    }

    .toc-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        margin-bottom: 0.75rem;
        text-decoration: none;
        color: #455a64;
        font-weight: 500;
        transition: var(--transition);
    }

    .toc-link:hover, .toc-link.active {
        background-color: rgba(30, 136, 229, 0.1);
        color: var(--primary-color);
        transform: translateX(5px);
    }

    .toc-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-right: 15px;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .workflow-step {
        position: relative;
        padding-bottom: 2rem;
    }

    .workflow-step:not(:last-child)::after {
        content: '';
        position: absolute;
        height: calc(100% - 70px);
        width: 3px;
        background: linear-gradient(to bottom, #e3f2fd, #bbdefb);
        left: 28px;
        top: 70px;
    }

    .workflow-icon {
        width: 60px;
        height: 60px;
        padding: 0 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        position: relative;
        z-index: 2;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    .collapse-table {
        border-radius: var(--border-radius);
        overflow: hidden;
    }

    .card-feature {
        border: none;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        border-radius: var(--border-radius);
        transition: var(--transition);
        height: 100%;
    }

    .card-feature:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
        color: white;
    }

    .toc-mobile-toggle {
        display: none;
        width: 100%;
        margin-bottom: 1.5rem;
        border-radius: var(--border-radius);
        padding: 0.75rem;
        background: #fff;
        box-shadow: var(--card-shadow);
        color: var(--primary-color);
        border: 1px solid rgba(0,0,0,0.05);
        font-weight: 500;
        transition: var(--transition);
    }

    .toc-mobile-toggle:hover {
        background: var(--primary-color);
        color: #fff;
    }

    .img-container {
        position: relative;
        margin-bottom: 1.5rem;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .img-container img {
        width: 100%;
        object-fit: cover;
        height: auto;
        transition: var(--transition);
    }

    .img-container:hover img {
        transform: scale(1.03);
    }

    .img-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        background: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .alert {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .table-responsive {
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .table {
        margin-bottom: 0;
    }

    /* Enhanced mobile styles */
    @media (max-width: 991.98px) {
        .sticky-lg-top {
            position: relative !important;
            top: 0 !important;
        }

        .toc-mobile-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .toc-wrapper {
            display: none;
            margin-bottom: 2rem;
        }

        .guide-header {
            padding: 1.5rem;
        }

        .guide-header h1 {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 767.98px) {
        .container-fluid {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        .guide-header {
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .guide-header h1 {
            font-size: 1.5rem;
        }

        .workflow-step:not(:last-child)::after {
            left: 24px;
            width: 2px;
        }


        .toc-icon {
            width: 36px;
            height: 36px;
            font-size: 1rem;
            margin-right: 10px;
        }

        .card-body {
            padding: 1rem;
        }

        .card-header {
            padding: 0.75rem 1rem;
        }

        h5 {
            font-size: 1.1rem;
        }

        .guide-section {
            margin-bottom: 1.25rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <!-- Guide Header -->
    <div class="guide-header">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1>Panduan Penggunaan AskepPro</h1>
                <p class="mb-0 opacity-85">Pelajari cara menggunakan AskepPro untuk manajemen asuhan keperawatan berbasis standar SDKI, SLKI, dan SIKI</p>
            </div>
            <div class="col-lg-4 text-end d-none d-lg-block">
                <i class="fas fa-book-open fa-5x opacity-25"></i>
            </div>
        </div>
    </div>

    <!-- Mobile TOC Toggle Button -->
    <button id="toc-mobile-toggle" class="toc-mobile-toggle d-lg-none" type="button">
        <span><i class="fas fa-list me-2"></i>Lihat Daftar Isi</span>
        <i class="fas fa-chevron-down"></i>
    </button>

    <div class="row g-4">
        <!-- Table of Contents Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="toc-wrapper">
                <div class="card sticky-lg-top guide-card" style="top: 80px; z-index: 1;">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-list me-2"></i>Daftar Isi
                    </div>
                    <div class="card-body">
                        <a href="#overview" class="toc-link">
                            <div class="toc-icon" style="background-color: var(--primary-color);">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div>Gambaran Umum</div>
                        </a>
                        <a href="#workflow" class="toc-link">
                            <div class="toc-icon" style="background-color: var(--success-color);">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <div>Alur Kerja</div>
                        </a>
                        <a href="#patient" class="toc-link">
                            <div class="toc-icon" style="background-color: var(--warning-color);">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>Manajemen Pasien</div>
                        </a>
                        <a href="#diagnoses" class="toc-link">
                            <div class="toc-icon" style="background-color: var(--danger-color);">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                            <div>Diagnosis Keperawatan</div>
                        </a>
                        <a href="#interventions" class="toc-link">
                            <div class="toc-icon" style="background-color: var(--purple-color);">
                                <i class="fas fa-notes-medical"></i>
                            </div>
                            <div>Intervensi Keperawatan</div>
                        </a>
                        <a href="#report" class="toc-link">
                            <div class="toc-icon" style="background-color: var(--dark-color);">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div>Laporan Asuhan</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Overview Section -->
            <div id="overview" class="guide-section">
                <div class="card guide-card">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-2"></i>1. Gambaran Umum
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8 mb-4 mb-md-0">
                                <p class="lead">AskepPro adalah aplikasi profesional untuk manajemen asuhan keperawatan berbasis standar SDKI, SLKI, dan SIKI.</p>

                                <div class="mt-4">
                                    <h5 class="mb-3">Fitur Utama Aplikasi:</h5>
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3 text-primary">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div>Pencatatan data pasien</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3 text-primary">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div>Asuhan keperawatan berbasis gejala</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3 text-primary">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div>Diagnosis keperawatan tepat</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3 text-primary">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div>Perencanaan luaran keperawatan</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3 text-primary">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div>Intervensi keperawatan</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3 text-primary">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div>Implementasi tindakan</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3 text-primary">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div>Evaluasi asuhan keperawatan</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3 text-primary">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div>Cetak laporan asuhan</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="rounded-circle p-4 mx-auto" style="background: var(--light-bg); width: 180px; height: 180px; display: flex; align-items: center; justify-content: center;">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3209/3209032.png" alt="AskepPro" class="img-fluid" style="max-width: 120px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Workflow Section -->
            <div id="workflow" class="guide-section">
                <div class="card guide-card">
                    <div class="card-header">
                        <i class="fas fa-project-diagram me-2"></i>2. Alur Kerja
                    </div>
                    <div class="card-body">
                        <p class="lead mb-4">Alur kerja asuhan keperawatan dalam AskepPro mengikuti tahapan standar proses keperawatan:</p>

                        <div class="row">
                            <div class="col-12">
                                <div class="workflow-step d-flex">
                                    <div class="workflow-icon me-3 d-none d-md-flex" style="background: linear-gradient(135deg, var(--primary-color), #64b5f6);">
                                        <i class="fas fa-clipboard-list "></i>
                                    </div>
                                    <div class="workflow-content">
                                        <h5 class="mb-2">
                                            <span class="d-inline d-md-none text-primary me-2"><i class="fas fa-clipboard-list"></i></span>
                                            1. Pengkajian
                                        </h5>
                                        <p class="text-muted mb-0">Input data pasien dan dokumentasikan gejala yang diamati. Sistem akan membantu mengidentifikasi gejala utama dan pendukung untuk menentukan diagnosis.</p>
                                    </div>
                                </div>

                                <div class="workflow-step d-flex">
                                    <div class="workflow-icon me-3 d-none d-md-flex" style="background: linear-gradient(135deg, var(--success-color), #81c784);">
                                        <i class="fas fa-stethoscope"></i>
                                    </div>
                                    <div class="workflow-content">
                                        <h5 class="mb-2">
                                            <span class="d-inline d-md-none text-success me-2"><i class="fas fa-stethoscope"></i></span>
                                            2. Diagnosis
                                        </h5>
                                        <p class="text-muted mb-0">Berdasarkan gejala yang diinput, sistem akan menyarankan diagnosis keperawatan sesuai standar SDKI. Pilih diagnosis yang paling sesuai.</p>
                                    </div>
                                </div>

                                <div class="workflow-step d-flex">
                                    <div class="workflow-icon me-3 d-none d-md-flex" style="background: linear-gradient(135deg, var(--warning-color), #ffb74d);">
                                        <i class="fas fa-bullseye"></i>
                                    </div>
                                    <div class="workflow-content">
                                        <h5 class="mb-2">
                                            <span class="d-inline d-md-none text-warning me-2"><i class="fas fa-bullseye"></i></span>
                                            3. Perencanaan
                                        </h5>
                                        <p class="text-muted mb-0">Tetapkan luaran keperawatan yang diinginkan berdasarkan SLKI dan pilih intervensi yang sesuai dari rekomendasi sistem berdasarkan SIKI.</p>
                                    </div>
                                </div>

                                <div class="workflow-step d-flex">
                                    <div class="workflow-icon me-3 d-none d-md-flex" style="background: linear-gradient(135deg, var(--secondary-color), #7986cb);">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <div class="workflow-content">
                                        <h5 class="mb-2">
                                            <span class="d-inline d-md-none text-secondary me-2"><i class="fas fa-tasks"></i></span>
                                            4. Implementasi
                                        </h5>
                                        <p class="text-muted mb-0">Lakukan intervensi yang telah direncanakan dan catat hasil implementasi serta respons pasien terhadap tindakan yang dilakukan.</p>
                                    </div>
                                </div>

                                <div class="workflow-step d-flex">
                                    <div class="workflow-icon me-3 d-none d-md-flex" style="background: linear-gradient(135deg, var(--purple-color), #ba68c8);">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="workflow-content">
                                        <h5 class="mb-2">
                                            <span class="d-inline d-md-none text-purple me-2"><i class="fas fa-chart-line"></i></span>
                                            5. Evaluasi
                                        </h5>
                                        <p class="text-muted mb-0">Evaluasi hasil luaran keperawatan berdasarkan indikator yang telah ditetapkan dan buat kesimpulan apakah tujuan tercapai.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-light border p-3">
                                    <div class="d-flex">
                                        <div class="me-3 text-primary">
                                            <i class="fas fa-lightbulb fs-5"></i>
                                        </div>
                                        <div>
                                            <strong>Tip Alur Kerja:</strong> Ikuti setiap tahapan secara berurutan untuk hasil yang optimal. Sistem akan mengarahkan Anda dari satu tahap ke tahap berikutnya secara otomatis.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Patient Management -->
            <div id="patient" class="guide-section">
                <div class="card guide-card">
                    <div class="card-header">
                        <i class="fas fa-user me-2"></i>3. Manajemen Pasien
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card card-feature h-100">
                                    <div class="card-body">
                                        <div class="feature-icon mb-3" style="background: linear-gradient(45deg, var(--primary-color), #64b5f6);">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <h5 class="card-title mb-3">Menambahkan Pasien Baru</h5>
                                        <ol class="ps-3 mb-0">
                                            <li class="mb-2">Klik menu "Pasien" pada sidebar</li>
                                            <li class="mb-2">Klik tombol "Tambah Pasien Baru"</li>
                                            <li class="mb-2">Isi formulir data pasien dengan lengkap</li>
                                            <li>Klik "Simpan" untuk menyimpan data pasien</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-feature h-100">
                                    <div class="card-body">
                                        <div class="feature-icon mb-3" style="background: linear-gradient(45deg, var(--success-color), #81c784);">
                                            <i class="fas fa-clipboard-check"></i>
                                        </div>
                                        <h5 class="card-title mb-3">Memulai Asuhan Keperawatan</h5>
                                        <ol class="ps-3 mb-0">
                                            <li class="mb-2">Cari pasien yang ingin diberikan asuhan</li>
                                            <li class="mb-2">Klik tombol "Buat Asuhan Baru"</li>
                                            <li class="mb-2">Pilih gejala-gejala yang dialami pasien</li>
                                            <li>Klik "Selanjutnya" untuk melanjutkan</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="alert alert-info d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-info-circle fs-4"></i>
                                    </div>
                                    <div>
                                        <strong>Tip:</strong> Pastikan data pasien terisi dengan lengkap dan akurat untuk membantu proses pengkajian dan diagnosis yang tepat. Anda dapat mengedit data pasien kapan saja jika ada informasi yang perlu diperbarui.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagnoses Section -->
            <div id="diagnoses" class="guide-section">
                <div class="card guide-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-stethoscope me-2"></i>4. Diagnosis Keperawatan</span>
                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#diagnosisListCollapse" aria-expanded="false" aria-controls="diagnosisListCollapse">
                            <i class="fas fa-table me-1"></i>Lihat Diagnosis
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-6 mb-4">
                                <div class="img-container">
                                    <img src="https://cdn-icons-png.flaticon.com/512/4404/4404156.png" alt="Diagnosis" class="img-fluid">
                                    <div class="img-badge text-primary">SDKI</div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <p>AskepPro menggunakan database diagnosis keperawatan berdasarkan SDKI. Sistem akan menyarankan diagnosis yang paling sesuai berdasarkan gejala yang dipilih saat pengkajian.</p>

                                <h5 class="mt-4 mb-3">Cara Memilih Diagnosis</h5>
                                <div class="d-flex mb-2">
                                    <div class="me-2 text-primary" style="width: 24px; text-align: center;">1.</div>
                                    <div>Setelah memilih gejala, sistem akan menampilkan saran diagnosis berdasarkan gejala</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="me-2 text-primary" style="width: 24px; text-align: center;">2.</div>
                                    <div>Pilih diagnosis yang paling sesuai dengan kondisi pasien</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="me-2 text-primary" style="width: 24px; text-align: center;">3.</div>
                                    <div>Tentukan penyebab (etiologi) dari diagnosis tersebut</div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-2 text-primary" style="width: 24px; text-align: center;">4.</div>
                                    <div>Klik "Simpan & Lanjutkan" untuk melanjutkan ke perencanaan luaran</div>
                                </div>
                            </div>
                        </div>

                        <div class="collapse mt-4" id="diagnosisListCollapse">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Diagnosis</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($diagnoses as $diagnosis)
                                        <tr>
                                            <td><span class="badge bg-primary">{{ $diagnosis->code }}</span></td>
                                            <td><strong>{{ $diagnosis->name }}</strong></td>
                                            <td>{{ $diagnosis->description }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interventions Section -->
            <div id="interventions" class="guide-section">
                <div class="card guide-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-notes-medical me-2"></i>5. Intervensi Keperawatan</span>
                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#interventionListCollapse" aria-expanded="false" aria-controls="interventionListCollapse">
                            <i class="fas fa-table me-1"></i>Lihat Intervensi
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-md-6 order-md-1 order-2">
                                <p>Intervensi keperawatan dalam AskepPro didasarkan pada SIKI, yang merekomendasikan tindakan-tindakan yang sesuai untuk setiap diagnosis keperawatan.</p>

                                <h5 class="mt-4 mb-3">Cara Mengelola Intervensi</h5>
                                <div class="d-flex mb-2">
                                    <div class="me-2 text-success" style="width: 24px; text-align: center;">1.</div>
                                    <div>Setelah menetapkan luaran keperawatan, sistem akan menampilkan rekomendasi intervensi</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="me-2 text-success" style="width: 24px; text-align: center;">2.</div>
                                    <div>Centang intervensi yang akan dilakukan untuk pasien</div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-2 text-success" style="width: 24px; text-align: center;">3.</div>
                                    <div>Klik "Simpan & Lanjutkan" untuk melanjutkan ke implementasi</div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 mb-4 mb-md-0 order-md-2 order-1">
                                <div class="img-container">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2376/2376100.png" alt="Intervensi" class="img-fluid">
                                    <div class="img-badge text-success">SIKI</div>
                                </div>
                            </div>
                        </div>

                        <div class="collapse mt-4" id="interventionListCollapse">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Intervensi</th>
                                            <th>Kategori</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($interventions as $intervention)
                                        <tr>
                                            <td><span class="badge bg-success">{{ $intervention->code }}</span></td>
                                            <td><strong>{{ $intervention->name }}</strong></td>
                                            <td><span class="badge bg-light text-dark">{{ $intervention->category }}</span></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Section -->
            <div id="report" class="guide-section">
                <div class="card guide-card">
                    <div class="card-header">
                        <i class="fas fa-file-pdf me-2"></i>6. Laporan Asuhan Keperawatan
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <div class="rounded-circle mx-auto mb-3" style="background: rgba(244, 67, 54, 0.1); width: 160px; height: 160px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-file-pdf text-danger fa-4x"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <p>Setelah menyelesaikan semua tahapan asuhan keperawatan, Anda dapat mencetak laporan untuk dokumentasi.</p>

                                <h5 class="mt-4 mb-3">Cara Mencetak Laporan</h5>
                                <div class="d-flex mb-2">
                                    <div class="me-2 text-danger" style="width: 24px; text-align: center;">1.</div>
                                    <div>Setelah menyelesaikan evaluasi, status asuhan akan berubah menjadi "Selesai"</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="me-2 text-danger" style="width: 24px; text-align: center;">2.</div>
                                    <div>Klik tombol "Cetak Laporan" pada halaman detail asuhan</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="me-2 text-danger" style="width: 24px; text-align: center;">3.</div>
                                    <div>Sistem akan menghasilkan PDF yang berisi semua informasi asuhan keperawatan</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="me-2 text-danger" style="width: 24px; text-align: center;">4.</div>
                                    <div>Laporan dapat diunduh dan dicetak sebagai dokumentasi resmi</div>
                                </div>

                                <div class="alert alert-warning mt-4 mb-0">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-exclamation-triangle fs-4"></i>
                                        </div>
                                        <div>
                                            <strong>Penting:</strong> Laporan hanya dapat dicetak setelah semua tahap asuhan keperawatan selesai. Pastikan semua data terisi dengan lengkap untuk menghasilkan laporan yang valid.
                                        </div>
                                    </div>
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
        // Smooth scrolling for anchor links
        const scrollLinks = document.querySelectorAll('a[href^="#"]');
        const tocMobileToggle = document.getElementById('toc-mobile-toggle');
        const tocWrapper = document.querySelector('.toc-wrapper');

        // Mobile menu toggle functionality
        tocMobileToggle.addEventListener('click', function() {
            if (tocWrapper.style.display === 'block') {
                tocWrapper.style.display = 'none';
                this.innerHTML = '<span><i class="fas fa-list me-2"></i>Lihat Daftar Isi</span><i class="fas fa-chevron-down"></i>';
            } else {
                tocWrapper.style.display = 'block';
                this.innerHTML = '<span><i class="fas fa-times me-2"></i>Tutup Daftar Isi</span><i class="fas fa-chevron-up"></i>';
            }
        });

        // Smooth scrolling implementation
        scrollLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    // Remove active class from all links and add to current
                    scrollLinks.forEach(link => link.classList.remove('active'));
                    this.classList.add('active');

                    // Smooth scroll to target
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });

                    // On mobile, hide TOC after clicking
                    if (window.innerWidth < 992) {
                        tocWrapper.style.display = 'none';
                        tocMobileToggle.innerHTML = '<span><i class="fas fa-list me-2"></i>Lihat Daftar Isi</span><i class="fas fa-chevron-down"></i>';
                    }

                    // Update URL without page reload
                    history.pushState(null, null, targetId);
                }
            });
        });

        // Highlight current section on scroll
        const sections = document.querySelectorAll('.guide-section');

        function highlightCurrentSection() {
            let scrollPosition = window.scrollY + 100;

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;

                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    const id = section.getAttribute('id');
                    scrollLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === '#' + id) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }

        // Handle responsive behavior
        function handleResponsive() {
            if (window.innerWidth >= 992) {
                tocWrapper.style.display = 'block';
            } else {
                tocWrapper.style.display = 'none';
                tocMobileToggle.innerHTML = '<span><i class="fas fa-list me-2"></i>Lihat Daftar Isi</span><i class="fas fa-chevron-down"></i>';
            }
        }

        window.addEventListener('scroll', highlightCurrentSection);
        window.addEventListener('resize', handleResponsive);

        // Initial setup
        handleResponsive();
        highlightCurrentSection();

        // Add active class to first link by default
        const firstLink = document.querySelector('.toc-link');
        if (firstLink) {
            firstLink.classList.add('active');
        }
    });
</script>
@endsection
