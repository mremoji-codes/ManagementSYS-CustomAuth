<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center">
                <h2 class="h4 text-dark mb-2 mb-sm-0">
                    {{ __('Edit Employee: ') . $employee->first_name . ' ' . $employee->last_name }}
                </h2>
                <a href="{{ route('employer.employees.index') }}"
                    class="btn btn-secondary d-flex align-items-center">
                    <svg class="bi me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Back to Directory
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg rounded-3">
                        <div class="card-body p-4 p-lg-5">

                            <h3 class="h4 fw-bold text-dark mb-4 pb-2 border-bottom">Employee Details</h3>
                            
                            {{-- Success Message Alert --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong class="fw-bold">Success!</strong>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- The Form uses PUT method for updating the resource --}}
                            <form action="{{ route('employer.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- =================================== --}}
                                {{-- SECTION 1: Personal Information --}}
                                {{-- =================================== --}}
                                <div class="mb-5">
                                    <p class="h6 fw-semibold text-primary pb-1 mb-3 border-bottom border-primary">1. Personal Information</p>

                                    {{-- Name Fields (First, Middle, Last) --}}
                                    <div class="row g-4 mb-4">
                                        
                                        {{-- First Name --}}
                                        <div class="col-md-4">
                                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" id="first_name" required
                                                value="{{ old('first_name', $employee->first_name) }}"
                                                class="form-control @error('first_name') is-invalid @enderror">
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Middle Name --}}
                                        <div class="col-md-4">
                                            <label for="middle_name" class="form-label">Middle Name</label>
                                            <input type="text" name="middle_name" id="middle_name"
                                                value="{{ old('middle_name', $employee->middle_name) }}"
                                                class="form-control @error('middle_name') is-invalid @enderror">
                                            @error('middle_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Last Name --}}
                                        <div class="col-md-4">
                                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" id="last_name" required
                                                value="{{ old('last_name', $employee->last_name) }}"
                                                class="form-control @error('last_name') is-invalid @enderror">
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Contact and Demographics --}}
                                    <div class="row g-4 mb-4">
                                        
                                        {{-- Email --}}
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email" id="email" required
                                                value="{{ old('email', $employee->email) }}"
                                                class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Mobile --}}
                                        <div class="col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input type="text" name="mobile" id="mobile"
                                                value="{{ old('mobile', $employee->mobile) }}"
                                                class="form-control @error('mobile') is-invalid @enderror">
                                            @error('mobile')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row g-4">
                                        {{-- Date of Birth --}}
                                        <div class="col-md-4">
                                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                                            <input type="date" name="date_of_birth" id="date_of_birth"
                                                value="{{ old('date_of_birth', $employee->date_of_birth) }}"
                                                class="form-control @error('date_of_birth') is-invalid @enderror">
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        {{-- Age --}}
                                        <div class="col-md-4">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="number" name="age" id="age" min="16"
                                                value="{{ old('age', $employee->age) }}"
                                                class="form-control @error('age') is-invalid @enderror">
                                            @error('age')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Sex --}}
                                        <div class="col-md-4">
                                            <label for="sex" class="form-label">Sex</label>
                                            <select name="sex" id="sex"
                                                class="form-select @error('sex') is-invalid @enderror">
                                                <option value="" @if(old('sex', $employee->sex) == '') selected @endif>Select...</option>
                                                <option value="Male" @if(old('sex', $employee->sex) == 'Male') selected @endif>Male</option>
                                                <option value="Female" @if(old('sex', $employee->sex) == 'Female') selected @endif>Female</option>
                                                <option value="Other" @if(old('sex', $employee->sex) == 'Other') selected @endif>Other</option>
                                            </select>
                                            @error('sex')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                {{-- =================================== --}}
                                {{-- SECTION 2: Employment Details --}}
                                {{-- =================================== --}}
                                <div class="mt-5 pt-4 border-top border-gray-200">
                                    <p class="h6 fw-semibold text-success pb-1 mb-3 border-bottom border-success">2. Employment Details</p>

                                    <div class="row g-4 mb-4">

                                        {{-- Position --}}
                                        <div class="col-md-4">
                                            <label for="position" class="form-label">Job Position</label>
                                            <input type="text" name="position" id="position"
                                                value="{{ old('position', $employee->position) }}"
                                                class="form-control @error('position') is-invalid @enderror">
                                            @error('position')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Salary --}}
                                        <div class="col-md-4">
                                            <label for="salary" class="form-label">Annual Salary (USD)</label>
                                            <input type="number" name="salary" id="salary" step="0.01" min="0"
                                                value="{{ old('salary', $employee->salary) }}"
                                                class="form-control @error('salary') is-invalid @enderror">
                                            @error('salary')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Date Started --}}
                                        <div class="col-md-4">
                                            <label for="date_started" class="form-label">Date Started</label>
                                            <input type="date" name="date_started" id="date_started"
                                                value="{{ old('date_started', $employee->date_started) }}"
                                                class="form-control @error('date_started') is-invalid @enderror">
                                            @error('date_started')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- =================================== --}}
                                {{-- SECTION 3: Update Password (Optional) --}}
                                {{-- =================================== --}}
                                <div class="mt-5 pt-4 border-top border-danger">
                                    <p class="h6 fw-semibold text-danger pb-1 mb-3 border-bottom border-danger">3. Change Password (Optional)</p>
                                    <p class="text-muted small mb-4">Only fill these fields if you need to reset the employee's password.</p>

                                    <div class="row g-4">

                                        {{-- Password --}}
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">New Password</label>
                                            <input type="password" name="password" id="password" autocomplete="new-password"
                                                class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Password Confirmation --}}
                                        <div class="col-md-6">
                                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>


                                {{-- Form Submission Button --}}
                                <div class="d-flex justify-content-end mt-5 pt-4 border-top">
                                    <button type="submit"
                                        class="btn btn-primary btn-lg d-flex align-items-center">
                                        <svg class="bi me-2" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M11.96 4.417a.5.5 0 0 0-.895-.445L7.498 7.915 5.518 5.93a.5.5 0 0 0-.707.707L6.793 8.62l4.872 4.872a.5.5 0 0 0 .707-.707l-4.757-4.758 4.757-4.757z"/>
                                        </svg>
                                        Update Employee Record
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>