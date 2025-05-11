<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AskepPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e88e5;
            --secondary-color: #5e35b1;
            --accent-color: #43a047;
            --text-color: #37474f;
            --light-bg: #f5f7fa;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: var(--text-color);
            position: relative;
            overflow-x: hidden;
        }

        .bg-shape {
            position: absolute;
            z-index: -1;
        }

        .shape-1 {
            top: -15%;
            right: -10%;
            width: 500px;
            height: 500px;
            border-radius: 62% 38% 70% 30% / 30% 27% 73% 70%;
            background: linear-gradient(135deg, rgba(94, 53, 177, 0.15) 0%, rgba(30, 136, 229, 0.15) 100%);
            animation: float 8s ease-in-out infinite;
        }

        .shape-2 {
            bottom: -15%;
            left: -10%;
            width: 400px;
            height: 400px;
            border-radius: 38% 62% 30% 70% / 70% 30% 70% 30%;
            background: linear-gradient(135deg, rgba(30, 136, 229, 0.15) 0%, rgba(67, 160, 71, 0.15) 100%);
            animation: float 9s ease-in-out infinite reverse;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(15px, 15px) rotate(5deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }

        .login-container {
            padding: 2rem 0;
        }

        .login-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row-reverse;
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .login-banner {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: var(--white);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 120%;
            height: 120%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            border-radius: 50%;
        }

        .banner-content {
            position: relative;
            z-index: 1;
        }

        .login-form-container {
            padding: 3rem;
            width: 100%;
        }

        .app-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2rem;
        }

        .logo-icon {
            font-size: 2rem;
            color: var(--accent-color);
            background: rgba(67, 160, 71, 0.15);
            height: 50px;
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            letter-spacing: 0.5px;
            margin: 0;
        }

        .login-title {
            color: var(--text-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: #607d8b;
            font-weight: 400;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            height: auto;
            border: 1px solid #dde1e6;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(30, 136, 229, 0.15);
        }

        .input-group-text {
            background-color: var(--light-bg);
            border: 1px solid #dde1e6;
            border-right: none;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            color: #607d8b;
        }

        .input-group .form-control {
            border-left: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 136, 229, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 136, 229, 0.4);
            background: linear-gradient(135deg, #1976d2 0%, #512da8 100%);
        }

        .btn-icon {
            margin-right: 8px;
        }

        .form-check-label {
            color: #607d8b;
            font-size: 0.9rem;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .footer-text {
            text-align: center;
            font-size: 0.85rem;
            color: #78909c;
            margin-top: 2rem;
        }

        .alert {
            border-radius: 10px;
            border-left: 4px solid #f44336;
            background-color: rgba(244, 67, 54, 0.1);
        }

        .banner-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .banner-text {
            margin-bottom: 2rem;
            opacity: 0.9;
            font-weight: 300;
            line-height: 1.6;
        }

        .features {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .features li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .feature-icon {
            margin-right: 10px;
            background: rgba(255,255,255,0.2);
            height: 30px;
            width: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 0.9rem;
        }

        @media (max-width: 991.98px) {
            .login-card {
                flex-direction: column;
                max-width: 500px;
            }

            .login-banner {
                padding: 2.5rem;
            }

            .login-form-container {
                padding: 2.5rem;
            }
        }

        @media (max-width: 767.98px) {
            .login-banner {
                padding: 2rem;
            }

            .login-form-container {
                padding: 2rem;
            }
        }

        @media (max-width: 575.98px) {
            .login-container {
                padding: 1rem;
            }

            .login-banner {
                padding: 1.5rem;
            }

            .login-form-container {
                padding: 1.5rem;
            }

            .app-logo {
                margin-bottom: 1.5rem;
            }

            .banner-title {
                font-size: 1.5rem;
            }

            .banner-text {
                font-size: 0.9rem;
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <div class="container login-container">
        <div class="login-card">
            <div class="login-banner d-none d-lg-flex">
                <div class="banner-content">
                    <h2 class="banner-title">ASKEP PRO</h2>
                    <p class="banner-text">Aplikasi manajemen asuhan keperawatan professional berbasis SDKI, SLKI, dan SIKI.</p>
                    <ul class="features">
                        <li>
                            <span class="feature-icon"><i class="fas fa-check"></i></span>
                            <span>Pencatatan data pasien</span>
                        </li>
                        <li>
                            <span class="feature-icon"><i class="fas fa-check"></i></span>
                            <span>Diagnosis keperawatan standar</span>
                        </li>
                        <li>
                            <span class="feature-icon"><i class="fas fa-check"></i></span>
                            <span>Perencanaan asuhan terintegrasi</span>
                        </li>
                        <li>
                            <span class="feature-icon"><i class="fas fa-check"></i></span>
                            <span>Laporan dan evaluasi terstruktur</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="login-form-container">
                <div class="app-logo">
                    <div class="logo-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h1 class="logo-text">ASKEP PRO</h1>
                </div>

                <h2 class="login-title">Selamat Datang</h2>
                <p class="login-subtitle">Silahkan masukkan kredensial Anda untuk mengakses sistem</p>

                @if(session('error'))
                    <div class="alert alert-danger mb-4" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autofocus
                                placeholder="Masukkan email Anda">
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="password" class="form-label mb-0">Password</label>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" required placeholder="Masukkan password">
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt btn-icon"></i> Masuk
                        </button>
                    </div>
                </form>

                <div class="footer-text">
                    <p>© {{ date('Y') }} AskepPro. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
