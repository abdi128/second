<?php

use App\Http\Controllers\LabTechnician\Auth\LabTechnicianLoginController;
use App\Http\Controllers\LabTechnician\Auth\LabTechnicianRegisteredController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::prefix('labtechnician')->middleware('guest:labtechnician')->group(function () {
    Route::get('register', [LabTechnicianRegisteredController::class, 'create'])
        ->name('labtechnician.register');

    Route::post('register', [LabTechnicianRegisteredController::class, 'store']);

    Route::get('login', [LabTechnicianLoginController::class, 'create'])
        ->name('labtechnician.login');

    Route::post('login', [LabTechnicianLoginController::class, 'store']);


});

Route::prefix('labtechnician')->middleware('auth:labtechnician')->group(function () {

    Route::get('dashboard', function () {
        return Inertia::render('labtechnician/dashboard');
    })->name('labtechnician.dashboard');

    Route::post('logout', [LabTechnicianLoginController::class, 'destroy'])
        ->name('labtechnician.logout');
});


