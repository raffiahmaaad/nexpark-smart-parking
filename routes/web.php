<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleInController;
use App\Http\Controllers\VehicleOutController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\ParkingSlotController;

/*
|--------------------------------------------------------------------------
| Frontend Routes (Public)
|--------------------------------------------------------------------------
*/

Route::name('frontend.')->group(function () {
    // Landing pages
    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('/about', [FrontendController::class, 'about'])->name('about');
    Route::get('/services', [FrontendController::class, 'services'])->name('services');
    Route::get('/pricing', [FrontendController::class, 'pricing'])->name('pricing');
    Route::get('/car', [FrontendController::class, 'car'])->name('car');
    Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Google OAuth Routes
Route::middleware(['web'])->group(function () {
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
    Route::post('auth/google/logout', [GoogleController::class, 'logout'])->name('google.logout');
});

// Admin Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Disable default login and register routes
Auth::routes(['login' => false, 'register' => false]);

/*
|--------------------------------------------------------------------------
| Customer Routes (Authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware(['customer.auth'])->name('frontend.')->group(function () {
    // Parking Management
    Route::prefix('parking')->name('parking.')->group(function () {
        Route::get('/form', [ParkingController::class, 'form'])->name('form');
        Route::post('/book', [ParkingController::class, 'book'])->name('book');
        Route::get('/slots', [ParkingController::class, 'getAvailableSlots'])->name('slots');
        Route::get('/receipt/{vehicleInId}', [ParkingController::class, 'receipt'])->name('receipt');
        Route::post('/exit', [ParkingController::class, 'exit'])->name('exit');
    });

    // Payment Processing
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/checkout/{vehicleInId}', [PaymentController::class, 'checkout'])->name('checkout');
        Route::post('/process/{vehicleInId}', [PaymentController::class, 'processPayment'])->name('process');
        Route::get('/waiting/{paymentId}', [PaymentController::class, 'waitingConfirmation'])->name('waiting');
        Route::get('/{paymentId}/status', [PaymentController::class, 'checkStatus'])->name('status');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_admin'])->name('backend.')->prefix('backend')->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Admin Profile & Management
    Route::get('/profile', [UserController::class, 'profile'])->name('admins.profile');
    Route::resource('/admins', UserController::class);
    Route::resource('/register', RegisterController::class);

    // Customer Management
    Route::resource('/customers', CustomerController::class);

    // Category Management
    Route::resource('/categories', CategoryController::class);

    // Vehicle Management
    Route::resource('/vehicles', VehicleController::class);
    Route::resource('/vehiclesIn', VehicleInController::class);
    Route::resource('/vehiclesOut', VehicleOutController::class);

    // Payment Management
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'adminIndex'])->name('index');
        Route::post('/{payment}/confirm', [PaymentController::class, 'adminConfirm'])->name('confirm');
        Route::post('/{payment}/reject', [PaymentController::class, 'adminReject'])->name('reject');
    });

    // Reports
    Route::get('reports/index', [ReportController::class, 'index'])->name('reports.index');

    // Parking Slots Management
    Route::get('/parking-slots', [ParkingSlotController::class, 'index'])->name('parking-slots.index');

    // Print/Receipt khusus admin
    Route::get('/receipt/{vehicleInId}', [ParkingController::class, 'receipt'])->name('receipt');

    // Route untuk menghapus duplikat VehicleOut berdasarkan registration_number tertentu
    Route::get('/hapus-duplikat-vehicleout', function () {
        $outs = \App\Models\VehicleOut::with('vehicleIn.vehicle')->get()->filter(function ($item) {
            return $item->vehicleIn && $item->vehicleIn->vehicle && $item->vehicleIn->vehicle->registration_number == '22901749707421';
        })->sortBy('created_at');
        if ($outs->count() > 1) {
            $outs->shift()->delete(); // Hapus yang paling lama
            return 'Data duplikat berhasil dihapus!';
        }
        return 'Tidak ada duplikat.';
    });
});
