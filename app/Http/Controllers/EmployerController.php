<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    private function ensureEmployer()
    {
        if (!Auth::check() || Auth::user()->role !== 'employer') {
            abort(403, 'Unauthorized Access — Only the employer can perform this action.');
        }
    }

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
        ]);

        // Combine name parts safely
        $fullName = trim(
            $validated['first_name'] . ' ' .
            ($validated['middle_name'] ?? '') . ' ' .
            $validated['last_name']
        );

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
            'role' => 'employee',
            'status' => 'active',
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    public function edit($id)
    {
        $this->ensureEmployer();

        $employee = User::findOrFail($id);

        // Split name into parts for the form
        $nameParts = explode(' ', $employee->name, 3);
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
            'password' => 'nullable|string|min:6|confirmed',
            'mobile' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'age' => 'nullable|integer|min:16',
            'sex' => 'nullable|string|max:10',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'date_started' => 'nullable|date',
        ]);

        $fullName = trim(
            $validated['first_name'] . ' ' .
            ($validated['middle_name'] ?? '') . ' ' .
            $validated['last_name']
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

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $employee->update($updateData);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $this->ensureEmployer();

        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee removed successfully!');
    }
}
