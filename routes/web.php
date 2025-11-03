<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔹 Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// 🔹 Employer Dashboard
Route::get('/employer/dashboard', function () {
    return view('employer.dashboard');
})->middleware(['auth', 'verified'])->name('employer.dashboard');

// 🔹 Employee Dashboard (Handled by Controller)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])
        ->name('employee.dashboard');

    // 🔹 Employee Profile Edit (we’ll build this later)
    Route::get('/employee/edit', [EmployeeController::class, 'edit'])
        ->name('employee.edit');

    Route::put('/employee/update', [EmployeeController::class, 'update'])
        ->name('employee.update');
});

// 🔹 Fallback Dashboard Redirect
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect('/login');
    }

    if ($user->role === 'employer') {
        return redirect()->route('employer.dashboard');
    }

    if ($user->role === 'employee') {
        return redirect()->route('employee.dashboard');
    }

    return abort(403, 'Unauthorized');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔹 Logout Route
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');

// 🔹 Employer-only routes (for managing employees)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/employees', [EmployerController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployerController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployerController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployerController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [EmployerController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployerController::class, 'destroy'])->name('employees.destroy');
});

// Include Laravel Breeze auth routes
require __DIR__ . '/auth.php';
