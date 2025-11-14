<section id="services" class="services-carousel section" style="background: #F0F8FF">
    <div class="container section-title" data-aos="fade-up">
        <h2>Layanan Terbaik PT Geo Santara</h2>
        <p>Kami selalu mengedepankan kualitas, keamanan, profesionalitas dan keahlian dalam setiap project yang kami
            kerjakan.</p>
    </div>

    <div class="container">
        <div class="swiper services-slider" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                @foreach ($services as $service)
                    <div class="swiper-slide">
                        <a href="{{ route('visitor.services.show', $service->slug) }}"
                            style="text-decoration:none; color:inherit;">
                            <div class="service-card text-center p-3"
                                style="border-radius: 16px; background:#fff; height: 100%; 
                                    box-shadow:0 4px 12px rgba(0,0,0,0.12);">

                                <!-- Thumbnail Full Rounded -->
                                <div style="width:100%; height:330px; overflow:hidden; border-radius:5px;">
                                    <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}"
                                        style="width:100%; height:100%; object-fit:cover; border-radius:10px;"
                                        loading="lazy">
                                </div>

                                <!-- Judul -->
                                <h3 class="mt-3" style="font-size: 1.05rem; font-weight:600; line-height:1.3;">
                                    {{ $service->name }}
                                </h3>

                                <!-- Deskripsi singkat -->
                                <p style="font-size: 0.9rem; color:#555; line-height:1.4;">
                                    {{ Str::limit(strip_tags($service->description), 100) }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Navigasi -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>

<section id="stats-text" class="stats section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 text-center">
            <h3>Komitmen Berkelanjutan</h3>
            <h5>Kami hadir mengubah tantangan menjadi kepercayaan melalui keterbukaan dan kolaborasi berkelanjutan,
                menuntun Anda menuju masa depan dengan pasokan air bersih yang terjamin.
            </h5>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper(".services-slider", {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            autoHeight: false,
            navigation: {
                nextEl: ".services-carousel .swiper-button-next",
                prevEl: ".services-carousel .swiper-button-prev",
            },
            pagination: {
                el: ".services-carousel .swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 20
                }
            }
        });
    });
</script>
