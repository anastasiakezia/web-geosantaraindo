@extends('layouts.admin')

@section('title', 'Edit Service')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .form-label {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .form-control {
            font-size: 1rem;
        }

        .card {
            margin: 20px auto;
            border-radius: 0.75rem;
            max-width: 1000px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-submit {
            width: 200px;
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

        .gallery-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .gallery-preview div {
            position: relative;
            display: inline-block;
        }

        .gallery-preview img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }

        .gallery-preview .remove-btn {
            position: absolute;
            top: 0;
            right: 0;
            background: rgba(220, 53, 69, 0.8);
            border: none;
            color: #fff;
            padding: 2px 6px;
            cursor: pointer;
            border-radius: 0 4px 0 4px;
        }

        .note-editor.note-frame {
            border-radius: 0.25rem;
            font-family: 'Inter', sans-serif;
        }

        .note-toolbar {
            background: #f8f9fa;
            border-bottom: 1px solid #ddd;
            border-radius: 0.25rem 0.25rem 0 0;
        }

        .note-editable {
            min-height: 200px;
            font-size: 1rem;
            line-height: 1.6;
            padding: 0.75rem;
            background: #fff;
            border-radius: 0 0 0.25rem 0.25rem;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="text-primary fw-bold mb-0">Edit Service</h3>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm btn-back">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
            <div class="card-body">

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form id="editServiceForm" action="{{ route('admin.services.update', $service->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Service Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg"
                            value="{{ old('name', $service->name) }}" placeholder="Enter service name..." required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Write service description...">{{ old('description', $service->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thumbnail</label>
                        <div style="position: relative; display: inline-block;">
                            @if ($service->thumbnail)
                                <img id="thumbnailPreview" src="{{ asset('storage/' . $service->thumbnail) }}"
                                    width="150" class="img-thumbnail">
                                <button type="button" id="removeThumbnail"
                                    style="position:absolute; top:0; right:0; background:rgba(220,53,69,0.8); color:#fff; border:none; border-radius:0 4px 0 4px; cursor:pointer; padding:2px 6px;">×</button>
                                <input type="hidden" name="remove_thumbnail" id="removeThumbnailInput" value="0">
                            @else
                                <img id="thumbnailPreview" src="" width="150" class="img-thumbnail mb-2"
                                    style="display:none;">
                                <button type="button" id="removeThumbnail" style="display:none;">×</button>
                                <input type="hidden" name="remove_thumbnail" id="removeThumbnailInput" value="0">
                            @endif
                        </div>
                        <input type="file" name="thumbnail" id="thumbnailInput" class="form-control mt-2">
                        <small class="text-muted">Click the × button to remove current thumbnail. Max size: 2MB</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gallery Images</label>
                        <div class="gallery-preview" id="existingGallery">
                            @foreach ($service->images as $img)
                                <div>
                                    <img src="{{ asset('storage/' . $img->image_path) }}" alt="Gallery">
                                    <label class="remove-btn">
                                        <input type="checkbox" name="remove_images[]" value="{{ $img->id }}"
                                            style="display:none;">
                                        ×
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <input type="file" name="images[]" id="galleryInput" class="form-control mt-2" multiple>
                        <small class="text-muted">Each image must not exceed 2MB.</small>
                        <div class="gallery-preview" id="galleryPreview"></div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary btn-submit" id="btnSubmitEdit">
                            <i class="bi bi-save me-1"></i> Update Service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                height: 300,
                tabsize: 2,
                placeholder: 'Write your service description...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontname', 'fontsize', 'color']],
                    ['insert', ['picture', 'link', 'video']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            function showError(field, message) {
                let $field = $(field);
                $field.addClass('is-invalid');
                $field.next('.invalid-feedback').remove();
                $field.after(`<div class="invalid-feedback d-block">${message}</div>`);
            }

            $('input, textarea').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });

            $('#btnSubmitEdit').click(function(e) {
                e.preventDefault();
                $('.invalid-feedback').remove();
                $('input, textarea').removeClass('is-invalid');

                let valid = true;
                let firstError = null;
                const name = $('#name').val().trim();
                const description = $('#description').summernote('isEmpty') ? '' : $('#description')
                    .summernote('code').trim();
                const thumbnail = $('#thumbnailInput')[0].files[0];
                const galleryFiles = $('#galleryInput')[0].files;

                if (!name) {
                    showError('#name', 'Service name wajib diisi.');
                    valid = false;
                    firstError = firstError || '#name';
                } else if (name.length > 255) {
                    showError('#name', 'Service name tidak boleh lebih dari 255 karakter.');
                    valid = false;
                    firstError = firstError || '#name';
                }

                if (!description) {
                    $('#description').after(
                        '<div class="invalid-feedback d-block">Description wajib diisi.</div>');
                    valid = false;
                    firstError = firstError || '#description';
                }

                if (thumbnail && thumbnail.size > 2 * 1024 * 1024) {
                    showError('#thumbnailInput', 'Thumbnail tidak boleh lebih dari 2MB.');
                    valid = false;
                    firstError = firstError || '#thumbnailInput';
                }

                for (let file of galleryFiles) {
                    if (file.size > 2 * 1024 * 1024) {
                        showError('#galleryInput', 'Setiap gambar gallery maksimal 2MB.');
                        valid = false;
                        firstError = firstError || '#galleryInput';
                        break;
                    }
                }

                if (!valid) {
                    if (firstError === '#description') {
                        $('#description').summernote('focus');
                    } else {
                        $(firstError).focus();
                    }
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update this service?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) $('#editServiceForm').submit();
                });
            });

            const thumbnailInput = document.getElementById('thumbnailInput');
            const thumbnailPreview = document.getElementById('thumbnailPreview');
            thumbnailInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        thumbnailPreview.src = e.target.result;
                        thumbnailPreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            const galleryInput = document.getElementById('galleryInput');
            const galleryPreview = document.getElementById('galleryPreview');
            galleryInput.addEventListener('change', function() {
                galleryPreview.innerHTML = '';
                [...this.files].forEach(file => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const div = document.createElement('div');
                        div.style.position = 'relative';
                        div.innerHTML = `
                            <img src="${e.target.result}" style="width:120px;height:80px;object-fit:cover;border-radius:4px;">
                            <button type="button" class="remove-btn">×</button>
                        `;
                        div.querySelector('.remove-btn').addEventListener('click', () => {
                            div.remove();
                            const dt = new DataTransfer();
                            [...galleryInput.files].forEach(f => {
                                if (f !== file) dt.items.add(f);
                            });
                            galleryInput.files = dt.files;
                        });
                        galleryPreview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>
@endpush
