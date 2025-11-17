@extends('layouts.visitor')

@section('title', $service->name)

@section('content')

    <!-- ✅ GLightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css"
        integrity="sha512-tM8q0uV4vLxj8NtiTjmLTYooQEzWQrtMZQt17m7SZbjqv64PcGzT9C6jCNSiq7MXuBHBngH10GPl98Hey9UgVg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <section class="service-detail py-5" style="background: #ffffff !important; padding: 0 1rem;">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-10">
                    <h1 class="mb-3" style="color: #007BFF">{{ $service->name }}</h1>

                    <div class="service-content">
                        {!! $service->description !!}
                    </div>

                    @if ($service->images && $service->images->count())
                        <div class="service-images mt-5">
                            <h3 class="mb-4 text-center">Galeri Alat</h3>

                            <div class="row justify-content-center">
                                @foreach ($service->images as $img)
                                    @php
                                        $imageUrl = url('storage/' . ltrim($img->image_path, '/'));
                                    @endphp

                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                                        <a href="{{ $imageUrl }}" class="glightbox" data-gallery="service-gallery">
                                            <img src="{{ $imageUrl }}" alt="Foto Alat"
                                                class="img-fluid rounded shadow-sm"
                                                style="height: 220px; width:100%; object-fit: cover; cursor:pointer;">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>


    <!-- ✅ GLightbox JS (VERSI STABIL) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js"
        integrity="sha512-gQkDSeuNspvPTPSoS4B5eED1nqmCAgztrZRfKrjFoCCxmE4RCPN8XxWkLLoW43Y8TEswFPuRENbcn7adKrxgCg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const lightbox = GLightbox({
            selector: '.glightbox',
            loop: true,
            zoomable: true,
            touchNavigation: true,
            openEffect: 'zoom',
            closeEffect: 'fade'
        });
    </script>

@endsection
