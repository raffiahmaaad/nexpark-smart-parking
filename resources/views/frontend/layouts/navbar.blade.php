@php
    use Illuminate\Support\Facades\Session;
    use App\Models\VehicleIn;
    use App\Models\Vehicle;
    use App\Models\Customer;

    $recentBookings = null;
    $customer = null;
    if (Session::has('customer_id')) {
        $customer = Customer::find(Session::get('customer_id'));
        $customerVehicles = Vehicle::where('customer_id', Session::get('customer_id'))
            ->pluck('id');

        $recentBookings = VehicleIn::with(['vehicle', 'slot'])
            ->whereIn('vehicle_id', $customerVehicles)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }
@endphp

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light fixed-top" id="ftco-navbar">
    <div class="container d-flex align-items-center justify-content-between" style="width:100%">
        <div class="navbar-brand-area d-flex align-items-center">
            <a class="navbar-brand" href="{{ url('/') }}">Nex<span>Park</span></a>
        </div>
        <div class="navbar-menu-area collapse navbar-collapse justify-content-center" id="ftco-nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item {{ Request::is('parking/form') ? 'active' : '' }}">
                    <a href="{{ url('parking/form') }}" class="nav-link">Booking Parkir</a>
                </li>
                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                    <a href="{{ url('about') }}" class="nav-link">Tentang Kami</a>
                </li>
                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                    <a href="{{ url('contact') }}" class="nav-link">Kontak</a>
                </li>
            </ul>
        </div>
        <div class="navbar-user-area d-flex align-items-center">
            @if(Session::has('customer_id') && Session::has('is_google_user'))
                <div class="nav-user-dropdown">
                    <div class="user-navbar-btn" role="button" tabindex="0">
                        @if($customer && $customer->avatar)
                            <img src="{{ asset($customer->avatar) }}" alt="Profile" class="rounded-circle"
                                style="width: 32px; height: 32px; object-fit: cover;">
                        @else
                            <div class="user-icon-navbar">
                                {{ substr(Session::get('customer_name'), 0, 1) }}
                            </div>
                        @endif
                        <div class="user-name-wrapper">
                            <span
                                class="user-name-navbar">{{ $customer ? $customer->name : (Session::get('customer_name') ?? '-') }}</span>
                        </div>
                    </div>
                    <div class="user-dropdown-menu">
                        <div class="user-dropdown-header">
                            @if($customer && $customer->avatar)
                                <img src="{{ asset($customer->avatar) }}" alt="Profile" class="rounded-circle"
                                    style="width: 48px; height: 48px; object-fit: cover;">
                            @else
                                <div class="user-icon-navbar">
                                    {{ substr(Session::get('customer_name'), 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <div class="user-name-navbar">
                                    {{ $customer ? $customer->name : (Session::get('customer_name') ?? '-') }}
                                </div>
                                <div class="user-email-navbar">
                                    {{ $customer ? $customer->email : (Session::get('customer_email') ?? '-') }}
                                </div>
                            </div>
                        </div>

                        <!-- Recent Bookings Section -->
                        @if($recentBookings && $recentBookings->count() > 0)
                            <div class="recent-bookings-section">
                                <div class="section-title">Riwayat Parkir Terakhir</div>
                                @foreach($recentBookings as $booking)
                                    <div class="booking-item">
                                        <div class="booking-info">
                                            <div class="vehicle-info">
                                                <i class="fas fa-car"></i>
                                                {{ $booking->vehicle->name }} - {{ $booking->vehicle->plat_number }}
                                            </div>
                                            <div class="parking-location">
                                                <i class="fas fa-map-marker-alt"></i>
                                                Area ({{ $booking->slot ? $booking->slot->area_name : '-' }}) -
                                                Slot ({{ $booking->slot ? $booking->slot->slot_number : '-' }})
                                            </div>
                                            <div class="booking-date">
                                                <i class="far fa-calendar-alt"></i>
                                                {{ $booking->created_at->format('d M Y H:i') }}
                                            </div>
                                        </div>
                                        @if($booking->status == 1)
                                            <form method="POST" action="{{ route('frontend.parking.exit') }}" style="margin-top:8px;">
                                                @csrf
                                                <input type="hidden" name="vehicle_in_id" value="{{ $booking->id }}">
                                                <button type="submit" class="exit-parking-btn">
                                                    <i class="fas fa-sign-out-alt"></i> Keluar Parkir
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('google.logout') }}" class="p-0 m-0">
                            @csrf
                            <button type="submit" class="logout-info-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('google.login') }}" class="btn google-login">
                    <i class="icon-google"></i> Login with Google
                </a>
            @endif
        </div>
    </div>
</nav>

<style>
    .navbar {
        transition: all 0.3s ease;
        padding: 12px 0;
        background: rgba(0, 0, 0, 0.85) !important;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .navbar.scrolled {
        padding: 10px 0;
        background: rgba(0, 0, 0, 0.9) !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        color: #fff !important;
        font-size: 26px;
        font-weight: 800;
        letter-spacing: 0.8px;
        margin-right: 35px;
        padding: 0 5px;
    }

    .navbar-brand span {
        color: #01d28e !important;
        transition: all 0.3s ease;
    }

    .navbar-brand:hover {
        transform: translateY(-1px);
    }

    .navbar-brand:hover span {
        color: #00ff9d !important;
        text-shadow: 0 0 15px rgba(0, 255, 157, 0.3);
    }

    .nav-item {
        margin: 0 15px;
    }

    .nav-link {
        color: #fff !important;
        font-weight: 500;
        padding: 8px 0;
        position: relative;
    }

    .nav-item.active .nav-link {
        color: #01d28e !important;
    }

    /* Untuk tampilan mobile */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            padding: 15px;
            border-radius: 10px;
            margin-top: 10px;
        }
    }

    /* Override warna default navbar */
    .bg-dark {
        background: transparent !important;
    }

    .ftco-navbar-light {
        background: transparent !important;
    }

    .ftco-navbar-light.scrolled {
        background: rgba(255, 255, 255, 0.1) !important;
    }

    /* Tambahan untuk memastikan warna putih */
    .navbar-dark .navbar-nav .nav-link {
        color: #fff !important;
    }

    .navbar-dark .navbar-brand {
        color: #fff !important;
    }

    .user-name-navbar,
    .user-email-navbar {
        color: #fff !important;
    }

    .dropdown-menu {
        background: rgba(255, 255, 255, 0.1) !important;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    .dropdown-menu .user-name-navbar,
    .dropdown-menu .user-email-navbar,
    .dropdown-menu .section-title,
    .dropdown-menu .booking-info,
    .dropdown-menu .vehicle-info,
    .dropdown-menu .parking-location,
    .dropdown-menu .booking-date {
        color: #fff !important;
    }

    .logout-info-btn {
        color: #fff !important;
        background: transparent;
        border: 1px solid #fff;
    }

    .logout-info-btn:hover {
        background: #01d28e;
        border-color: #01d28e;
    }

    .exit-parking-btn {
        background: linear-gradient(90deg, #00d084 0%, #00b8d4 100%);
        color: #fff;
        border: none;
        border-radius: 50px;
        width: 100%;
        margin-top: 15px;
        padding: 5px 0;
        font-size: 1rem;
        font-weight: 600;
        box-shadow: 0 4px 16px rgba(0, 208, 132, 0.10);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.2s;
        letter-spacing: 0.5px;
    }

    .exit-parking-btn i {
        font-size: 1.3rem;
    }

    .exit-parking-btn:hover,
    .exit-parking-btn:focus {
        background: linear-gradient(90deg, #00b8d4 0%, #00d084 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 8px 24px rgba(0, 208, 132, 0.18);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var navbar = document.getElementById('ftco-navbar');

        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    });
</script>