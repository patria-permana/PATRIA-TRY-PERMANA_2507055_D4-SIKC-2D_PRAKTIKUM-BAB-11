<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/laporan', [HomeController::class, 'laporan'])->name('laporan');

// Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');

Route::resource('categories', CategoryController::class);

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Fitur admin dan user
Route::middleware(['auth', 'role:admin,user'])->group(function () {
    Route::resource('reports', ReportController::class);
});

// Khusus admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('kategori', CategoryController::class);
    });
