<?php

use App\Http\Controllers\CounselingController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect()->route('counseling.index');
});

// Route Guest (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

// Route Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Lindungi route pasien dengan middleware auth
Route::middleware('auth')->group(function () {
    Route::resource('patient', PatientController::class);
    Route::resource('counseling', CounselingController::class);
});