<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="/" class="logo d-flex align-items-center">
                <img
                    src="{{ asset('assets/img/logo.png') }}"
                    alt="navbar brand"
                    class="navbar-brand"
                     class="me-2"
                    style="height: 25px; width: auto;" />
                <span
                    style="font-family: Arial, sans-serif; font-size:11px; line-height:1.2;"
                    class="fw-bold fst-italic text-uppercase text-white">
                    BPS Kabupaten Tulungagung
                </span>

            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('form.*') ? 'active' : '' }}">
                    <a href="{{ route('form.index') }}">
                        <i class="fas fa-file"></i>
                        <p>Tambah Data Strategis</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('download.index') ? 'active' : '' }}">
                    <a href="{{ route('download.index') }}">
                        <i class="fas fa-database"></i>
                        <p>Data Strategis</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Kelola</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('*') || request()->routeIs('manage.user.create') || request()->routeIs('manage.user.edit') ? 'active' : '' }}">
                    <a href="{{ route('kelola.indikator.index') }}">
                        <i class="fas fa-folder-open"></i>
                        <p>Indikator</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('panduan.index') ? 'active' : '' }}">
                    
                        <i class="fas fa-book"></i>
                        <p>Panduan</p>
                    </a>
                </li>
                <style>
                    .nav-item a .badge-success {
                        margin-right: 0;
                    }

                    .nav-item a .badge-danger {
                        margin-left: 2px;
                    }
                </style>
            </ul>
        </div>
    </div>
</div>
