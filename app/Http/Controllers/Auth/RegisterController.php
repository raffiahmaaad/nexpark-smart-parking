<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// Tambahkan use statement ini
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Ke mana user akan diarahkan setelah register (jika tidak ditimpa).
     * Kita akan arahkan ke halaman login.
     *
     * @var string
     */
    // Ubah $redirectTo ke rute login Anda
    // Jika Anda menggunakan nama rute 'login', maka bisa seperti ini:
    // protected $redirectTo = '/login';
    // Atau jika Anda ingin lebih dinamis:
    protected function redirectTo()
    {
        return route('login'); // Pastikan Anda memiliki rute dengan nama 'login'
    }

    /**
     * Buat instance controller baru.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Tampilkan form registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        // Pastikan path view ini benar
        return view('backend.auth.register');
    }

    /**
     * Validasi data registrasi.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // Pastikan 'unique:users,email' sudah benar
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'kata_kata' => ['nullable', 'string', 'max:255'],
        ]);
    }

    /**
     * Buat user baru.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'] ?? 'Laki-laki', // Nilai default untuk gender
            'kata_kata' => $data['kata_kata'] ?? 'Belum ada kata-kata', // Nilai default untuk kata-kata
        ]);
    }

    /**
     * Handle sebuah permintaan registrasi untuk aplikasi.
     * Method ini akan menimpa method register() dari trait RegistersUsers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // 1. Validasi input dari form
        $this->validator($request->all())->validate();

        // Pastikan data gender dan kata_kata selalu ada
        $data = $request->all();
        if (!isset($data['gender'])) {
            $data['gender'] = 'Jenis Kelamin';
        }
        if (!isset($data['kata_kata'])) {
            $data['kata_kata'] = 'Belum ada kata-kata';
        }

        // 2. Buat user baru dan kirim event "Registered"
        //    Event ini penting jika Anda memiliki listener yang perlu dijalankan setelah registrasi (misalnya kirim email verifikasi)
        event(new Registered($user = $this->create($data)));

        // Baris di bawah ini yang berfungsi untuk login otomatis sengaja DIHILANGKAN/DIKOMENTARI.
        // $this->guard()->login($user);

        // 3. Alihkan (redirect) ke halaman login dengan pesan sukses
        //    Pesan ini bisa Anda tampilkan di halaman login.
        return redirect($this->redirectPath())->with('success', 'Registrasi berhasil! Silakan masuk untuk melanjutkan.');
    }
}
