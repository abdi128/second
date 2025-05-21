<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: ['appearance']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();



    /*
    //app.php

use App\Http\Middleware\EnsurePatientEmailIsVerified; // <-- Add this import

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: ['appearance']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        // Register route middleware here:
        $middleware->alias([
            'patient.verified' => EnsurePatientEmailIsVerified::class,
            // Add other route middleware aliases here if needed
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
    */


/*
    //use in web.php

    Route::prefix('patient')->middleware(['auth:patient', 'patient.verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('patient/dashboard');
    })->name('patient.dashboard');
});


*/


/*
//create middleware:
php artisan make:middleware EnsurePatientEmailIsVerified

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsurePatientEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        $patient = Auth::guard('patient')->user();

        // If not logged in as patient, redirect to login (optional)
        if (!$patient) {
            return redirect()->route('patient.login');
        }

        // If the patient has not verified their email
        if (!$patient->hasVerifiedEmail()) {
            // Redirect to a patient-specific email verification notice page
            return redirect()->route('patient.verification.notice');
        }

        return $next($request);
    }
}

*/
