<?php

namespace App\Http\Controllers\LabTechnician\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LabTechnician;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class LabTechnicianRegisteredController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('labtechnician/auth/register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name'=> 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.LabTechnician::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number'=>'required|string|max:30',
            'specialty' => 'required|string|max:255',
        ]);


        do {
                $licenseNumber = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
            } while (LabTechnician::where('license_number', $licenseNumber)->exists());


        $labtechnician = LabTechnician::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'specialty' => $request->specialty,
            'license_number' => $licenseNumber,
        ]);

        event(new Registered($labtechnician));

        Auth::guard('labtechnician')->login($labtechnician);

        return to_route('labtechnician.dashboard');
    }
}
