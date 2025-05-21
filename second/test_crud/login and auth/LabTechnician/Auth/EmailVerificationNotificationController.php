<?php

namespace App\Http\Controllers\LabTechnician\Auth;

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
        if ($request->labtechnician()->hasVerifiedEmail()) {
            return redirect()->intended(route('labtechnician.dashboard', absolute: false));
        }

        $request->labtechnician()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
