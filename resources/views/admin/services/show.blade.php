@extends('layouts.admin')

@section('title', 'Service Detail')

@push('styles')
    <style>
        .card {
            margin: 20px auto;
            border-radius: 0.75rem;
            max-width: 900px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #ddd;
            position: relative;
        }

        .btn-back {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .service-thumbnail {
            max-width: 300px;
            border-radius: 8px;
            margin: 20px auto;
            display: block;
        }

        .service-description {
            margin-top: 15px;
        }

        .gallery-images {
            margin-top: 25px;
        }

        .gallery-images img {
            width: 180px;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
            margin: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            cursor: pointer;
        }

        .gallery-images img:hover {
            transform: scale(1.05);
        }

        .carousel-item img {
            max-height: 80vh;
            object-fit: contain;
            margin: auto;
            border-radius: 8px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="text-primary fw-bold mb-0">Service Detail</h3>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm btn-back">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <div class="card-body">
                <h4 class="fw-bold">{{ $service->name }}</h4>

                <!-- Thumbnail -->
                @if ($service->thumbnail)
                    <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="Thumbnail" class="service-thumbnail">
                @endif

                <!-- Deskripsi (render HTML) -->
                <div class="service-description">
                    {!! $service->description !!}
                </div>

                <!-- Gallery Images -->
                @if ($service->images && $service->images->count() > 0)
                    <div class="gallery-images">
                        <h5 class="fw-bold mb-3">Gallery Images</h5>
                        <div class="d-flex flex-wrap">
                            @foreach ($service->images as $index => $img)
                                <img src="{{ asset('storage/' . $img->image_path) }}" alt="Gallery Image"
                                    data-bs-target="#imageCarousel" data-bs-slide-to="{{ $index }}"
                                    data-bs-toggle="modal">
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-4">
                    <p><strong>Created at:</strong> {{ $service->created_at?->format('d M Y H:i') }}</p>
                    <p><strong>Updated at:</strong> {{ $service->updated_at?->format('d M Y H:i') }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>

                    <form id="deleteServiceForm" action="{{ route('admin.services.destroy', $service->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Carousel untuk Gallery -->
    <div class="modal fade" id="imageCarousel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark">
                <div class="modal-body p-0">
                    <div id="carouselInner" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($service->images as $index => $img)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="d-block mx-auto"
                                        style="max-height:80vh; width:auto; border-radius:8px;" alt="Gallery Image">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselInner"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselInner"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let deleteForm = document.getElementById("deleteServiceForm");

            deleteForm.addEventListener("submit", function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This service will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.submit();
                    }
                });
            });

            // sukses alert
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
@endpush
