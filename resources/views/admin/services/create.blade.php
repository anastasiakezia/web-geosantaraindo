@extends('layouts.admin')

@section('title', 'Create Service')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .form-label {
            font-weight: 600;
            font-size: 1.15rem;
        }

        .form-control {
            font-size: 1rem;
        }

        .card {
            margin: 20px auto;
            border-radius: 0.75rem;
            max-width: 1200px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-submit {
            width: 180px;
        }

        .card-header {
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #ddd;
            font-size: 1.25rem;
            position: relative;
        }

        .btn-back {
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
        }

        #thumbnailPreviewWrapper {
            position: relative;
            margin-top: 10px;
        }

        #thumbnailPreviewWrapper img {
            width: 150px;
            display: block;
            margin-top: 5px;
            border-radius: 4px;
        }

        #removeThumbnailBtn {
            position: absolute;
            top: -5px;
            right: -5px;
            background: rgba(220, 53, 69, 0.8);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            display: none;
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
            height: 90px;
            object-fit: cover;
            border-radius: 4px;
        }

        .gallery-preview .remove-btn {
            position: absolute;
            top: -5px;
            right: -5px;
            background: rgba(220, 53, 69, 0.8);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center">
                <h3 class="text-primary fw-bold mb-0">Create Service</h3>
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

                <form id="createServiceForm" action="{{ route('admin.services.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">

                        <!-- Name -->
                        <div class="col-12">
                            <label for="name" class="form-label">Service Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                                value="{{ old('name') }}" placeholder="Enter service name..." required>
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="6"
                                placeholder="Write service description...">{{ old('description') }}</textarea>
                        </div>

                        <!-- Thumbnail -->
                        <div class="col-12">
                            <label class="form-label d-block">Thumbnail</label>
                            <div id="thumbnailPreviewWrapper"
                                style="position: relative; display: inline-block; margin-top: 10px;">
                                <img id="thumbnailPreview" src="" class="img-thumbnail"
                                    style="width:150px; display:none; border-radius:4px;">
                                <button type="button" id="removeThumbnailBtn"
                                    style="position: absolute; top: -8px; right: -8px; background: rgba(220,53,69,0.8);
                                color: #fff; border: none; border-radius: 50%; width: 24px; height: 24px;
                                cursor: pointer; display:none;">×</button>
                            </div>
                            <input type="file" name="thumbnail" id="thumbnailInput" class="form-control mt-2" required>
                            <small class="text-muted d-block mt-1">Max file size: 2 MB</small>
                        </div>

                        <!-- Gallery -->
                        <div class="col-12">
                            <label class="form-label">Gallery Images</label>
                            <input type="file" name="images[]" id="galleryInput" class="form-control mt-2" multiple>
                            <small class="text-muted d-block mt-1">Max file size: 2 MB per image</small>
                            <div class="gallery-preview" id="galleryPreview"
                                style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;"></div>
                        </div>

                        <!-- Submit -->
                        <div class="col-12 d-flex justify-content-end mt-4">
                            <button type="button" id="btnSubmitCreate" class="btn btn-primary btn-submit">
                                <i class="bi bi-plus-circle me-1"></i> Create Service
                            </button>
                        </div>
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

            $('#btnSubmitCreate').click(function() {
                let valid = true;
                let firstError = null;
                $('.invalid-feedback').remove();
                $('input, textarea').removeClass('is-invalid');

                const name = $('#name').val().trim();
                const description = $('#description').summernote('isEmpty') ? '' : $('#description')
                    .summernote('code').trim();
                const thumbnailFile = $('#thumbnailInput')[0].files[0];
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

                if (!description || $('#description').summernote('isEmpty')) {
                    $('#description').next('.invalid-feedback').remove();
                    $('#description').after(
                        '<div class="invalid-feedback d-block">Description wajib diisi.</div>');
                    valid = false;
                    firstError = firstError || '#description';
                }

                if (!thumbnailFile) {
                    showError('#thumbnailInput', 'Thumbnail wajib diunggah.');
                    valid = false;
                    firstError = firstError || '#thumbnailInput';
                } else if (thumbnailFile.size > 2 * 1024 * 1024) {
                    showError('#thumbnailInput', 'Ukuran thumbnail tidak boleh lebih dari 2 MB.');
                    valid = false;
                    firstError = firstError || '#thumbnailInput';
                }

                for (let file of galleryFiles) {
                    if (file.size > 2 * 1024 * 1024) {
                        showError('#galleryInput', `File ${file.name} melebihi 2 MB.`);
                        valid = false;
                        firstError = firstError || '#galleryInput';
                        break;
                    }
                }

                if (!valid) {
                    if (firstError === '#description') $('#description').summernote('focus');
                    else $(firstError).focus();
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to create this service?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, create it!'
                }).then((result) => {
                    if (result.isConfirmed) $('#createServiceForm').submit();
                });
            });

            const thumbnailInput = document.getElementById('thumbnailInput');
            const thumbnailPreview = document.getElementById('thumbnailPreview');
            const removeThumbnailBtn = document.getElementById('removeThumbnailBtn');

            thumbnailInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        thumbnailPreview.src = e.target.result;
                        thumbnailPreview.style.display = 'block';
                        removeThumbnailBtn.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeThumbnailBtn.addEventListener('click', () => {
                thumbnailPreview.src = '';
                thumbnailPreview.style.display = 'none';
                thumbnailInput.value = '';
                removeThumbnailBtn.style.display = 'none';
            });

            const galleryInput = document.getElementById('galleryInput');
            const galleryPreview = document.getElementById('galleryPreview');

            galleryInput.addEventListener('change', function() {
                galleryPreview.innerHTML = '';
                [...this.files].forEach(file => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const div = document.createElement('div');
                        div.innerHTML = `
                    <img src="${e.target.result}">
                    <button type="button" class="remove-btn">×</button>
                `;
                        const btn = div.querySelector('.remove-btn');
                        btn.addEventListener('click', () => {
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
