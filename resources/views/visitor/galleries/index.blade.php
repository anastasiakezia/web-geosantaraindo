@extends('layouts.visitor')

@section('title', 'Galeri')

@section('content')
    <style>
        :root {
            --primary-color: #0d6efd;
            --dark-color: #1e293b;
            --secondary-text: #64748b;
            --section-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #eef2f7;
            --shadow-color: rgba(149, 157, 165, 0.1);
            --shadow-hover-color: rgba(149, 157, 165, 0.2);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--section-bg);
            color: #475569;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-weight: 700;
            color: var(--dark-color);
        }

        .section-header-minimal {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--border-color);
        }

        .section-header-minimal h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .filter {
            max-width: 800px;
            margin: 0 auto 2.5rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter select {
            flex: 1;
            padding: 14px 20px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            font-size: 1rem;
            cursor: pointer;
            background-color: var(--card-bg);
        }

        /* Styling untuk tampilan Select2 agar selaras dengan desain filter kamu */
        .select2-container--default .select2-selection--single {
            height: 50px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            padding-left: 10px;
            background-color: var(--card-bg);
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
            right: 10px;
        }

        .select2-dropdown {
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px var(--shadow-color);
        }

        .select2-results__options {
            max-height: 220px;
            /* biar bisa scroll */
        }

        @media (min-width: 768px) {
            .filter {
                flex-direction: row;
                /* kiri-kanan */
                justify-content: center;
                align-items: center;
            }

            .filter .select2-container {
                flex: 1;
                /* biar dua-duanya punya lebar seimbang */
            }
        }

        @media (max-width: 767px) {
            .filter {
                flex-direction: column;
            }

            .filter select {
                width: 100%;
            }
        }

        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 28px;
        }

        .gallery-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 8px 16px var(--shadow-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            flex: 0 1 280px;
            position: relative;
        }

        .gallery-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 16px 24px var(--shadow-hover-color);
        }

        .card-img-container {
            width: 100%;
            height: 180px;
            position: relative;
            overflow: hidden;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .gallery-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.05);
        }

        .location-on-image {
            position: absolute;
            bottom: 12px;
            left: 12px;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 500;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .gallery-card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .gallery-card-body h4 {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .btn-detail {
            font-size: 0.85rem;
            /* DIKECILKAN dari 0.9rem */
            font-weight: 500;
            padding: 8px 16px;
            /* DIKECILKAN dari 10px 20px */
            background-color: var(--primary-color);
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
            margin-top: auto;
            align-self: flex-start;
        }

        .btn-detail:hover {
            background-color: #0b5ed7;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(13, 110, 253, 0.3);
            color: #fff;
        }

        .pagination {
            margin-top: 1rem !important;
            margin-bottom: 1.5rem !important;
            justify-content: center;
        }

        .pagination-info,
        .pagination-summary {
            text-align: center;
            margin-bottom: 0.25rem;
            /* biar jaraknya kecil tapi tetap lega */
        }

        nav[role="navigation"] {
            display: block !important;
            text-align: center !important;
            margin-top: 40px !important;
        }

        nav[role="navigation"]>div:first-child {
            display: block !important;
            margin-bottom: 25px !important;
            /* JARAK ANTARA SHOWING DAN ANGKA */
        }

        nav[role="navigation"] .pagination {
            display: inline-flex !important;
            margin-top: 10px !important;
        }
    </style>

    <main id="main" class="container pt-4 pb-5">
        <div class="section-header-minimal">
            <h1>Project Gallery</h1>
        </div>

        {{-- FILTER SERVICE + LOKASI --}}
        <div class="filter">
            {{-- Dropdown Service --}}
            <select id="serviceFilter">
                <option value="all">All Services</option>
                @forelse ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @empty
                    <option disabled>Belum ada layanan tersedia</option>
                @endforelse
            </select>

            {{-- Dropdown Lokasi --}}
            <select id="locationFilter">
                <option value="all">All Locations</option>
                @forelse ($locations as $loc)
                    <option value="{{ $loc['id'] }}">{{ $loc['province'] }} - {{ $loc['city_name'] }}</option>
                @empty
                    <option disabled>Belum ada lokasi project</option>
                @endforelse
            </select>
        </div>

        {{-- Grid Galeri --}}
        <div class="gallery-grid" id="galleryGrid">
            @forelse ($galleryItems as $item)
                <div class="gallery-card" data-location="{{ $item->city_id }}" data-service="{{ $item->service_id }}">
                    <div class="card-img-container">
                        <img src="{{ $item->images->count() ? asset('storage/' . $item->images->first()->image_path) : asset('visitor/img/default.jpg') }}"
                            alt="{{ $item->project_name }}">
                        <span class="location-on-image">{{ $item->city->city_name ?? 'Lokasi' }}</span>
                    </div>
                    <div class="gallery-card-body">
                        <h4>{{ Str::limit(html_entity_decode(strip_tags($item->project_name)), 50) }}</h4>
                        <a href="{{ route('visitor.galleries.show', $item->slug) }}" class="btn-detail">
                            <span>Lihat Detail</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center w-100" style="padding: 50px 0;">
                    <h5>🙏 Maaf, belum ada project yang tersedia saat ini.</h5>
                    <p>Nantikan update terbaru dari kami segera.</p>
                </div>
            @endforelse
        </div>

        {{-- Fallback kalau filter aktif tapi hasilnya kosong --}}
        <div id="noResults" class="text-center w-100 py-5" style="display:none;">
            <h5>🙏 Maaf, belum ada project untuk pilihan ini.</h5>
            <p>Silakan coba pilih layanan atau lokasi lainnya.</p>
        </div>

        <div class="pagination-container text-center mt-4">
            @if ($galleryItems->hasPages())
                <div class="pagination-wrapper">
                    {!! $galleryItems->links() !!}
                </div>
            @endif
        </div>
    </main>
    <!-- End #main -->

    {{-- Script untuk filter --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('#serviceFilter').select2({
                placeholder: 'Pilih atau cari layanan...',
                allowClear: true,
                width: '100%'
            });

            $('#locationFilter').select2({
                placeholder: 'Pilih atau cari lokasi...',
                allowClear: true,
                width: '100%'
            });

            // Ambil semua kartu project
            const allCards = document.querySelectorAll('.gallery-card');
            const noResults = document.getElementById('noResults');

            function filterCards() {
                const serviceValue = $('#serviceFilter').val();
                const locationValue = $('#locationFilter').val();

                let visibleCount = 0;

                allCards.forEach(card => {
                    const matchService = (serviceValue === 'all' || !serviceValue || card.dataset.service ==
                        serviceValue);
                    const matchLocation = (locationValue === 'all' || !locationValue || card.dataset
                        .location == locationValue);

                    if (matchService && matchLocation) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                noResults.style.display = (visibleCount === 0) ? 'block' : 'none';
            }

            // Jalankan filter saat dropdown berubah
            $('#serviceFilter, #locationFilter').on('change', function() {
                filterCards();
            });

            // Jalankan pertama kali untuk memastikan semuanya tampil
            filterCards();
        });
    </script>

@endsection
