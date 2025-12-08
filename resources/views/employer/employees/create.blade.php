<x-app-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body p-4 p-md-5">

                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <h2 class="h3 fw-bold text-dark mb-0">Add New Employee</h2>
                            
                            <a href="{{ route('employer.employees.index') }}"
                               class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                <svg class="bi me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                                Back to Employees
                            </a>
                        </div>

                        <form method="POST" action="{{ route('employer.employees.store') }}" autocomplete="off">
                            @csrf

                            <h4 class="h5 text-dark mb-4 pt-3 border-top">Personal Information</h4>
                            <div class="row g-4 mb-4">
                                
                                <div class="col-12">
                                    <div class="row g-3">
                                        
                                        <div class="col-sm-4">
                                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                                                class="form-control @error('first_name') is-invalid @enderror">
                                            @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="middle_name" class="form-label">Middle Name</label>
                                            <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}"
                                                class="form-control @error('middle_name') is-invalid @enderror">
                                            @error('middle_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                                class="form-control @error('last_name') is-invalid @enderror">
                                            @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="off"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Phone Number</label>
                                    <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}"
                                        class="form-control @error('mobile') is-invalid @enderror">
                                    @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                                        class="form-control @error('date_of_birth') is-invalid @enderror">
                                    @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="sex" class="form-label">Sex</label>
                                    <select name="sex" id="sex" 
                                        class="form-select @error('sex') is-invalid @enderror">
                                        <option value="">Select</option>
                                        <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('sex') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('sex') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" name="age" id="age" value="{{ old('age') }}"
                                        class="form-control @error('age') is-invalid @enderror">
                                    @error('age') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <h4 class="h5 text-dark mb-4 pt-3 border-top">Employment Details</h4>
                            <div class="row g-4 mb-4">
                                <div class="col-md-4">
                                    <label for="date_started" class="form-label">Date Started <span class="text-danger">*</span></label>
                                    <input type="date" name="date_started" id="date_started" value="{{ old('date_started') }}" required
                                        class="form-control @error('date_started') is-invalid @enderror">
                                    @error('date_started') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-5">
                                    <label for="position" class="form-label">Job Title <span class="text-danger">*</span></label>
                                    <input type="text" name="position" id="position" value="{{ old('position') }}" required
                                        class="form-control @error('position') is-invalid @enderror">
                                    @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="salary" class="form-label">Salary (GHC) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="salary" id="salary" value="{{ old('salary') }}" required
                                        class="form-control @error('salary') is-invalid @enderror">
                                    @error('salary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <h4 class="h5 text-dark mb-4 pt-3 border-top">Security (Login)</h4>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" required autocomplete="new-password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                                        class="form-control">
                                </div>
                            </div>


                            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                                <button type="submit"
                                        class="btn btn-success btn-lg d-flex align-items-center">
                                    <svg class="bi me-2" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 1 0-1.047-1.02L5.472 8.08.429 12.181a.733.733 0 0 0 1.047 1.02l4.894-4.757 5.051-5.05z"/>
                                    </svg>
                                    Save New Employee
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>