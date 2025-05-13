<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AskepPro') - Aplikasi Asuhan Keperawatan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            --primary-color: #1e88e5;
            --secondary-color: #5e35b1;
            --accent-color: #43a047;
            --dark-color: #2c3e50;
            --light-bg: #f8f9fa;
            --text-color: #37474f;
            --text-muted: #78909c;
            --border-color: #e0e0e0;
            --topbar-height: 64px;
            --transition-speed: 0.25s;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--text-color);
            overflow-x: hidden;
            transition: background-color 0.3s ease;
        }

        #wrapper {
            min-height: 100vh;
            display: flex;
        }

        /* ===== SIDEBAR STYLING ===== */
        #sidebar-wrapper {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(135deg, #2b3f66 0%, #1c2838 100%);
            transition: all var(--transition-speed) ease-out;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            z-index: 1040;
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            background: rgba(67, 160, 71, 0.2);
            color: var(--accent-color);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .logo-text {
            color: white;
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar-menu {
            padding: 1.25rem 0;
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-category {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 1rem 1.5rem 0.5rem;
        }

        .sidebar-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            margin: 4px 0;
        }

        .menu-link {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .menu-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.07);
            border-left-color: rgba(67, 160, 71, 0.5);
        }

        .menu-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-left-color: var(--accent-color);
        }

        .menu-icon {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1rem;
            text-align: center;
            transition: margin 0.3s ease;
        }

        .menu-text {
            transition: opacity 0.3s ease;
        }

        /* User info in sidebar */
        .sidebar-footer {
            padding: 1rem 1.5rem;
            background: rgba(0, 0, 0, 0.15);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
        }

        .user-details {
            overflow: hidden;
            transition: opacity 0.3s ease;
        }

        .user-name {
            color: white;
            font-size: 0.9rem;
            font-weight: 500;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
            margin: 0;
        }

        /* ===== PAGE CONTENT STYLING ===== */
        #page-content-wrapper {
            flex: 1;
            width: calc(100% - var(--sidebar-width));
            margin-left: var(--sidebar-width);
            transition: margin var(--transition-speed) ease-out, width var(--transition-speed) ease-out;
            display: flex;
            flex-direction: column;
        }

        /* Topbar styling */
        .top-navbar {
            height: var(--topbar-height);
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .menu-toggle-btn {
            background: transparent;
            border: none;
            color: var(--text-color);
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .menu-toggle-btn:hover {
            background: rgba(0, 0, 0, 0.04);
        }

        .page-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            margin-left: 1rem;
            color: var(--text-color);
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-item .nav-link {
            color: var(--text-color);
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-item .nav-link:hover {
            background: rgba(0, 0, 0, 0.04);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background-color: #f44336;
            color: white;
            font-size: 0.7rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-dropdown img {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            object-fit: cover;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 0.5rem;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 0.6rem 1rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.04);
        }

        .dropdown-divider {
            margin: 0.5rem 0;
        }

        /* Main Content Area */
        .content-container {
            padding: 1.5rem;
            flex: 1;
        }

        /* Cards and UI elements */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .alert-success {
            background-color: rgba(67, 160, 71, 0.1);
            color: #2e7d32;
        }

        .alert-danger {
            background-color: rgba(244, 67, 54, 0.1);
            color: #d32f2f;
        }

        .alert-icon {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .alert .btn-close {
            margin-left: auto;
        }

        /* Footer styling */
        footer {
            background-color: white;
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--border-color);
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        /* Responsive behavior */
        @media (max-width: 991.98px) {
            #sidebar-wrapper {
                margin-left: calc(-1 * var(--sidebar-width));
            }

            #page-content-wrapper {
                width: 100%;
                margin-left: 0;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }

            .top-navbar {
                padding: 0 1rem;
            }

            .content-container {
                padding: 1.25rem;
            }

            /* Add overlay when sidebar is open on mobile */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1035;
            }

            #wrapper.toggled .sidebar-overlay {
                display: block;
            }
        }

        /* Collapsed sidebar state */
        #wrapper.sidebar-collapsed #sidebar-wrapper {
            width: var(--sidebar-collapsed-width);
        }

        #wrapper.sidebar-collapsed #page-content-wrapper {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }

        #wrapper.sidebar-collapsed .logo-text,
        #wrapper.sidebar-collapsed .menu-text,
        #wrapper.sidebar-collapsed .user-details,
        #wrapper.sidebar-collapsed .menu-category {
            opacity: 0;
            visibility: hidden;
        }

        #wrapper.sidebar-collapsed .menu-icon {
            margin-right: 0;
        }

        #wrapper.sidebar-collapsed .logo-container {
            justify-content: center;
        }

        #wrapper.sidebar-collapsed .menu-link {
            justify-content: center;
            padding: 0.75rem;
        }

        /* Animated components */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
    <link href="{{ asset('assets/css/components/preloader.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <div class="askep-preloader">
        <div class="askep-preloader__content">
            <div class="askep-preloader__progress">
                <div class="askep-preloader__progress-bar"></div>
            </div>
            <div class="askep-preloader__text">
                Memuat ASKEP Pro...
            </div>
        </div>
    </div>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-logo">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h1 class="logo-text toggle-hide">AskepPro</h1>
                </div>
            </div>

            <div class="sidebar-menu">
                <div class="menu-category toggle-hide">Navigasi</div>
                <ul>
                    <li class="menu-item">
                        <a href="{{ route('dashboard') }}"
                            class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                            <span class="menu-icon"><i class="fas fa-tachometer-alt"></i></span>
                            <span class="menu-text toggle-hide">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('patients.index') }}"
                            class="menu-link {{ request()->routeIs('patients.*') ? 'active' : '' }}"
                            data-bs-toggle="tooltip" data-bs-placement="right" title="Data Pasien">
                            <span class="menu-icon"><i class="fas fa-user-injured"></i></span>
                            <span class="menu-text toggle-hide">Data Pasien</span>
                        </a>
                    </li>
                </ul>

                <div class="menu-category toggle-hide">Bantuan</div>
                <ul>
                    <li class="menu-item">
                        <a href="{{ route('guide.index') }}"
                            class="menu-link {{ request()->routeIs('guide.*') ? 'active' : '' }}"
                            data-bs-toggle="tooltip" data-bs-placement="right" title="Panduan">
                            <span class="menu-icon"><i class="fas fa-book-medical"></i></span>
                            <span class="menu-text toggle-hide">Panduan</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="user-details toggle-hide">
                        <p class="user-name">{{ Auth::user()->name }}</p>
                        <p class="user-role">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay for mobile -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="pt-4 px-4">
                <nav class="top-navbar rounded-pill shadow-sm">
                    <div class="d-flex align-items-center">
                        <button class="menu-toggle-btn rounded-circle" id="menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="page-title d-none d-sm-block">@yield('title', 'Dashboard')</h1>
                    </div>

                    <div class="ms-auto d-flex align-items-center">
                        <div class="nav-item position-relative me-3">
                            <a href="#" class="nav-link rounded-pill">
                                <i class="far fa-calendar-alt"></i>
                                <span class="ms-2 d-none d-lg-inline-block">{{ date('d M Y') }}</span>
                            </a>
                        </div>

                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center rounded-pill" href="#"
                                id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar rounded-circle">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="ms-2 d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="content-container">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Berhasil</h5>
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-exclamation-triangle fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Error</h5>
                                <p class="mb-0">{{ session('error') }}</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>

            <footer>
                <div class="container">
                    <p class="mb-0">© {{ date('Y') }} AskepPro - Aplikasi Asuhan Keperawatan Digital</p>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/components/preloader.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById("menu-toggle");
            const wrapper = document.getElementById("wrapper");
            const overlay = document.getElementById("sidebar-overlay");

            // Check if the sidebar was collapsed in previous session
            const sidebarState = localStorage.getItem('sidebar-collapsed');
            if (sidebarState === 'true') {
                wrapper.classList.add('sidebar-collapsed');
            }

            // Check if the sidebar was toggled in mobile view
            const sidebarMobileState = localStorage.getItem('sidebar-toggled');
            if (sidebarMobileState === 'true' && window.innerWidth < 992) {
                wrapper.classList.add('toggled');
            }

            function toggleSidebar() {
                const isMobile = window.innerWidth < 992;

                if (isMobile) {
                    wrapper.classList.toggle("toggled");
                    localStorage.setItem('sidebar-toggled', wrapper.classList.contains('toggled'));
                } else {
                    wrapper.classList.toggle("sidebar-collapsed");
                    localStorage.setItem('sidebar-collapsed', wrapper.classList.contains('sidebar-collapsed'));
                }
            }

            toggle.addEventListener("click", toggleSidebar);

            // Close sidebar when clicking overlay
            if (overlay) {
                overlay.addEventListener("click", function() {
                    if (wrapper.classList.contains('toggled')) {
                        wrapper.classList.remove('toggled');
                        localStorage.setItem('sidebar-toggled', 'false');
                    }
                });
            }

            // Auto-hide sidebar on mobile when clicking nav items
            const mediaQuery = window.matchMedia('(max-width: 991.98px)');
            if (mediaQuery.matches) {
                document.querySelectorAll('#sidebar-wrapper .menu-link').forEach(item => {
                    item.addEventListener('click', () => {
                        wrapper.classList.remove('toggled');
                        localStorage.setItem('sidebar-toggled', 'false');
                    });
                });
            }

            // Adjust sidebar behavior on resize
            window.addEventListener('resize', function() {
                const isMobile = window.innerWidth < 992;

                if (isMobile) {
                    wrapper.classList.remove('sidebar-collapsed');
                    if (localStorage.getItem('sidebar-toggled') === 'true') {
                        wrapper.classList.add('toggled');
                    } else {
                        wrapper.classList.remove('toggled');
                    }
                } else {
                    wrapper.classList.remove('toggled');
                    if (localStorage.getItem('sidebar-collapsed') === 'true') {
                        wrapper.classList.add('sidebar-collapsed');
                    }
                }
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
