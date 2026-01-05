<x-app-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">Employee Leave Requests</h2>
            <a href="{{ route('employer.dashboard') }}" class="btn btn-outline-secondary btn-sm">Back to Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0 rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Employee</th>
                            <th>Type</th>
                            <th>Duration</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaves as $leave)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">{{ $leave->user->name }}</div>
                                <small class="text-muted">{{ $leave->user->position }}</small>
                            </td>
                            <td><span class="badge bg-info text-dark">{{ $leave->leave_type }}</span></td>
                            <td>
                                <small>{{ $leave->start_date }} to {{ $leave->end_date }}</small>
                            </td>
                            <td>
                                <small class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $leave->reason }}">
                                    {{ $leave->reason }}
                                </small>
                            </td>
                            <td>
                                @if($leave->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($leave->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                @if($leave->status == 'pending')
                                    <form action="{{ route('employer.leaves.updateStatus', $leave->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('employer.leaves.updateStatus', $leave->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="btn btn-sm btn-outline-danger">Reject</button>
                                    </form>
                                @else
                                    <span class="text-muted small">Processed</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No leave requests found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>