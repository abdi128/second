<?php

use App\Http\Controllers\Doctor\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Doctor\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Doctor\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Doctor\Auth\NewPasswordController;
use App\Http\Controllers\Doctor\Auth\PasswordResetLinkController;
use App\Http\Controllers\Doctor\Auth\VerifyEmailController;
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

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('doctor.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('doctor.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('doctor.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('doctor.password.store');


});

Route::prefix('doctor')->middleware('auth:doctor')->group(function () {

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('doctor.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('doctor.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('doctor.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('doctor.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);


    Route::post('logout', [DoctorLoginController::class, 'destroy'])
        ->name('doctor.logout');
});


////////////////////////////////////////////////////////////////////////

Route::prefix('doctor')->middleware('auth:doctor')->group(function () {

    Route::get('dashboard', function () {
        return Inertia::render('doctor/dashboard');
    })->name('doctor.dashboard');

});
