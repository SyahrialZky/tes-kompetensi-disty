<div class="sidebar collapse show " id="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src=" {{ asset('assets/img/kliniksehat.svg') }} " alt="navbar brand" class="navbar-brand" height="30" />
                {{-- <span class="text-white">Klinik Sehat</span> --}}
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
                <!-- Menu Dashboard -->
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="/">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (Auth::user()->hasRole('admin'))
                <li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
                    <a href="/users">
                        <i class="fas fa-user"></i>
                        <p>User Management</p>
                    </a>
                </li>
                @endif
                
                @if (Auth::user()->hasRole(['admin', 'petugas']))
                <li class="nav-item {{ Request::is('patients*') ? 'active' : '' }}">
                    <a href="{{ route('patients.index') }}">
                        <i class="fas fa-user"></i>
                        <p>Pasien & Pemeriksaan</p>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>
