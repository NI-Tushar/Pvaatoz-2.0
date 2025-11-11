@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('breadcrumb', 'Select Your Consultants')
@section('previous-menu', 'Request')
@section('active-menu', 'Select Consultants')
@push('css')
    <style>
        .product-card {
            border-radius: 10px;
            overflow: hidden;
            transition: 0.3s;
        }

        .product-card:hover {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .product-image {
            height: 200px;
            object-fit: cover;
        }

        .verified-badge {
            color: #0d6efd;
        }
    </style>
@endpush
@section('master-content')

    <div class="card p-3">

        <div class="row justify-content-center">

            @foreach ($consultants as $consultant)
                <div class="col-md-3">
                    <div class="card product-card">
                        <!-- Product Image -->
                        <div class="position-relative">
                            <img src="{{ asset($consultant->image ?? 'avatar.png') }}" class="card-img-top product-image"
                                alt="Product Image">
                            @if ($consultant->is_verified === 'Verified')
                                <span class="position-absolute top-0 end-0 m-2 text-primary">
                                    <img src="{{ asset('verify.png') }}" alt="" width="25px">
                                </span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">{{ $consultant->name }}</h5>
                            </div>
                            <p class="text-muted mb-2">{{ Str::limit($consultant->experience, 20, '...') }}</p>
                            <p class="text-muted mb-2">Time Duration : {{ $consultant->assessment_duration }} days</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold"><i class="fa-solid fa-bangladeshi-taka-sign"></i> {{ number_format($consultant->assessment_price, 2) }}</span>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary btn-sm viewConsultant" data-id="{{ $consultant->id }}"
                                        data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl">
                                        View
                                    </button>
                                    <a href="{{ route('student.assessment.send-request', $consultant->id) }}" class="btn btn-primary btn-sm" type="submit">Select</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
    <!--Extra large modal-->
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Consultant Name</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <!-- Profile Header -->
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('avatar.png') }}" class="rounded-circle me-3 consultant-image" width="80"
                            height="80" alt="Profile Image">
                        <div>
                            <h5 class="mb-0 consultant-name"></h5>
                            <p class="text-muted mb-0 consultant-experience"></p>
                            <p class="text-muted mb-0 consultant-verified"></p>
                        </div>
                    </div>

                    <!-- Basic Info -->
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Gender:</strong> <span class="consultant-gender"></span></p>
                            <p><strong>Nationality:</strong> <span class="consultant-nationality"></span></p>
                            <p><strong>Date of Birth:</strong> <span class="consultant-dob"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Preferred Education:</strong> <span class="consultant-education"></span></p>
                            <p><strong>Preferred Country:</strong> <span class="consultant-country"></span></p>
                        </div>
                    </div>

                    <!-- Qualification -->
                    <h6 class="mt-3">Qualifications</h6>
                    <ul class="list-group qualification-list"></ul>

                    <!-- Experience -->
                    <h6 class="mt-3">Experience</h6>
                    <ul class="list-group experience-list"></ul>

                    <!-- Training -->
                    <h6 class="mt-3">Training</h6>
                    <ul class="list-group training-list"></ul>

                    <!-- Reviews -->
                    <h6 class="mt-3">Reviews</h6>
                    <ul class="list-group review-list"></ul>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('script')
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('.viewConsultant').click(function() {
                var consultantId = $(this).data('id');

                console.log(consultantId);

                $.ajax({
                    url: "{{ route('consultant.details') }}", // Update with your route
                    type: "GET",
                    data: {
                        id: consultantId
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            var consultant = response.consultant;

                            // Update modal title
                            $('#myLargeModalLabel').text(consultant.name);

                            // Update profile image
                            var imageUrl = consultant.image ?
                                `{{ asset('') }}${consultant.image}` :
                                `{{ asset('avatar.png') }}`;
                            $('.modal-body img').attr('src', imageUrl);

                            // Update basic details
                            $('.modal-body .consultant-name').text(consultant.name);
                            $('.modal-body .consultant-experience').text(consultant.experience);
                            $('.modal-body .consultant-verified').text(consultant.is_verified);
                            $('.modal-body .consultant-gender').text(consultant.gender);
                            $('.modal-body .consultant-nationality').text(consultant
                                .nationality);
                            $('.modal-body .consultant-dob').text(consultant.date_of_birth);
                            $('.modal-body .consultant-education').text(consultant
                                .proffered_education);
                            $('.modal-body .consultant-country').text(consultant
                                .proffered_country);

                            // Update Qualification List
                            var qualificationHtml = '';
                            consultant.qualifications.forEach(function(qualification) {
                                qualificationHtml += `<li class="list-group-item">
                                    <strong>${qualification.degree_title}</strong> - ${qualification.institution} (${qualification.passing_year})
                                </li>`;
                            });
                            $('.modal-body .qualification-list').html(qualificationHtml);

                            // Update Experience List
                            var experienceHtml = '';
                            consultant.experiences.forEach(function(experience) {
                                experienceHtml += `<li class="list-group-item">
                                    <strong>${experience.designation}</strong> at ${experience.organization} (${experience.start_date} - ${experience.end_date ?? 'Present'})
                                </li>`;
                            });
                            $('.modal-body .experience-list').html(experienceHtml);

                            // Update Training List
                            var trainingHtml = '';
                            consultant.trainings.forEach(function(training) {
                                trainingHtml += `<li class="list-group-item">
                                    <strong>${training.training_title}</strong> - ${training.organization} (${training.year})
                                </li>`;
                            });
                            $('.modal-body .training-list').html(trainingHtml);

                            // Update Reviews List
                            var reviewHtml = '';
                            consultant.reviews.forEach(function(review) {
                                reviewHtml += `<li class="list-group-item">
                                    <p class="mb-0"><strong>${review.user.name}</strong> rated ${review.rating}/5</p>
                                    <p class="text-muted">${review.comment}</p>
                                </li>`;
                            });
                            $('.modal-body .review-list').html(reviewHtml);
                        }
                    }
                });
            });
        });
    </script>
@endpush
