@extends('layouts.admin')

@section('title', 'Gallery project')
@section('content')
    <div class="container mt-4">
        {{-- Header judul & tombol --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary fw-bold m-0">Gallery Projects</h1>
            <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                + New Project
            </a>
        </div>

        {{-- Card tabel --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <table id="projectsTable" class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="width: 450px;">Project Name</th>
                            <th style="width: 180px;">Service</th>
                            <th style="width: 220px;">City / Province</th>
                            <th style="width: 150px;">Created At</th>
                            <th style="width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    {{-- ❗ tbody dikosongkan karena isi dari server (AJAX DataTables) --}}
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // ✅ Inisialisasi DataTables server-side
            let table = $('#projectsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.galleries.getData') }}', // route getData
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'project_name',
                        name: 'project_name'
                    },
                    {
                        data: 'service',
                        name: 'service'
                    },
                    {
                        data: 'city',
                        name: 'city'
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
                responsive: true,
                pageLength: 10,
                order: [
                    [0, 'dsc']
                ]
            });

            // ✅ SweetAlert konfirmasi delete 
            $(document).on('submit', '.form-delete', function(e) {
                e.preventDefault();
                let form = this;

                Swal.fire({
                    title: "Are you sure?",
                    text: "This project will be deleted!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
