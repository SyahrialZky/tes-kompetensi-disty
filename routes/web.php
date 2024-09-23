<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
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
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
});

// Group Routing untuk role Petugas dan Admin
Route::middleware([RoleMiddleware::class . ':petugas,admin'])->group(function () {
    // Route pasien 
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');


    // Route examinasi / pemeriksaan
    Route::get('/patients/{patient}/examinations', [ExaminationController::class, 'index'])->name('examinations.index');
    Route::get('/patients/{patient}/examinations/create', [ExaminationController::class, 'create'])->name('examinations.create');
    Route::post('/patients/{patient}/examinations', [ExaminationController::class, 'store'])->name('examinations.store');
    Route::get('/examinations/{examination}/edit', [ExaminationController::class, 'edit'])->name('examinations.edit');
    Route::put('/examinations/{examination}', [ExaminationController::class, 'update'])->name('examinations.update');
    Route::delete('/examinations/{examination}', [ExaminationController::class, 'destroy'])->name('examinations.destroy');
    Route::get('/examinations/{examination}', [ExaminationController::class, 'show'])->name('examinations.show');


    // Route kategori
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
});
