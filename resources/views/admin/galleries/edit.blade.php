@extends('layouts.admin')

@section('title', 'Edit Gallery Project')

@section('content')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary mb-0">Edit Gallery Project</h3>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Back</a>
        </div>

        {{-- Form Card --}}
        <div class="card shadow-sm">
            <div class="card-body">
                {{-- Alert Success / Error --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Please fix the errors below.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form id="editGalleryForm" action="{{ route('admin.galleries.update', $galleryProject->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Project Name --}}
                    <div class="mb-3">
                        <label for="project_name" class="form-label">Project Name</label>
                        <input type="text" name="project_name" id="project_name"
                            class="form-control @error('project_name') is-invalid @enderror"
                            value="{{ old('project_name', $galleryProject->project_name) }}"
                            placeholder="Enter project name" required>
                        @error('project_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Service --}}
                    <div class="mb-3">
                        <label for="service_id" class="form-label">Service</label>
                        <select name="service_id" id="service_id"
                            class="form-select @error('service_id') is-invalid @enderror" required>
                            <option value="">-- Select Service --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ old('service_id', $galleryProject->service_id) == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Province --}}
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <select name="province" id="province" class="form-select" required>
                            <option value="">-- Select Province --</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province }}"
                                    {{ $galleryProject->city && $galleryProject->city->province == $province ? 'selected' : '' }}>
                                    {{ $province }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- City --}}
                    <div class="mb-3">
                        <label for="city_id" class="form-label">City</label>
                        <select name="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror"
                            required>
                            <option value="">-- Select City --</option>
                            @if ($galleryProject->city)
                                <option value="{{ $galleryProject->city->id }}" selected>
                                    {{ $galleryProject->city->city_name }}
                                </option>
                            @endif
                        </select>
                        @error('city_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Existing Images --}}
                    <div class="mb-3">
                        <label class="form-label d-block">Existing Images</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($galleryProject->images as $image)
                                <div class="position-relative" style="width:100px; height:100px;">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        style="width:100%; height:100%; object-fit:cover; border-radius:5px; border:1px solid #ddd;">
                                    <button type="button" class="btn btn-danger btn-sm delete-image"
                                        data-id="{{ $image->id }}"
                                        style="position:absolute; top:2px; right:2px; padding:0 4px; border-radius:3px;">&times;</button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- New Images --}}
                    <div class="mb-3">
                        <label for="image_path" class="form-label">Add New Images (Max 2MB per file)</label>
                        <input type="file" name="image_path[]" id="image_path" class="form-control" multiple
                            accept="image/*">
                        @error('image_path.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div id="imagePreview" class="mt-3 d-flex flex-wrap gap-2"></div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary">Update Project</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Province change -> load cities
            $('#province').on('change', function() {
                let province = $(this).val();
                $('#city_id').html('<option value="">-- Loading Cities --</option>');

                if (province) {
                    $.get(`/admin/cities-by-province/${province}`, function(data) {
                        let options = '<option value="">-- Select City --</option>';
                        data.forEach(city => {
                            options +=
                                `<option value="${city.id}">${city.city_name}</option>`;
                        });
                        $('#city_id').html(options);
                    });
                } else {
                    $('#city_id').html('<option value="">-- Select City --</option>');
                }
            });

            // Preview new images
            $('#image_path').on('change', function() {
                $('#imagePreview').html('');
                let files = Array.from(this.files);

                files.forEach((file, index) => {
                    if (file.size > 2 * 1024 * 1024) {
                        alert(`${file.name} is too large! Maximum size is 2MB.`);
                        files.splice(index, 1);
                        return;
                    }

                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let card = $(`
                            <div class="position-relative" style="width:100px; height:100px;">
                                <img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover; border-radius:5px; border:1px solid #ddd;">
                                <button type="button" class="btn btn-danger btn-sm remove-image" style="position:absolute; top:2px; right:2px; padding:0 4px; border-radius:3px;">&times;</button>
                            </div>
                        `);
                        $('#imagePreview').append(card);

                        card.find('.remove-image').on('click', function() {
                            files.splice(index, 1);
                            card.remove();
                            let dt = new DataTransfer();
                            files.forEach(f => dt.items.add(f));
                            document.getElementById('image_path').files = dt.files;
                        });
                    }
                    reader.readAsDataURL(file);
                });
            });

            // Delete existing image
            $('.delete-image').on('click', function() {
                const id = $(this).data('id');
                const imageContainer = $(this).closest('div.position-relative');

                Swal.fire({
                    title: 'Delete image?',
                    text: 'This image will be permanently deleted.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/galleries/image/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                imageContainer.remove();
                                Swal.fire('Deleted!', 'Image has been removed.',
                                    'success');
                            },
                            error: function() {
                                Swal.fire('Error', 'Failed to delete image.', 'error');
                            }
                        });
                    }
                });
            });

            // SweetAlert confirm before submit
            $('#editGalleryForm').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to update this project?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update it!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    </script>
@endpush
