<?php

namespace App\Http\Controllers\LabTechnician\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated labtechnician's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->labtechnician()->hasVerifiedEmail()) {
            return redirect()->intended(route('labtechnician.dashboard', absolute: false).'?verified=1');
        }

        if ($request->labtechnician()->markEmailAsVerified()) {
            /** @var \Illuminate\Contracts\Auth\MustVerifyEmail $labtechnician */
            $labtechnician = $request->labtechnician();

            event(new Verified($labtechnician));
        }

        return redirect()->intended(route('labtechnician.dashboard', absolute: false).'?verified=1');
    }
}
