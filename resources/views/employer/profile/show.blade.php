<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <h2 class="h4 font-weight-bold text-dark mb-0">
                {{ __('My Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="h4 fw-bold text-dark mb-4 pb-3 border-bottom">
                                Employer Account Details
                            </h2>

                            <div class="d-grid gap-4">
                                
                                <div>
                                    <p class="text-sm text-uppercase text-muted mb-1">Full Name</p>
                                    <p class="h5 text-dark fw-semibold">{{ $employer->name }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-uppercase text-muted mb-1">Email Address</p>
                                    <p class="h5 text-dark fw-semibold">{{ $employer->email }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-uppercase text-muted mb-1">Role</p>
                                    <p class="h5 text-dark fw-semibold">Employer</p>
                                </div>

                                <div>
                                    <p class="text-sm text-uppercase text-muted mb-1">Status</p>
                                    <span class="badge rounded-pill bg-success-subtle text-success py-2 px-3">
                                        <svg class="bi me-1" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M10.975 4.985a2.5 2.5 0 0 0-3.328 3.515l-.234-.234L8.7 10l-.234-.234a2.5 2.5 0 0 0 3.515-3.328l-.707-.707zM10.742 4l-4 4-2.5-2.5a.5.5 0 1 1 .707-.707L6.5 7.293l3.293-3.293a.5.5 0 1 1 .707.707z"/>
                                        </svg>
                                        Active
                                    </span>
                                </div>

                            </div>
                            
                            {{-- Optional: Add Edit Button --}}
                            <div class="pt-4 border-top mt-5">
                                <a href="#" class="btn btn-outline-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>