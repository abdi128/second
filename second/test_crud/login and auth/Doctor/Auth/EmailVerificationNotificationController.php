<?php

namespace App\Http\Controllers\Doctor\Auth;

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
        if ($request->doctor()->hasVerifiedEmail()) {
            return redirect()->intended(route('doctor.dashboard', absolute: false));
        }

        $request->doctor()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
