<section id="about" class="about section" style="padding: 0 1rem;">
    <div class="container">
        <div class="row gy-4 gx-5">
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <h3 class="mt-4">Mitra Profesional dalam Pengerjaan Project Anda</h3>
                <p class="mt-3" style="text-align: justify">PT Geo Santara Indo bukan sekadar kontraktor, Sejak tahun
                    2018 kami hadir
                    sebagai mitra
                    profesional yang akan membersamai Anda dengan perencanaan teknis yang strategis berdasarkan analisa
                    komprehensif menggunakan teknologi mutakhir.</p>
                <p style="text-align: justify">
                    Mitra profesional yang dipercaya oleh lebih dari 1100+ client dan perusahaan terkemuka di Indonesia.
                    Bersama-sama kita akan berkolaborasi mengatasi tantangan, demi harapan akan terwujudnya masa depan
                    Indonesia menjadi lebih baik

                </p>
                <div class="col-md-12">
                    <div class="video-wrapper">
                        <iframe src="https://www.youtube.com/embed/r7ZVcHxdoFk" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 content mt-5" data-aos="fade-up" data-aos-delay="100" style="0 1">
                <h3>Keunggulan Kami</h3>
                <ul>
                    <li>
                        <i class="fa-solid fa-file-contract" style="color: #007bff;"></i>
                        <div>
                            <h5>Legalitas Lengkap & Resmi</h5>
                            <p>Kami memiliki legalitas resmi perusahaan berupa AKTA Pendirian Perusahaan, NPWP, NIB,
                                SPPKP, SBUJK, SIPPA, Sertifikat Juru Bor, Surat Instalasi Alat Bor, SKT / SKA yang bisa
                                dipertanggungjawabkan secara legal dan terdaftar resmi di dokumen negara Indonesia.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-file-signature" style="color: #007bff;"></i>
                        <div>
                            <h5>Tersedia Kontrak Kerja</h5>
                            <p>Kami menyediakan Dokumen Kontrak Kerja untuk kedua belah pihak sebagai bagian dari SPK
                                atau MOU agar masing-masing pihak memiliki Hak & Kewajiban.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-people-group" style="color: #007bff;"></i>
                        <div>
                            <h5>Tim Ahli Berpengalaman</h5>
                            <p>Kami melayani sejak 2018 dan telah memiliki klien di seluruh Indonesia dan memiliki lebih
                                dari 400 proyek yang telah selesai kami kerjakan. Seluruh tim kami memiliki sertifikasi
                                resmi sesuai dengan bidang yang akan ditangani.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-list-check" style="color: #007bff;"></i>
                        <div>
                            <h5>Manajemen Pekerjaan Terbaik</h5>
                            <p>Anda akan menerima report pekerjaan secara berkala, dan seluruh pengerjaan akan mengacu
                                pada SOP atau alur kerja yang terstruktur.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
</section>

<section id="certifications" class="certifications section" style="margin-top: 4rem;">
    <div class="container section-title" data-aos="fade-up">
        <h2 style="color: #007bff;">Telah Tersertifikasi Oleh</h2>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="certification-container">
            <div class="certification-item">
                <img src="{{ asset('visitor/assets/img/home/verifikasi-1.png') }}" alt="Sertifikasi NSQ">
            </div>
            <div class="certification-divider"></div>
            <div class="certification-item">
                <img src="{{ asset('visitor/assets/img/home/verifikasi-2.png') }}" alt="Sertifikasi ISO">
            </div>
            <div class="certification-divider"></div>
            <div class="certification-item">
                <img src="{{ asset('visitor/assets/img/home/verifikasi-3.png') }}" alt="Sertifikasi ASIB">
            </div>
        </div>
    </div>
</section>

</div>

<style>
    /* ======================================= */
    /* == CSS UNTUK KESERAGAMAN KEUNGGULAN == */
    /* ======================================= */
    #about ul {
        list-style: none;
        padding: 0;
    }

    #about ul li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 25px;
    }

    #about ul li:last-child {
        margin-bottom: 0;
    }

    #about ul li i {
        font-size: 2.2rem;
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 20px;
        flex-shrink: 0;
    }

    #about ul li div {
        flex-grow: 1;
    }

    #about ul li h5 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: #1e293b;
    }

    #about ul li p {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #475569;
        text-align: justify
    }

    /* ======================================= */
    /* == CSS LOGO SERTIFIKASI DENGAN ANIMASI HOVER == */
    /* ======================================= */
    .certifications {
        padding-top: 40px;
    }

    .certification-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        background-color: #f0f7ff;
        padding: 2rem 1.5rem;
        border-radius: 16px;
        border: 1px solid #dbe9f9;
    }

    .certification-item {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 1rem;
        transition: transform 0.3s ease;
        /* Transisi untuk efek naik */
    }

    /* EFEK HOVER DITAMBAHKAN DI SINI */
    .certification-item:hover {
        transform: translateY(-8px);
        /* Efek terangkat saat di-hover */
    }

    .certification-item img {
        max-height: 150px;
        max-width: 100%;
        height: auto;
        object-fit: contain;
        transition: transform 0.3s ease;
        /* Transisi untuk efek zoom */
    }

    /* EFEK HOVER PADA GAMBAR */
    .certification-item:hover img {
        transform: scale(1.05);
        /* Efek zoom-in saat di-hover */
    }

    .certification-divider {
        width: 1.5px;
        height: 70px;
        background-color: #cdddf0;
    }

    /* Style untuk mobile */
    @media (max-width: 767px) {
        .certification-container {
            flex-direction: column;
            padding: 1.5rem;
        }

        .certification-item {
            margin-bottom: 1.5rem;
            margin-top: 1.5rem;
        }

        .certification-item:first-child {
            margin-top: 0;
        }

        .certification-item:last-child {
            margin-bottom: 0;
        }

        .certification-divider {
            width: 80%;
            height: 1px;
            margin: 0 auto;
        }
    }
</style>
