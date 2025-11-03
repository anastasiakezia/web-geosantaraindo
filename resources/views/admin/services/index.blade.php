@extends('layouts.admin')

@section('title', 'Services')

@push('styles')
    <style>
        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .description-truncate {
            max-width: 350px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            font-family: 'Inter', Arial, sans-serif;
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        .gallery-preview img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        /* Modal content font */
        #previewModal .modal-body {
            font-family: 'Inter', Arial, sans-serif;
            font-size: 15px;
            color: #212529;
        }

        #previewModal .gallery-preview {
            margin-top: 15px;
            display: flex;
            flex-wrap: wrap;
        }
    </style>
@endpush

@section('content')
    <div class="card shadow-sm rounded-2xl">
        <div class="card-header-custom bg-white">
            <h3 class="text-primary fw-bold mb-0">Services</h3>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary shadow">
                <i class="bi bi-plus-lg me-1"></i> New Service
            </a>
        </div>

        <div class="card-body-custom table-responsive">
            <table id="servicesTable" class="table table-striped table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-primary" id="previewModalLabel">Service Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 id="previewName" class="fw-bold mb-3"></h4>
                    <div id="previewThumbnail" class="mb-3 text-center"></div>
                    <div id="previewDescription" class="mb-4"></div>
                    <h6 class="fw-bold">Gallery Images</h6>
                    <div id="previewGallery" class="gallery-preview d-flex flex-wrap"></div>
                    <hr>
                    <p><strong>Created At:</strong> <span id="previewCreated"></span></p>
                    <p><strong>Updated At:</strong> <span id="previewUpdated"></span></p>
                </div>
                <div class="modal-footer">
                    <a href="#" id="previewDetailLink" class="btn btn-primary">
                        <i class="bi bi-box-arrow-up-right"></i> View Detail
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // DataTable dengan pagination bawaan
            let table = $('#servicesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.services.data') }}', // route harus mengembalikan datatables JSON
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        orderable: false,
                        searchable: false
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
                    },
                ],
                order: [
                    [3, 'desc']
                ],
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search service..."
                }
            });

            // Preview modal
            $(document).on('click', '.btn-preview', function() {
                let id = $(this).data('id');
                $('#previewName').text('');
                $('#previewThumbnail').html('');
                $('#previewDescription').html('');
                $('#previewGallery').html('');

                $.ajax({
                    url: `/admin/services/preview/${id}`,
                    method: 'GET',
                    success: function(data) {
                        $('#previewName').text(data.name ?? '-');
                        if (data.thumbnail) $('#previewThumbnail').html('<img src="' + data
                            .thumbnail + '" style="max-width:200px; border-radius:6px;">');
                        $('#previewDescription').html(data.description ?? '-');
                        $('#previewCreated').text(data.created_at ?? '-');
                        $('#previewUpdated').text(data.updated_at ?? '-');
                        $('#previewDetailLink').attr('href', `/admin/services/${id}`);
                        if (data.images && data.images.length) {
                            data.images.forEach(img => {
                                $('#previewGallery').append('<img src="' + img
                                    .image_path +
                                    '" style="width:120px;height:80px;object-fit:cover;border-radius:4px;margin-right:5px;margin-bottom:5px;">'
                                );
                            });
                        }
                        let previewModal = new bootstrap.Modal(document.getElementById(
                            'previewModal'));
                        previewModal.show();
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to load service preview.'
                        });
                    }
                });
            });

            // Delete confirmation
            $(document).on('submit', '.form-delete', function(e) {
                e.preventDefault();
                let form = this;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This service will be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
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
                    text: "{{ session('success') }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
@endpush
