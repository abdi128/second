<?php

namespace App\Http\Controllers\Patient\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->patient()->hasVerifiedEmail()) {
            return redirect()->intended(route('patient.dashboard', absolute: false));
        }

        $request->patient()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
