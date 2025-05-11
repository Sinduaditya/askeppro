
@extends('layouts.eror')

@section('code', '419')
@section('title', 'Sesi Telah Berakhir')
@section('color', '#fd7e14')
@section('color-hover', '#e66a07')
@section('image', asset('images/419.svg'))

@section('message')
    Sesi Anda telah kedaluwarsa karena tidak aktif terlalu lama atau token CSRF tidak valid.
    Silakan muat ulang halaman atau login kembali untuk melanjutkan.
@endsection

@section('actions')
    <a href="javascript:location.reload()" class="btn btn-primary me-2">
        <i class="fas fa-sync-alt me-2"></i> Muat Ulang Halaman
    </a>

    @auth
        <form method="POST" action="{{ route('logout') }}" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn btn-outline-secondary">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="btn btn-outline-secondary">
            <i class="fas fa-sign-in-alt me-2"></i> Login
        </a>
    @endauth
@endsection

@section('scripts')
<script>
    // Timer untuk menunjukkan hitungan mundur
    let secondsLeft = 30;
    const timerElement = document.createElement('p');
    timerElement.className = 'mt-3 text-muted';
    timerElement.innerHTML = `Halaman akan dimuat ulang dalam <span id="countdown">${secondsLeft}</span> detik`;

    document.querySelector('.error-actions').appendChild(timerElement);

    const countdownInterval = setInterval(function() {
        secondsLeft--;
        document.getElementById('countdown').textContent = secondsLeft;

        if (secondsLeft <= 0) {
            clearInterval(countdownInterval);
            window.location.reload();
        }
    }, 1000);
</script>
@endsection
