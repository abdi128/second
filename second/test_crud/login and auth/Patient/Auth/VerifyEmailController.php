<?php

namespace App\Http\Controllers\Patinet\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated patient's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->patient()->hasVerifiedEmail()) {
            return redirect()->intended(route('patient.dashboard', absolute: false).'?verified=1');
        }

        if ($request->patient()->markEmailAsVerified()) {
            /** @var \Illuminate\Contracts\Auth\MustVerifyEmail $patient */
            $patient = $request->patient();

            event(new Verified($patient));
        }

        return redirect()->intended(route('patient.dashboard', absolute: false).'?verified=1');
    }
}
