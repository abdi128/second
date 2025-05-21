<?php

/*use App\Http\Controllers\Patient\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Patient\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Patient\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Patient\Auth\NewPasswordController;
use App\Http\Controllers\Patient\Auth\PasswordResetLinkController;
use App\Http\Controllers\Patient\Auth\VerifyEmailController;*/
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

    /*Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('patient.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('patient.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('patient.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('patient.password.store');*/


});

Route::prefix('patient')->middleware('auth:patient')->group(function () {

    /*Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('patient.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('patient.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('patient.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('patient.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);*/


    Route::post('logout', [PatientLoginController::class, 'destroy'])
        ->name('patient.logout');
});

/////////////////////////////////////////////////////////////////////////////////////

Route::prefix('patient')->middleware('auth:patient')->group(function () {

    Route::get('dashboard', function () {
        return Inertia::render('patient/dashboard');
    })->name('patient.dashboard');

    

});
