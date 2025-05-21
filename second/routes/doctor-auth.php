<?php

use App\Http\Controllers\Doctor\Auth\DoctorLoginController;
use App\Http\Controllers\Doctor\Auth\DoctorRegisteredController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::prefix('doctor')->middleware('guest:doctor')->group(function () {
    Route::get('register', [DoctorRegisteredController::class, 'create'])
        ->name('doctor.register');

    Route::post('register', [DoctorRegisteredController::class, 'store']);

    Route::get('login', [DoctorLoginController::class, 'create'])
        ->name('doctor.login');

    Route::post('login', [DoctorLoginController::class, 'store']);


});

Route::prefix('doctor')->middleware('auth:doctor')->group(function () {

    Route::get('dashboard', function () {
        return Inertia::render('doctor/dashboard');
    })->name('doctor.dashboard');

    Route::post('logout', [DoctorLoginController::class, 'destroy'])
        ->name('doctor.logout');
});


