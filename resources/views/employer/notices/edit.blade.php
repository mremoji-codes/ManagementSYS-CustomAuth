<x-app-layout>
    <div class="container py-5">
        {{-- SUCCESS TOAST NOTIFICATION --}}
        @if(session('success'))
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
                <div class="toast show align-items-center text-white bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <script>
                setTimeout(() => {
                    const toastElement = document.querySelector('.toast');
                    if(toastElement) toastElement.classList.remove('show');
                }, 3000);
            </script>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h4 class="mb-0 fw-bold text-dark">Edit Announcement</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('employer.notices.update', $notice->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Title</label>
                                <input type="text" name="title" class="form-control bg-light border-0" value="{{ $notice->title }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Priority Level</label>
                                <select name="priority" class="form-select bg-light border-0">
                                    <option value="low" {{ $notice->priority == 'low' ? 'selected' : '' }}>Low (Blue)</option>
                                    <option value="medium" {{ $notice->priority == 'medium' ? 'selected' : '' }}>Medium (Yellow)</option>
                                    <option value="high" {{ $notice->priority == 'high' ? 'selected' : '' }}>High (Red)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Announcement Content</label>
                                <textarea name="content" class="form-control bg-light border-0" rows="5" required>{{ $notice->content }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between pt-3">
                                <a href="{{ route('employer.notices.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                                <button type="submit" class="btn btn-dark rounded-pill px-4">Update Announcement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>