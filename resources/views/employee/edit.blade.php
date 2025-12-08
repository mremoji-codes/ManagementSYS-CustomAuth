<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Profile - ManagementSYS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/m_logo.svg') }}?v=1">
    
    <style>
        body { background-color: #f8f9fa; } /* Light background */
        .profile-photo {
            width: 96px; /* w-24 */
            height: 96px; /* h-24 */
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #ffffff; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .file-input-custom .form-control-file {
            padding: 0.5rem 1rem;
            background-color: #eef2ff; /* indigo-50 */
            color: #4f46e5; /* indigo-700 */
            border: none;
            border-radius: 50rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }
        .file-input-custom .form-control-file:hover {
             background-color: #e0e7ff; /* indigo-100 */
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <h2 class="fs-3 fw-bold text-dark">Edit My Profile</h2>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4 shadow-sm" role="alert">
                            <p class="fw-semibold mb-2">There were some errors with your submission:</p>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employee.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-4 mb-4 border-bottom pb-4">
                            
                            <div class="profile-photo flex-shrink-0">
                                <img id="profile-preview"
                                     src="{{ !empty($user->profile_photo) ? asset('storage/' . $user->profile_photo) : asset('images/profile-placeholder.png') }}" 
                                     alt="Profile Photo" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>

                            <div class="flex-grow-1">
                                <label class="d-block fs-5 fw-semibold text-dark mb-2">Change Profile Photo</label>
                                
                                <input type="file" name="profile_photo" id="profile_photo_input" accept="image/*" 
                                        class="form-control" style="background-color: #f8f9fa;">
                                
                                <p class="text-muted small mt-2">Recommended: Square image (JPG, PNG, WEBP) — max 4MB.</p>
                            </div>
                        </div>

                        <div class="row g-4">
                            
                            <div class="col-12">
                                <label for="name" class="form-label small fw-bold text-muted">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label small fw-bold text-muted">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required readonly
                                    class="form-control bg-light" title="Email cannot be changed here.">
                                <small class="form-text text-muted">Email address is read-only.</small>
                            </div>

                            <div class="col-md-6">
                                <label for="mobile" class="form-label small fw-bold text-muted">Phone</label>
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile', $user->mobile) }}"
                                    class="form-control @error('mobile') is-invalid @enderror">
                                @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="sex" class="form-label small fw-bold text-muted">Gender</label>
                                <select name="sex" id="sex" class="form-select @error('sex') is-invalid @enderror">
                                    <option value="">Select</option>
                                    <option value="Male" {{ old('sex', $user->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex', $user->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('sex', $user->sex) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('sex') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label small fw-bold text-muted">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}"
                                    class="form-control @error('date_of_birth') is-invalid @enderror">
                                @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                               <label for="age" class="form-label small fw-bold text-muted">Age</label>
                               <input type="number" name="age" id="age" value="{{ old('age', $user->age) }}"
                                   class="form-control @error('age') is-invalid @enderror">
                               @error('age') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="position" class="form-label small fw-bold text-muted">Job Title</label>
                                <input type="text" name="position" id="position" value="{{ old('position', $user->position) }}"
                                    class="form-control bg-light @if(auth()->user()->role !== 'employer') cursor-not-allowed @endif" 
                                    @if(auth()->user()->role !== 'employer') readonly @endif>
                                <small class="form-text text-muted">Job title is typically updated by management.</small>
                            </div>

                            <div class="col-md-6">
                                <label for="date_started" class="form-label small fw-bold text-muted">Date Started</label>
                                <input type="date" name="date_started" id="date_started" value="{{ old('date_started', $user->date_started) }}"
                                    class="form-control bg-light @if(auth()->user()->role !== 'employer') cursor-not-allowed @endif" 
                                    @if(auth()->user()->role !== 'employer') readonly @endif>
                                <small class="form-text text-muted">Start date is read-only.</small>
                            </div>

                            <div class="col-12">
                                <label for="salary" class="form-label small fw-bold text-muted">Salary (GHC)</label>
                                @if(auth()->user()->role === 'employer')
                                    <input type="number" name="salary" id="salary" value="{{ old('salary', $user->salary) }}" step="0.01"
                                        class="form-control @error('salary') is-invalid @enderror">
                                    <small class="form-text text-muted">Only accessible by Employer role.</small>
                                @else
                                    <input type="text" value="{{ 'GHC ' . number_format($user->salary, 2) }}" readonly
                                        class="form-control bg-light text-muted cursor-not-allowed">
                                    <small class="form-text text-muted">Salary is read-only for employees.</small>
                                @endif
                                @error('salary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('dashboard') }}"
                               class="btn btn-outline-secondary">
                                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Back to Dashboard
                            </a>
                            <button type="submit" 
                                    class="btn btn-success btn-lg shadow-sm">
                                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-3m-4-6l-9 9m1-4h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h3"></path></svg>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const photoInput = document.getElementById('profile_photo_input');
            const photoPreview = document.getElementById('profile-preview');
            
            if (photoInput) {
                photoInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            photoPreview.src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>