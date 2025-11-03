@extends('layouts.visitor')

@section('title', $galleryItem->project_name)

@section('content')
    <main id="main" class="container py-5">

        <!-- Judul Project -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ $galleryItem->project_name }}</h2>
            <p class="text-muted">
                <i class="bi bi-geo-alt"></i>
                {{ $galleryItem->city->province ?? '-' }} - {{ $galleryItem->city->city_name ?? '-' }}
            </p>
        </div>

        <!-- Detail Layanan -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="fw-bold text-primary border-bottom pb-2 mb-3 text-center">
                    {{ $galleryItem->service->name ?? 'Layanan Terkait' }}
                </h3>

                @if ($galleryItem->service)
                    <p class="fs-5 service-description">
                        {!! \Illuminate\Support\Str::limit(strip_tags($galleryItem->service->description), 300) !!}
                        @if (strlen(strip_tags($galleryItem->service->description)) > 300)
                            <a href="{{ route('visitor.services.show', $galleryItem->service->slug) }}"
                                class="read-more-link">
                                Read More
                            </a>
                        @endif
                    </p>
                @else
                    <p><em>Layanan belum ditentukan.</em></p>
                @endif
            </div>
        </div>

        <!-- Thumbnail Grid -->
        <div class="row justify-content-center mb-5 gallery-wrapper">
            @if ($galleryItem->images->count())
                @foreach ($galleryItem->images as $index => $img)
                    <div class="col-6 col-sm-4 col-lg-3 text-center gallery-col">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal"
                            data-index="{{ $index }}">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="img-fluid gallery-thumb"
                                alt="{{ $galleryItem->project_name }}">
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <img src="{{ asset('visitor/img/default.jpg') }}" class="img-fluid rounded shadow" alt="Default">
                </div>
            @endif
        </div>

        <!-- Modal Carousel -->
        <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content border-0">
                    <div class="modal-body p-2">
                        <div id="modalCarousel" class="carousel slide" data-bs-ride="false">
                            <div class="carousel-inner text-center">
                                @foreach ($galleryItem->images as $index => $img)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $img->image_path) }}" class="modal-img"
                                            alt="{{ $galleryItem->project_name }}">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Slim Controls -->
                            <button class="carousel-control-prev slim-control" type="button"
                                data-bs-target="#modalCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next slim-control" type="button"
                                data-bs-target="#modalCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center mt-4">
            <a href="{{ route('visitor.galleries.index') }}" class="btn btn-secondary">
                ← Kembali ke Galeri
            </a>
        </div>

    </main>

    <style>
        /* === GALLERY === */
        .gallery-wrapper {
            gap: 12px;
            /* kasih jarak antar gambar */
        }

        .gallery-thumb {
            height: 220px;
            width: 100%;
            object-fit: contain;
            border-radius: 12px !important;
            transition: transform 0.3s ease;
            display: block;
            overflow: hidden;
        }

        .gallery-thumb:hover {
            transform: scale(1.05);
        }

        /* Di bawah 768px → jadi 1 kolom + gap */
        @media (max-width: 768px) {
            .gallery-wrapper {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 16px;
            }

            .service-description {
                padding: 0 1rem;
            }

            .gallery-col {
                flex: 0 0 100%;
                max-width: 90%;
            }

            .gallery-thumb {
                height: 200px;
                border-radius: 12px !important;
            }
        }

        /* Di bawah 425px → kecilin gambar */
        @media (max-width: 425px) {
            .gallery-thumb {
                height: 160px;
                width: 110%;
                margin: 0 auto;
                border-radius: 12px !important;
            }

            .gallery-wrapper {
                gap: 18px;
            }
        }

        /* === MODAL === */
        .carousel-item {
            background: transparent !important;
        }

        .modal-img {
            max-height: 80vh;
            max-width: 100%;
            object-fit: contain;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.7);
        }

        #galleryModal .modal-content {
            background-color: transparent;
            border: none;
        }

        .read-more-link {
            color: #0d6efd;
            font-weight: 500;
            text-decoration: none;
            margin-left: 4px;
        }

        .read-more-link:hover {
            text-decoration: underline;
        }

        .slim-control {
            width: 40px !important;
            opacity: 0.8;
        }

        .slim-control:hover {
            opacity: 1;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 28px;
            height: 28px;
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='white'%3E%3Cpath d='M11 1 3 8l8 7'/%3E%3C/svg%3E") !important;
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 16 16'%3E%3Cpath d='M5 1l8 7-8 7'/%3E%3C/svg%3E");
        }

        .carousel-control-prev::after,
        .carousel-control-next::after {
            content: '';
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            opacity: 0.7;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const galleryLinks = document.querySelectorAll('[data-bs-target="#galleryModal"]');
            const modalCarousel = document.getElementById('modalCarousel');

            galleryLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const index = this.getAttribute('data-index');
                    const carousel = bootstrap.Carousel.getOrCreateInstance(modalCarousel);
                    carousel.to(index);
                });
            });
        });
    </script>
@endsection
