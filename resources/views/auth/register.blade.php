<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ManagementSYS - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/m_logo.svg') }}">

    <style>
        body {
            background: url('{{ asset('images/pictureforbackground.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
        }
        .bg-glass {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.12);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        /* Custom style for input fields */
        .form-control-glass {
            background-color: rgba(255,255,255,0.15) !important;
            color: white !important;
            border-color: rgba(255,255,255,0.3) !important;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 py-5">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card bg-glass p-4 text-white">
                    <h2 class="card-title text-center mb-4 fw-bold">Register New Account</h2>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control form-control-glass">
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control form-control-glass">
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Register As</label>
                                <select id="role" name="role" required class="form-select form-control-glass" style="height: 48px;">
                                    <option value="" class="text-dark">Select Role</option>
                                    <option value="employee" class="text-dark" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                    <option value="employer" class="text-dark" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer</option>
                                </select>
                                @error('role')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="form-label">Mobile (Optional)</label>
                                <input id="mobile" type="text" name="mobile" value="{{ old('mobile') }}" class="form-control form-control-glass">
                                @error('mobile')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control form-control-glass">
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control form-control-glass">
                            </div>
                            
                            <div class="col-md-4 mb-3 d-none"> 
                                <label for="age" class="form-label">Age</label>
                                <input id="age" type="number" name="age" value="{{ old('age') }}" class="form-control form-control-glass">
                            </div>
                            </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success btn-lg">
                                Register Account
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center pt-3 border-top border-secondary-subtle">
                        <p class="small text-white-50 mb-1">Already registered?</p>
                        <a href="{{ route('login') }}" class="text-white fw-bold text-decoration-none" style="color: #20c997 !important;">
                            Go to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>