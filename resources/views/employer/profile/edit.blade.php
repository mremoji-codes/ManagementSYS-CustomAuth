<x-app-layout>
    <x-slot name="header">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="h4 font-weight-bold text-dark mb-0">
                {{ __('Edit Profile Settings') }}
            </h2>
            <a href="{{ route('employer.profile.show') }}" class="btn btn-sm btn-outline-secondary shadow-sm">
                &larr; Cancel and Go Back
            </a>
        </div>
    </x-slot>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <div class="card shadow-sm border-0 rounded-3 mb-4">
                        <div class="card-body p-4 p-md-5">
                            <div class="mb-4">
                                <h3 class="h5 fw-bold text-dark mb-1">Account Information</h3>
                                <p class="text-muted small">Update your primary account details below.</p>
                            </div>
                            
                            <form action="{{ route('employer.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="name" class="form-label text-xs text-uppercase text-muted fw-bold" style="letter-spacing: 0.05em;">Full Name</label>
                                    <input type="text" name="name" id="name" 
                                           class="form-control border-light bg-light py-2 @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $employer->name) }}" 
                                           required autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label text-xs text-uppercase text-muted fw-bold" style="letter-spacing: 0.05em;">Email Address</label>
                                    <input type="email" name="email" id="email" 
                                           class="form-control border-light bg-light py-2 @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $employer->email) }}" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="pt-3 border-top mt-4">
                                    <button type="submit" class="btn px-4 fw-bold" style="background-color: #10b981; color: white; border: none;">
                                        Save Profile Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body p-4 p-md-5">
                            <div class="mb-4">
                                <h3 class="h5 fw-bold text-dark mb-1">Security Update</h3>
                                <p class="text-muted small">Update your password to keep your account secure.</p>
                            </div>
                            
                            <form action="{{ route('employer.profile.password.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="current_password" class="form-label text-xs text-uppercase text-muted fw-bold" style="letter-spacing: 0.05em;">Current Password</label>
                                    <input type="password" name="current_password" id="current_password" 
                                           class="form-control border-light bg-light py-2 @error('current_password', 'updatePassword') is-invalid @enderror" required>
                                    @error('current_password', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label text-xs text-uppercase text-muted fw-bold" style="letter-spacing: 0.05em;">New Password</label>
                                    <input type="password" name="password" id="password" 
                                           class="form-control border-light bg-light py-2 @error('password', 'updatePassword') is-invalid @enderror" required>
                                    @error('password', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label text-xs text-uppercase text-muted fw-bold" style="letter-spacing: 0.05em;">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" 
                                           class="form-control border-light bg-light py-2" required>
                                </div>

                                <div class="pt-3 border-top mt-4">
                                    <button type="submit" class="btn px-4 fw-bold" style="background-color: #10b981; color: white; border: none;">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-white border rounded-3 d-flex align-items-center shadow-sm">
                        <div class="bg-light rounded-circle p-2 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#10b981" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                            </svg>
                        </div>
                        <p class="small text-muted mb-0">Password changes will take effect immediately. You may be asked to log in again.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>