<?php

use App\Http\Controllers\Patient\Auth\PatientLoginController;
use App\Http\Controllers\Patient\Auth\PatientRegisteredController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::prefix('patient')->middleware('guest:patient')->group(function () {
    Route::get('register', [PatientRegisteredController::class, 'create'])
        ->name('patient.register');

    Route::post('register', [PatientRegisteredController::class, 'store']);

    Route::get('login', [PatientLoginController::class, 'create'])
        ->name('patient.login');

    Route::post('login', [PatientLoginController::class, 'store']);


});

Route::prefix('patient')->middleware('auth:patient')->group(function () {

    Route::get('dashboard', function () {
        return Inertia::render('patient/dashboard');
    })->name('patient.dashboard');

    Route::post('logout', [PatientLoginController::class, 'destroy'])
        ->name('patient.logout');
});

/////////////////////////////////////////////////////////////////////////////////////

