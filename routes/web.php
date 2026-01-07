<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// Custom Auth Controllers
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
// Existing Controllers
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\NoticeController; 
// 🆕 Added the Employer Notice Controller
use App\Http\Controllers\EmployerNoticeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔑 GUEST ROUTES (Login, Register, Password Reset)
Route::middleware('guest')->group(function () {

    // ➡️ LOGIN Routes
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // ➡️ REGISTRATION Routes
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    // ➡️ PASSWORD RESET Routes
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// ➡️ LOGOUT Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


// -----------------------------------------------------------------------
// 🌍 PUBLIC ROUTES
// -----------------------------------------------------------------------

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');


// -----------------------------------------------------------------------
// 🔒 AUTHENTICATED ROUTES
// -----------------------------------------------------------------------

// 🔹 Employee Dashboard and Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])
        ->name('employee.dashboard');

    // 🔹 Employee Profile Edit
    Route::get('/employee/edit', [EmployeeController::class, 'edit'])
        ->name('employee.edit');

    Route::put('/employee/update', [EmployeeController::class, 'update'])
        ->name('employee.update');

    // 🆕 LEAVE REQUEST ROUTES (FOR EMPLOYEES)
    Route::get('/employee/leave/create', [LeaveRequestController::class, 'create'])
        ->name('employee.leave.create');
        
    Route::post('/employee/leave/store', [LeaveRequestController::class, 'store'])
        ->name('employee.leave.store');

    // 🔔 NEW: Employee Specific Management (Clear/Delete/View All)
    Route::get('/employee/notices', [EmployeeController::class, 'allNotices'])
        ->name('employee.notices.index');

    Route::delete('/employee/leave/{id}', [EmployeeController::class, 'deleteLeave'])
        ->name('employee.leave.delete');

    Route::delete('/employee/leave-clear-all', [EmployeeController::class, 'clearAllLeaves'])
        ->name('employee.leave.clearAll');
});

// 🔹 Fallback Dashboard Redirect
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
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


// 🔹 Employer-only routes
Route::middleware(['auth', 'verified'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {
        
        // 🟢 Employer Dashboard Route
        Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('dashboard');

        // 🟢 Employer Profile Routes
        Route::get('/profile', [EmployerController::class, 'showProfile'])->name('profile.show');
        Route::get('/profile/edit', [EmployerController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/update', [EmployerController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [EmployerController::class, 'updatePassword'])->name('profile.password.update');
        
        // 🟢 Employee CRUD Routes
        Route::get('/employees', [EmployerController::class, 'index'])->name('employees.index');
        Route::get('/employees/create', [EmployerController::class, 'create'])->name('employees.create');
        Route::post('/employees', [EmployerController::class, 'store'])->name('employees.store');
        Route::get('/employees/{id}/edit', [EmployerController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/{id}', [EmployerController::class, 'update'])->name('employees.update');
        Route::delete('/employees/{id}', [EmployerController::class, 'destroy'])->name('employees.destroy');

        // 🆕 LEAVE MANAGEMENT ROUTES
        Route::get('/leaves', [LeaveRequestController::class, 'index'])->name('leaves.index');
        Route::patch('/leaves/{id}/status', [LeaveRequestController::class, 'updateStatus'])->name('leaves.updateStatus');

        // 🆕 ANNOUNCEMENT (NOTICE) MANAGEMENT ROUTES FOR EMPLOYER
        // We added .parameters() to fix the "Missing parameter: announcement" error
        Route::resource('announcements', EmployerNoticeController::class)->parameters([
            'announcements' => 'notice' 
        ])->names([
            'index'   => 'notices.index',
            'create'  => 'notices.create',
            'store'   => 'notices.store',
            'edit'    => 'notices.edit',
            'update'  => 'notices.update',
            'destroy' => 'notices.destroy',
        ]);
    });

// -----------------------------------------------------------------------
// 📢 NOTICE BOARD ROUTES (GENERAL VIEW)
// -----------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
    Route::post('/notices', [NoticeController::class, 'store'])->name('notices.store');
    Route::delete('/notices/{id}', [NoticeController::class, 'destroy'])->name('notices.destroy');
});