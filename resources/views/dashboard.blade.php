<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-white flex flex-col justify-center items-center py-12">
        <h1 class="text-3xl font-bold mb-4">
            Welcome {{ Auth::user()->role == 'employer' ? 'Employer' : 'Employee' }}
        </h1>
        <p class="text-xl text-gray-700 mb-6">
            This is your dashboard
        </p>

        <!-- Logout button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>
</x-app-layout>
