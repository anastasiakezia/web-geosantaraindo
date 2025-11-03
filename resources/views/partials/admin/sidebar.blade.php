{{-- <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> --}}
<style>
    .app-sidebar {
        background-color: #3157c5 !important;
        color: #fff;
    }

    .app-sidebar .nav-link,
    .app-sidebar .brand-link {
        color: #fff !important;
    }

    .app-sidebar .nav-link.active {
        background-color: rgba(255, 255, 255, 0.15) !important;
        color: #fff !important;
    }
</style>

<aside class="app-sidebar bg-body-secondary shadow">
    <!-- Brand -->
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('admin/assets/img/logo_geo.png') }}" alt="AdminLTE Logo" class="brand-image shadow" />
            <span class="brand-text fw-bold text-white">Geo Santara</span>
        </a>
    </div>

    <!-- Sidebar menu -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Articles -->
                <li class="nav-item">
                    <a href="{{ route('admin.articles.index') }}"
                        class="nav-link {{ request()->is('admin/articles*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-newspaper"></i>
                        <p>Articles</p>
                    </a>
                </li>

                <!-- Services -->
                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}"
                        class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-briefcase"></i>
                        <p>Services</p>
                    </a>
                </li>

                <!-- Gallery Project -->
                <li class="nav-item">
                    <a href="{{ route('admin.galleries.index') }}"
                        class="nav-link {{ request()->is('admin/galleries*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-hammer"></i>
                        <p>Gallery Project</p>
                    </a>
                </li>

                <!-- Gallery Tools -->
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.gallerytools.index') }}"
                        class="nav-link {{ request()->is('admin/tools*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-hammer"></i>
                        <p>Gallery Tools</p>
                    </a>
                </li> --}}

                <!-- Users (optional, nanti untuk Super Admin) -->
                {{-- 
        <li class="nav-item">
          <a href="{{ route('users.index') }}" 
             class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-people"></i>
            <p>Users</p>
          </a>
        </li>
        --}}
            </ul>
        </nav>
    </div>
</aside>
