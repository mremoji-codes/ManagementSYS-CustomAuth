<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8 sm:mt-10 p-4 sm:p-6 bg-white shadow-lg rounded-lg w-[95%]">

        <h2 class="text-xl sm:text-2xl font-bold mb-6 text-gray-700 text-center break-words">
            ✏️ Edit Profile
        </h2>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('employee.update') }}" class="space-y-4 sm:space-y-6">
            @csrf
            @method('PUT')

            <!-- Responsive Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- First Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                           class="mt-1 w-full border-gray-300 rounded-md p-2 sm:p-3 text-sm sm:text-base" required>
                </div>

                <!-- Middle Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}"
                           class="mt-1 w-full border-gray-300 rounded-md p-2 sm:p-3 text-sm sm:text-base">
                </div>

                <!-- Last Name -->
                <div class="col-span-1 sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                           class="mt-1 w-full border-gray-300 rounded-md p-2 sm:p-3 text-sm sm:text-base" required>
                </div>

                <!-- Email -->
                <div class="col-span-1 sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="mt-1 w-full border-gray-300 rounded-md p-2 sm:p-3 text-sm sm:text-base" required>
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}"
                           class="mt-1 w-full border-gray-300 rounded-md p-2 sm:p-3 text-sm sm:text-base">
                </div>

                <!-- Sex -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sex</label>
                    <select name="sex"
                            class="mt-1 w-full border-gray-300 rounded-md p-2 sm:p-3 text-sm sm:text-base">
                        <option value="">Select</option>
                        <option value="Male" {{ $user->sex == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $user->sex == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <!-- Date of Birth -->
                <div class="col-span-1 sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="date_of_birth"
                           value="{{ old('date_of_birth', $user->date_of_birth) }}"
                           class="mt-1 w-full border-gray-300 rounded-md p-2 sm:p-3 text-sm sm:text-base">
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-between gap-3 sm:gap-0">
                <!-- Back Button -->
                <a href="{{ route('employee.dashboard') }}"
                   class="w-full sm:w-auto px-5 sm:px-6 py-2.5 sm:py-3 bg-gray-300 text-gray-800 text-sm sm:text-base font-semibold rounded-lg hover:bg-gray-400 transition text-center">
                   ⬅️ Back
                </a>

                <!-- Save Button -->
                <button type="submit"
                        class="w-full sm:w-auto px-5 sm:px-6 py-2.5 sm:py-3 bg-blue-600 text-white text-sm sm:text-base font-semibold rounded-lg hover:bg-blue-700 transition">
                    💾 Save Changes
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
