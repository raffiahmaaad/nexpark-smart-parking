<div class="app-sidebar colored" style="background-color: blue; color: white;">
    <div class="sidebar-header" style="background-color: black; color: white;">
        <a class="header-brand" href="{{ route('backend.home') }}">
            <div class="logo-img">
                NexPark
            </div>
        </a>
    </div>

    <div class="sidebar-content">
        <div class="nav-container" style="background-color: black; color: white;">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item active">
                    <a href="{{ route('backend.home') }}"><i class="ik ik-bar-chart-2"></i><span>Beranda</span></a>
                </div>

                <div class="nav-lavel" style="background-color: blue; color: white;">Manajemen Akun</div>
                <div class="nav-item has-sub {{ request()->routeIs('admins*') ? 'open' : ''}}">
                    <a href="javascript:void(0)"><i class="ik ik-user"></i><span>Kelola Akun Admin </span> </a>
                    <div class="submenu-content">
                        <a href="{{ route('backend.admins.create') }}"
                            class="menu-item {{ request()->routeIs('backend.admins.create') ? 'active' : '' }}">Buat
                            Akun
                            Admin</a>
                        <a href="{{ route('backend.admins.index') }}"
                            class="menu-item  {{ request()->routeIs('backend.admins.index') ? 'active' : '' }}">List
                            Daftar
                            Admin</a>
                    </div>
                </div>
                <div class="nav-item has-sub {{ request()->routeIs('customers*') ? 'open' : ''}}">
                    <a href="javascript:void(0)"><i class="ik ik-users"></i><span>Kelola Akun Pelanggan </span> </a>
                    <div class="submenu-content">
                        <a href="{{ route('backend.customers.create') }}"
                            class="menu-item  {{ request()->routeIs('backend.customers.create') ? 'active' : '' }}">Buat
                            Akun
                            Pelanggan</a>
                        <a href="{{ route('backend.customers.index') }}"
                            class="menu-item  {{ request()->routeIs('backend.customers.index') ? 'active' : '' }}">List
                            Daftar
                            Pelanggan</a>
                    </div>
                </div>
                <div class="nav-lavel" style="background-color: blue; color: white;">Manajemen Data Parkir </div>
                <div class="nav-item has-sub {{ request()->routeIs('categories*') ? 'open' : ''}}">
                    <a href="#"><i class="ik ik-box"></i><span>Kelola Kategori</span></a>
                    <div class="submenu-content">
                        <a href="{{ route('backend.categories.create') }}"
                            class="menu-item  {{ request()->routeIs('backend.categories.create') ? 'active' : '' }}">Buat
                            Kategori</a>
                        <a href="{{ route('backend.categories.index') }}"
                            class="menu-item  {{ request()->routeIs('backend.categories.index') ? 'active' : '' }}">List
                            Daftar
                            Kategori</a>
                    </div>
                </div>
                <div class="nav-item has-sub {{ request()->routeIs('vehicles*') ? 'open' : ''}}">
                    <a href="#"><i class="ik ik-truck"></i><span>Daftar Kendaraan</span> </a>
                    <div class="submenu-content">
                        <a href="{{ route('backend.vehicles.create') }}"
                            class="menu-item  {{ request()->routeIs('backend.vehicles.create') ? 'active' : '' }}">Buat
                            Data
                            kendaraaan</a>
                        <a href="{{ route('backend.vehicles.index') }}"
                            class="menu-item  {{ request()->routeIs('backend.vehicles.index') ? 'active' : '' }}">List
                            Daftar
                            Kendaran</a>
                    </div>
                </div>

                <div class="nav-item has-sub {{ request()->routeIs(['vehiclesIn*', 'vehiclesOut*']) ? 'open' : ''}}">
                    <a href="#"><i class="ik ik-gitlab"></i><span>Kelola Data Parkir</span> </a>
                    <div class="submenu-content">
                        <a href="{{ route('backend.vehiclesIn.index') }}"
                            class="menu-item  {{ request()->routeIs('backend.vehiclesIn*') ? 'active' : '' }}">Kendaraan
                            Masuk</a>
                        <a href="{{ route('backend.vehiclesOut.index') }}"
                            class="menu-item  {{ request()->routeIs('backend.vehiclesOut*') ? 'active' : '' }}">Kendaraan
                            Keluar</a>
                    </div>
                </div>

                <div class="nav-lavel" style="background-color: blue; color: white;">Manajemen Slot</div>
                <div class="nav-item">
                    <a href="{{ route('backend.parking-slots.index') }}">
                        <i class="fas fa-parking"></i>
                        <span>Manajemen Slot</span>
                    </a>
                </div>

                <div class="nav-lavel" style="background-color: blue; color: white;">Pembayaran</div>
                <div class="nav-item">
                    <a href="{{ route('backend.payments.index') }}">
                        <i class="ik ik-credit-card"></i>
                        <span>Konfirmasi Pembayaran</span>
                    </a>
                </div>

                <div class="nav-lavel" style="background-color: blue; color: white;">Laporan</div>
                <div class="nav-item">
                    <a href="{{ route('backend.reports.index') }}"><i class="ik ik-edit"></i><span>Buat
                            Laporan</span></a>
                </div>
            </nav>
        </div>
    </div>
</div>

<style>
    .submenu-content .menu-item {
        padding: 8px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .submenu-content .menu-item i {
        font-size: 14px;
        width: 20px;
        text-align: center;
    }

    .submenu-content .menu-item span {
        font-size: 14px;
    }

    .submenu-content .menu-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
    }

    .submenu-content .menu-item.active {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
    }

    .nav-item.has-sub>a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 15px;
        color: #fff;
        text-decoration: none;
    }

    .nav-item.has-sub.open>a {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
    }

    .nav-item a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 15px;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .nav-item a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
    }

    .nav-item a.active {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
    }

    .nav-item i {
        font-size: 16px;
        width: 20px;
        text-align: center;
    }
</style>