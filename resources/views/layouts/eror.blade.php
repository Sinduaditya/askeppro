<!-- filepath: resources/views/errors/layouts/error.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ASKEP Pro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .error-page {
            padding: 40px 0;
        }
        .error-code {
            font-size: 120px;
            font-weight: 800;
            color: @yield('color', '#0d6efd');
            line-height: 1;
        }
        .error-image {
            max-width: 100%;
            height: auto;
        }
        .error-actions {
            margin-top: 2rem;
        }
        .text-primary {
            color: @yield('color', '#0d6efd') !important;
        }
        .btn-primary {
            background-color: @yield('color', '#0d6efd');
            border-color: @yield('color', '#0d6efd');
        }
        .btn-primary:hover {
            background-color: @yield('color-hover', '#0b5ed7');
            border-color: @yield('color-hover', '#0b5ed7');
            opacity: 0.9;
        }
        .btn-outline-primary {
            color: @yield('color', '#0d6efd');
            border-color: @yield('color', '#0d6efd');
        }
        .btn-outline-primary:hover {
            background-color: @yield('color', '#0d6efd');
            border-color: @yield('color', '#0d6efd');
        }
    </style>
    @yield('additional-styles')
</head>
<body>
    <div class="container error-page">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 order-md-2">
                <div class="text-center mb-4 mb-md-0">
                    <img src="@yield('image', asset('images/error.svg'))" alt="@yield('code') Error" class="error-image img-fluid" style="max-height: 300px;">
                </div>
            </div>
            <div class="col-md-6 order-md-1">
                <div class="text-center text-md-start">
                    <div class="mb-4">
                        <h1 class="error-code">@yield('code')</h1>
                        <h2 class="h3 fw-bold text-dark">@yield('title')</h2>
                        <p class="lead text-muted">@yield('message')</p>
                    </div>
                    <div class="error-actions">
                        @yield('actions')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
