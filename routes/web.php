<?php

<<<<<<< Updated upstream
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
=======
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PasienController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');
    Route::post('/change_pass', 'change_pass')->name('change_pass');
});

// Protected routes
Route::middleware([Authenticate::class])->group(function () {
    Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin routes for managing petugas
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    Route::get('/admin/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
    Route::post('/admin/petugas', [PetugasController::class, 'store'])->name('petugas.store');
    Route::get('/admin/petugas/{id_petugas}/edit', [PetugasController::class, 'edit'])->name('petugas.edit');
    Route::put('/admin/petugas/{id_petugas}', [PetugasController::class, 'update'])->name('petugas.update');
    Route::delete('/admin/petugas/{id_petugas}', [PetugasController::class, 'destroy'])->name('petugas.destroy');
});

// Group Routing untuk Admin
Route::middleware([Authenticate::class])->group(function () {
    Route::middleware([RoleMiddleware::class . ':admin,petugas'])->group(function () {
        Route::get('/admin/pasien', [PasienController::class, 'index'])->name('pasien.index');
        Route::get('/admin/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
        Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
        Route::get('/admin/pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
        Route::put('/admin/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
        Route::delete('/admin/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');
        Route::get('/admin/pasien/{id}', [PasienController::class, 'show'])->name('pasien.show');
    });
});

// Group Routing untuk Petugas
Route::middleware([RoleMiddleware::class . ':petugas'])->group(function () {});
>>>>>>> Stashed changes
