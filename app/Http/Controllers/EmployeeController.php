<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\LeaveRequest; 
use App\Models\Notice; // 🆕 Added to access the Notice model

class EmployeeController extends Controller
{
    // Employee Dashboard
    public function dashboard()
    {
        $user = Auth::user();
        
        // Fetch the logged-in user's leave requests to show on their dashboard
        $leaveRequests = LeaveRequest::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        // 🆕 Fetch all notices, newest first, to show on the notice board
        $notices = Notice::latest()->get();

        // Updated compact() to include 'notices'
        return view('employee.dashboard', compact('user', 'leaveRequests', 'notices'));
    }

    // Edit Profile Page
    public function edit()
    {
        $user = Auth::user();
        return view('employee.edit', compact('user'));
    }

    // Update Profile Info
    public function update(Request $request)
    {
        $user = Auth::user();

        // Base validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'nullable|string|max:20',
            'sex' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'age' => 'nullable|integer|min:16',
            'position' => 'nullable|string|max:255',
            'date_started' => 'nullable|date',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];

        // Salary validation ONLY if employer is editing
        if ($user->role === 'employer') {
            $rules['salary'] = 'nullable|numeric|min:0';
        }

        $request->validate($rules);

        // Map general fields
        $updateData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'sex' => $request->input('sex'),
            'age' => $request->input('age'),
            'date_of_birth' => $request->input('date_of_birth'),
            'position' => $request->input('position'),
            'date_started' => $request->input('date_started'),
        ];

        // Only employer can update salary
        if ($user->role === 'employer') {
            $updateData['salary'] = $request->input('salary');
        }

        // --- PROFILE PHOTO LOGIC ---
        if ($request->hasFile('profile_photo')) {
            // 1. Delete old photo if it exists
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // 2. Store new photo in 'public/profile_photos'
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            
            // 3. Add to update array
            $updateData['profile_photo'] = $path;
        }

        $user->update($updateData);

        return redirect()->route('employee.dashboard')->with('success', 'Profile updated successfully!');
    }
}