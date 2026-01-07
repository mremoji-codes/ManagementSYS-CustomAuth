<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Company Announcements - ManagementSYS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/m_logo.svg') }}?v=1">

    <style>
        body { background-color: #f8f9fa; }
        .notice-card {
            border-left: 6px solid;
            transition: all 0.3s ease;
        }
        .notice-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        /* Priority Colors to match Dashboard */
        .border-priority-high { border-left-color: #dc3545; }
        .border-priority-medium { border-left-color: #ffc107; }
        .border-priority-low { border-left-color: #0dcaf0; }
        
        .pagination { margin-bottom: 0; }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white border-bottom shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">ManagementSYS</span>
            <div class="d-flex align-items-center">
                <a href="{{ route('employee.dashboard') }}" class="btn btn-outline-secondary btn-sm me-2">
                    <i class="fas fa-arrow-left me-1"></i> Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="fw-bold text-dark mb-1">Company Announcements</h1>
                        <p class="text-secondary">Stay updated with the latest news and notices from management.</p>
                    </div>
                </div>

                @forelse($notices as $notice)
                    <div class="card border-0 shadow-sm rounded-4 mb-4 notice-card border-priority-{{ $notice->priority }}">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h4 class="fw-bold text-dark mb-1">{{ $notice->title }}</h4>
                                    <span class="badge bg-light text-secondary border">
                                        <i class="far fa-calendar-alt me-1"></i> 
                                        {{ $notice->created_at->format('M d, Y') }} ({{ $notice->created_at->diffForHumans() }})
                                    </span>
                                </div>
                                @if($notice->priority == 'high')
                                    <span class="badge bg-danger">Urgent</span>
                                @endif
                            </div>
                            
                            <div class="text-secondary lh-lg" style="white-space: pre-line;">
                                {{ $notice->content }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                        <div class="mb-3">
                            <i class="fas fa-bullhorn fa-3x text-light"></i>
                        </div>
                        <h5 class="text-secondary">No announcements found at this time.</h5>
                        <p class="text-muted">Check back later for updates from your employer.</p>
                    </div>
                @endforelse

                <div class="d-flex justify-content-center mt-5">
                    {{ $notices->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>