@extends('layouts.visitor')

@section('title', 'Tentang Kami')
@section('meta_description',
    'PT Geo Santara Indonesia adalah perusahaan pengeboran geologi, survey geoteknik, dan
    analisis bawah permukaan berbasis profesionalisme dan teknologi modern.')

@section('content')
    <main class="container-fluid px-0">
        {{-- SECTION HERO BANNER --}}
        <section class="hero-banner">
            <div class="banner-background">
                <img src="{{ asset('visitor/assets/img/about/banner_about us.jpg') }}" alt="Banner PT Geo Santara Indo"
                    class="banner-img">
            </div>
            <div class="hero-text">
                <h1 class="fw-bold mb-2">Tentang Kami</h1>
                <p class="mb-0">Membangun Fondasi Kuat untuk Masa Depan yang Terukur</p>
            </div>
        </section>

        {{-- NAVIGASI TAB --}}
        <nav class="sub-navigation">
            <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-profil-tab" data-bs-toggle="tab" data-bs-target="#nav-profil"
                    type="button" role="tab" aria-controls="nav-profil" aria-selected="true">Profil</button>
                <button class="nav-link" id="nav-sejarah-tab" data-bs-toggle="tab" data-bs-target="#nav-sejarah"
                    type="button" role="tab" aria-controls="nav-sejarah" aria-selected="false">Sejarah</button>
                <button class="nav-link" id="nav-visi-misi-tab" data-bs-toggle="tab" data-bs-target="#nav-visi-misi"
                    type="button" role="tab" aria-controls="nav-visi-misi" aria-selected="false">Visi & Misi</button>
                <button class="nav-link" id="nav-logo-tab" data-bs-toggle="tab" data-bs-target="#nav-logo" type="button"
                    role="tab" aria-controls="nav-logo" aria-selected="false">Budaya & Nilai</button>
                <button class="nav-link" id="nav-direksi-tab" data-bs-toggle="tab" data-bs-target="#nav-direksi"
                    type="button" role="tab" aria-controls="nav-direksi" aria-selected="false">Dewan Direksi</button>
            </div>
        </nav>

        {{-- KONTEN TAB --}}
        <div class="tab-content" id="nav-tabContent">

            {{-- KONTEN TAB 1: PROFIL --}}
            <div class="tab-pane fade show active" id="nav-profil" role="tabpanel" aria-labelledby="nav-profil-tab">
                <div class="container py-5 content-container">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-5">
                            <p class="profile-supertitle fw-bold">Profil PT. Geo Santara</p>
                            <h2 class="profile-headline">Fondasi Kuat Masa Depan Terukur</h2>
                            <p class="profile-subtitle text-muted">Solusi pengeboran, survey geologi, pertambangan
                                <br>serta analisis atas dan bawah permukaan.
                            </p>
                        </div>
                        <div class="col-lg-7">
                            <p class="body-text" style="padding: 0 1rem;">PT. Geo Santara didirikan pada <strong>tahun
                                    2018</strong> dan telah melakukan berbagai proyek di beberapa wilayah di Indonesia
                                seperti:
                                Yogyakarta, Semarang, Sumatera Utara, Sumatera Selatan, Bandung, Banten, Bogor, Tangerang,
                                Bekasi,
                                Sukabumi, Purwakarta, Cirebon, Surabaya, Malang, Gresik, Madura, Kalimantan Barat,
                                Kalimantan
                                Tengah, Kalimantan Timur, Kalimantan Selatan, Bali, Kupang dan wilayah lain di seluruh
                                Indonesia.
                            </p>
                            <p class="body-text" style="padding: 0 1rem;">Setelah melakukan riset mengenai perkembangan
                                pembangunan yang semakin meningkat di beberapa sektor seperti <strong>industri manufaktur,
                                    sektor
                                    energi dan konstruksi</strong> di wilayah Indonesia. Diketahui bahwa memiliki daya saing
                                yang
                                kompleks dari segi pelayanan jasa. Untuk mengantisipasinya, kami sudah memiliki bekal
                                kematangan
                                kuat untuk ikut berpartisipasi di masing-masing bidang. Juga dari segi <strong>kedisiplinan
                                    dan
                                    profesional kerja</strong> pun kami jaga dengan baik. Sehingga klien yang melakukan
                                kerja sama
                                dengan kami akan merasa nyaman dan bisa <strong>bekerja sama jangka panjang.</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KONTEN TAB 2: SEJARAH --}}
            <div class="tab-pane fade" id="nav-sejarah" role="tabpanel" aria-labelledby="nav-sejarah-tab">
                <div class="container py-5 content-container">
                    <div class="row g-lg-5 g-4 align-items-stretch history-row">
                        <div class="col-lg-4 history-intro">
                            <p class="history-supertitle fw-bold">Sejarah Perusahaan</p>
                            <h2 class="history-headline text-primary fw-bold">Perjalanan dan Evolusi Kami</h2>
                            <p class="history-subtitle text-muted">Berawal dari bumi, kami menyalurkan makna keberlanjutan
                                bagi kehidupan.</p>
                        </div>
                        <div class="col-lg-4 d-flex">
                            <div class="history-card">
                                <span class="history-year-label">Sejak 2018</span>
                                <h4 class="fw-bold text-primary mb-3">Pendirian & Pertumbuhan Awal</h4>
                                <p class="body-text small">Berdiri pada <strong>tahun 2018</strong>, PT Geo Santara
                                    Indonesia lahir dari visi untuk menjawab kebutuhan pembangunan nasional yang
                                    dinamis. Sejak awal, kami langsung berekspansi dan mendapatkan kepercayaan dari
                                    berbagai kalangan, melayani klien dari pemerintah, swasta, hingga masyarakat
                                    luas di seluruh nusantara.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex">
                            <div class="history-card">
                                <span class="history-year-label">Sampai Sekarang</span>
                                <h4 class="fw-bold text-primary mb-3">Modernisasi & Komitmen Kualitas</h4>
                                <p class="body-text small">Memasuki <strong>tahun 2024</strong>, kami menegaskan komitmen
                                    pada kualitas dengan melakukan investasi berkelanjutan pada <strong>modernisasi
                                        peralatan dan teknologi</strong>. Langkah ini, didukung oleh tim profesional
                                    dan manajemen yang tangguh, mengukuhkan posisi kami sebagai perusahaan
                                    terpercaya yang mampu menyelesaikan setiap proyek secara efisien dengan jaminan
                                    hasil terbaik.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KONTEN TAB 3: VISI & MISI --}}
            <div class="tab-pane fade" id="nav-visi-misi" role="tabpanel" aria-labelledby="nav-visi-misi-tab">
                <div class="container py-5 content-container">
                    <div class="section-title text-center mb-5">
                        <h2 class="text-uppercase text-primary fw-bold section-heading">Visi & Misi</h2>
                        <p class="text-muted">Tujuan dan Komitmen Kami</p>
                    </div>
                    <div class="row g-lg-5 g-4 align-items-stretch">
                        <div class="col-lg-5 d-flex flex-column">
                            <img src="{{ asset('visitor/assets/img/misi/visi.png') }}" alt="Visi Perusahaan"
                                class="vision-final-image">
                            <p class="vision-text-new mt-auto" style="padding: 0 1rem; text-align:left;">"Menjadi
                                perusahaan
                                pengeboran nomor
                                1 di Indonesia yang
                                unggul, terpercaya, inovatif, produktif, dan selalu mengedepankan profesionalisme serta
                                pelayanan terbaik."</p>
                        </div>
                        <div class="col-lg-7">
                            <div class="mission-container">
                                <h3 class="mission-title">Misi</h3>
                                <ul class="mission-list">
                                    <li><i class="bi bi-check-circle-fill"></i><span>Mengadopsi teknologi pengeboran
                                            terbaru
                                            dan metode kerja efisien untuk meningkatkan kualitas layanan sebesar 20% dalam
                                            dua tahun ke depan.</span></li>
                                    <li><i class="bi bi-check-circle-fill"></i><span>Meningkatkan kepuasan klien hingga
                                            mencapai tingkat retensi sebesar 90% melalui penyelesaian proyek tepat waktu dan
                                            sesuai spesifikasi dalam satu tahun kedepan.</span></li>
                                    <li><i class="bi bi-check-circle-fill"></i><span>Melatih dan mengembangkan minimal 50
                                            karyawan setiap tahun untuk mencapai sertifikasi profesional di bidang
                                            pengeboran, guna memastikan kompetensi dan integritas sumber daya
                                            manusia.</span></li>
                                    <li><i class="bi bi-check-circle-fill"></i><span>Menerapkan sistem manajemen mutu ISO
                                            9001 dalam waktu 18 bulan untuk meningkatkan produktivitas dan efektivitas
                                            operasional secara berkelanjutan.</span></li>
                                    <li><i class="bi bi-check-circle-fill"></i><span>Menjalin kemitraan strategis dengan
                                            minimal lima mitra bisnis baru setiap tahun untuk memperluas jaringan dan
                                            meningkatkan nilai tambah bagi klien.</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KONTEN TAB 4: BUDAYA & NILAI --}}
            <div class="tab-pane fade" id="nav-logo" role="tabpanel" aria-labelledby="nav-logo-tab">
                <div class="container py-5 content-container">

                    {{-- Judul Bagian --}}
                    <div class="section-title text-center mb-5">
                        <h2 class="text-uppercase text-primary fw-bold section-heading">Budaya & Nilai Perusahaan</h2>
                        <p class="text-muted">Prinsip Pemandu Kinerja Kami</p>
                    </div>

                    {{-- Wrapper untuk dua box --}}
                    <div class="row justify-content-center g-4 g-lg-5">

                        {{-- Box 1: Budaya Perusahaan --}}
                        <div class="col-lg-11 col-12">
                            <div class="culture-box">
                                <h3 class="culture-title">Budaya Perusahaan</h3>
                                <div class="culture-grid">

                                    {{-- Item 1 --}}
                                    <div class="culture-item">
                                        <div class="culture-icon-wrapper">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                        <p>Kerja Cerdas & Efisien</p>
                                    </div>

                                    {{-- Item 2 --}}
                                    <div class="culture-item">
                                        <div class="culture-icon-wrapper">
                                            <i class="bi bi-graph-up"></i>
                                        </div>
                                        <p>Komitmen pada Kualitas</p>
                                    </div>

                                    {{-- Item 3 --}}
                                    <div class="culture-item">
                                        <div class="culture-icon-wrapper">
                                            <i class="bi bi-compass"></i>
                                        </div>
                                        <p>Kolaborasi & Sinergi</p>
                                    </div>

                                    {{-- Item 4 --}}
                                    <div class="culture-item">
                                        <div class="culture-icon-wrapper">
                                            <i class="bi bi-bar-chart-line"></i>
                                        </div>
                                        <p>Peningkatan Berkelanjutan</p>
                                    </div>

                                    {{-- Item 5 --}}
                                    <div class="culture-item">
                                        <div class="culture-icon-wrapper">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                        <p>Keselamatan & Tanggung Jawab</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Box 2: Nilai Perusahaan --}}
                        <div class="col-lg-11 col-12">
                            <div class="culture-box">
                                <h3 class="culture-title">Nilai Perusahaan</h3>
                                <div class="culture-grid">

                                    {{-- Item 1 --}}
                                    <div class="culture-item">
                                        <div class="culture-icon-wrapper">
                                            <i class="bi bi-clipboard-check"></i>
                                        </div>
                                        <p>Profesionalisme Terukur</p>
                                    </div>

                                    {{-- Item 2 --}}
                                    <div class="culture-item">
                                        <div class="culture-icon-wrapper">
                                            <i class="bi bi-envelope-open"></i>
                                        </div>
                                        <p>Kepercayaan & Transparansi</p>
                                    </div>

                                    {{-- Item 3 --}}
                                    <div class="culture-item">
                                        <div class="culture-icon-wrapper">
                                            <i class="bi bi-building-gear"></i>
                                        </div>
                                        <p>Inovasi Teknologi Pengeboran</p>
                                    </div>

                                    {{-- Item 4 --}}
                                    <div class="culture-item">
                                        <div class="culture-icon-wrapper">
                                            <i class="bi bi-pencil-fill"></i>
                                        </div>
                                        <p>Produktivitas & Efisiensi Kerja</p>
                                    </div>

                                    {{-- Item 5 --}}
                                    <div class="culture-item">
                                        <div class="culture-icon-wrapper">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <p>Pengembangan SDM Berkelanjutan</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KONTEN TAB 5: DEWAN DIREKSI --}}
            <div class="tab-pane fade" id="nav-direksi" role="tabpanel" aria-labelledby="nav-direksi-tab">
                <div class="container py-5 content-container">

                    {{-- [BARU] Judul Bagian Dipindahkan Ke Sini --}}
                    <div class="row justify-content-center mb-4 mb-lg-5">
                        <div class="col-lg-8 text-center">
                            <h2 class="text-primary fw-bold section-heading director-heading-lg">
                                Dewan Direksi
                            </h2>
                            <p class="text-muted" style="font-size: 1.3rem;">
                                Kepemimpinan Geo Santara hadir dengan visi jelas untuk menjaga arah dan integritas
                                perusahaan.
                            </p>
                        </div>
                    </div>

                    {{-- Grid Kartu Sekarang Berisi 6 Orang --}}
                    <div class="row g-4 align-items-stretch justify-content-center">

                        {{-- Card 1: --}}
                        <div class="col-lg-4 col-md-6 col-10">
                            <div class="director-card">
                                <div class="director-front"
                                    style="background-image: url('{{ asset('visitor/assets/img/direksi/pak_galih.jpg') }}');">
                                    <div class="director-info-overlay">
                                        <h5>Yoseph Galih Gunawan, S.T.</h5>
                                        <p>Komisaris</p>
                                    </div>
                                </div>
                                <div class="director-back">
                                    <div class="director-back-content">
                                        <span class="director-year">2018</span>
                                        <p><strong>Perguruan Tinggi:</strong> Institut Teknologi Nasional Yogyakarta</p>
                                        <p><strong>Spesialisasi:</strong> Pengeboran, Geoteknik, Konstruksi</p>
                                        <p class="mb-0"><strong>Tanggung Jawab:</strong></p>
                                        <ul class="director-tasks-new">
                                            <li>Mengakses dan memeriksa semua dokumen perusahaan.</li>
                                            <li>Meminta penjelasan direksi secara tertulis dan lisan.</li>
                                            <li>Pengurusan Perseroan melalui RUPS.</li>
                                            <li>Melakukan pelaporan dan dokumentasi secara berkala.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card 2: Malita --}}
                        <div class="col-lg-4 col-md-6 col-10">
                            <div class="director-card">
                                <div class="director-front"
                                    style="background-image: url('{{ asset('visitor/assets/img/direksi/bu_malita.jpeg') }}');">
                                    <div class="director-info-overlay">
                                        <h5>Malita Mentari</h5>
                                        <p>Chief Executive Officer</p>
                                    </div>
                                </div>
                                <div class="director-back">
                                    <div class="director-back-content">
                                        <span class="director-year">2024</span>
                                        <p><strong>Perguruan Tinggi:</strong>
                                            Puspita Martha International Beauty School</p>
                                        {{-- <p><strong>Spesialisasi:</strong> Pengeboran, Geoteknik, Konstruksi</p> --}}
                                        <p class="mb-0"><strong>Tanggung Jawab:</strong></p>
                                        <ul class="director-tasks-new">
                                            <li>Kepemimpinan strategis & Visi</li>
                                            <li>Pengelolaan keuangan dan kepatuhan (melalui SPV Financial & SPV Legal)</li>
                                            <li>Pengawasan kinerja utama</li>
                                            <li>Hubungan eksternal</li>
                                            <li>Manajemen risiko tingkat tinggi</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card 3: Lukman (Tetap) --}}
                        <div class="col-lg-4 col-md-6 col-10">
                            <div class="director-card">
                                <div class="director-front"
                                    style="background-image: url('{{ asset('visitor/assets/img/direksi/pak_luky.jpg') }}');">
                                    <div class="director-info-overlay">
                                        <h5>Lukman Lukita Aji, S.T.</h5>
                                        <p>Direksi</p>
                                    </div>
                                </div>
                                <div class="director-back">
                                    <div class="director-back-content">
                                        <span class="director-year">2024</span>
                                        <p><strong>Perguruan Tinggi:</strong>Universitas Atma Jaya Yogyakarta</p>
                                        <p><strong>Spesialisasi:</strong>Pengeboran, Konstruksi, Survey & Analisis Geoteknik
                                        </p>
                                        <p class="mb-0"><strong>Tanggung Jawab:</strong></p>
                                        <ul class="director-tasks-new">
                                            <li>Perencanaan & pengawasan.</li>
                                            <li>Manajemen tim.</li>
                                            <li>Pengendalian biaya & kualitas.</li>
                                            <li>Komunikasi, koordinasi & pengambilan keputusan.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card 4: Winarti (Tetap) --}}
                        <div class="col-lg-4 col-md-6 col-10">
                            <div class="director-card">
                                <div class="director-front"
                                    style="background-image: url('{{ asset('visitor/assets/img/direksi/bu_win.jpg') }}');">
                                    <div class="director-info-overlay">
                                        <h5>Dr. Ir. Winarti, S.T., M.T.</h5>
                                        <p>Penasihat Geofisika</p>
                                    </div>
                                </div>
                                <div class="director-back">
                                    <div class="director-back-content">
                                        <span class="director-year">2025</span>
                                        <p><strong>Perguruan Tinggi:</strong>Institut Teknologi Nasional Yogyakarta</p>
                                        <p><strong>Spesialisasi:</strong>Geofisika, Pengeboran, Geoteknik</p>
                                        <p class="mb-0"><strong>Tanggung Jawab:</strong></p>
                                        <ul class="director-tasks-new">
                                            <li>Mengarahkan survei geofisika dan pemodelan bawah permukaan.</li>
                                            <li>Mentoring analisis data seismik dan interpretasi hasil survei.</li>
                                            <li>Berkoordinasi dengan tim lintas fungsi untuk evaluasi eksplorasi.</li>
                                            <li>Mengawasi penerapan hasil studi pada kegiatan pengeboran.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card 5: Akhmad (Tetap) --}}
                        <div class="col-lg-4 col-md-6 col-10">
                            <div class="director-card">
                                <div class="director-front"
                                    style="background-image: url('{{ asset('visitor/assets/img/direksi/pak_fajar.jpg') }}');">
                                    <div class="director-info-overlay">
                                        <h5>Dr. Akhmad Fajar Prasetyo, S.Pd., M.Pd., Cht., Cl.</h5>
                                        <p>Penasihat Pengembangan SDM</p>
                                    </div>
                                </div>
                                <div class="director-back">
                                    <div class="director-back-content">
                                        <span class="director-year">2025</span>
                                        <p><strong>Spesialisasi:</strong> Filsafat Ilmu, Konseling Behavioristik, Konseling
                                            Komprehensif, Konseling Multicultural, Teknik Tes</p>
                                        <p class="mb-0"><strong>Tanggung Jawab:</strong></p>
                                        <ul class="director-tasks-new">
                                            <li>Mentoring strategi pengembangan kompetensi karyawan.</li>
                                            <li>Membimbing manajemen dalam perencanaan tenaga kerja.</li>
                                            <li>Mengawasi kebijakan kompensasi, benefit, dan penghargaan.</li>
                                            <li>Memastikan kebijakan SDM sesuai dengan peraturan.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card 6: Al Hussein (Tetap) --}}
                        <div class="col-lg-4 col-md-6 col-10">
                            <div class="director-card">
                                <div class="director-front"
                                    style="background-image: url('{{ asset('visitor/assets/img/direksi/pak_husein.jpg') }}');">
                                    <div class="director-info-overlay">
                                        <h5>Al Hussein Flowers Rizqi, S.T, M.Eng.</h5>
                                        <p>Penasihat Geohidrologi</p>
                                    </div>
                                </div>
                                <div class="director-back">
                                    <div class="director-back-content">
                                        <span class="director-year">2025</span>
                                        <p><strong>Perguruan Tinggi:</strong>Institut Teknologi Nasional Yogyakarta</p>
                                        <p><strong>Spesialisasi:</strong>Geologi</p>
                                        <p class="mb-0"><strong>Tanggung Jawab:</strong></p>
                                        <ul class="director-tasks-new">
                                            <li>Memberikan rekomendasi pengelolaan sumber daya air tanah.</li>
                                            <li>Mengevaluasi studi geohidrologi untuk lokasi sumur bor.</li>
                                            <li>Mengevaluasi analisis data hidrologi (kuantitas dan kualitas air).</li>
                                            <li>Mengawasi kepatuhan terhadap regulasi lingkungan hidrologi.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap');

        /* -- GLOBAL & HERO -- */
        .hero-banner {
            position: relative;
            height: 70vh;
            min-height: 450px;
            width: 100%;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
        }

        .banner-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-text {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1100px;
            padding: 0 50px;
            margin: 0 auto 0 100px;
            margin-bottom: 50px;
            text-align: left;
            font-family: 'Poppins', sans-serif;
        }

        .hero-text h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            color: #fff;
            font-size: clamp(2.5rem, 6vw, 4rem);
            -webkit-text-stroke: 1px rgba(0, 0, 0, 0.6);
            line-height: 1.1;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .hero-text p {
            font-weight: 400;
            color: #f1f1f1;
            font-size: clamp(1rem, 1.5vw, 1.25rem);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .sub-navigation {
            width: 100%;
            background-color: #fff;
            border-top: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 80px;
            z-index: 1019 !important;
        }

        .sub-navigation .nav-link {
            font-weight: 500;
            padding: 1rem 1.5rem;
            transition: all 0.2s ease-in-out;
            border: none;
            border-radius: 0;
            position: relative;
            color: #495057;
        }

        .sub-navigation .nav-link:hover {
            color: #0056b3;
            background-color: #f8f9fa;
        }

        .sub-navigation .nav-link.active {
            color: #0d6efd;
            font-weight: 700;
            background-color: #fff;
            border-bottom: 3px solid #0d6efd;
        }

        .sub-navigation .nav-tabs {
            border-bottom: none;
        }

        .sub-navigation .nav-link:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 25px;
            background-color: #dee2e6;
        }

        .body-text {
            text-align: justify;
            color: #495057;
            line-height: 1.8;
        }

        .body-text.small {
            font-size: 0.9rem;
            line-height: 1.7;
        }

        .section-heading {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
        }

        /* -- TAB 1: PROFIL -- */
        .profile-supertitle {
            color: #1e293b;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .profile-headline {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            color: #0d6efd;
            line-height: 1;
            margin-bottom: 1.5rem;
        }

        .profile-subtitle {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* -- TAB 2: SEJARAH -- */
        .history-intro .history-supertitle {
            color: #1e293b;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .history-intro .history-headline {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: clamp(2.2rem, 4.5vw, 3.2rem);
            line-height: 1.1;
            margin-bottom: 1rem;
        }

        .history-intro .history-subtitle {
            font-size: 1rem;
            line-height: 1.7;
        }

        .history-card {
            background-color: #e7f0ff;
            border-radius: 20px;
            padding: 2rem;
            width: 100%;
            align-self: stretch;
        }

        .history-year-label {
            display: inline-block;
            background-color: #0d6efd;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.4rem 1rem;
            border-radius: 15px;
            margin-bottom: 1.25rem;
        }

        .history-card h4 {
            font-size: 1.3rem;
            line-height: 1.3;
            font-weight: 700;
        }

        /* -- TAB 3: VISI & MISI -- */
        .vision-final-image {
            width: 100%;
            object-fit: cover;
            border-radius: 24px;
            flex-grow: 1;
            min-height: 0;
            margin-top: -70px;
        }

        .vision-text-new {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #495057;
            margin-top: 1.5rem;
        }

        .mission-container {
            background-color: #f0f7ff;
            border-radius: 24px;
            padding: 2.5rem;
            height: 100%;
        }

        .mission-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 2rem;
        }

        .mission-list {
            list-style: none;
            padding-left: 0;
        }

        .mission-list li {
            display: flex;
            align-items: flex-start;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 1.25rem;
            color: #3e4c5d;
        }

        .mission-list li i {
            font-size: 1.4rem;
            color: #0d6efd;
            margin-right: 15px;
            margin-top: 4px;
        }

        .mission-list li:last-child {
            margin-bottom: 0;
        }

        /* -- TAB 4: BUDAYA & NILAI [REVISI] -- */
        .culture-box {
            background-color: #f0f7ff;
            /* Mengambil warna dari box misi */
            border-radius: 24px;
            /* Mengambil radius dari box misi */
            padding: 2.5rem 2rem;
            width: 100%;
        }

        .culture-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: #0d6efd;
            margin-bottom: 2.5rem;
            text-align: left;
            padding-left: 0.5rem;
        }

        .culture-grid {
            display: flex;
            flex-wrap: wrap;
            /* Penting untuk responsive */
            justify-content: center;
            /* Pusatkan item */
            gap: 2rem;
            /* Jarak antar item */
        }

        .culture-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex-basis: 150px;
            /* Lebar dasar item */
            flex-grow: 1;
            /* Izinkan item tumbuh */
            min-width: 130px;
            /* Lebar minimum */
        }

        .culture-icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #dbeaff;
            /* Biru lebih muda */
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .culture-icon-wrapper i {
            font-size: 2.5rem;
            color: #0d6efd;
            transition: all 0.3s ease;
        }

        .culture-item p {
            font-size: 1rem;
            font-weight: 500;
            color: #3e4c5d;
            line-height: 1.4;
            margin-bottom: 0;
            max-width: 150px;
            /* Batasi lebar teks */
        }

        .culture-item:hover .culture-icon-wrapper {
            background-color: #0d6efd;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
            transform: translateY(-5px);
        }

        .culture-item:hover .culture-icon-wrapper i {
            color: #fff;
        }

        /* -- Style lama yang tidak dipakai lagi -- */
        .culture-values-col {
            border-right: none;
        }

        .values-header h2 {
            display: none;
        }

        .values-header h2::after {
            display: none;
        }

        .values-list {
            display: none;
        }

        /* -- TAB 5: DEWAN DIREKSI -- */
        .director-text-card {
            background-color: transparent;
            border: none;
            box-shadow: none;
            padding: 1.25rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .director-text-card .director-heading-lg {
            font-size: clamp(2.8rem, 6vw, 4rem);
            line-height: 1.1;
        }

        .director-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            height: 0;
            background-color: transparent;
            cursor: pointer;
            perspective: 1000px;
            width: 100%;
            padding-top: 125%;
            /* 4:5 Aspect Ratio */
        }

        .director-front {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            backface-visibility: hidden;
            transform-style: preserve-3d;
            transition: transform 0.6s ease, box-shadow 0.3s ease;
            z-index: 2;
        }

        .director-info-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1.5rem 1.25rem 1.25rem 1.25rem;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.8) 100%);
            text-align: left;
            z-index: 3;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .director-info-overlay h5 {
            font-size: 1.0rem;
            line-height: 1.4;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.1rem;
        }

        .director-info-overlay p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
        }

        .director-back {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #0d6efd;
            color: #ffffff;
            overflow-y: auto;
            text-align: left;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            backface-visibility: hidden;
            transform: rotateY(180deg);
            transform-style: preserve-3d;
            transition: transform 0.6s ease, box-shadow 0.3s ease;
            z-index: 1;
        }

        .director-back-content {
            padding: 1.5rem;
            position: relative;
        }

        .director-year {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            font-size: 1.15rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.7);
        }

        .director-back p {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .director-back p strong {
            color: #ffffff;
            font-weight: 700;
            display: block;
            margin-bottom: 0.1rem;
        }

        .director-card:hover .director-front {
            transform: rotateY(180deg);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .director-card:hover .director-back {
            transform: rotateY(360deg);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            z-index: 3;
        }

        .director-tasks-new {
            list-style: none;
            padding-left: 0;
            margin-top: 0.5rem;
        }

        .director-tasks-new li {
            position: relative;
            padding-left: 1.4rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
        }

        .director-tasks-new li::before {
            content: '•';
            position: absolute;
            left: 0;
            top: 0px;
            font-weight: 900;
            color: #fff;
            font-size: 1rem;
        }

        /* -- RESPONSIVE: MEDIUM (<= 991px) -- */
        @media (max-width: 991px) {

            .profile-headline,
            .profile-supertitle {
                text-align: center;
            }

            .profile-subtitle {
                text-align: center;
                margin-bottom: 1.2rem;
            }

            .history-intro {
                text-align: center;
                margin-bottom: 2rem;
            }
        }

        /* -- RESPONSIVE: SMALL (<= 767px) -- */
        @media (max-width: 767px) {
            .hero-banner {
                height: 60vh;
                min-height: 350px;
            }

            .hero-text {
                margin: 0 0 40px 0;
                padding: 0 20px;
                width: 100%;
                text-align: center;
            }

            .hero-text h1 {
                font-size: clamp(2rem, 10vw, 2.8rem);
                -webkit-text-stroke: 0.5px rgba(0, 0, 0, 0.7);
            }

            .hero-text p {
                font-size: 1rem;
            }

            .sub-navigation {
                top: 80px;
                z-index: 1019;
            }

            .sub-navigation .nav-link {
                padding: 0.8rem 1rem;
                font-size: 0.9rem;
            }

            .sub-navigation .nav-tabs {
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                justify-content: flex-start !important;
            }

            .content-container {
                padding-top: 2.5rem !important;
                padding-bottom: 2.5rem !important;
            }

            .section-heading {
                font-size: 1.8rem;
            }

            .body-text {
                text-align: justify;
                font-size: 0.95rem;
            }

            /* [REVISI] Padding untuk row sejarah di mobile */
            .history-row {
                padding: 0 1rem;
            }

            .history-intro .history-headline {
                font-size: clamp(1.8rem, 6vw, 2.5rem);
            }

            .history-card {
                padding: 1.5rem;
            }

            .history-year-label {
                padding: 0.3rem 0.8rem;
                font-size: 0.8rem;
                margin-bottom: 1rem;
            }

            .history-card h4 {
                font-size: 1.1rem;
            }

            .body-text.small {
                font-size: 0.85rem;
            }

            .vision-text-new {
                text-align: justify;
                margin-bottom: 2rem;
                margin-top: 1rem;
            }

            .mission-container {
                padding: 1.8rem;
            }

            .mission-title {
                font-size: 2rem;
                text-align: center;
            }

            /* [REVISI] Responsive untuk Tab 4 */
            .culture-box {
                padding: 2rem 1rem;
            }

            .culture-title {
                font-size: 1.5rem;
                text-align: center;
                margin-bottom: 2rem;
                padding-left: 0;
            }

            .culture-grid {
                gap: 1.5rem 1rem;
                /* Kurangi jarak di mobile */
            }

            .culture-item {
                flex-basis: 100px;
                /* Perkecil basis item */
                min-width: 100px;
            }

            .culture-icon-wrapper {
                width: 65px;
                height: 65px;
            }

            .culture-icon-wrapper i {
                font-size: 2rem;
            }

            .culture-item p {
                font-size: 0.9rem;
            }

            .director-text-card {
                text-align: center;
                padding: 1rem;
            }

            .director-text-card .director-heading-lg {
                font-size: clamp(2.2rem, 10vw, 3rem);
            }

            /* [REVISI] Ukuran konten card direksi di mobile */
            .director-card {
                /* Padding-top (aspect ratio) sudah diatur di style utama, tidak perlu diubah */
                min-height: auto;
                /* Hapus min-height di mobile agar aspect ratio bekerja penuh */
            }

            .director-info-overlay {
                padding: 1rem 1rem 0.75rem 1rem;
            }

            .director-info-overlay h5 {
                font-size: 0.85rem;
            }

            .director-info-overlay p {
                font-size: 0.75rem;
            }

            .director-back-content {
                padding: 1.1rem;
            }

            .director-year {
                top: 1.1rem;
                right: 1.1rem;
                font-size: 0.9rem;
            }

            .director-back p {
                font-size: 0.85rem;
                margin-bottom: 0.5rem;
            }

            .director-tasks-new {
                margin-top: 0.3rem;
            }

            .director-tasks-new li {
                font-size: 0.8rem;
                margin-bottom: 0.3rem;
                padding-left: 1.2rem;
            }

            .director-tasks-new li::before {
                font-size: 0.9rem;
            }
        }
    </style>
@endsection
