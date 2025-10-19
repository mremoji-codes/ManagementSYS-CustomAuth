<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->isEmployer()) {
        return redirect('/employer/dashboard');
    }

    if ($user->isEmployee()) {
        return redirect('/employee/dashboard');
    }

    abort(403, 'Unauthorized');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/employer/dashboard', function () {
    return view('employer.dashboard');
})->middleware(['auth', 'verified'])->name('employer.dashboard');

Route::get('/employee/dashboard', function () {
    return view('employee.dashboard');
})->middleware(['auth', 'verified'])->name('employee.dashboard');

require __DIR__.'/auth.php';
