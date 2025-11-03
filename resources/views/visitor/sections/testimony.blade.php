<style>
    #sponsors .section-title {
        margin-bottom: -60px !important;
    }

    /* Styling untuk membuat kartu logo lebih modern */
    #clients .logo-card {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        padding: 0;
        /* HAPUS PADDING */
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
        border: 1px solid #eef0f2;
        overflow: hidden;
        /* Penting agar gambar tidak keluar dari sudut melengkung */
    }

    /* Efek interaktif saat kursor mouse di atas kartu */
    #clients .logo-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0, 123, 255, 0.1);
    }

    /* Memastikan gambar logo tidak terdistorsi dan pas di dalam kartu */
    #clients .logo-card img {
        width: 100%;
        /* Buat gambar mengisi lebar penuh */
        height: 100%;
        /* Buat gambar mengisi tinggi penuh */
        object-fit: cover;
        /* Pastikan gambar menutupi area tanpa gepeng */
    }

    /* Memberi jarak antar baris di layar kecil (mobile) */
    #clients .col-lg-4 {
        margin-bottom: 2rem;
    }

    @media (min-width: 992px) {
        #clients .col-lg-4 {
            margin-bottom: 0;
        }
    }

    /* Perbesar area tiap slide */
    #sponsors .swiper-slide {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 130px;
        /* tinggi area untuk logo, bisa dinaikkan kalau mau lebih besar */
    }

    /* Atur ukuran logo agar proporsional dan cukup besar */
    #sponsors .swiper-slide img {
        max-height: 100%;
        /* logo isi penuh tinggi area */
        max-width: 90%;
        /* biar gak kepanjangan */
        object-fit: contain;
        transition: transform 0.3s ease, filter 0.3s ease;
    }

    /* Efek hover biar lebih hidup */
    #sponsors .swiper-slide img:hover {
        transform: scale(1.1);
        filter: brightness(1.1);
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 768px) {
        #sponsors .swiper-slide {
            height: 100px;
        }

        #sponsors .swiper-slide img {
            max-width: 85%;
        }
    }
</style>


<section id="about" class="about section">
    <div class="container">
        <div class="container section-title" data-aos="fade-up">
            <h2 style="color: #007bff;">Apa Kata Mereka?</h2>
            <p>Bagaimana penilaian sebagian dari Klien Kami yang telah kami bantu seluruh kebutuhan mereka?</p>
        </div>
        <div class="row gy-4 gx-5">
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <div class="col-md-12">
                    <div class="video-wrapper">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/_8cdswIyPOg"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <div class="col-md-12">
                    <div class="video-wrapper">
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/qONNJCsSDuo?si=kpDlylFzZToDQ80E"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="clients" class="clients-section-simple section" style="background: #F0F8FF">
    <div class="container">
        <div class="container section-title" data-aos="fade-up">
            <h2>Telah Dipercaya Oleh</h2>
        </div>

        <div class="row gy-4 justify-content-center" data-aos="fade-up" data-aos-delay="100">

            <div class="col-lg-4 col-md-6">
                <div class="logo-card">
                    <img src="{{ asset('visitor/assets/img/testimonials/pt_bca.png') }}" class="img-fluid"
                        alt="Client BCA">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="logo-card">
                    <img src="{{ asset('visitor/assets/img/testimonials/pt_gotion.png') }}" class="img-fluid"
                        alt="Client Gotion">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="logo-card">
                    <img src="{{ asset('visitor/assets/img/testimonials/pt_subang.png') }}" class="img-fluid"
                        alt="Client Subang">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="logo-card">
                    <img src="{{ asset('visitor/assets/img/testimonials/pak_adi_geolistrik.png') }}" class="img-fluid"
                        alt="Client Adi Geolistrik">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="logo-card">
                    <img src="{{ asset('visitor/assets/img/testimonials/PAK TEJA_BOREHOLE CAMERA.png') }}"
                        class="img-fluid" alt="Client Antam">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="logo-card">
                    <img src="{{ asset('visitor/assets/img/testimonials/PAK RUBI_SIP SIPA.png') }}" class="img-fluid"
                        alt="Client Hokben">
                </div>
            </div>

        </div>
    </div>
</section>

<section id="sponsors" class="sponsors section" style="background: #FFFFFF">
    <div class="">
        <div class="container section-title" data-aos="fade-up">
            <h2 style="color: #007bff;">Telah Dipercaya Oleh</h2>
        </div>
        <div class="swiper sponsors-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/antam.jpeg') }}" alt="Antam"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/gacoan.jpeg') }}" alt="Gacoan"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/berau_coal.jpeg') }}" alt="Berau Coal"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/dinkes_ngawi.jpeg') }}" alt="Dinkes Ngawi"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/hokben.png') }}" alt="Hokben"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/sucofindo.jpeg') }}" alt="Sucofindo"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/wings.png') }}" alt="Wigs"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/esdm.png') }}" alt="ESDN"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/ecolab.png') }}" alt="Ecolab"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/kamajaya.png') }}" alt="Kamajaya"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/japfa.png') }}" alt="Japfa"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/kementrian_perindustrian.png') }}"
                        alt="Kementrian Perindustrian" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/balai_standarisasi.png') }}"
                        alt="Balai Standarisasi" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/pln.png') }}" alt="PLN"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/wika.png') }}" alt="Wika"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/surya.png') }}" alt="Surya"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/tokai.png') }}" alt="Tokai"
                        class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Inisialisasi Swiper untuk #sponsors 
        new Swiper(".sponsors-slider", {
            slidesPerView: 5,
            spaceBetween: 30,
            loop: true,
            freeMode: true,
            freeModeMomentum: false,
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
            speed: 5000,
            grabCursor: false,
            breakpoints: {
                0: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 25
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 30
                },
            },
        });

        // Inisialisasi Swiper untuk #clients SUDAH DIHAPUS

    });
</script>
