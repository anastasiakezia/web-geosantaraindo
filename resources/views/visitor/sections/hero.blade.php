@section('meta')
    <meta name="title" content="Fondasi Kuat, Masa Depan Terukur! | PT GEO SANTARA INDO">
    <meta name="description"
        content="Mengungkap Harapan di bawah Lapisan Permukaan
                    Di tengah kekhawatiran pasokan air bersih, PT Geo Santara Indo memahami tantangan besar yang Anda hadapi. 
                    PT Geo Santara Indo seakan menjadi lentera harapan, siap membantu mengubah kekhawatiran menjadi keyakinan akan masa depan air bersih melalui layanan sumur bor profesional
                    ">
    {{-- Open Graph untuk share preview --}}
    <meta property="og:title" content="Fondasi Kuat, Masa Depan Terukur! | PT GEO SANTARA INDO">
    <meta property="og:description"
        content="PT Geo Santara Indo siap membantu mengubah kekhawatiran menjadi keyakinan akan masa depan air bersih melalui layanan sumur bor profesional.">
    <meta property="og:image" content="{{ asset('visitor/assets/img/home/banner-website-1.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection

<section id="hero" class="hero section">

    <img src="{{ asset('visitor/assets/img/home/banner-website-1.jpg') }}" alt="Banner Geo Santara" class="hero-bg">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6">
                <div class="welcome" data-aos="fade-right">
                    <h2 style="padding: 0 1rem;">Fondasi Kuat, Masa Depan Terukur!</h2>
                    <h3 class="mt-3" style="padding: 0 1rem;">Mengungkap Harapan di bawah Lapisan Permukaan</h3>
                    <p class="mt-3" style="padding: 0 1rem; text-align: justify;">
                        Di tengah kekhawatiran pasokan air bersih, PT Geo Santara Indo memahami tantangan besar yang
                        Anda hadapi.
                        PT Geo Santara Indo seakan menjadi lentera harapan, siap membantu mengubah kekhawatiran menjadi
                        keyakinan akan masa depan air bersih melalui layanan sumur bor profesional
                    </p>

                    <a href="#contact" class="btn-get-offer" style="margin-left: 1rem;">
                        Dapatkan Penawaran Menarik <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 hero-people-wrapper" data-aos="zoom-in">
                <img src="{{ asset('visitor/assets/img/home/foto_pak_agung.png') }}" class="img-fluid"
                    alt="Geo Santara Team">
            </div>

        </div>
    </div>
</section>
