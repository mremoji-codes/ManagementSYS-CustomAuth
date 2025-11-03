<x-app-layout>
    <div class="max-w-7xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-bold text-gray-800 text-center sm:text-left">Employee Management</h2>

            <div class="flex flex-wrap justify-center sm:justify-end gap-3">
                <!-- Back Button -->
                <a href="{{ route('employer.dashboard') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition text-sm sm:text-base">
                    ⬅️ Back
                </a>

                <!-- Add New Employee Button -->
                <a href="{{ route('employees.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm sm:text-base">
                    ➕ Add Employee
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Employees Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-200 text-sm sm:text-base">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">#</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Full Name</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Email</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Phone</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Age</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Date of Birth</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Sex</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Job Title</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Salary (GHC)</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-600">Date Started</th>
                        <th class="px-4 py-2 text-center font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($employees as $index => $employee)
                        <tr>
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $employee->name ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $employee->email ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $employee->mobile ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $employee->age ?? '—' }}</td>
                            <td class="px-4 py-2">
                                {{ $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('d M, Y') : '—' }}
                            </td>
                            <td class="px-4 py-2 capitalize">{{ $employee->sex ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $employee->position ?? '—' }}</td>
                            <td class="px-4 py-2">
                                {{ $employee->salary ? number_format($employee->salary, 2) : '—' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $employee->date_started ? \Carbon\Carbon::parse($employee->date_started)->format('d M, Y') : '—' }}
                            </td>
                            <td class="px-4 py-2 flex justify-center gap-2 flex-wrap">
                                <!-- Edit -->
                                <a href="{{ route('employees.edit', $employee->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    ✏️ Edit
                                </a>

                                <!-- Delete -->
                                <form method="POST"
                                      action="{{ route('employees.destroy', $employee->id) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4 text-gray-500">
                                No employees found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
