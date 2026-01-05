<x-app-layout>
    <style>
        :root {
            --brand-emerald: #10b981;
            --brand-light-green: #ecfdf5;
            --sidebar-dark: #0f172a;
            --bg-canvas: #f8fafc;
        }

        body { 
            background-color: var(--bg-canvas); 
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #1e293b;
        }

        /* Hero Header */
        .dashboard-hero {
            background: linear-gradient(135deg, var(--sidebar-dark) 0%, #1e293b 100%);
            padding: 3rem 0 6rem 0;
            color: white;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            margin-bottom: -4rem;
        }

        /* Card Styling */
        .stunning-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .stunning-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .stunning-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 4px;
            background: var(--brand-emerald);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .stunning-card:hover::before { opacity: 1; }

        /* Icon Wrapper */
        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            background: var(--brand-light-green);
            color: var(--brand-emerald);
        }

        .metric-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .metric-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--sidebar-dark);
            margin: 0.25rem 0;
        }

        /* Analytics Surface */
        .chart-surface {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        /* Stretched Link to make whole card clickable */
        .stretched-link::after {
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            z-index: 1;
            content: "";
        }

        /* Footer Styling */
        .dashboard-footer {
            margin-top: 4rem;
            padding: 2rem 0;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .dashboard-hero { padding: 2rem 0 5rem 0; border-radius: 0; }
            .metric-value { font-size: 1.75rem; }
        }
    </style>

    <div class="dashboard-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h1 class="display-6 fw-bold mb-2">Welcome Back, {{ Auth::user()->name }} 👋</h1>
                    <p class="opacity-75 lead mb-0">Manage your team and system settings efficiently.</p>
                </div>
                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                    <div class="d-flex justify-content-md-end gap-2">
                        <a href="{{ route('employer.profile.show') }}" class="btn btn-outline-light rounded-pill px-4 shadow-sm">My Account</a>
                        <a href="{{ route('employer.employees.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm" style="background-color: var(--brand-emerald); border:none;">+ New Hire</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: -2rem;">
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="stunning-card p-4">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                        </svg>
                    </div>
                    <div class="metric-title">Total Staff</div>
                    <div class="metric-value">{{ $employeeCount }}</div>
                    <div class="text-success small fw-bold">Active Directory &rarr;</div>
                    <a href="{{ route('employer.employees.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stunning-card p-4">
                    <div class="icon-box" style="background: #fff1f2; color: #e11d48;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                        </svg>
                    </div>
                    <div class="metric-title">Leave Requests</div>
                    <div class="metric-value">Pending</div>
                    <div class="text-danger small fw-bold">Manage Approvals &rarr;</div>
                    <a href="{{ route('employer.leaves.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stunning-card p-4">
                    <div class="icon-box" style="background: #fef3c7; color: #d97706;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z"/>
                        </svg>
                    </div>
                    <div class="metric-title">New Hires</div>
                    <div class="metric-value">{{ $newHiresCount }}</div>
                    <div class="text-warning small fw-bold">Last 30 Days &rarr;</div>
                    <a href="{{ route('employer.employees.index') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stunning-card p-4">
                    <div class="icon-box" style="background: #f3e8ff; color: #9333ea;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5z"/>
                        </svg>
                    </div>
                    <div class="metric-title">Security</div>
                    <div class="metric-value">Edit</div>
                    <div class="text-purple small fw-bold">Password & Email &rarr;</div>
                    <a href="{{ route('employer.profile.edit') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <div class="row g-4 pb-5">
            <div class="col-lg-8">
                <div class="chart-surface h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold m-0">Personnel Distribution</h5>
                        <span class="badge bg-light text-dark border p-2 fw-semibold shadow-sm">Live Ratio</span>
                    </div>
                    <div style="height: 350px; position: relative;" class="d-flex justify-content-center">
                        <canvas id="personnelPieChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="chart-surface h-100 bg-white">
                    <h5 class="fw-bold mb-4">System Summary</h5>
                    
                    <div class="p-3 bg-light rounded-3 mb-3 d-flex justify-content-between align-items-center">
                        <span class="text-muted small fw-bold">Active Employees</span>
                        <span class="badge rounded-pill bg-success px-3">{{ $employeeCount }}</span>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-3 d-flex justify-content-between align-items-center">
                        <span class="text-muted small fw-bold">Admin Accounts</span>
                        <span class="badge rounded-pill bg-dark px-3">{{ $employerCount }}</span>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-4 d-flex justify-content-between align-items-center">
                        <span class="text-muted small fw-bold">New This Month</span>
                        <span class="badge rounded-pill bg-primary px-3">{{ $newHiresCount }}</span>
                    </div>

                    <div class="border-top pt-4">
                        <h6 class="fw-bold mb-3">Quick Actions</h6>
                        <a href="{{ route('employer.employees.create') }}" class="btn btn-sm btn-outline-success w-100 mb-2 py-2">Add New Employee</a>
                        <a href="{{ route('employer.employees.index') }}" class="btn btn-sm btn-outline-dark w-100 mb-2 py-2">View Full Directory</a>
                        <a href="{{ route('employer.leaves.index') }}" class="btn btn-sm btn-info text-white w-100 mb-2 py-2">Manage Leave Requests</a>
                        <a href="{{ route('notices.index') }}" class="btn btn-sm btn-dark w-100 py-2">Post Announcement</a>
                    </div>
                </div>
            </div>
        </div>

        <footer class="dashboard-footer text-center">
            <div class="container">
                <p class="mb-1 fw-bold text-dark">Management SYS</p>
                <p class="small mb-0">&copy; {{ date('Y') }} All Rights Reserved. Built for secure workforce management.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('personnelPieChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Staff Employees', 'Administrators'],
                    datasets: [{
                        data: [{{ $employeeCount }}, {{ $employerCount }}],
                        backgroundColor: [
                            '#10b981', // Emerald Green
                            '#0f172a'  // Sidebar Navy
                        ],
                        hoverOffset: 25,
                        borderWidth: 6,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 30,
                                usePointStyle: true,
                                font: {
                                    size: 14,
                                    weight: '600',
                                    family: "'Inter', sans-serif"
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 12,
                            titleFont: { size: 14 },
                            bodyFont: { size: 13 },
                            cornerRadius: 8,
                            displayColors: true
                        }
                    },
                    layout: {
                        padding: 10
                    }
                }
            });
        });
    </script>
</x-app-layout>