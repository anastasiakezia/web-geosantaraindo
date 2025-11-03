@extends('layouts.admin')

@section('title', 'Create Article')

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
                    <h3 class="text-primary fw-bold mb-0">Create Article</h3>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary btn-sm btn-back">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form id="createArticleForm" action="{{ route('admin.articles.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control form-control-lg"
                                    value="{{ old('title') }}" placeholder="Enter article title..." required
                                    style="height:50px;">
                            </div>

                            <div class="col-12">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="" disabled selected>-- Select Type --</option>
                                    <option value="article" {{ old('type') == 'article' ? 'selected' : '' }}>Artikel
                                    </option>
                                    <option value="csr" {{ old('type') == 'csr' ? 'selected' : '' }}>CSR</option>
                                </select>
                            </div>

                            <div class="col-12 {{ old('type') == 'csr' ? 'd-none' : '' }}" id="service-wrapper">
                                <label for="service_id" class="form-label">Service</label>
                                <select name="service_id" id="service_id" class="form-select">
                                    <option value="">-- Select Service --</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" id="content" class="form-control" placeholder="Write your article content here..."
                                    style="min-height:500px;">{{ old('content') }}</textarea>
                            </div>

                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button type="button" id="btnSubmitCreate" class="btn btn-primary btn-submit">
                                    <i class="bi bi-save me-1"></i> Create Article
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
            // ✅ Inisialisasi Summernote
            $('#content').summernote({
                height: 500,
                tabsize: 2,
                placeholder: 'Write your article here...',
                popover: {
                    image: [
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['resize', ['resize100', 'resize50', 'resize25']],
                        ['remove', ['removeMedia']]
                    ]
                },
                buttons: {
                    resize100: function(context) {
                        var ui = $.summernote.ui;
                        return ui.button({
                            contents: '100%',
                            tooltip: 'Resize to 100%',
                            click: function() {
                                var img = $(context.invoke('editor.restoreTarget'));
                                img.css('width', '100%');
                            }
                        }).render();
                    },
                    resize50: function(context) {
                        var ui = $.summernote.ui;
                        return ui.button({
                            contents: '50%',
                            tooltip: 'Resize to 50%',
                            click: function() {
                                var img = $(context.invoke('editor.restoreTarget'));
                                img.css('width', '50%');
                            }
                        }).render();
                    },
                    resize25: function(context) {
                        var ui = $.summernote.ui;
                        return ui.button({
                            contents: '25%',
                            tooltip: 'Resize to 25%',
                            click: function() {
                                var img = $(context.invoke('editor.restoreTarget'));
                                img.css('width', '25%');
                            }
                        }).render();
                    }
                },
                callbacks: {
                    onFocus: function() {
                        // 🧩 Tambah tombol "Float Center" ketika popover gambar muncul
                        $(document).off('shown.note.popover').on('shown.note.popover', function() {
                            const $floatGroup = $('.note-image-popover .note-floating');
                            if ($floatGroup.length && !$floatGroup.find(
                                    '.note-btn-float-center').length) {
                                $('<button type="button" class="note-btn note-btn-float-center" title="Float Center"><i class="note-icon-align-center"></i></button>')
                                    .on('click', function() {
                                        const $img = $($('#content').summernote(
                                            'editor.restoreTarget'));
                                        $img.css({
                                            display: 'block',
                                            margin: '0 auto',
                                            float: 'none'
                                        });
                                    })
                                    .appendTo($floatGroup);
                            }
                        });
                    },
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            let file = files[i];
                            if (file.size > 2 * 1024 * 1024) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Image too large!',
                                    text: `${file.name} exceeds 2MB limit.`,
                                    confirmButtonColor: '#0d6efd'
                                });
                                continue;
                            }
                            let reader = new FileReader();
                            reader.onload = function(e) {
                                $('#content').summernote('insertImage', e.target.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                }
            });

            // ✅ Toggle field Service
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

            // 🧭 Validasi dan Submit
            function showError(field, message) {
                let $field = $(field);
                $field.addClass('is-invalid');
                $field.next('.invalid-feedback').remove();
                $field.after(`<div class="invalid-feedback d-block">${message}</div>`);
            }

            function focusFirstError() {
                let $first = $('.is-invalid:first');
                if ($first.length) {
                    $first.focus();
                    $('html, body').animate({
                        scrollTop: $first.offset().top - 150
                    }, 500);
                }
            }
            $('input, select, textarea').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });
            $('#btnSubmitCreate').click(function() {
                let valid = true;
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
                } else if (title.length > 255) {
                    showError('#title', 'Title tidak boleh lebih dari 255 karakter.');
                    valid = false;
                }
                if (!type) {
                    showError('#type', 'Type wajib dipilih.');
                    valid = false;
                }
                if (type === 'article' && !service) {
                    showError('#service_id', 'Service wajib dipilih untuk tipe article.');
                    valid = false;
                }
                if (!content || $('#content').summernote('isEmpty')) {
                    $('#content').next('.invalid-feedback').remove();
                    $('#content').after('<div class="invalid-feedback d-block">Content wajib diisi.</div>');
                    valid = false;
                }

                if (!valid) {
                    focusFirstError();
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to create this article?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Yes, create it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#createArticleForm').submit();
                    }
                });
            });
        });
    </script>
@endpush
