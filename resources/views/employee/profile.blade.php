<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-2xl font-semibold mb-4 text-center">
                Welcome, {{ $user->name }}
            </h3>

            <p class="text-gray-700 mb-2"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="text-gray-700 mb-2"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
            <p class="text-gray-700 mb-6"><strong>Joined:</strong> {{ $user->created_at->format('F j, Y') }}</p>

            <a href="{{ route('employee.dashboard') }}" 
               class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
               ← Back to Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
