<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Profile - ManagementSYS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/m_logo.svg') }}?v=1">
    
    <style>
        :root {
            --brand-emerald: #10b981;
            --bg-canvas: #f8fafc;
        }
        body { background-color: var(--bg-canvas); font-family: 'Inter', system-ui, sans-serif; }
        
        .profile-photo-wrapper {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #ffffff; 
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background: #e2e8f0;
        }

        .card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--brand-emerald);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .btn-success {
            background-color: var(--brand-emerald);
            border: none;
            border-radius: 12px;
            padding: 0.8rem 2rem;
            font-weight: 700;
        }

        .cursor-not-allowed { cursor: not-allowed; }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4 p-md-5">
                    
                    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom">
                        <div>
                            <h2 class="h3 fw-bold text-dark mb-1">Edit My Profile</h2>
                            <p class="text-muted small mb-0">Personalize your account and identification details.</p>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            <ul class="mb-0 small fw-bold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employee.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="d-flex flex-column flex-sm-row align-items-center gap-4 mb-5 p-4 bg-light rounded-4">
                            <div class="profile-photo-wrapper flex-shrink-0">
                                <img id="profile-preview"
                                     src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=10b981&color=fff' }}" 
                                     alt="Profile Photo" 
                                     class="w-100 h-100 object-fit-cover">
                            </div>

                            <div class="flex-grow-1 text-center text-sm-start">
                                <label class="d-block fw-bold text-dark mb-2">Profile Picture</label>
                                <input type="file" name="profile_photo" id="profile_photo_input" accept="image/*" 
                                        class="form-control mb-2">
                                <p class="text-muted small mb-0">Square JPG, PNG, or WEBP (Max 4MB).</p>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-12">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                    class="form-control @error('name') is-invalid @enderror">
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required readonly
                                    class="form-control bg-light cursor-not-allowed">
                                <small class="text-muted italic">Login email cannot be changed.</small>
                            </div>

                            <div class="col-md-6">
                                <label for="mobile" class="form-label">Phone Number</label>
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile', $user->mobile) }}"
                                    class="form-control @error('mobile') is-invalid @enderror">
                            </div>

                            <div class="col-md-6">
                                <label for="sex" class="form-label">Gender</label>
                                <select name="sex" id="sex" class="form-select">
                                    <option value="">Select</option>
                                    <option value="Male" {{ old('sex', $user->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex', $user->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('sex', $user->sex) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}"
                                    class="form-control">
                            </div>
                            
                            <div class="col-md-6">
                               <label for="age" class="form-label">Age</label>
                               <input type="number" name="age" id="age" value="{{ old('age', $user->age) }}"
                                   class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="position" class="form-label">Job Title</label>
                                <input type="text" name="position" id="position" value="{{ old('position', $user->position) }}"
                                    class="form-control bg-light cursor-not-allowed" readonly>
                            </div>

                            <div class="col-md-6">
                                <label for="date_started" class="form-label">Date Started</label>
                                <input type="date" name="date_started" id="date_started" value="{{ old('date_started', $user->date_started) }}"
                                    class="form-control bg-light cursor-not-allowed" readonly>
                            </div>

                            <div class="col-12">
                                <label for="salary" class="form-label">Salary (GHC)</label>
                                <input type="text" value="GHC {{ number_format($user->salary ?? 0, 2) }}" readonly
                                       class="form-control bg-light text-muted cursor-not-allowed">
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-top d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                &larr; Cancel
                            </a>
                            <button type="submit" class="btn btn-success shadow-sm px-5">
                                Save Profile Changes
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
</body>
</html>