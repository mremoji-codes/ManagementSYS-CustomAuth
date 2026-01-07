<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Employee Dashboard - ManagementSYS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/m_logo.svg') }}?v=1">

    <style>
        body {
            background-color: #f8f9fa; 
        }
        .profile-photo {
            width: 128px;
            height: 128px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #e0f2f1;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .text-indigo {
            color: #4f46e5;
        }
        .bg-emerald {
            background-color: #059669 !important;
            border-color: #059669 !important;
        }
        .bg-emerald:hover {
            background-color: #047857 !important;
        }
        /* Notice Board Custom Styles */
        .notice-card {
            border-left: 5px solid;
            transition: transform 0.2s;
        }
        .notice-card:hover {
            transform: scale(1.01);
        }
        .border-priority-high { border-left-color: #dc3545; }
        .border-priority-medium { border-left-color: #ffc107; }
        .border-priority-low { border-left-color: #0dcaf0; }
        
        /* Dropdown wrap fix */
        .whitespace-normal {
            white-space: normal !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white border-bottom shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">ManagementSYS</span>
            <div class="d-flex align-items-center">
                
                {{-- 🔔 Notification Bell Integration --}}
                @isset($notices)
                <div class="dropdown me-3">
                    <a class="position-relative text-dark" href="#" id="noticeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell fs-5"></i>
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" aria-labelledby="noticeDropdown" style="width: 300px; max-height: 400px; overflow-y: auto;">
                        <div class="px-3 py-2 border-bottom bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold small">Latest Announcements</span>
                            <a href="{{ route('employee.notices.index') }}" class="text-primary small text-decoration-none" style="font-size: 0.7rem;">View All</a>
                        </div>
                        
                        {{-- 🟢 UPDATED DROPDOWN LOOP WITH UNREAD INDICATORS --}}
                        @forelse($notices as $notice)
                            @php 
                                $isUnread = !$user->notices->contains($notice->id); 
                            @endphp
                            <a href="{{ route('employee.notices.index') }}" class="dropdown-item py-3 border-bottom whitespace-normal {{ $isUnread ? 'bg-light' : '' }}">
                                <div class="d-flex justify-content-between">
                                    <strong class="small text-dark">
                                        @if($isUnread) <i class="fas fa-circle text-primary me-1" style="font-size: 0.5rem;"></i> @endif
                                        {{ $notice->title }}
                                    </strong>
                                    <small class="text-muted" style="font-size: 0.7rem;">{{ $notice->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="small text-muted mb-0 mt-1">{{ Str::limit($notice->content, 60) }}</p>
                            </a>
                        @empty
                            <div class="text-center py-3 text-muted small">No new announcements</div>
                        @endforelse
                        {{-- 🟢 END UPDATED LOOP --}}

                    </div>
                </div>
                @endisset
                {{-- 🔔 End Bell --}}

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
                    <div class="alert alert-success shadow-sm alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5 mb-4">
                    
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

                                <div class="mt-3 d-flex flex-wrap justify-content-center justify-content-md-start gap-2">
                                    <a href="{{ route('employee.edit') }}"
                                        class="btn btn-primary shadow-sm">
                                        <i class="fas fa-user-edit me-2"></i>Update My Profile
                                    </a>

                                    <a href="{{ route('employee.leave.create') }}"
                                        class="btn btn-success bg-emerald shadow-sm">
                                        <i class="fas fa-calendar-plus me-2"></i>Request Leave
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
                                <p class="small text-muted mt-2">Next payment date: (Calculated monthly)</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if(isset($notices) && $notices->count() > 0)
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fs-5 fw-semibold text-dark mb-0">
                            <i class="fas fa-bullhorn me-2 text-primary"></i>Company Announcements
                        </h3>
                        <a href="{{ route('employee.notices.index') }}" class="btn btn-link text-decoration-none small">View All</a>
                    </div>
                    <div class="row g-3">
                        @foreach($notices as $notice)
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 rounded-3 notice-card border-priority-{{ $notice->priority }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="fw-bold mb-0 text-dark">{{ $notice->title }}</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">{{ $notice->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="text-secondary small mb-0">{{ Str::limit($notice->content, 100) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                        <h3 class="fs-5 fw-semibold text-dark mb-0">
                            <i class="fas fa-history me-2 text-secondary"></i>Recent Leave Requests
                        </h3>
                        @if($leaveRequests->count() > 0)
                            <form action="{{ route('employee.leave.clearAll') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear your entire leave history?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-eraser me-1"></i> Clear All
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($leaveRequests as $leave)
                                    <tr>
                                        <td class="fw-bold">{{ $leave->leave_type }}</td>
                                        <td>{{ $leave->start_date }}</td>
                                        <td>{{ $leave->end_date }}</td>
                                        <td>
                                            @if($leave->status == 'pending')
                                                <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Pending</span>
                                            @elseif($leave->status == 'approved')
                                                <span class="badge bg-success"><i class="fas fa-check me-1"></i>Approved</span>
                                            @else
                                                <span class="badge bg-danger"><i class="fas fa-times me-1"></i>Rejected</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <form action="{{ route('employee.leave.delete', $leave->id) }}" method="POST" onsubmit="return confirm('Delete this leave record?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm text-danger border-0 bg-transparent">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">You haven't submitted any leave requests yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>