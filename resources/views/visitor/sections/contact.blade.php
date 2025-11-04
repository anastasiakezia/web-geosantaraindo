    <section id="contact" class="contact section" style="padding: 30px 40px;">
        <div class="card rounded-12 border-0 pt-5 pb-5" style="background-color: #F0F8FF; border-radius:50px">
            <div class="container section-title" data-aos="fade-up">
                <h2 style="color: #007bff;">Kami Menunggu Konsultasi Kebutuhan Anda!</h2>
                <p>Jika Anda memiliki pertanyaan, jangan ragu untuk mengirimi kami pesan. Kami menantikan kabar dari
                    Anda!
                </p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-4">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>PT GEO SANTARA INDO</h4>
                                <p>Head Office Lantai 3, R. 309 310 Jl. Magelang No. 188, Karangwaru, Kec. Tegalrejo,
                                    Kota
                                    Yogyakarta, 55242</p>
                            </div>
                        </div>
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <p>Meeting Office Jl Gading Kirana Timur A-11/15 Lantai 1, RT 001 RW 08, Kel. Kelapa
                                    Gading
                                    Barat, Kec. Kelapa Gading,14240, Jakarta Utara</p>
                            </div>
                        </div>
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h4>Call Us</h4>
                                <p>+6281134500100</p>
                            </div>
                        </div>
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email</h4>
                                <p>santarageo@gmail.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        {{-- Form Contact --}}
                        <form action="{{ route('contact.send') }}" method="post" class="contact-form"
                            data-aos="fade-up" data-aos-delay="200">
                            @csrf
                            <div class="row gy-4">

                                {{-- Judul Pesan --}}
                                <div class="col-md-12">
                                    <label for="message_title" class="form-label">Judul Pesan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="message_title" name="message_title"
                                        class="form-control rounded-3" required>
                                </div>
                                {{-- Nama (Wajib) --}}
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control rounded-3"
                                        required>
                                </div>

                                {{-- Nomor HP (Wajib) --}}
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Nomor HP <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="phone" name="phone" class="form-control rounded-3"
                                        required>
                                </div>

                                {{-- Email (Opsional) --}}
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email (Opsional)</label>
                                    <input type="email" id="email" name="email" class="form-control rounded-3">
                                </div>

                                {{-- Nama Perusahaan (Opsional) --}}
                                <div class="col-md-6">
                                    <label for="company" class="form-label">Nama Perusahaan (Opsional)</label>
                                    <input type="text" id="company" name="company" class="form-control rounded-3">
                                </div>

                                {{-- Pilih Jasa (Opsional, pakai Select2) --}}
                                <div class="col-md-6">
                                    <label for="service_id" class="form-label">Pilih Jasa (Opsional)</label>
                                    <select id="service_id" name="service_id" class="form-select rounded-3 select2">
                                        <option value="">Pilih Jasa</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Titik Lokasi / Koordinat (Opsional, isi fake untuk testing) --}}
                                <div class="col-md-6">
                                    <label for="location" class="form-label">Titik Lokasi / Koordinat (Opsional)</label>
                                    <input type="text" id="location" name="location" class="form-control rounded-3"
                                        placeholder="Contoh: -7.795580, 110.369490">
                                </div>

                                {{-- Kebutuhan (Wajib) --}}
                                <div class="col-md-12">
                                    <label for="needs" class="form-label">Kebutuhan <span
                                            class="text-danger">*</span></label>
                                    <textarea id="needs" name="needs" class="form-control rounded-3" rows="5" required></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary px-4 py-2">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: "Pilih Jasa",
                allowClear: true
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('success')),
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: @json(session('error')),
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Coba Lagi'
                });
            @endif
        });
    </script>

    <style>
        .contact-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .contact-form button:hover {
            background-color: #0056b3;
        }

        .form-label {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 500;
            margin-bottom: 4px;
            display: block;
        }

        .form-control,
        .form-select {
            font-size: 0.95rem;
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        .select2-container .select2-selection--single {
            height: 42px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 6px 12px;
            font-size: 0.95rem;
        }

        .select2-container--default .select2-selection__arrow {
            height: 38px;
        }

        small.text-muted {
            font-size: 0.8rem;
            color: #868e96;
        }
    </style>
