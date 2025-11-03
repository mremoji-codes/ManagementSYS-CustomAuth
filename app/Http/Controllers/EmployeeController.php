<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // 🔹 Employee Dashboard
    public function dashboard()
    {
        $user = Auth::user();
        return view('employee.dashboard', compact('user'));
    }

    // 🔹 Edit Profile Page
    public function edit()
    {
        $user = Auth::user();
        return view('employee.edit', compact('user'));
    }

    // 🔹 Update Profile Info
    public function update(Request $request)
    {
        $user = Auth::user();

        // ✅ Validate input fields
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'nullable|string|max:20',
            'sex' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
        ]);

        // ✅ Update fields
        $user->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            // Keep the combined full name for easier display in some pages
            'name' => trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name),
            'email' => $request->email,
            'mobile' => $request->mobile,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth,
        ]);

        // ✅ Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
