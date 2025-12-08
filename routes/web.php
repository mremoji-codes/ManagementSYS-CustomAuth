<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// Custom Auth Controllers
use App\Http\Controllers\Auth\AuthenticatedSessionController; // <-- ADDED
use App\Http\Controllers\Auth\RegisteredUserController;       // <-- ADDED (for next step)
// Existing Controllers
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\EmployeeController;
use App\Providers\RouteServiceProvider;

use App\Http\Controllers\Auth\PasswordResetLinkController;    // <-- NEW
use App\Http\Controllers\Auth\NewPasswordController;          // <-- NEW

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔑 AUTHENTICATION ROUTES (Manual Implementation)
Route::middleware('guest')->group(function () {

    // ➡️ LOGIN Routes (Existing)
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // ➡️ REGISTRATION Routes (Existing)
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    // ➡️ PASSWORD RESET Routes (NEW)
    // 1. Forgot Password Form (Show)
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    // 2. Forgot Password Submission (Send Link)
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // 3. Reset Password Form (Show after clicking link)
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    // 4. Reset Password Submission (Update Password)
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});


// ... rest of your routes
// Routes accessible only to guests (not logged in)
Route::middleware('guest')->group(function () {

    // ➡️ LOGIN Routes
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // ➡️ REGISTRATION Routes (To be implemented in the next step)
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    // NOTE: Password Reset routes (forgot, reset) would also go here.
});

// ➡️ LOGOUT Route (Accessible only to logged-in users)
// **REPLACED** your existing custom logout route with the one pointing to the new controller
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


// -----------------------------------------------------------------------
// 🌍 PUBLIC & AUTHENTICATED ROUTES
// -----------------------------------------------------------------------

// 🔹 Welcome Page and About Page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

// 🔹 Employee Dashboard and Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])
        ->name('employee.dashboard');

    // 🔹 Employee Profile Edit
    Route::get('/employee/edit', [EmployeeController::class, 'edit'])
        ->name('employee.edit');

    Route::put('/employee/update', [EmployeeController::class, 'update'])
        ->name('employee.update');
});

// 🔹 Fallback Dashboard Redirect (sends users to the correct dashboard based on role)
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        // Since the 'auth' middleware should handle this, 
        // we can rely on it to redirect to the 'login' route defined above.
        // But for explicit clarity, we keep the check.
        return redirect()->route('login'); 
    }

    if ($user->role === 'employer') {
        return redirect()->route('employer.dashboard');
    }

    if ($user->role === 'employee') {
        return redirect()->route('employee.dashboard');
    }

    return abort(403, 'Unauthorized');
})->middleware(['auth', 'verified'])->name('dashboard');


// 🔹 Employer-only routes (for managing employees, dashboard, and profile)
Route::middleware(['auth', 'verified'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {
        
        // 🟢 Employer Dashboard Route
        Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('dashboard');

        // 🟢 Employer Profile Route (View/Show)
        Route::get('/profile', [EmployerController::class, 'showProfile'])->name('profile.show');
        
        // Employee CRUD Routes (EXISTING)
        Route::get('/employees', [EmployerController::class, 'index'])->name('employees.index');
        Route::get('/employees/create', [EmployerController::class, 'create'])->name('employees.create');
        Route::post('/employees', [EmployerController::class, 'store'])->name('employees.store');
        Route::get('/employees/{id}/edit', [EmployerController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/{id}', [EmployerController::class, 'update'])->name('employees.update');
        Route::delete('/employees/{id}', [EmployerController::class, 'destroy'])->name('employees.destroy');

    });