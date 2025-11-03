@extends('layouts.admin')

@section('title', 'Articles')

@push('styles')
    <style>
        #articlesTable {
            width: 100% !important;
            table-layout: auto;
        }

        /* Kolom teks panjang terpotong */
        #articlesTable td {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Kolom terakhir (action) di tengah */
        #articlesTable td:last-child {
            text-align: center;
        }

        /* Badge biar lebih kecil dan rapi */
        .badge {
            font-size: 0.75rem;
            padding: 6px 10px;
            border-radius: 8px;
        }

        /* Card & Table styling */
        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        .btn-main-action {
            min-width: 140px;
            padding: 0.4rem 0.8rem;
            font-size: 0.95rem;
        }

        table.dataTable td {
            vertical-align: middle;
            white-space: nowrap;
        }

        .btn-sm {
            padding: 0.45rem 0.9rem;
            font-size: 0.85rem;
        }

        /* Pagination style fix */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1rem;
            text-align: right !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination {
            justify-content: flex-end;
            margin-bottom: 0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3rem 0.6rem !important;
            margin: 0 2px !important;
            border-radius: 4px !important;
            border: 1px solid #dee2e6 !important;
            background: #fff !important;
            color: #0d6efd !important;
            font-size: 0.85rem !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #0d6efd !important;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #aaa !important;
            background: #f8f9fa !important;
        }

        /* Hapus semua SVG bawaan DataTables */
        .dataTables_wrapper .dataTables_paginate svg,
        .dataTables_wrapper .dataTables_paginate i {
            display: none !important;
        }
    </style>
@endpush

@section('content')
    <div class="card shadow-sm rounded-2xl">
        <!-- Header -->
        <div class="card-header-custom bg-white">
            <h3 class="text-primary fw-bold mb-0">Articles</h3>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-main-action shadow">
                <i class="bi bi-plus-lg me-1"></i> New Article
            </a>
        </div>

        <!-- Body -->
        <div class="card-body-custom table-responsive">
            <table id="articlesTable" class="table table-striped table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

    <!-- Modal Preview -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" id="previewTitle">Judul Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <img id="previewImage" src="" class="img-fluid rounded shadow-sm d-none" alt="Thumbnail">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <small class="text-muted d-block">Service</small>
                            <span class="fw-semibold" id="previewService">-</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <small class="text-muted d-block">Author</small>
                            <span class="fw-semibold" id="previewAuthor">-</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <small class="text-muted d-block">Type</small>
                            <span class="badge bg-secondary" id="previewType">-</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <small class="text-muted d-block">Created At</small>
                            <span class="fw-semibold" id="previewCreated">-</span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Content</small>
                        <div class="text-dark" id="previewContent" style="font-size: 0.95rem; line-height: 1.5;"></div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" id="previewDetailLink" class="btn btn-sm btn-primary">View Detail</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let table = $('#articlesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.articles.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                paging: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                responsive: true,
                autoWidth: false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari artikel..."
                }
            });

            // Preview modal (event delegation)
            $('#articlesTable').on('click', '.btn-preview', function() {
                let slug = $(this).data('slug');
                $.get(`/admin/articles/preview/${slug}`, function(data) {
                    $('#previewTitle').text(data.title ?? '-');
                    if (data.image) {
                        $('#previewImage').attr('src', data.image).removeClass('d-none');
                    } else {
                        $('#previewImage').addClass('d-none');
                    }
                    $('#previewAuthor').text(data.author ?? '-');
                    $('#previewService').text(data.service ?? '-');
                    let typeColors = {
                        article: 'bg-primary',
                        csr: 'bg-success'
                    };
                    $('#previewType')
                        .attr('class', 'badge ' + (typeColors[data.type] ?? 'bg-secondary') +
                            ' text-white')
                        .text(data.type ? data.type.charAt(0).toUpperCase() + data.type.slice(1) :
                            '-');
                    $('#previewCreated').text(data.created_at ?? '-');
                    $('#previewContent').html(data.content ?? '-');
                    $('#previewDetailLink').attr('href', `/admin/articles/${slug}`);
                    new bootstrap.Modal(document.getElementById('previewModal')).show();
                });
            });

            // Delete button (event delegation)
            $('#articlesTable').on('click', '.btn-delete', function() {
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This article will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });

            // Success message
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
