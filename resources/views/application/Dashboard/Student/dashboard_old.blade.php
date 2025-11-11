@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')
    <!-- Include Bootstrap 5 Icons and SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('reg_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('reg_success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <div class="container-fluid py-4">
        <!-- Collapsible Welcome Banner -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 text-primary fw-bold">Welcome, {{ auth()->guard('web')->user()->name }}!</h3>
                        <div>
                            <button class="btn btn-sm btn-outline-secondary me-2" type="button" data-bs-toggle="collapse"
                                data-bs-target="#welcomeContent" aria-expanded="true" aria-controls="welcomeContent">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <button id="closeWelcomeBanner" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse show" id="welcomeContent">
                        <div class="card-body p-4 pt-0">
                            <p class="text-muted">
                                This is the dashboard from where you can see the status and updates of your services and
                                manage your activities.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <!-- Total Request Card -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body position-relative">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted mb-1 text-uppercase small">Total Request</h6>
                                <h3 class="mb-2">{{ $total_request }}</h3>
                                <p class="mb-0 text-success small">
                                    <i class="bi bi-arrow-up"></i>
                                    <span>Recent activity</span>
                                </p>
                            </div>
                            <div
                                class="bg-info bg-opacity-10 rounded-circle p-3 d-flex align-items-center justify-content-center">
                                <i class="bi bi-bell-fill text-info fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Complete Request Card -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body position-relative">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted mb-1 text-uppercase small">Complete Request</h6>
                                <h3 class="mb-2">{{ $complete_request }}</h3>
                                <p class="mb-0 text-success small">
                                    <i class="bi bi-arrow-up"></i>
                                    <span>Recent completions</span>
                                </p>
                            </div>
                            <div
                                class="bg-success bg-opacity-10 rounded-circle p-3 d-flex align-items-center justify-content-center">
                                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Consultants Card -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body position-relative">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted mb-1 text-uppercase small">Total Consultants Available</h6>
                                <h3 class="mb-2">{{ $total_consultants }}</h3>
                                <p class="mb-0 text-success small">
                                    <i class="bi bi-arrow-up"></i>
                                    <span>Active consultants</span>
                                </p>
                            </div>
                            <div
                                class="bg-warning bg-opacity-10 rounded-circle p-3 d-flex align-items-center justify-content-center">
                                <i class="bi bi-chat-left-text-fill text-warning fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row g-3">
            <!-- Your Activities Section -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3 d-flex align-items-center">
                            <i class="bi bi-activity text-primary me-2"></i>Your Activities
                        </h5>
                        <div class="list-group">
                            <a href="{{ route('student.choice') }}"
                                class="list-group-item list-group-item-action border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                        <i class="bi bi-list text-primary"></i>
                                    </div>
                                    <span>Create Your Choice</span>
                                </div>
                            </a>
                            <a href="{{ route('student.assessment.all-request') }}"
                                class="list-group-item list-group-item-action border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded p-2 me-3">
                                        <i class="bi bi-layers text-success"></i>
                                    </div>
                                    <span>See All Assessments</span>
                                </div>
                            </a>
                            {{-- <a href="{{route('consultant.assessment.all-request',  ['status' => 'pending'])  }}" class="list-group-item list-group-item-action border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 rounded p-2 me-3">
                                        <i class="bi bi-mortarboard text-warning"></i>
                                    </div>
                                    <span>Pending Services</span>
                                </div>
                            </a>
                            <a href="{{route('consultant.assessment.all-request',  ['status' => 'completed'])  }}" class="list-group-item list-group-item-action border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info bg-opacity-10 rounded p-2 me-3">
                                        <i class="bi bi-check-all text-info"></i>
                                    </div>
                                    <span>Completed Services</span>
                                </div>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Management Section -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3 d-flex align-items-center">
                            <i class="bi bi-person-circle text-primary me-2"></i>Profile Management
                        </h5>
                        <div class="list-group">
                            <a href="{{ route('profile.edit') }}"
                                class="list-group-item list-group-item-action border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                        <i class="bi bi-person text-primary"></i>
                                    </div>
                                    <span>Profile Manage</span>
                                </div>
                            </a>
                            {{-- <a href="{{ route('consultant.transaction.details') }}" class="list-group-item list-group-item-action border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded p-2 me-3">
                                        <i class="bi bi-bank text-success"></i>
                                    </div>
                                    <span>Bank Account Manage</span>
                                </div>
                            </a> --}}
                            <a href="{{ route('student.transaction.cash-in') }}"
                                class="list-group-item list-group-item-action border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info bg-opacity-10 rounded p-2 me-3">
                                        <i class="bi bi-currency-exchange text-info"></i>
                                    </div>
                                    <span>Transaction History</span>
                                </div>
                            </a>
                            {{-- <a href="{{ route('password.update') }}" class="list-group-item list-group-item-action border-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 rounded p-2 me-3">
                                        <i class="bi bi-key text-warning"></i>
                                    <span>Change Password</span>
                                </div>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Section -->
    {{-- <div class="row g-3 mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3 d-flex align-items-center">
                            <i class="bi bi-lightning-charge text-primary me-2"></i>Quick Access
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <a href="{{route('consultant.assessment.all-request', ['status' => 'new'])}}" class="text-decoration-none">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body text-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3">
                                                <i class="bi bi-bell text-primary fs-4"></i>
                                            </div>
                                            <h6 class="mb-0">New Requests</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('consultant.services.create') }}" class="text-decoration-none">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body text-center">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3">
                                                <i class="bi bi-plus-circle text-success fs-4"></i>
                                            </div>
                                            <h6 class="mb-0">Add New Service</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('consultant.education.index') }}" class="text-decoration-none">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body text-center">
                                            <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3">
                                                <i class="bi bi-mortarboard text-info fs-4"></i>
                                            </div>
                                            <h6 class="mb-0">Update Education</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('consultant.experience.index') }}" class="text-decoration-none">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body text-center">
                                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3">
                                                <i class="bi bi-briefcase text-warning fs-4"></i>
                                            </div>
                                            <h6 class="mb-0">Update Experience</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection

@push('script')
    <script>
        // Store the closed state with an expiration timestamp (e.g., 7 days from now)
        document.getElementById('closeWelcomeBanner').addEventListener('click', function() {
            const welcomeBanner = this.closest('.row');
            welcomeBanner.style.transition = 'opacity 0.3s';
            welcomeBanner.style.opacity = '0';

            setTimeout(function() {
                welcomeBanner.style.display = 'none';

                // Current time plus 7 days in milliseconds
                const expirationTime = Date.now() + (5000); //for development
                // const expirationTime = Date.now() + ( 7 * 24 * 60 * 60 * 1000); //for production

                // Store both the state and expiration time
                localStorage.setItem('welcomeBannerClosed', JSON.stringify({
                    closed: true,
                    expiresAt: expirationTime
                }));
            }, 300);
        });

        // Check if banner was previously closed and if the setting hasn't expired
        document.addEventListener('DOMContentLoaded', function() {
            const storedData = localStorage.getItem('welcomeBannerClosed');

            if (storedData) {
                try {
                    const data = JSON.parse(storedData);
                    const currentTime = Date.now();

                    // If stored data exists and hasn't expired yet
                    if (data.closed && data.expiresAt > currentTime) {
                        document.querySelector('.row.mb-4').style.display = 'none';
                    } else {
                        // If expired, remove the item from localStorage
                        localStorage.removeItem('welcomeBannerClosed');
                    }
                } catch (e) {
                    // Handle parsing errors if any
                    localStorage.removeItem('welcomeBannerClosed');
                }
            }
        });
    </script>
@endpush
