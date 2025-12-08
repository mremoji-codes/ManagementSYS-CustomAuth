<x-app-layout>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3 p-4 p-md-5">

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h2 class="h3 fw-bold text-dark text-center text-sm-start mb-3 mb-sm-0">Employee Directory</h2>

                <div class="d-flex flex-wrap justify-content-center justify-content-sm-end gap-3">
                    
                    <a href="{{ route('employer.dashboard') }}"
                       class="btn btn-outline-secondary d-flex align-items-center transition-shadow">
                        <svg class="bi me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('employer.employees.create') }}"
                       class="btn btn-primary d-flex align-items-center shadow-sm transition-shadow">
                        <svg class="bi me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                        Add New Employee
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <strong class="fw-bold">Success!</strong>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive rounded-3 border shadow-sm">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-start text-uppercase text-primary">#</th>
                            <th scope="col" class="px-3 py-3 text-start text-uppercase text-primary">Full Name</th>
                            <th scope="col" class="px-3 py-3 text-start text-uppercase text-primary">Email</th>
                            <th scope="col" class="px-3 py-3 text-start text-uppercase text-primary">Phone</th>
                            <th scope="col" class="px-3 py-3 text-start text-uppercase text-primary d-none d-sm-table-cell">Age</th>
                            <th scope="col" class="px-3 py-3 text-start text-uppercase text-primary d-none d-lg-table-cell">Date of Birth</th>
                            <th scope="col" class="px-3 py-3 text-start text-uppercase text-primary d-none d-sm-table-cell">Sex</th>
                            <th scope="col" class="px-3 py-3 text-start text-uppercase text-primary">Job Title</th>
                            <th scope="col" class="px-3 py-3 text-start text-uppercase text-primary d-none d-lg-table-cell">Salary (GHC)</th>
                            <th scope="col" class="px-3 py-3 text-start text-uppercase text-primary d-none d-md-table-cell">Date Started</th>
                            <th scope="col" class="px-3 py-3 text-center text-uppercase text-primary">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($employees as $index => $employee)
                            <tr class="align-middle">
                                <td class="px-3 py-3">{{ $index + 1 }}</td>
                                <td class="px-3 py-3 fw-semibold text-dark">{{ $employee->name ?? '—' }}</td>
                                <td class="px-3 py-3 text-muted">{{ $employee->email ?? '—' }}</td>
                                <td class="px-3 py-3 text-muted">{{ $employee->mobile ?? '—' }}</td>
                                <td class="px-3 py-3 text-muted d-none d-sm-table-cell">{{ $employee->age ?? '—' }}</td>
                                <td class="px-3 py-3 text-muted d-none d-lg-table-cell">
                                    {{ $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('d M, Y') : '—' }}
                                </td>
                                <td class="px-3 py-3 text-muted text-capitalize d-none d-sm-table-cell">{{ $employee->sex ?? '—' }}</td>
                                <td class="px-3 py-3 text-muted">{{ $employee->position ?? '—' }}</td>
                                <td class="px-3 py-3 text-dark font-monospace d-none d-lg-table-cell">
                                    {{ $employee->salary ? 'GHC ' . number_format($employee->salary, 2) : '—' }}
                                </td>
                                <td class="px-3 py-3 text-muted d-none d-md-table-cell">
                                    {{ $employee->date_started ? \Carbon\Carbon::parse($employee->date_started)->format('d M, Y') : '—' }}
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('employer.employees.edit', $employee->id) }}"
                                           class="btn btn-sm btn-warning text-white rounded-circle p-2"
                                           title="Edit Employee Details">
                                            <svg class="bi" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M.052 13.568L0 13.5v2.948a.5.5 0 0 0 .5.5h2.948a.5.5 0 0 0 .354-.146L14.717 5.753a.5.5 0 0 0 0-.707L10.395.748a.5.5 0 0 0-.707 0L.198 13.214a.5.5 0 0 0-.146.354zM2 14.5l10.5-10.5 2 2-10.5 10.5-2 0z"/>
                                            </svg>
                                        </a>

                                        <form method="POST"
                                              action="{{ route('employer.employees.destroy', $employee->id) }}"
                                              onsubmit="return confirm('Are you sure you want to delete {{ $employee->name ?? $employee->email }}? This action is permanent.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger rounded-circle p-2"
                                                    title="Delete Employee">
                                                <svg class="bi" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4h-.118A2 2 0 0 1 11 2.5V2H5v.5A2 2 0 0 1 4.118 4z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-5 text-muted bg-light border-top">
                                    😔 No employee records found. Start by clicking "**Add New Employee**".
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>