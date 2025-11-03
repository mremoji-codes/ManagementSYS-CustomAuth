<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Attempt login
        $request->authenticate();

        // Regenerate session for security
        $request->session()->regenerate();

        $user = Auth::user();

        // ✅ Step 1: Check if user is removed
        if ($user->status !== 'active') {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Sorry, your employment has been terminated. Please contact your employer for clarification.',
            ]);
        }

        // ✅ Step 2: Redirect based on role
        if ($user->role === 'employer') {
            return redirect()->route('employer.dashboard');
        }

        if ($user->role === 'employee') {
            return redirect()->route('employee.dashboard');
        }

        // Default fallback
        return redirect('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
