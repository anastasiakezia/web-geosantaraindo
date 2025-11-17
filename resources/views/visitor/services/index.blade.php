@extends('layouts.visitor')

@section('title', 'Layanan Kami')

@section('content')
    <section id="services" class="services section py-5">
        <div class="container px-4 px-md-3">
            <div class="section-title text-center mb-5" data-aos="fade-up">
                <h2>Layanan Kami</h2>
                <p>Temukan layanan terbaik kami sesuai kebutuhan Anda.</p>
            </div>

            <style>
                /* 🎨 Gaya untuk form pencarian */
                #search {
                    height: 45px;
                    border: 2px solid #0d6efd;
                    /* warna border biru Bootstrap */
                    border-radius: 12px;
                    transition: all 0.2s ease-in-out;
                }

                #search:focus {
                    outline: none;
                    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
                    /* efek glow */
                }

                #btn-search {
                    height: 45px;
                    border-radius: 12px;
                    white-space: nowrap;
                    background-color: #0d6efd;
                    border: none;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: all 0.2s ease-in-out;
                }

                #btn-search:hover {
                    background-color: #0b5ed7;
                }
            </style>

            <!-- 🔍 Form Pencarian -->
            <div class="row justify-content-center mb-4" data-aos="fade-up" style="margin-top: -55px; margin-bottom:5px">
                <div class="col-md-6">
                    <div class="d-flex gap-2">
                        <input type="text" id="search" class="form-control" placeholder="Cari layanan...">
                        <button id="btn-search" class="btn btn-primary px-4" type="button">
                            <i class="bi bi-search me-2" style="font-size: 1rem;"></i>
                            <span style="font-weight: 500;">Cari</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 🔄 Spinner Loading -->
            <div id="loading-spinner" class="text-center my-4" style="display:none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <!-- 💡 Daftar Layanan -->
            <div class="row gy-4 justify-content-center" id="service-list" data-aos="fade-up">
                @forelse ($services as $service)
                    <div class="col-md-4">
                        <a href="{{ route('visitor.services.show', $service->slug) }}"
                            class="text-decoration-none text-dark">
                            <div class="service-card text-center h-100"
                                style="border-radius:16px; background:#fff; overflow:hidden;
                                box-shadow:0 4px 12px rgba(0,0,0,0.12);
                                transition:all .25s ease-in-out;">
                                <div style="width:100%; height:230px; overflow:hidden; border-radius:16px 16px 0 0;">
                                    <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}"
                                        style="width:100%; height:100%; object-fit:cover;"loading="lazy">
                                </div>
                                <div class="p-3">
                                    <h3 style="font-size:1rem; font-weight:600; line-height:1.3;">{{ $service->name }}</h3>
                                    <p style="font-size:0.9rem; color:#555; line-height:1.4;">
                                        {{ Str::limit(strip_tags($service->description), 100) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div style="font-size:3rem;">😕</div>
                        <p class="text-muted mt-2">Belum ada layanan tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let debounceTimer;
            const searchInput = document.getElementById('search');
            const searchButton = document.getElementById('btn-search');
            const serviceList = document.getElementById('service-list');
            const spinner = document.getElementById('loading-spinner');

            function doSearch() {
                const query = searchInput.value.trim();
                spinner.style.display = 'block';

                fetch(`{{ route('visitor.services.index') }}?search=${encodeURIComponent(query)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        serviceList.innerHTML = data.html;
                        spinner.style.display = 'none';
                    })
                    .catch(err => {
                        console.error(err);
                        spinner.style.display = 'none';
                    });
            }

            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(doSearch, 200);
            });

            searchButton.addEventListener('click', doSearch);
        });
    </script>
@endpush
