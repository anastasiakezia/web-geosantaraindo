<header id="header" class="header sticky-top">

    {{-- Topbar --}}
    @include('partials.visitor.topbar')

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('visitor/assets/img/home/logo_geo.png') }}" alt="">

            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a class="nav-link {{ request()->is('/') || request()->routeIs('visitor.home') ? 'active' : '' }}"
                            href="{{ route('visitor.home') }}">
                            Beranda
                        </a>

                    </li>
                    <li class="dropdown">
                        <a class="nav-link {{ request()->routeIs('visitor.about.profile') ? 'active' : '' }}"
                            href="{{ route('visitor.about.profile') }}">
                            Tentang Kami
                        </a>
                        {{-- <ul>
                            <li>
                                <a href="{{ route('visitor.about.profile') }}"
                                    class="{{ request()->routeIs('visitor.about.profile') ? 'active' : '' }}">
                                    Profil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('visitor.about.history') }}"
                                    class="{{ request()->routeIs('visitor.about.history') ? 'active' : '' }}">
                                    Sejarah Perusahaan
                                </a>
                            </li>
                        </ul> --}}
                    </li>
                    <li>
                        <a href="https://blog.geosantara.com/" class="nav-link">Berita</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('visitor.articles.*') && request('from') != 'csr' ? 'active' : '' }}"
                            href="{{ route('visitor.articles.index', ['from' => 'articles']) }}">
                            Project Kami
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->routeIs('visitor.galleries.*') ? 'active' : '' }}"
                            href="{{ route('visitor.galleries.index') }}">
                            Galeri
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('visitor.articles.*') && request('from') == 'csr' ? 'active' : '' }}"
                            href="{{ route('visitor.articles.csr', ['from' => 'csr']) }}">
                            CSR
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link {{ request()->routeIs('visitor.services.*') ? 'active' : '' }}"
                            href="{{ route('visitor.services.index') }}"><span>Layanan</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            @foreach ($allServices as $service)
                                <li>
                                    <a href="{{ route('visitor.services.show', $service->slug) }}">
                                        {{ $service->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    {{-- <li class="dropdown"><a href="#"><span>Layanan</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ route('visitor.home') }}#contact"
                            class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                            Kontak Kami
                        </a>
                    </li> --}}
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav><!-- End Navmenu -->

            {{-- <a class="cta-btn d-none d-sm-block" href="#appointment">Make an Appointment</a> --}}

        </div>
    </div>

</header><!-- End Header -->
