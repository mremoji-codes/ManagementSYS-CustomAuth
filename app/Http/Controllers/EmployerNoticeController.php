<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;

class EmployerNoticeController extends Controller
{
    // List all notices for the employer to manage
    public function index()
    {
        $notices = Notice::latest()->paginate(10);
        return view('employer.notices.index', compact('notices'));
    }

    // Show form to create a new notice
    public function create()
    {
        return view('employer.notices.create');
    }

    // Store the new notice
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        Notice::create([
            'title' => $request->title,
            'content' => $request->content,
            'priority' => $request->priority,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('employer.notices.index')->with('success', 'Announcement posted successfully!');
    }

    // Show form to edit an existing notice
    public function edit(Notice $notice)
    {
        return view('employer.notices.edit', compact('notice'));
    }

    // Update the notice
    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $notice->update($request->only(['title', 'content', 'priority']));

        return redirect()->route('employer.notices.index')->with('success', 'Announcement updated successfully!');
    }

    // Delete the notice
    public function destroy(Notice $notice)
    {
        $notice->delete();
        return back()->with('success', 'Announcement deleted successfully!');
    }
}