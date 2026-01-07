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
                
                {{-- 🔔 NEW: Notification Bell (Wrapped in isset to prevent errors on other pages) --}}
                @isset($notices)
                <li class="nav-item dropdown me-3">
                    <a class="nav-link position-relative" href="#" id="noticeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell fs-5 text-light"></i> {{-- Changed to text-light for dark navbar --}}
                        
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                    
                    {{-- Dropdown Menu --}}
                    <div class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" aria-labelledby="noticeDropdown" style="width: 320px; max-height: 400px; overflow-y: auto;">
                        <div class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center bg-light">
                            <span class="fw-bold small text-dark">Announcements</span>
                            <span class="badge bg-primary">Latest</span>
                        </div>
                        
                        @forelse($notices as $notice)
                            <a class="dropdown-item px-3 py-3 border-bottom" href="#">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="fw-bold mb-0 small text-truncate text-dark" style="max-width: 180px;">{{ $notice->title }}</h6>
                                    <small class="text-muted" style="font-size: 0.7rem;">{{ $notice->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="small text-secondary mb-0 text-truncate">{{ $notice->content }}</p>
                            </a>
                        @empty
                            <div class="text-center py-4">
                                <i class="fas fa-check-circle text-muted mb-2"></i>
                                <p class="small text-muted mb-0">No new announcements</p>
                            </div>
                        @endforelse
                    </div>
                </li>
                @endisset
                {{-- 🔔 END Notification Bell --}}

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