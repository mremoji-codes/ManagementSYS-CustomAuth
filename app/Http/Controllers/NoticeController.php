<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    /**
     * Display the Notice Board management page.
     */
    public function index()
    {
        if (Auth::user()->role !== 'employer') {
            abort(403);
        }

        $notices = Notice::latest()->get();
        
        return view('employer.notices.index', compact('notices'));
    }

    /**
     * Store a newly created notice in the database.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'employer') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        // Manually inject the user_id to avoid the NOT NULL constraint error
        $validated['user_id'] = Auth::id();

        Notice::create($validated);

        return redirect()->route('notices.index')->with('success', 'Announcement posted successfully!');
    }

    /**
     * Remove the specified notice from the database.
     */
    public function destroy($id)
    {
        if (Auth::user()->role !== 'employer') {
            abort(403);
        }

        $notice = Notice::findOrFail($id);
        $notice->delete();

        // Redirect back to the index page to refresh the list
        return redirect()->route('notices.index')->with('success', 'Notice deleted successfully!');
    }
}