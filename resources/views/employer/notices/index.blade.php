<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold">Notice Management Board</h2>
                    <a href="{{ route('employer.dashboard') }}" class="btn btn-outline-secondary rounded-pill">Back to Dashboard</a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-bullhorn me-2 text-success"></i>Create New Notice</h5>
                    <form action="{{ route('notices.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">Title</label>
                            <input type="text" name="title" class="form-control bg-light border-0" placeholder="Notice Title..." required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">Details</label>
                            <textarea name="content" class="form-control bg-light border-0" rows="4" placeholder="Announcement details..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted">Priority Level</label>
                            <select name="priority" class="form-select bg-light border-0">
                                <option value="low">Low Priority</option>
                                <option value="medium" selected>Medium Priority</option>
                                <option value="high">High Priority</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 fw-bold py-2">Post Announcement</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h5 class="fw-bold mb-4">Current Announcements</h5>
                    
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @forelse($notices as $notice)
                        <div class="p-3 rounded-3 mb-3 border-start border-4 {{ $notice->priority == 'high' ? 'border-danger bg-light' : ($notice->priority == 'medium' ? 'border-warning bg-light' : 'border-primary bg-light') }}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $notice->title }}</h6>
                                    <p class="small text-secondary mb-1">{{ $notice->content }}</p>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        Posted: {{ $notice->created_at->format('M d, Y • h:i A') }}
                                    </small>
                                </div>
                                
                                <form action="{{ route('notices.destroy', $notice->id) }}" method="POST" onsubmit="return confirm('Permanently delete this announcement?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No notices have been posted yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>