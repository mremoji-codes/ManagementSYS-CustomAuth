<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    @php
        $user = Auth::user();

        // CHANGE THIS IF YOUR COLUMN IS DIFFERENT
        $role = $user->role ?? 'User';
        $role = ucfirst($role); // employer → Employer

        $name = $user->name;
        $email = $user->email;
        // Define employer-specific routes here for easy reference
        $dashboardRoute = route('employer.dashboard'); 
        $profileRoute = route('employer.profile.show');
        $directoryRoute = route('employer.employees.index'); 
    @endphp

    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ $dashboardRoute }}">
            Management SYS
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#EmployerNavbar" aria-controls="EmployerNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="EmployerNavbar">
            <ul class="navbar-nav me-auto">
                {{-- Example Nav Item --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('employer.dashboard') ? 'active' : '' }}" href="{{ $dashboardRoute }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('employer.employees.*') ? 'active' : '' }}" href="{{ $directoryRoute }}">Employee Directory</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $name }} ({{ $role }})
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        
                        <li class="d-lg-none"><h6 class="dropdown-header">{{ $email }}</h6></li>
                        
                        <li><a class="dropdown-item" href="{{ $profileRoute }}">My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>