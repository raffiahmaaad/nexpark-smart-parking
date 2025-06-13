<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'NexPark')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('frontend/images/icon.jpg') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/navbar-custom.css') }}">
    @stack('styles')
    <style>
        /* Navbar Styling */
        .ftco-navbar-light {
            background: rgba(0, 0, 0, 0.7) !important;
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .ftco-navbar-light .navbar-brand {
            color: #fff;
            font-weight: 700;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .ftco-navbar-light .navbar-brand span {
            color: #00d084;
        }

        .ftco-navbar-light .navbar-nav .nav-item {
            margin: 0 15px;
        }

        .ftco-navbar-light .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 16px;
            padding: 0.5rem 0;
            position: relative;
            transition: all 0.3s ease;
        }

        .ftco-navbar-light .navbar-nav .nav-link:hover,
        .ftco-navbar-light .navbar-nav .nav-item.active .nav-link {
            color: #00d084;
        }

        .ftco-navbar-light .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #00d084;
            transition: width 0.3s ease;
        }

        .ftco-navbar-light .navbar-nav .nav-link:hover::after,
        .ftco-navbar-light .navbar-nav .nav-item.active .nav-link::after {
            width: 100%;
        }

        /* User Area Styling */
        .navbar-user-area {
            margin-left: auto;
        }

        .user-navbar-btn {
            background: transparent;
            border: none;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .user-navbar-btn:hover {
            background: rgba(0, 208, 132, 0.1);
        }

        .user-icon-navbar {
            width: 32px;
            height: 32px;
            background: #00d084;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
        }

        .user-name-wrapper {
            color: #fff;
            font-weight: 500;
        }

        .user-dropdown-menu {
            background: rgba(33, 37, 41, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 12px;
            margin-top: 10px;
            min-width: 250px;
            padding: 15px;
        }

        .user-dropdown-header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 10px;
        }

        .user-name-navbar {
            color: #fff;
            font-weight: 600;
            font-size: 14px;
        }

        .user-email-navbar {
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
        }

        .logout-info-btn {
            background: transparent;
            border: none;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            width: 100%;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .logout-info-btn:hover {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .google-login {
            background: #fff;
            color: #333;
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .google-login:hover {
            background: #00d084;
            color: #fff;
            transform: translateY(-1px);
        }

        .google-login i {
            font-size: 18px;
        }

        /* Responsive Navbar */
        @media (max-width: 991.98px) {
            .navbar-menu-area {
                background: rgba(33, 37, 41, 0.95);
                backdrop-filter: blur(10px);
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                padding: 20px;
                border-radius: 0 0 15px 15px;
            }

            .ftco-navbar-light .navbar-nav .nav-item {
                margin: 10px 0;
            }

            .navbar-user-area {
                margin-left: 15px;
            }
        }
    </style>
</head>

<body>
    @include('frontend.layouts.navbar')
    @stack('styles')
    <main>
        @yield('content')
    </main>
    @include('frontend.layouts.footer')
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('frontend/js/scrollax.min.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('frontend/js/google-map.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>