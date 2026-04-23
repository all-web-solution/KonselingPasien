<?php

use App\Http\Controllers\CounselingController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('counseling.index');
});

// Route untuk master data pasien
Route::resource('patient', PatientController::class);

// Route untuk konseling
Route::resource('counseling', CounselingController::class);
