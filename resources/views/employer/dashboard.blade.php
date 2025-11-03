<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl sm:text-2xl text-gray-800 leading-tight text-center sm:text-left">
            {{ __('Employer Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-50 flex flex-col items-center px-4 sm:px-6 py-10">
        <!-- Welcome Section -->
        <div class="bg-white w-full sm:max-w-3xl rounded-lg shadow-md p-6 sm:p-10 text-center">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">
                👋 Welcome, {{ Auth::user()->name }} (Employer)
            </h1>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-6">
                This is your employer dashboard. You can manage your employees and view their records below.
            </p>

            <!-- Manage Employees Button -->
            <a href="{{ route('employees.index') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg transition text-sm sm:text-base w-full sm:w-auto">
                👥 Manage Employees
            </a>
        </div>

        
    </div>
</x-app-layout>
