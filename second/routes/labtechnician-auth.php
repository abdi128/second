<?php

use App\Http\Controllers\LabTechnician\Auth\ConfirmablePasswordController;
use App\Http\Controllers\LabTechnician\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\LabTechnician\Auth\EmailVerificationPromptController;
use App\Http\Controllers\LabTechnician\Auth\NewPasswordController;
use App\Http\Controllers\LabTechnician\Auth\PasswordResetLinkController;
use App\Http\Controllers\LabTechnician\Auth\VerifyEmailController;
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

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('labtechnician.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('labtechnician.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('labtechnician.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('labtechnician.password.store');


});

Route::prefix('labtechnician')->middleware('auth:labtechnician')->group(function () {

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('labtechnician.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('labtechnician.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('labtechnician.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('labtechnician.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);


    Route::post('logout', [LabTechnicianLoginController::class, 'destroy'])
        ->name('labtechnician.logout');
});


//////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('labtechnician')->middleware('auth:labtechnician')->group(function () {

    Route::get('dashboard', function () {
        return Inertia::render('labtechnician/dashboard');
    })->name('labtechnician.dashboard');

});
