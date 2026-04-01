<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin(): View|RedirectResponse
    {
        // Already logged in — send straight to dashboard
        if (Session::get('admin_authenticated')) {
            return redirect()->route('dashboard.index');
        }

        return view('auth.login');
    }

    /**
     * Handle the login form submission.
     * Compares the submitted password against ADMIN_PASSWORD in .env
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $adminPassword = config('auth.admin_password');

        if (! $adminPassword) {
            return back()->withErrors([
                'password' => 'Admin password is not configured. Set ADMIN_PASSWORD in your .env file.',
            ]);
        }

        if ($request->input('password') !== $adminPassword) {
            // Throttle hint: in production add RateLimiter here
            return back()->withErrors([
                'password' => 'Incorrect password. Please try again.',
            ]);
        }

        // Mark session as authenticated
        Session::put('admin_authenticated', true);
        Session::regenerate();

        return redirect()->intended(route('dashboard.index'));
    }

    /**
     * Log the admin out and clear the session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Session::forget('admin_authenticated');
        Session::regenerate();

        return redirect()->route('login')->with('status', 'You have been signed out.');
    }
}
