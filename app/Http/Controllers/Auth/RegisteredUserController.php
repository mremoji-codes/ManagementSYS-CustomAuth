<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:employee,employer'],
            'mobile' => ['nullable', 'string', 'max:20'],
            'age' => ['nullable', 'integer', 'min:1'],
            'sex' => ['nullable', 'in:Male,Female'],
            'date_of_birth' => ['nullable', 'date'],
            'date_started' => ['nullable', 'date'],
        ]);
        // dd("validation passed");

        // Combine name fields into a single "name" for display
        ;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'mobile' => $request->mobile,
            'age' => $request->age,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth,
            'date_started' => $request->date_started,
        ]);

        // dd("user creation passed");

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        return $user->role === 'employer'
            ? redirect()->route('employer.dashboard')
            : redirect()->route('employee.dashboard');
    }
}
