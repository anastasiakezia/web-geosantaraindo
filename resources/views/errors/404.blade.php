@extends('layouts.visitor')

@section('title', 'Page Not Found')

@section('content')
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center text-center bg-light">
        <!-- Animasi Lottie -->
        <div id="lottie-404" style="width: 320px; height: 320px;" class="mb-3"></div>

        <!-- Judul -->
        <h1 class="display-3 fw-bold text-danger mb-2">404</h1>
        <h2 class="fw-semibold mb-3">Oops! Halaman Tidak Ditemukan</h2>

        <!-- Deskripsi -->
        <p class="lead text-muted mb-4" style="max-width: 500px;">
            Sepertinya kamu tersesat... Halaman yang dicari tidak tersedia.
        </p>

        <!-- Tombol -->
        <a href="{{ url('/') }}" class="btn btn-primary mt-2 mb-4">
            <i class="bi bi-house-door"></i> Back to Home
        </a>

    </div>

    <!-- Lottie JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.13/lottie.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lottie.loadAnimation({
                container: document.getElementById('lottie-404'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: 'https://assets3.lottiefiles.com/packages/lf20_jcikwtux.json' // contoh animasi 404
            });
        });
    </script>
@endsection
