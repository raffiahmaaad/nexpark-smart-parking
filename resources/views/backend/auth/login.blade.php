<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>NexPark | Login</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="../favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <script src="{{ asset('backend/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <style>
        :root {
            --primary-color: #1a73e8;
            --hover-color: #1557b0;
            --bg-color: #f8faff;
            --text-color: #3c4043;
            --light-text: #5f6368;
            --border-color: #e1e5ee;
            --neon-color: #00ff9d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset("frontend/images/bg2.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-container {
            background: white;
            width: 100%;
            max-width: 400px;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-text {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--neon-color);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0;
            padding: 0;
            line-height: 1;
            text-shadow: 0 0 10px rgba(0, 255, 157, 0.3);
            transition: all 0.3s ease;
        }

        .logo-text:hover {
            text-shadow: 0 0 20px rgba(0, 255, 157, 0.5);
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 2rem;
        }

        .welcome-text h2 {
            color: var(--text-color);
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .welcome-text p {
            color: var(--light-text);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            background: var(--bg-color);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.95rem;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 4px rgba(26, 115, 232, 0.1);
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-text);
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .form-control:focus + i {
            color: var(--primary-color);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .custom-checkbox input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--primary-color);
        }

        .custom-checkbox span {
            color: var(--light-text);
            font-size: 0.9rem;
        }

        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--hover-color);
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 0.875rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: var(--hover-color);
            transform: translateY(-1px);
        }

        .invalid-feedback {
            color: #d93025;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 480px) {
            body {
                padding: 1rem;
            }

            .login-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <h1 class="logo-text">NexPark</h1>
        </div>
        <div class="welcome-text">
            <p>Silahkan login untuk melanjutkan</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}"
                       placeholder="Email" required autocomplete="email" autofocus>
                <i class="fas fa-envelope"></i>
                @error('email')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" placeholder="Password"
                       required autocomplete="current-password">
                <i class="fas fa-lock"></i>
                @error('password')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="remember-forgot">
                <label class="custom-checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Ingat Saya</span>
                </label>
                @if (Route::has('backend.password.request'))
                <a href="{{ route('backend.password.request') }}" class="forgot-link">
                    Lupa Password?
                </a>
                @endif
            </div>
            <button type="submit" class="login-btn">
                Masuk
            </button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="{{ asset('backend/src/js/vendor/jquery-3.3.1.min.js') }}"><\/script>')
    </script>
    <script src="{{ asset('backend/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>

</html>
