<head>
    <style>
        #sponsors .section-title {
            margin-bottom: -60px !important;
        }

        /* Tempel kode CSS di sini */
        .sponsors-slider .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sponsors-slider .swiper-slide img {
            max-height: 100px;
            max-width: 100%;
            width: auto;
            height: auto;
        }
    </style>
</head>

<section id="gallery" class="gallery section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p>Recent project photos</p>
    </div>
    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-0">
            @for ($i = 1; $i <= 8; $i++)
                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('visitor/assets/img/gallery/gallery-' . $i . '.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('visitor/assets/img/gallery/gallery-' . $i . '.jpg') }}" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>

<section id="sponsors" class="sponsors section" style="background: #FFFFFF">
    <div class="">
        <div class="container section-title" data-aos="fade-up">
            <h2 style="color: #007bff;">Melayani Metode Pembayaran</h2>
        </div>
        <div class="swiper sponsors-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/mandiri.jpg') }}" alt="Antam"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/bni.jpg') }}" alt="Gacoan" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/bsi.jpg') }}" alt="Berau Coal"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/mastercard.png') }}" alt="Dinkes Ngawi"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/visa.png') }}" alt="Hokben" class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/bitcoin.png') }}" alt="Sucofindo"
                        class="img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('visitor/assets/img/testimonials/usdt.png') }}" alt="USDT" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Inisialisasi Swiper untuk #sponsors (TETAP ADA)
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

    });
</script>
