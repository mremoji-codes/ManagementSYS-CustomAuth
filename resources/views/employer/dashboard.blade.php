<x-app-layout>
    
    <x-slot name="header">
        <h2 class="h4 font-weight-bold text-dark">
            {{ __('Employer Dashboard') }}
        </h2>
    </x-slot>

    <header class="bg-success shadow-lg" style="background: linear-gradient(90deg, #10b981 0%, #0d9488 100%); border-bottom: 2px solid #06726e;">
        <div class="container py-5 text-white">
            <div class="d-md-flex align-items-md-center justify-content-md-between">
                <h1 class="display-5 fw-bold tracking-tight mb-3 mb-md-0">
                    Welcome Back, {{ Auth::user()->name ?? 'Employer' }}
                </h1>
                <div class="mt-3 mt-md-0">
                    <button type="button" 
                            class="btn btn-light btn-lg rounded-pill shadow-sm text-success fw-medium transition-shadow">
                        Quick System Review
                    </button>
                </div>
            </div>
            <p class="mt-2 h5 opacity-90">
                Monitor, manage, and grow your team effectively.
            </p>
        </div>
    </header>

    <div class="py-5 bg-light">
        <div class="container">
            
            <h2 class="h3 fw-bold text-dark mb-4">
                System Overview & Quick Access
            </h2>
            
            <div class="row g-4 mb-5">
                
                <div class="col-sm-6 col-lg-4">
                    <div class="card p-4 shadow-xl border-start border-5 border-success transition-transform hover-lift">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="text-sm text-uppercase text-muted mb-0">Total Employees</p>
                            <svg class="bi text-success" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M7 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H7zm1-9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.652-2.35 1.5-3.033.582-.474 1.115-.81 1.76-.983.472-.132.997-.17 1.498-.17s1.026.038 1.498.17c.645.173 1.178.51 1.76.983.848.683 1.5 1.678 1.5 3.033 0 .42-.102.73-1 1-2.909 0-5.83-1.02-8.5-1H5z"/>
                            </svg>
                        </div>
                        <p class="mt-2 display-6 fw-bold text-dark">{{ $employeeCount }}</p>
                        <a href="{{ route('employer.employees.index') }}" 
                           class="mt-3 text-sm fw-medium text-success text-decoration-none hover-text-dark">
                            View Full Directory &rarr;
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card p-4 shadow-xl border-start border-5 border-purple transition-transform hover-lift">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="text-sm text-uppercase text-muted mb-0">My Profile</p>
                            <svg class="bi text-purple" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </div>
                        <p class="mt-2 display-6 fw-bold text-dark">View</p>
                        <a href="{{ route('employer.profile.show') }}" 
                           class="mt-3 text-sm fw-medium text-purple text-decoration-none hover-text-dark">
                            View My Details &rarr;
                        </a>
                    </div>
                </div>
                
                <div class="col-sm-6 col-lg-4">
                    <div class="card p-4 shadow-xl border-start border-5 border-primary transition-transform hover-lift">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="text-sm text-uppercase text-muted mb-0">New Hires (30 days)</p>
                            <svg class="bi text-primary" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M14 6v.55L9.5 0 9 0V2a.5.5 0 0 1 .5.5H12v.5a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5V2H8.5V.55L7.5 0 7 0V2a.5.5 0 0 1-.5.5H4a1 1 0 0 0-1 1V15a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6H14zM4 11.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </div>
                        <p class="mt-2 display-6 fw-bold text-dark">6</p>
                        <a href="{{ route('employer.employees.create') }}" 
                           class="mt-3 text-sm fw-medium text-primary text-decoration-none hover-text-dark">
                            Onboard New Staff &rarr;
                        </a>
                    </div>
                </div>
                
            </div>
            
            <div class="card shadow-lg p-4 mt-5">
                <h3 class="h5 fw-semibold text-dark mb-3">Recent System Activity</h3>
                <p class="text-muted">Employee login logs or recent updates can be displayed here.</p>
            </div>


        </div>
    </div>
    
    {{-- Custom Style for Card Hover Effect --}}
    <style>
        .hover-lift {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .text-purple {
            color: #8b5cf6; /* A common Tailwind purple color */
        }
        .border-purple {
            border-color: #8b5cf6 !important;
        }
    </style>
</x-app-layout>