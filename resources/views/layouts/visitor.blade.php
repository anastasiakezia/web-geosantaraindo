<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>
        @yield('title', '')
        @if (trim($__env->yieldContent('title')))
            - PT Geo Santara Indo
        @else
            PT Geo Santara Indo
        @endif
    </title>

    @yield('meta')



    <!-- Favicons -->
    <link href="{{ asset('visitor/assets/img/logo_favicon.png') }}" rel="icon">
    <link href="{{ asset('visitor/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Raleway:300,400,500,600,700|Poppins:300,400,500,600,700"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('visitor/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('visitor/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('visitor/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('visitor/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('visitor/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('visitor/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('visitor/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="@yield('body-class', 'index-page')">

    {{-- <!-- ======= Top Bar ======= -->
    @include('partials.visitor.topbar') --}}

    <!-- ======= Header ======= -->
    @include('partials.visitor.header')

    <main id="main">
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    @include('partials.visitor.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('visitor/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('visitor/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('visitor/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('visitor/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('visitor/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('visitor/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Template Main JS File -->
    <script src="{{ asset('visitor/assets/js/main.js') }}"></script>
    @stack('scripts')

    <!-- ======= WhatsApp Floating Button ======= -->
    <div id="whatsapp-popup">
        <a href="https://wa.me/6281134500100" target="_blank" id="whatsapp-button" aria-label="Chat via WhatsApp">
            <!-- WhatsApp SVG Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 16 16">
                <path
                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.594 0 .002 3.59.002 8c0 1.41.368 2.787 1.07 4.007L0 16l4.122-1.064A7.977 7.977 0 0 0 8 16c4.4 0 7.992-3.59 7.992-8a7.95 7.95 0 0 0-2.391-5.674M8 14.5a6.52 6.52 0 0 1-3.357-.918l-.24-.143-2.445.631.65-2.379-.157-.244A6.518 6.518 0 0 1 1.5 8c0-3.59 2.91-6.5 6.5-6.5 1.739 0 3.373.677 4.603 1.907A6.484 6.484 0 0 1 14.5 8c0 3.59-2.91 6.5-6.5 6.5m3.416-4.659c-.2-.1-1.18-.58-1.364-.647-.184-.068-.318-.1-.452.1-.133.2-.517.647-.634.78-.117.133-.234.15-.434.05-.2-.1-.843-.31-1.604-.99-.593-.527-.993-1.18-1.11-1.38-.117-.2-.012-.307.088-.406.09-.089.2-.234.3-.35.1-.117.133-.2.2-.334.067-.133.034-.25-.017-.35-.05-.1-.452-1.09-.62-1.49-.165-.393-.334-.34-.452-.347-.117-.007-.25-.007-.384-.007a.74.74 0 0 0-.534.25c-.183.2-.7.684-.7 1.667 0 .983.717 1.933.817 2.067.1.133 1.41 2.157 3.418 3.027.478.207.85.33 1.14.423.478.152.913.13 1.257.08.383-.057 1.18-.48 1.347-.943.167-.464.167-.863.117-.943-.05-.08-.184-.133-.384-.233" />
            </svg>
        </a>
    </div>

    <style>
        #whatsapp-popup {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        #whatsapp-button {
            background: #25D366;
            border-radius: 50%;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s ease-in-out;
            animation: pulse 2s infinite;
        }

        #whatsapp-button:hover {
            transform: scale(1.1);
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }
    </style>
    <!-- ======= End WhatsApp Floating Button ======= -->

</body>

</html>
