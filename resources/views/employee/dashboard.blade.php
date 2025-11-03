<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 sm:p-8 rounded-lg shadow-lg w-[95%] sm:w-full">
        <!-- Header -->
        <h2 class="text-xl sm:text-2xl font-bold text-gray-700 mb-6 text-center break-words">
            👋 Welcome, {{ $user->first_name ?? $user->name }}
        </h2>

        <!-- Profile Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm sm:text-base">
            <!-- Column 1 -->
            <div class="space-y-3">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->mobile ?? 'Not provided' }}</p>
                <p><strong>Sex:</strong> {{ $user->sex ?? 'Not provided' }}</p>
                <p><strong>Date of Birth:</strong> {{ $user->date_of_birth ?? 'Not provided' }}</p>
            </div>

            <!-- Column 2 -->
            <div class="space-y-3">
                <p><strong>Job Title:</strong> {{ $user->position ?? 'N/A' }}</p>
                <p><strong>Salary:</strong> {{ $user->salary ? '₵' . number_format($user->salary, 2) : 'N/A' }}</p>
                <p><strong>Date Started:</strong> {{ $user->date_started ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($user->status ?? 'Active') }}</p>
            </div>
        </div>

        <!-- Centered Edit Button -->
        <div class="mt-8 flex justify-center">
            <a href="{{ route('employee.edit') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition text-center text-sm sm:text-base">
               ✏️ Edit Profile
            </a>
        </div>

        <!-- Hidden Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</x-app-layout>
