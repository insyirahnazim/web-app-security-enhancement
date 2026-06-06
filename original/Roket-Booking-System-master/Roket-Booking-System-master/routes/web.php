<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourtController; 
use App\Http\Controllers\PaymentController;


// Authentication Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']); // Handle registration submission
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);  // Handle POST request to login
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Logout route

// Default Login Route (this can be removed if login route is already handled above)
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login'); // Login page
Route::post('/', [LoginController::class, 'login']); // Handle login form submission

// Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

// Authenticated Routes (Dashboard and other protected pages)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    // Add more authenticated routes here as needed
});

// Static Pages (Publicly accessible)
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/badminton', function () {
    return view('badminton');
})->name('badminton');


Route::get('/court/booking', [CourtController::class, 'showBookingForm'])->name('court.booking');

Route::get('/search-courts', [CourtController::class, 'search'])->name('search.courts');
Route::get('/court/{day}/{court}', [CourtController::class, 'show'])->name('court.show');


Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.show');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');


