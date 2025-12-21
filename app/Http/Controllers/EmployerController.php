<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password; // Added for secure password validation

class EmployerController extends Controller
{
    private function ensureEmployer()
    {
        if (!Auth::check() || Auth::user()->role !== 'employer') {
            abort(403, 'Unauthorized Access — Only the employer can perform this action.');
        }
    }

    public function dashboard()
    {
        $this->ensureEmployer();

        $employeeCount = User::where('role', 'employee')->count();
        $newHiresCount = User::where('role', 'employee')
                             ->where('date_started', '>=', now()->subDays(30))
                             ->count();

        $employerCount = User::where('role', 'employer')->count();
                             
        return view('employer.dashboard', compact('employeeCount', 'newHiresCount', 'employerCount'));
    }

    // =========================================================================
    // EMPLOYER SELF-PROFILE METHODS
    // =========================================================================

    public function showProfile()
    {
        $this->ensureEmployer();
        $employer = Auth::user();
        return view('employer.profile.show', compact('employer'));
    }

    public function editProfile()
    {
        $this->ensureEmployer();
        $employer = Auth::user(); 
        return view('employer.profile.edit', compact('employer'));
    }

    public function updateProfile(Request $request)
    {
        $this->ensureEmployer();
        $employer = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employer->id,
        ]);

        $employer->update($validated);

        return redirect()->route('employer.profile.show')
                         ->with('success', 'Profile updated successfully!');
    }

    /**
     * Handle Password Update for the Employer
     */
    public function updatePassword(Request $request)
    {
        $this->ensureEmployer();
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'], // Checks if it matches current DB password
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    // =========================================================================
    // EMPLOYEE MANAGEMENT METHODS
    // =========================================================================

    public function index()
    {
        $this->ensureEmployer();
        $employees = User::where('role', 'employee')->get();
        return view('employer.employees.index', compact('employees'));
    }

    public function create()
    {
        $this->ensureEmployer();
        return view('employer.employees.create');
    }

    public function store(Request $request)
    {
        $this->ensureEmployer();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'mobile' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'age' => 'nullable|integer|min:16',
            'sex' => 'nullable|string|max:10',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'date_started' => 'nullable|date',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fullName = trim(
            $validated['first_name'] . ' ' .
            ($validated['middle_name'] ?? '') . ' ' .
            $validated['last_name']
        );

        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        User::create([
            'name' => $fullName,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'mobile' => $validated['mobile'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'age' => $validated['age'] ?? null,
            'sex' => $validated['sex'] ?? null,
            'position' => $validated['position'] ?? null,
            'salary' => $validated['salary'] ?? null,
            'date_started' => $validated['date_started'] ?? null,
            'profile_photo' => $profilePhotoPath,
            'role' => 'employee',
            'status' => 'active',
        ]);

        return redirect()->route('employer.employees.index')->with('success', 'Employee created successfully!');
    }

    public function edit($id)
    {
        $this->ensureEmployer();
        $employee = User::findOrFail($id);
        
        $nameParts = preg_split('/\s+/', trim($employee->name), 3);
        $employee->first_name = $nameParts[0] ?? '';
        $employee->middle_name = $nameParts[1] ?? '';
        $employee->last_name = $nameParts[2] ?? '';

        return view('employer.employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $this->ensureEmployer();
        $employee = User::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->id,
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'mobile' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'age' => 'nullable|integer|min:16',
            'sex' => 'nullable|string|max:10',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'date_started' => 'nullable|date',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fullName = trim(
            ($validated['first_name'] ?? '') . ' ' .
            ($validated['middle_name'] ?? '') . ' ' .
            ($validated['last_name'] ?? '')
        );

        $updateData = [
            'name' => $fullName,
            'email' => $validated['email'],
            'mobile' => $validated['mobile'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'age' => $validated['age'] ?? null,
            'sex' => $validated['sex'] ?? null,
            'position' => $validated['position'] ?? null,
            'salary' => $validated['salary'] ?? null,
            'date_started' => $validated['date_started'] ?? null,
        ];

        if ($request->hasFile('profile_photo')) {
            if ($employee->profile_photo && Storage::disk('public')->exists($employee->profile_photo)) {
                Storage::disk('public')->delete($employee->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $updateData['profile_photo'] = $path;
        }

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $employee->update($updateData);

        return redirect()->route('employer.employees.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $this->ensureEmployer();
        $employee = User::findOrFail($id);
        
        if ($employee->profile_photo) {
             Storage::disk('public')->delete($employee->profile_photo);
        }
        
        $employee->delete();
        return redirect()->route('employer.employees.index')->with('success', 'Employee removed successfully!');
    }
}