<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\LeaveRequest; 
use App\Models\Notice; 

class EmployeeController extends Controller
{
    // Employee Dashboard
    public function dashboard()
    {
        $user = Auth::user();
        
        // Fetch the logged-in user's leave requests
        $leaveRequests = LeaveRequest::where('user_id', $user->id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        // 🆕 UPDATED: Fetch only the latest 2 notices for the dashboard list
        $notices = Notice::latest()->take(2)->get();

        // 🆕 UPDATED: Count only notices the user hasn't "read" yet
        // This checks if a record exists in the notice_user pivot table for this user
        $unreadCount = Notice::whereDoesntHave('users', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        return view('employee.dashboard', compact('user', 'leaveRequests', 'notices', 'unreadCount'));
    }

    // 🆕 UPDATED: Show all notices and mark them as read
    public function allNotices()
    {
        $user = Auth::user();
        
        // Fetch all notices with pagination
        $notices = Notice::latest()->paginate(10);

        // 🆕 LOGIC: Mark all currently visible notices as "read" for this user
        foreach ($notices as $notice) {
            if (!$user->notices()->where('notice_id', $notice->id)->exists()) {
                $user->notices()->attach($notice->id);
            }
        }

        // Set unreadCount to 0 since we just viewed them
        $unreadCount = 0;

        return view('employee.notices', compact('user', 'notices', 'unreadCount'));
    }

    // --- LEAVE REQUEST LOGIC (UNCHANGED) ---

    public function deleteLeave($id)
    {
        $leave = LeaveRequest::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $leave->delete();
        return back()->with('success', 'Leave request removed successfully.');
    }

    public function clearAllLeaves()
    {
        LeaveRequest::where('user_id', Auth::id())->delete();
        return back()->with('success', 'All leave requests cleared successfully.');
    }

    // --- PROFILE LOGIC (UNCHANGED) ---

    public function edit()
    {
        $user = Auth::user();
        return view('employee.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
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

        if ($user->role === 'employer') {
            $rules['salary'] = 'nullable|numeric|min:0';
        }

        $request->validate($rules);

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

        if ($user->role === 'employer') {
            $updateData['salary'] = $request->input('salary');
        }

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $updateData['profile_photo'] = $path;
        }

        $user->update($updateData);
        return redirect()->route('employee.dashboard')->with('success', 'Profile updated successfully!');
    }
}