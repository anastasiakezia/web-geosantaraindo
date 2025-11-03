@extends('layouts.admin')

@section('title', 'Gallery Project Detail')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    @endpush

    <div class="container mt-3">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary mb-0">Gallery Project Detail</h3>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        {{-- Project Info --}}
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h5 class="fw-bold mb-3">{{ $galleryProject->project_name }}</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        {{-- "text-muted" diganti menjadi "text-secondary" --}}
                        <small class="text-secondary d-block fw-semibold">Service</small>
                        <span>{{ $galleryProject->service->name ?? '-' }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <small class="text-secondary d-block fw-semibold">City</small>
                        <span>{{ $galleryProject->city->city_name ?? '-' }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <small class="text-secondary d-block fw-semibold">Province</small>
                        <span>{{ $galleryProject->city->province ?? '-' }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <small class="text-secondary d-block fw-semibold">Created At</small>
                        <span>{{ $galleryProject->created_at?->format('d M Y') ?? '-' }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <small class="text-secondary d-block fw-semibold">Updated At</small>
                        <span>{{ $galleryProject->updated_at?->format('d M Y') ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Project Images (Tidak ada perubahan) --}}
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Project Images</div>
            <div class="card-body">
                @if ($galleryProject->images->count())
                    <div class="row g-3 image-gallery">
                        @foreach ($galleryProject->images as $image)
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="{{ asset('storage/' . $image->image_path) }}"
                                    data-title="{{ $galleryProject->project_name }}"
                                    class="d-block card shadow-sm h-100 overflow-hidden text-decoration-none">

                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top w-100"
                                        alt="{{ $galleryProject->project_name }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No images uploaded for this project.</p>
                @endif
            </div>
        </div>

    </div>

    @push('scripts')
        {{-- Script jQuery & Magnific Popup (Tidak ada perubahan) --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.image-gallery').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        easing: 'ease-in-out'
                    }
                });
            });
        </script>
    @endpush
@endsection
