<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Show the form for creating a new leave request.
     */
    public function create()
    {
        // This looks for resources/views/employee/leave_create.blade.php
        return view('employee.leave_create');
    }

    /**
     * Store a newly created leave request in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the input
        $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
        ]);

        // 2. Create the record in the database
        LeaveRequest::create([
            'user_id' => Auth::id(),
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending', // Default status for new requests
        ]);

        // 3. Redirect back to dashboard with success message
        return redirect()->route('employee.dashboard')->with('success', 'Your leave request has been submitted and is pending approval.');
    }

    /**
     * 🆕 Show all leave requests to the Employer.
     */
    public function index()
    {
        // Fetch all requests with the user information attached
        // This uses "Eager Loading" (with('user')) to make it fast
        $leaves = LeaveRequest::with('user')->orderBy('created_at', 'desc')->get();
        
        return view('employer.leaves_index', compact('leaves'));
    }

    /**
     * 🆕 Update the status (Approve or Reject).
     */
    public function updateStatus(Request $request, $id)
    {
        $leave = LeaveRequest::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $leave->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Leave request status updated to ' . $request->status);
    }
}