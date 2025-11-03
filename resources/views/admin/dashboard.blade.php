@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{ $articlesCount }}</h3>
                            <p>Articles</p>
                        </div>
                        <a href="{{ url('admin/articles') }}" class="small-box-footer">
                            More info <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-secondary">
                        <div class="inner">
                            <h3>{{ $csrCount }}</h3>
                            <p>CSR</p>
                        </div>
                        {{-- Pastikan route 'admin.articles.index' ada atau sesuaikan --}}
                        <a href="{{ route('admin.articles.index') }}?category=csr" class="small-box-footer">
                            More info <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ $servicesCount }}</h3>
                            <p>Services</p>
                        </div>
                        <a href="{{ url('admin/services') }}" class="small-box-footer">
                            More info <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-info">
                        <div class="inner">
                            <h3>{{ $projectsCount }}</h3>
                            <p>Projects</p>
                        </div>
                        <a href="{{ url('admin/galleries') }}" class="small-box-footer">
                            More info <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Articles per Month</h3>
                        </div>
                        <div class="card-body">
                            {{-- Pastikan div ini ada SEBELUM script dijalankan --}}
                            <div id="articlesChart"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.48.0/dist/apexcharts.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartElement = document.querySelector("#articlesChart");

            if (chartElement) {
                const chartData = @json($chartData ?? []);
                console.log('Chart Data:', chartData);

                if (!Array.isArray(chartData)) {
                    console.error('Error: chartData bukan sebuah array!', chartData);
                    chartElement.innerHTML =
                        '<p style="color: red; text-align: center;">Error memuat data chart. Data bukan array.</p>';
                    return;
                }
                if (chartData.length !== 12) {
                    console.warn('Peringatan: Jumlah data chartData bukan 12.', chartData);
                }

                // [REVISI] Menambahkan kembali 'stroke'
                var options = {
                    chart: {
                        type: 'line',
                        height: 300
                    },
                    series: [{
                        name: 'Articles',
                        data: chartData
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                        ]
                    },
                    // [BARU] Tambahkan stroke
                    stroke: {
                        curve: 'smooth' // Membuat garis lebih halus
                    }
                    // Opsi lain masih dihapus
                };

                try {
                    var chart = new ApexCharts(chartElement, options);
                    chart.render();
                    console.log('ApexCharts render dipanggil (dengan stroke).');
                } catch (error) {
                    console.error("Error saat merender ApexCharts:", error);
                    chartElement.innerHTML =
                        '<p style="color: red; text-align: center;">Error merender chart. Cek console untuk detail.</p>';
                }

            } else {
                console.error('Error: Elemen chart #articlesChart tidak ditemukan!');
            }
        });
    </script>
@endpush
