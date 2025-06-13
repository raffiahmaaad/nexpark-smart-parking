<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CustomerAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Log current session state
        Log::info('CustomerAuth Middleware - Session state:', [
            'session_id' => Session::getId(),
            'has_customer_id' => Session::has('customer_id'),
            'has_is_google_user' => Session::has('is_google_user'),
            'all_session_data' => Session::all()
        ]);

        if (!Session::has('customer_id') || !Session::has('is_google_user')) {
            return redirect()->route('google.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah data customer lengkap
        if (!Session::get('customer_name') || !Session::get('customer_email')) {
            Log::warning('CustomerAuth Middleware - Incomplete customer data');
            Session::flush(); // Hapus semua data sesi jika tidak lengkap
            return redirect()->route('frontend.index')
                ->with('error', 'Terjadi kesalahan pada data login. Silakan login ulang.');
        }

        return $next($request);
    }
}
