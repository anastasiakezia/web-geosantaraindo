@extends('layouts.admin')

@section('title', 'Edit Article')

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

        .note-editor.note-frame {
            border-radius: 0.25rem;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                    <h3 class="text-primary fw-bold mb-0">Edit Article</h3>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary btn-sm btn-back">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form id="editArticleForm" action="{{ route('admin.articles.update', $article->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <!-- Title -->
                            <div class="col-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control form-control-lg"
                                    value="{{ old('title', $article->title) }}" required style="height:50px;">
                            </div>

                            <!-- Type -->
                            <div class="col-12">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="article"
                                        {{ old('type', $article->type) == 'article' ? 'selected' : '' }}>Artikel</option>
                                    <option value="csr" {{ old('type', $article->type) == 'csr' ? 'selected' : '' }}>CSR
                                    </option>
                                </select>
                            </div>

                            <!-- Service -->
                            <div class="col-12 {{ old('type', $article->type) == 'csr' ? 'd-none' : '' }}"
                                id="service-wrapper">
                                <label for="service_id" class="form-label">Service</label>
                                <select name="service_id" id="service_id" class="form-select"
                                    {{ old('type', $article->type) == 'article' ? 'required' : '' }}>
                                    <option value="">-- Pilih Service --</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            {{ old('service_id', $article->service_id) == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Content -->
                            <div class="col-12">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" id="content" class="form-control" style="min-height:500px;">{{ old('content', $article->content) }}</textarea>
                            </div>

                            <!-- Submit -->
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button type="button" id="btnSubmitEdit" class="btn btn-primary btn-submit">
                                    <i class="bi bi-save me-1"></i> Update Article
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Summernote init
            $('#content').summernote({
                height: 500,
                tabsize: 2,
                placeholder: 'Write your article content here...',
                callbacks: {
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            let reader = new FileReader();
                            reader.onload = function(e) {
                                $('#content').summernote('insertImage', e.target.result);
                            };
                            reader.readAsDataURL(files[i]);
                        }
                    }
                }
            });

            // Placeholder setup
            $('#title').attr('placeholder', 'Enter article title...');
            $('#type').prepend('<option value="" disabled>-- Select Type --</option>');
            $('#service_id').prepend('<option value="">-- Select Service --</option>');

            // Toggle service field
            function toggleServiceField() {
                if ($('#type').val() === 'article') {
                    $('#service-wrapper').removeClass('d-none');
                    $('#service_id').attr('required', true);
                } else {
                    $('#service-wrapper').addClass('d-none');
                    $('#service_id').removeAttr('required').val('');
                    $('#service_id').next('.invalid-feedback').remove();
                }
            }
            toggleServiceField();
            $('#type').on('change', toggleServiceField);

            // Show error
            function showError(field, message) {
                let $field = $(field);
                $field.addClass('is-invalid');
                $field.next('.invalid-feedback').remove();
                $field.after(`<div class="invalid-feedback d-block">${message}</div>`);
            }

            // Remove error on input/change
            $('input, select, textarea').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });

            // Submit
            $('#btnSubmitEdit').click(function() {
                let valid = true;
                let firstError = null; // track first invalid field
                $('.invalid-feedback').remove();
                $('input, select, textarea').removeClass('is-invalid');

                const title = $('#title').val().trim();
                const type = $('#type').val();
                const service = $('#service_id').val();
                const content = $('#content').summernote('isEmpty') ? '' : $('#content').summernote('code')
                    .trim();

                if (!title) {
                    showError('#title', 'Title wajib diisi.');
                    valid = false;
                    firstError = firstError || '#title';
                } else if (title.length > 255) {
                    showError('#title', 'Title tidak boleh lebih dari 255 karakter.');
                    valid = false;
                    firstError = firstError || '#title';
                }

                if (!type) {
                    showError('#type', 'Type wajib dipilih.');
                    valid = false;
                    firstError = firstError || '#type';
                }

                if (type === 'article' && !service) {
                    showError('#service_id', 'Service wajib dipilih untuk tipe article.');
                    valid = false;
                    firstError = firstError || '#service_id';
                }

                if (!content || $('#content').summernote('isEmpty')) {
                    $('#content').next('.invalid-feedback').remove();
                    $('#content').after('<div class="invalid-feedback d-block">Content wajib diisi.</div>');
                    valid = false;
                    firstError = firstError || '#content';
                }

                // Fokus ke kolom pertama yang error
                if (!valid) {
                    if (firstError === '#content') {
                        $('#content').summernote('focus');
                    } else {
                        $(firstError).focus();
                    }
                    return;
                }

                // SweetAlert konfirmasi
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update this article?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#editArticleForm').submit();
                    }
                });
            });

            // SweetAlert success
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
@endpush
