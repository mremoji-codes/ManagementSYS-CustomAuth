<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome to ManagementSYS</title>
    <link type="x-icon" href=""></link>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/m_logo.svg') }}">

    <style>
        body {
            /* Ensure the image path is correct relative to the 'public' directory */
            background: url('{{ asset('images/pictureforbackground.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff; /* Default text color */
        }
        .bg-glass {
            /* Custom class for a clean glass effect */
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.12);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        /* Ensure navbar text is white and links stand out */
        .navbar-nav .nav-link, .navbar-brand {
            color: white !important;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover, .navbar-brand:hover {
            color: #198754 !important; /* Bootstrap success green */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-glass fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-4 fw-bold" href="#">ManagementSYS</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm text-danger-emphasis nav-link" style="color: white !important;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <section class="d-flex flex-column align-items-center justify-content-center min-vh-100 text-center p-4">
    
    <div class="container"> 
        <div class="bg-glass p-5 rounded-4 shadow-lg mx-auto" style="max-width: 600px;">
            <h2 class="display-5 fw-bold mb-4">Welcome to <span style="color: #198754;">ManagementSYS</span></h2>
            <p class="lead text-white-50">Your smart and secure employee management system.</p>
            <div class="mt-4 pt-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg me-3">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg me-3">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">Register</a>
                @endauth
            </div>
        </div>
    </div>
    
    </section>

    <footer class="bg-glass w-100 text-center text-white-50 py-4 mt-auto">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-md-start mb-3 mb-md-0">
                    <h2 class="fs-4 fw-bold text-white">ManagementSYS</h2>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <a href="#" class="text-white-50 text-decoration-none me-3 hover-success">Home</a>
                    <a href="{{ route('about') }}" class="text-white-50 text-decoration-none me-3 hover-success">About</a>
                    <a href="#" class="text-white-50 text-decoration-none me-3 hover-success">Contact</a>
                    <a href="#" class="text-white-50 text-decoration-none hover-success">Privacy Policy</a>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="#" class="text-white-50 text-decoration-none me-3 hover-success">Facebook</a>
                    <a href="#" class="text-white-50 text-decoration-none me-3 hover-success">Twitter</a>
                    <a href="#" class="text-white-50 text-decoration-none hover-success">Instagram</a>
                </div>
            </div>
            <hr class="border-secondary my-3">
            <p class="mb-0 text-sm">© <span id="year"></span> ManagementSYS. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>