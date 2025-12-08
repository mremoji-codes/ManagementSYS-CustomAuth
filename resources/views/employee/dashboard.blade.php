<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Employee Dashboard - ManagementSYS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/m_logo.svg') }}?v=1">

    <style>
        /* Light Gray Background for the Body (Tailwind's bg-gray-100 equivalent) */
        body {
            background-color: #f8f9fa; 
        }
        .profile-photo {
            width: 128px;
            height: 128px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #e0f2f1; /* Light Indigo border equivalent */
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .text-indigo {
            color: #4f46e5; /* Tailwind indigo-600 */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white border-bottom shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">ManagementSYS</span>
            <div class="d-flex">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    Logout
                </button>
            </form>
            </div>
        </div>
    </nav>
    
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="mb-4">
                    <h1 class="fs-2 fw-bold text-dark mb-1">
                        Welcome back, {{ explode(' ', $user->name)[0] }}!
                    </h1>
                    <p class="lead text-secondary">Your central hub for personal and employment information.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success shadow-sm" role="alert">
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                @endif
                
                <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">
                    
                    <div class="row g-4 border-bottom pb-4 mb-4 align-items-center">
                        
                        <div class="col-12 col-md-auto text-center">
                            <div class="profile-photo mx-auto mx-md-0">
                                @if(isset($user->profile_photo) && $user->profile_photo)
                                    <img id="profile-preview" 
                                    src="{{ asset('storage/' . $user->profile_photo) }}" 
                                    alt="Profile Photo" 
                                    class="w-100 h-100 object-fit-cover">
                                @else
                                    <svg class="w-100 h-100 text-secondary p-3" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4a4 4 0 100 8 4 4 0 000-8zm0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4z"/>
                                    </svg>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-md">
                            <div class="text-center text-md-start">
                                <h2 class="fs-3 fw-bold text-dark break-words mb-1">{{ $user->name }}</h2>
                                <p class="fs-5 fw-medium text-indigo">{{ $user->position ?? 'Role Pending' }}</p>
                                <p class="text-muted">{{ $user->email }}</p>

                                <div class="mt-3">
                                    <a href="{{ route('employee.edit') }}"
                                        class="btn btn-primary btn-lg shadow-sm hover-shadow-lg transition-all">
                                        <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Update My Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5">

                        <div class="col-lg-4">
                            <h3 class="fs-5 fw-semibold text-dark mb-4 border-bottom pb-2">Personal Details</h3>
                            <dl class="row g-3">
                                @php
                                    $details = [
                                        'Phone' => $user->mobile ?? 'Not provided',
                                        'Gender' => $user->sex ?? 'N/A',
                                        'Date of Birth' => $user->date_of_birth ?? 'N/A',
                                        'Age' => $user->age ?? 'N/A'
                                    ];
                                @endphp
                                @foreach($details as $key => $value)
                                    <div class="col-5">
                                        <dt class="text-sm text-secondary">{{ $key }}</dt>
                                    </div>
                                    <div class="col-7 text-end">
                                        <dd class="text-sm fw-bold text-dark">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>

                        <div class="col-lg-4">
                            <h3 class="fs-5 fw-semibold text-dark mb-4 border-bottom pb-2">Employment Details</h3>
                            <dl class="row g-3">
                                @php
                                    $startDate = $user->date_started ? \Carbon\Carbon::parse($user->date_started) : null;
                                    $serviceLength = $startDate ? $startDate->diff(\Carbon\Carbon::now())->format('%y years, %m months') : 'N/A';
                                    
                                    $employmentDetails = [
                                        'Job Title' => $user->position ?? 'N/A',
                                        'Start Date' => $user->date_started ?? 'N/A',
                                        'Service Length' => $serviceLength
                                    ];
                                @endphp
                                @foreach($employmentDetails as $key => $value)
                                    <div class="col-5">
                                        <dt class="text-sm text-secondary">{{ $key }}</dt>
                                    </div>
                                    <div class="col-7 text-end">
                                        <dd class="text-sm fw-bold text-dark">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>

                        <div class="col-lg-4 border-start-lg ps-lg-4 pt-4 pt-lg-0">
                            <h3 class="fs-5 fw-semibold text-dark mb-4 border-bottom pb-2">Compensation</h3>
                            
                            <div class="bg-light p-4 rounded-3 shadow-sm mb-4">
                                <dt class="text-sm text-secondary">Current Gross Salary</dt>
                                <dd class="mt-1 fs-1 fw-bolder text-success">
                                    {{ $user->salary ? '₵' . number_format($user->salary, 2) : 'N/A' }}
                                </dd>
                                <p class="small text-muted mt-2">Displayed in GHC (Ghanaian Cedi)</p>
                            </div>

                            <div class="bg-light p-4 rounded-3 shadow-sm">
                                <dt class="text-sm text-secondary">Payroll Cycle</dt>
                                <dd class="mt-1 fs-4 fw-bold text-dark">Monthly</dd>
                                <p class="small text-muted mt-2">Next payment date: (Requires backend data)</p>
                            </div>
                        </div>

                    </div>
                    </div>
                </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>