<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view (The Form).
     */
    public function create(): View
    {
        // This expects your login form to be at resources/views/auth/login.blade.php
        return view('auth.login'); 
    }

    /**
     * Handle an incoming authentication request (The Submission).
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Validate credentials and attempt login
        $request->authenticate(); 

        // 2. Regenerate the session to prevent session fixation attacks
        $request->session()->regenerate();

        // 3. Redirect the user to the intended URL (or the default HOME page)
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session (Logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 1. Log the user out of the default 'web' guard
        Auth::guard('web')->logout();

        // 2. Invalidate the current session
        $request->session()->invalidate();

        // 3. Regenerate the CSRF token
        $request->session()->regenerateToken();

        // 4. Redirect the user to the home page
        return redirect('/');
    }
}