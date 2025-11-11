@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Assessment Details')
@section('breadcrumb', 'Request Details')
@section('previous-menu', 'Assessment')
@section('active-menu', 'Details')
@section('master-content')
    <div class="container-fluid py-4">
        <!-- Header with Badge -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                    <i class="fa-solid fa-file-circle-check fa-2x"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">Assessment Request Details</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Assessments</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Status Badge -->
            <span class="badge rounded-pill fs-6 py-2 px-3
                {{ $assessment->status == 'Accepted' ? 'bg-info text-dark' : '' }}
                {{ $assessment->status == 'Completed' ? 'bg-success' : '' }}
                {{ $assessment->status == 'Pending' ? 'bg-warning text-dark' : '' }}
                {{ $assessment->status == 'Rejected' ? 'bg-danger' : '' }}">
                <i class="fas fa-circle me-1 small"></i> {{ $assessment->status ?? 'Pending' }}
            </span>
        </div>

        <!-- Overview Cards -->
        <div class="row g-4 mb-5">
            <!-- Student Information Card -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header border-bottom pt-4 pb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                                <i class="fa-solid fa-user-graduate"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-0">Student Information</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Full Name</label>
                                    <p class="fw-medium mb-0">{{ $assessment->student->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Email Address</label>
                                    <p class="fw-medium mb-0">{{ $assessment->student->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Phone Number</label>
                                    <p class="fw-medium mb-0">{{ $assessment->student->phone ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Date of Birth</label>
                                    <p class="fw-medium mb-0">
                                        {{ $assessment->student->date_of_birth ? \Carbon\Carbon::parse($assessment->student->date_of_birth)->format('d M Y') : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small mb-1">Nationality</label>
                                    <p class="fw-medium mb-0">{{ $assessment->student->nationality ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small mb-1">Age</label>
                                    <p class="fw-medium mb-0">{{ $assessment->student->date_of_birth ? \Carbon\Carbon::parse($assessment->student->date_of_birth)->age . ' years' : 'N/A' }}
</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assessment Details Card -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header border-bottom pt-4 pb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                                <i class="fa-solid fa-clipboard-list"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-0">Assessment Details</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Required Service</label>

                                    <div class="mt-1 mb-3 flex flex-wrap gap-2">
                                        @foreach(array_slice(json_decode($assessment->assessment_service_name), 0, 5) as $subject)
                                            <span class="text-black bg-primary-gray px-2 py-1 rounded text-[14px]">
                                                {{ $subject }}{{ !$loop->last ? : '' }}
                                            </span>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Assessment Title</label>
                                    <p class="fw-medium mb-0">{{ $assessment->assessment_title ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Preferred Country</label>
                                    <p class="fw-medium mb-0">{{ $assessment->preferred_country ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small mb-1">Preferred Subject</label>
                                    <p class="fw-medium mb-0">{{ $assessment->preferred_subject ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Qualifications Section -->
        <div class="card border-0 shadow-sm mb-5">
            <div class="card-header border-bottom pt-4 pb-3">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px;">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-0">Academic Qualifications</h5>
                </div>
            </div>
            <div class="card-body">
                @if ($assessment->student->studentInfo)
                    <div class="row g-4">
                        <!-- Primary Education -->
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-header bg-light py-3">
                                    <h6 class="fw-bold mb-0">Primary Education</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        @if ($assessment->student->studentInfo->academic_type)
                                            <div class="col-12">
                                                <label class="form-label text-muted small mb-1">Academic System</label>
                                                <p class="fw-medium mb-0">{{ ucfirst($assessment->student->studentInfo->academic_type) }}</p>
                                            </div>
                                        @endif

                                        @if ($assessment->student->studentInfo->ssc_result)
                                            <div class="col-12">
                                                <label class="form-label text-muted small mb-1">SSC/Equivalent</label>
                                                <p class="fw-medium mb-0">
                                                    {{ $assessment->student->studentInfo->ssc_result }}
                                                    @if ($assessment->student->studentInfo->ssc_certificate)
                                                        <span class="badge bg-success bg-opacity-10 text-success small ms-2">
                                                            <i class="fa-solid fa-check-circle me-1"></i>Certificate provided
                                                        </span>
                                                    @endif
                                                </p>
                                            </div>
                                        @endif

                                        @if ($assessment->student->studentInfo->hsc_result)
                                            <div class="col-12">
                                                <label class="form-label text-muted small mb-1">HSC/Equivalent</label>
                                                <p class="fw-medium mb-0">
                                                    {{ $assessment->student->studentInfo->hsc_result }}
                                                    @if ($assessment->student->studentInfo->hsc_certificate)
                                                        <span class="badge bg-success bg-opacity-10 text-success small ms-2">
                                                            <i class="fa-solid fa-check-circle me-1"></i>Certificate provided
                                                        </span>
                                                    @endif
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Qualifications -->
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-header bg-light py-3">
                                    <h6 class="fw-bold mb-0">Additional Qualifications</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        @if ($assessment->student->studentInfo->ielts_score)
                                            <div class="col-12">
                                                <label class="form-label text-muted small mb-1">IELTS Score</label>
                                                <p class="fw-medium mb-0">
                                                    {{ $assessment->student->studentInfo->ielts_score }}
                                                    @if ($assessment->student->studentInfo->ielts_certificate)
                                                        <span class="badge bg-success bg-opacity-10 text-success small ms-2">
                                                            <i class="fa-solid fa-check-circle me-1"></i>Certificate provided
                                                        </span>
                                                    @endif
                                                </p>
                                            </div>
                                        @endif

                                        @if ($assessment->student->studentInfo->last_edu_title)
                                            <div class="col-12">
                                                <label class="form-label text-muted small mb-1">Last Education</label>
                                                <div class="bg-light p-3 rounded">
                                                    <h6 class="fw-bold mb-2">{{ $assessment->student->studentInfo->last_edu_title }}</h6>
                                                    <h7 class="fw-bold mb-2">{{ $assessment->student->studentInfo->last_edu_department }}</h7>
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <div>
                                                            <small class="text-muted">Result:</small>
                                                            <span class="ms-1">{{ $assessment->student->studentInfo->last_edu_result ?? 'N/A' }}</span>
                                                        </div>

                                                        @if ($assessment->student->studentInfo->last_edu_startDate && $assessment->student->studentInfo->last_edu_endDate)
                                                            <div>
                                                                <small class="text-muted">Duration:</small>
                                                                <span class="ms-1">
                                                                    {{ \Carbon\Carbon::parse($assessment->student->studentInfo->last_edu_startDate)->format('M Y') }}
                                                                    -
                                                                    {{ \Carbon\Carbon::parse($assessment->student->studentInfo->last_edu_endDate)->format('M Y') }}
                                                                </span>
                                                            </div>
                                                        @elseif($assessment->student->studentInfo->last_edu_Duration)
                                                            <div>
                                                                <small class="text-muted">Duration:</small>
                                                                <span class="ms-1">{{ $assessment->student->studentInfo->last_edu_Duration }}</span>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    @if ($assessment->student->studentInfo->last_edu_certificate)
                                                        <div class="mt-2">
                                                            <span class="badge bg-success bg-opacity-10 text-success">
                                                                <i class="fa-solid fa-check-circle me-1"></i>Certificate provided
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger d-flex align-items-center p-4" role="alert">
                        <i class="fa-solid fa-triangle-exclamation fa-lg me-3"></i>
                        <div>No academic information available for this student.</div>
                    </div>
                @endif
            </div>
        </div>


        @php
            // Make sure this runs where $assessment is available (e.g. inside the loop)
            $services = $assessment->assessment_service_name;

            // If it's not already an array, try to decode JSON; fallback to empty array
            if (!is_array($services)) {
                $services = $services ? json_decode($services, true) : [];
                if (!is_array($services)) {
                    $services = [];
                }
            }
        @endphp

        <!-- Action Buttons -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2 justify-content-end">
                    @if ($assessment->status == 'Pending')
                        <form action="{{ route('consultant.assessment.status') }}" method="POST" id="accept-form-{{ $assessment->id }}">
                            @csrf
                            <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
                            <input type="hidden" name="status" value="Accepted">
                            <button type="submit" class="btn btn-primary px-4 py-2 show_confirm">
                                <i class="fas fa-check-circle me-2"></i> Accept Request
                            </button>
                        </form>

                        <form action="{{ route('consultant.assessment.status') }}" method="POST" id="reject-form-{{ $assessment->id }}">
                            @csrf
                            <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
                            <input type="hidden" name="status" value="Rejected">
                            <button type="submit" class="btn btn-outline-danger px-4 py-2 show_reject_confirm">
                                <i class="fas fa-times-circle me-2"></i> Reject Request
                            </button>
                        </form>

                    @elseif ($assessment->status == 'Accepted' && in_array('Assessment', $services))
                        <a href="{{ route('consultant.assessment.report.create', $assessment->id) }}" class="btn btn-success px-4 py-2">
                            <i class="fas fa-file-alt me-2"></i> Prepare Assessment Report
                        </a>
                    @elseif ($assessment->status == 'Accepted' && in_array('Feature Processing', $services))
                        <a href="{{ route('consultant.assessment.report.create', $assessment->id) }}" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-eye me-2"></i> View Full Report
                        </a>
                    @elseif ($assessment->status == 'Accepted' && !in_array('Assessment', $services))
                        <a href="mailto:{{ $assessment->student->email }}" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-envelope me-2"></i> Contact Student
                        </a>
                    @elseif ($assessment->status == 'Rejected')
                        <form action="{{ route('consultant.assessment.status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
                            <input type="hidden" name="status" value="Accepted">
                            <button type="submit" class="btn btn-primary px-4 py-2 show_confirm">
                                <i class="fas fa-check-circle me-2"></i> Accept Request Again
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");

            Swal.fire({
                title: "Confirm Acceptance",
                text: "Are you sure you want to accept this assessment request? You will be responsible for completing the assessment process.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Accept",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        $('.show_reject_confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");

            Swal.fire({
                title: "Confirm Reject",
                text: "Are you sure you want to reject this assessment request?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Reject",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
