<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header py-3" style="background-color: #059669; color: white; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                        <h4 class="mb-0 fs-5 fw-bold">
                            <i class="fas fa-calendar-plus me-2"></i>Request Leave
                        </h4>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-white" style="border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
                        <form action="{{ route('employee.leave.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">Leave Type</label>
                                <select name="leave_type" class="form-select @error('leave_type') is-invalid @enderror">
                                    <option value="">Select Type</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Vacation">Vacation</option>
                                    <option value="Personal">Personal Leave</option>
                                    <option value="Maternity/Paternity">Maternity/Paternity</option>
                                </select>
                                @error('leave_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold text-dark">Start Date</label>
                                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror">
                                    @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold text-dark">End Date</label>
                                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror">
                                    @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">Reason for Leave</label>
                                <textarea name="reason" rows="4" class="form-control @error('reason') is-invalid @enderror" placeholder="Briefly describe why you are requesting leave..."></textarea>
                                @error('reason') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <a href="{{ route('employee.dashboard') }}" class="btn btn-outline-secondary px-4">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-success px-5 shadow-sm" style="background-color: #059669; border: none;">
                                    Submit Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>