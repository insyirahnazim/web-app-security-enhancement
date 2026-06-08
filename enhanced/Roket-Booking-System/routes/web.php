<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Login & Register (Only for guests)
Route::middleware('guest')->group(function () {

    // Default page → Login
    Route::get('/', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->middleware('throttle:5,1')
        ->name('register.submit');
});

/*
|--------------------------------------------------------------------------
| Public Pages (Can Access Without Login)
|--------------------------------------------------------------------------
*/

Route::get('/home', [HomeController::class, 'index'])
    ->name('home.index');

Route::get('/about', function () {
    return view('about');
})->name('about');

/*
|--------------------------------------------------------------------------
| Logout (Authenticated Only)
|--------------------------------------------------------------------------
*/

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Must Login First)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('dashboard');

    // Badminton Booking Page
    Route::get('/badminton', function () {
        return view('badminton');
    })->name('badminton');

    // Court Booking
    Route::get('/court/booking', [CourtController::class, 'showBookingForm'])
        ->name('court.booking');

    Route::get('/search-courts', [CourtController::class, 'search'])
        ->name('search.courts');

    Route::get('/court/{day}/{court}', [CourtController::class, 'show'])
        ->name('court.show');

    // Payment
    Route::get('/payment', [PaymentController::class, 'showPaymentPage'])
        ->name('payment.show');

    Route::post('/payment/process', [PaymentController::class, 'processPayment'])
        ->name('payment.process');

    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])
        ->name('payment.success');
});
