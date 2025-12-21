<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Get the current user
        $user = Auth::user();

        // 2. Prepare Data for the Chart
        // Count total employees and employers
        $employeeCount = User::where('role', 'employee')->count();
        $employerCount = User::where('role', 'employer')->count();

        // 3. Return the correct view based on role (like we did before)
        // But now we pass the chart data to the view!
        if ($user->role === 'employer') {
            return view('dashboard.employer', compact('employeeCount', 'employerCount'));
        } else {
            return view('dashboard.employee');
        }
    }
}