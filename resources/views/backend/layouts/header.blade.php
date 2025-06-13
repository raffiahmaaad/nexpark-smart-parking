<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                <div class="header-search">
                    <div class="input-group">
                        <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                        <input type="text" class="form-control">
                        <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                    </div>
                </div>
                <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
            </div>
            <div class="top-menu d-flex align-items-center">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="ik ik-bell"></i><span
                            class="badge bg-danger">2</span></a>
                    <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="notiDropdown">
                        <h4 class="header">Pemberitahuan</h4>
                        <div class="notifications-wrap">
                            <a href="#" class="media">
                                <span class="d-flex">
                                    <i class="ik ik-check"></i>
                                </span>
                                <span class="media-body">
                                    <span class="heading-font-family media-heading">Undangan Di Terima</span>
                                    <span class="media-content">Anda Telah di Undang ...</span>
                                </span>
                            </a>

                            <a href="#" class="media">
                                <span class="d-flex">
                                    <i class="ik ik-calendar"></i>
                                </span>
                                <span class="media-body">
                                    <span class="heading-font-family media-heading">Agenda Kegiatan</span>
                                    <span class="media-content">Rapat dengan Kawan Agil Hari Jum'at 8 Malam ...</span>
                                </span>
                            </a>
                        </div>
                        <div class="footer"><a href="javascript:void(0);">Lihat Semua aktifitas</a></div>
                    </div>
                </div>
                {{-- <button type="button" class="nav-link ml-10 right-sidebar-toggle"><i
                        class="ik ik-message-square"></i><span class="badge bg-success">3</span></button> --}}
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @if(auth()->user()->avatar)
                            <img class="avatar" src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                style="width: 35px; height: 35px; object-fit: cover; border-radius: 50%; border: 2px solid #fff;">
                        @else
                            @php
                                $colors = ['#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#34495e', '#16a085', '#27ae60', '#2980b9', '#8e44ad', '#2c3e50'];
                                $randomColor = $colors[array_rand($colors)];
                            @endphp
                            <div class="avatar" style="width: 35px; height: 35px; border-radius: 50%; background-color: {{ $randomColor }};
                                                       color: white; display: flex; align-items: center; justify-content: center;
                                                       font-weight: bold; font-size: 16px; border: 2px solid #fff;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('backend.admins.profile') }}"><i
                                class="ik ik-user dropdown-icon"></i> Akun </a>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            <i class="ik ik-power dropdown-icon"></i>
                            {{ __('Keluar') }}
                        </a>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>