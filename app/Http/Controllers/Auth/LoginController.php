<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Ditambahkan untuk method logout
use Illuminate\Support\Facades\Auth; // Ditambahkan untuk method guard

class LoginController extends Controller
{
    use AuthenticatesUsers {
        login as protected traitLogin;
    }

    /**
     * Redirect user setelah login berhasil
     *
     * @var string
     */
    protected $redirectTo = '/backend/home';

    /**
     * Tampilkan form login (view diarahkan ke folder backend)
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showLoginForm()
    {
        // Jika user sudah login dengan Google, logout dulu
        if (Auth::check() && !Auth::user()->is_admin) {
            Auth::logout();
            return redirect('/')->with('error', 'Silakan logout dari akun Google terlebih dahulu untuk mengakses halaman admin.');
        }

        return view('backend.auth.login');
    }

    /**
     * Middleware agar hanya guest bisa akses, kecuali logout
     */
    public function __construct()
    {
        // Diperbaiki: 'login' menjadi 'logout' pada except()
        $this->middleware('guest')->except('logout');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Mengambil guard yang sedang digunakan (biasanya 'web')
        $this->guard()->logout();

        // Membatalkan sesi pengguna saat ini
        $request->session()->invalidate();

        // Membuat token CSRF baru untuk sesi berikutnya
        $request->session()->regenerateToken();

        // Mengarahkan pengguna ke halaman login setelah logout
        return redirect()->route('login')->with('status', 'Anda telah berhasil logout.');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(); // Menggunakan Auth facade untuk mendapatkan guard default
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Check if user exists and is admin
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ditemukan atau bukan admin atau memiliki google_id
        if (!$user || !$user->is_admin || $user->google_id) {
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Email atau password tidak valid. Halaman ini hanya untuk admin.']);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the post login redirect path.
     */
    protected function redirectTo(): string
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return '/backend/home';
        }
        return '/';
    }
}
