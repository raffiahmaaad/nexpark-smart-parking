<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            Log::error('Google redirect error: ' . $e->getMessage());
            return redirect()->route('frontend.index')
                ->with('error', 'Terjadi kesalahan saat menghubungkan ke Google. Silakan coba lagi.');
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari atau buat customer berdasarkan google_id
            $customer = Customer::updateOrCreate(
                ['google_id' => $googleUser->id],
                [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'avatar' => $googleUser->avatar
                ]
            );

            // Set session data
            $request->session()->put([
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'customer_avatar' => $customer->avatar,
                'is_google_user' => true
            ]);

            // Pastikan session disimpan
            $request->session()->save();

            return redirect()->route('frontend.index')
                ->with('success', 'Berhasil login dengan Google.');

        } catch (Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return redirect()->route('frontend.index')
                ->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }

    public function logout(Request $request)
    {
        $sessionKeys = [
            'customer_id',
            'customer_name',
            'customer_email',
            'customer_avatar',
            'is_google_user'
        ];

        foreach ($sessionKeys as $key) {
            $request->session()->forget($key);
            Session::forget($key);
        }

        Session::save();
        $request->session()->save();

        return redirect()->route('frontend.index')
            ->with('success', 'Anda telah berhasil logout.');
    }
}