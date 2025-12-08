<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ManagementSYS - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/m_logo.svg') }}">

    <style>
        body {
            /* Use the same background for consistency */
            background: url('{{ asset('images/background.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
        }
        .bg-glass {
            /* Custom Glassmorphism style */
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.12);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card bg-glass p-4 text-white">
                    <h2 class="card-title text-center mb-4 fw-bold">ManagementSYS Login</h2>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control" style="background-color: rgba(255,255,255,0.15); color: white; border-color: rgba(255,255,255,0.3);">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" required class="form-control" style="background-color: rgba(255,255,255,0.15); color: white; border-color: rgba(255,255,255,0.3);">
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label small text-white-50" for="remember_me">
                                    Remember me
                                </label>
                            </div>
                            
                            <a href="{{ route('password.request') }}" class="small text-decoration-none" style="color: #198754;">
                                Forgot Password?
                            </a>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success btn-lg">
                                Log In
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center pt-3 border-top border-secondary-subtle">
                        <p class="small text-white-50 mb-1">Don't have an account?</p>
                        <a href="{{ route('register') }}" class="text-white fw-bold text-decoration-none" style="color: #20c997 !important;">
                            Register Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>