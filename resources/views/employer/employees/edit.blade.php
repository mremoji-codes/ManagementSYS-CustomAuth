<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-700">Edit Employee Details</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @php
            // Split full name safely for edit form
            $nameParts = explode(' ', $employee->name);
            $first = $nameParts[0] ?? '';
            $middle = $nameParts[1] ?? '';
            $last = $nameParts[2] ?? '';
        @endphp

        <form method="POST" action="{{ route('employees.update', $employee->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">First Name</label>
                    <input type="text" name="first_name"
                           value="{{ old('first_name', $first) }}"
                           class="mt-1 w-full border-gray-300 rounded-md" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Middle Name</label>
                    <input type="text" name="middle_name"
                           value="{{ old('middle_name', $middle) }}"
                           class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium">Last Name</label>
                    <input type="text" name="last_name"
                           value="{{ old('last_name', $last) }}"
                           class="mt-1 w-full border-gray-300 rounded-md" required>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email', $employee->email) }}"
                           class="mt-1 w-full border-gray-300 rounded-md" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Date of Birth</label>
                    <input type="date" name="date_of_birth"
                           value="{{ old('date_of_birth', $employee->date_of_birth) }}"
                           class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium">Sex</label>
                    <select name="sex" class="mt-1 w-full border-gray-300 rounded-md">
                        <option value="">Select</option>
                        <option value="Male" {{ old('sex', $employee->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('sex', $employee->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Phone Number</label>
                    <input type="text" name="mobile"
                           value="{{ old('mobile', $employee->mobile) }}"
                           class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium">Age</label>
                    <input type="number" name="age"
                           value="{{ old('age', $employee->age) }}"
                           class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium">Date Started</label>
                    <input type="date" name="date_started"
                           value="{{ old('date_started', $employee->date_started) }}"
                           class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium">Job Title</label>
                    <input type="text" name="position"
                           value="{{ old('position', $employee->position) }}"
                           class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium">Salary (GHC)</label>
                    <input type="number" step="0.01" name="salary"
                           value="{{ old('salary', $employee->salary) }}"
                           class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <!-- Optional password update -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium">New Password (optional)</label>
                    <input type="password" name="password"
                           class="mt-1 w-full border-gray-300 rounded-md"
                           placeholder="Leave blank to keep existing password">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                           class="mt-1 w-full border-gray-300 rounded-md">
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('employees.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                    ← Back
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Update Employee
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
