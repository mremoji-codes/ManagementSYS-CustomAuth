<x-app-layout>
    <style>
        :root {
            --brand-emerald: #10b981;
            --brand-dark: #0f172a;
        }

        .profile-header-bg {
            background: linear-gradient(135deg, var(--brand-dark) 0%, #1e293b 100%);
            height: 120px;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .profile-card {
            margin-top: -60px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .info-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #64748b;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--brand-dark);
        }

        .status-badge {
            background-color: #ecfdf5;
            color: #059669;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.5rem 1rem;
            border-radius: 50px;
        }
    </style>

    <div class="profile-header-bg">
        <div class="container d-flex justify-content-between align-items-center pt-4">
            <h2 class="h4 text-white fw-bold mb-0">Account Settings</h2>
            <a href="{{ route('employer.dashboard') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
                &larr; Back to Dashboard
            </a>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card profile-card">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex justify-content-between align-items-start mb-5">
                            <div>
                                <h3 class="fw-extrabold text-dark mb-1">Employer Account Details</h3>
                                <p class="text-muted small">Manage your personal identification and system role.</p>
                            </div>
                            <span class="status-badge">
                                <i class="bi bi-check-circle-fill me-1"></i> Active Account
                            </span>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-success">
                                    <div class="info-label mb-1">Full Name</div>
                                    <div class="info-value">{{ $employer->name }}</div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                                    <div class="info-label mb-1">Email Address</div>
                                    <div class="info-value">{{ $employer->email }}</div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-dark">
                                    <div class="info-label mb-1">System Role</div>
                                    <div class="info-value">Employer / Administrator</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-top">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <a href="{{ route('employer.profile.edit') }}" class="btn btn-success px-5 py-2 fw-bold rounded-pill shadow-sm" style="background-color: var(--brand-emerald); border: none;">
                                    Edit Profile Information
                                </a>
                            </div>
                            <p class="mt-3 text-muted small">
                                <i class="bi bi-info-circle me-1"></i> To ensure security, some roles can only be changed by the System Owner.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-white border rounded-3 d-flex align-items-center shadow-sm">
                    <div class="bg-light rounded-circle p-2 me-3 text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                            <path d="M5.338 1.59a.5.5 0 0 1 .424.039l6 3.5a.5.5 0 0 1 .162.674l-3.99 6.84a.5.5 0 0 1-.706.175l-6-3.5a.5.5 0 0 1-.162-.674l3.99-6.84a.5.5 0 0 1 .282-.214zM7 3.033v3.136l1.246-.727L7 3.033z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-0 fw-bold small">Need to update your password?</p>
                        <a href="{{ route('employer.profile.edit') }}" class="small text-decoration-none">Go to Security Settings &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>