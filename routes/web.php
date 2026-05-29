<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard'); 
        }
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::get('/lapangan', [UserController::class, 'lapangan']);
    Route::get('/booking', [BookingController::class, 'bookingForm']);
    Route::post('/booking', [BookingController::class, 'booking']);
    Route::get('/history', [BookingController::class, 'history']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// ROUTE ADMIN - Sesuai dengan AdminController kamu
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/bookings', [AdminController::class, 'bookings']); // Mengarah ke data booking
    Route::post('/bookings/{id}/update', [AdminController::class, 'updateStatus']); // Untuk update status & notes

    Route::post('/admin/lapangan/{id}/update-status', [AdminController::class, 'updateStatusLapangan']);
Route::post('/admin/raket/{id}/update-status', [AdminController::class, 'updateStatusRaket']);
// Pastikan mengarah ke AdminController dan fungsi index


    Route::get('/lapangan', [AdminController::class, 'lapanganAdmin']);
    Route::get('/raket', [AdminController::class, 'raket']);
});

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
});
Route::delete('/admin/bookings/{id}/delete', [AdminController::class, 'destroy']);
// Route untuk Maintenance / Blokir Jadwal oleh Admin
Route::get('/admin/maintenance', [\App\Http\Controllers\AdminController::class, 'formMaintenance']);
Route::post('/admin/maintenance', [\App\Http\Controllers\AdminController::class, 'simpanMaintenance']);

// Rute Update Status Fasilitas oleh Admin
Route::post('/admin/lapangan/{id}/update', [\App\Http\Controllers\AdminController::class, 'updateStatusLapangan']);
Route::post('/admin/raket/{id}/update', [\App\Http\Controllers\AdminController::class, 'updateStatusRaket']);

// Rute untuk Fitur Blokir Jadwal (Maintenance)
Route::get('/admin/maintenance', [\App\Http\Controllers\AdminController::class, 'formMaintenance']);
Route::post('/admin/maintenance', [\App\Http\Controllers\AdminController::class, 'simpanMaintenance']);