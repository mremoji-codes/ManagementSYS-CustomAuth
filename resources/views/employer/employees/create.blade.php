<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-700 text-center">Add New Employee</h2>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('employees.store') }}" id="employeeForm">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="mt-1 w-full border-gray-300 rounded-md" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="mt-1 w-full border-gray-300 rounded-md" required>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="mt-1 w-full border-gray-300 rounded-md" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Sex</label>
                    <select name="sex" class="mt-1 w-full border-gray-300 rounded-md">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="mobile" class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" name="age" class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Date Started</label>
                    <input type="date" name="date_started" class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Job Title</label>
                    <input type="text" name="position" class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Salary (GHC)</label>
                    <input type="number" name="salary" step="0.01" class="mt-1 w-full border-gray-300 rounded-md">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" class="mt-1 w-full border-gray-300 rounded-md" required>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="mt-1 w-full border-gray-300 rounded-md" required>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit"
                    class="px-6 py-3 bg-green-600 text-white text-lg font-semibold rounded-lg hover:bg-green-700 transition">
                    ✅ Save Employee
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
