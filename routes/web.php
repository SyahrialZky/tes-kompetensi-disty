<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

// Route::get('/home', function () {
//     return view('home');
// });

// Authentication 

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');
    Route::post('/change_pass', 'change_pass')->name('change_pass');
});


Route::middleware([Authenticate::class])->group(function () {
    Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Group Routing untuk Admin
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {});

// Group Routing untuk Admin
Route::middleware([RoleMiddleware::class . ':petugas'])->group(function () {});
