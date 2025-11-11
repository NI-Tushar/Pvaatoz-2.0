@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('breadcrumb', 'Request')
@section('previous-menu', 'Request')
@section('active-menu', 'Request')
@section('master-content')

<link rel="stylesheet" href="{{ url('Frontend/assets/css/assessment_requested_list.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">


<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <!-- <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
        <i class="fa-solid fa-pen fa-2x"></i>
    </div> -->
    <div>
        <h3 class="fw-bold fs-4 mb-0">{{ __('message.student_service_heading') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Your Request</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->

<!-- _____________ student service request start -->
<section class="selected_assessment_section">

  @if ($assessments->isNotEmpty())
    <div class="search_bar">
         <p>All Services</p>
        <input type="text" id="searchInput" class="form-control" placeholder="Search by country, institute/university, subject/course, budget...">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
  @foreach ($assessments as $data)
    <div class="searchable-item w-100">
        <!-- __________________ -->
        <div class="accordian">
            <div class="accordian_head">
                <div class="head_elelments">
                    <div class="pro_img">
                        <img src="{{ $data->consultant->image ? asset($data->consultant->image) : asset('no-profile-img.png') }}" alt="User Image">
                    </div>
                    <!-- ___________ -->
                    <div class="accordian_part">
                        <p class="span"><i class="fa-solid fa-user"></i> Consultants Name</p>
                        <p>{{$data->consultant->name}}</p>
                    </div>
                    <!-- ___________ -->
                    <div class="accordian_part desctop_element">
                        <p class="span"><i class="fa-solid fa-book"></i> Subject</p>
                        <p>{{$data->assessment_subject}}</p>
                    </div>
                    <!-- ___________ -->
                    <div class="accordian_part desctop_element">
                        <p class="span"> <i class="fa-solid fa-earth-americas"></i> Country</p>
                        <p>{{$data->assessment_country}}</p>
                    </div>
                    <!-- ___________ -->
                    @if($data->assessment_charge !== null && $data->assessment_charge !== '')
                    <div class="accordian_part desctop_element">
                        <p class="span"><i class="fa-solid fa-bangladeshi-taka-sign"></i> Charge</p>
                        <p>{{$data->assessment_charge}} BDT</p>
                    </div>
                    @endif
                    <!-- ___________ -->
                    <div class="accordian_part desctop_element">
                        <p class="span"><i class="fa-regular fa-clock"></i> Duration of Assessment</p>
                        <p>{{$data->assessment_duration}}</p>
                    </div>
                    <!-- ___________ -->

                    @if($data->status == 'Pending')
                        <div style="background-color: rgb(225, 139, 0); color:black;font-weight:700;" class="mov_status">{{$data->status}}</div>
                    @elseif($data->status == 'Accepted')
                        <div style="background-color: rgb(13, 90, 255);font-weight:700;" class="mov_status">In-Progress</div>
                    @elseif($data->status == 'Completed')
                        <div style="background-color: green;font-weight:700;" class="mov_status">Delivered</div>
                    @elseif($data->status == 'Rejected')
                        <div style="background-color: red;font-weight:700;" class="mov_status">{{$data->status}}</div>
                    @endif

                    <div class="accordian_toggler toggler_arrow">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>

                </div>
            </div>

            <div class="accordian_body {{ isset($assessmentId) && $assessmentId == $data->id ? 'active_body' : '' }}">
                <div class="accordian_description">

                <div class="mov_consultant_section">
                    <div class="item"><i class="fa-solid fa-book"></i> {{$data->assessment_subject}}</div>
                    <div class="item"><i class="fa-solid fa-earth-americas"></i> {{$data->assessment_country}}</div>
                    <div class="item"><i class="fa-solid fa-bangladeshi-taka-sign"></i> {{$data->assessment_charge}} BDT</div>
                    <div class="item"><i class="fa-regular fa-clock"></i> {{$data->assessment_duration}}</div>

                    @if($data->status == 'Completed')
                    <div class="mov_attachment">
                        <p>Attachment:</p>
                        <div class="attach_buttons">
                            {{-- <button class="_df_button" source="{{ asset('storage/Documents/1741080670_CompanyProfile.pdf') }}">View</button> --}}
                            <a href="{{ route('consultant.assessment.report.download', $data->id) }}">Download</a>
                        </div>
                    </div>
                    @endif

                </div>

                <div class="detail_part_section">

                    <!-- ___________ -->
                    <div class="detail_part">
                        <div class="icon"><i class="fa-solid fa-earth-americas"></i></div>
                        <div class="part_text">
                            <span>Preferred Country</span>
                            <p>{{$data->preferred_country}}</p>
                        </div>
                    </div>
                    <!-- ___________ -->
                    <div class="detail_part">
                        <div class="icon"><i class="fa-solid fa-building-columns"></i></div>
                        <div class="part_text">
                            <span> Preferred Institute</span>
                            <p>{{$data->preferred_institute}}</p>
                        </div>
                    </div>
                    <!-- ___________ -->
                    <div class="detail_part">
                        <div class="icon"><i class="fa-solid fa-book"></i></div>
                        <div class="part_text">
                            <span>Preferred Subject</span>
                            <p>{{$data->preferred_subject}}</p>
                        </div>
                    </div>
                    <!-- ___________ -->
                    <div class="detail_part">
                        <div class="icon"><i class="fa-solid fa-sack-dollar"></i></div>
                        <div class="part_text">
                            <span>Your Budget</span>
                            <p>{{$data->student_budget}}</p>
                        </div>
                    </div>
                    <!-- ___________ -->
                    <div class="detail_part bottom_part">
                        <div class="icon">
                            <i class="fa-solid fa-tags"></i>
                        </div>
                        <div class="part_text">
                            <span>Assessment Status</span>
                            @if($data->status == 'Pending')
                                <p style="background-color: rgb(233, 179, 0);font-weight:700;">{{$data->status}}</p>
                            @elseif($data->status == 'Accepted')
                                <p style="background-color: rgb(13, 90, 255);font-weight:700;">{{$data->status}}</p>
                            @elseif($data->status == 'Completed')
                                <p style="background-color: green;font-weight:700;">{{$data->status}}</p>
                            @elseif($data->status == 'Rejected')
                                <p style="background-color: red;font-weight:700;">{{$data->status}}</p>
                            @endif
                            @if($data->status == 'Completed')
                            <div class="desktop_attachment">
                                <p>Attachment:</p>
                                <div class="attach_buttons">
                                {{-- <button class="_df_button" source="{{ asset('storage/Documents/1741080670_CompanyProfile.pdf') }}">View</button> --}}
                                <a class="text-center" href="{{ route('consultant.assessment.report.download', $data->id) }}">Download</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- ___________ -->
                </div>

                </div>
            </div>
        </div>
        <!-- __________________ -->
    </div>
    @endforeach
    @else
    <div class="no_data_section">
        <div class="empty-state">
            <div class="empty-state__content">
                <div class="empty-state__icon"><img src="{{asset('no-data-image.png')}}" alt=""></div>
                <div class="empty-state__message">No Choice has been added yet.</div>
                <div class="empty-state__help">Add a new Choice by simpley clicking the button at bottom here.</div>
                <a href="{{ route('create.choice.form') }}"><button>Create Choices</button></a>
            </div>
        </div>
    </div>
    @endif
</section>
<!-- _____________ student service request end -->



@endsection
@push('script')

    <!-- ___________ jquery search start -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#searchInput').on('keyup', function () {
            let value = $(this).val().toLowerCase();

            $('.searchable-item').filter(function () {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(value) > -1);
            });
        });
    </script>
    <!-- ___________ jquery search end -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">

        // __________________ request list expend start
        let accordianHead = Array.from(document.querySelectorAll(".accordian_head"));

            accordianHead.map((item) =>
            item.addEventListener("click", () => {
                closeAllAccordian(item);
            })
            );

            function closeAllAccordian(current_target) {
            console.log(current_target);
            accordianHead.map((item) => {
                const togglerArrowIcon = item.querySelector(".toggler_arrow i");
                if (current_target !== item) {
                    const accordianBody = item.nextElementSibling;
                    const togglerBtn = item.firstElementChild;
                    togglerBtn.classList.remove("active");
                    accordianBody.classList.remove("active_body");
                    togglerArrowIcon.classList.remove("rotate");
                } else {
                    const accordianBody = current_target.nextElementSibling;
                    const togglerBtn = item.firstElementChild;
                    togglerBtn.classList.toggle("active");
                    accordianBody.classList.toggle("active_body");
                    togglerArrowIcon.classList.toggle("rotate");
                }
            });
            }

        // __________________ request list expend end



        $('.show_confirm').click(function(event) {
            event.preventDefault(); // Prevent form submission

            var form = $(this).closest("form"); // Get the closest form

            Swal.fire({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                customClass: {
                    confirmButton: 'text-white',
                    cancelButton: 'btn btn-secondary'
                },
                dangerMode: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form if the user confirms
                }
            });
        });

        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#activityTable tbody tr');

            rows.forEach(function(row) {
                // Convert row text content to lowercase and check if it includes the search input
                var rowText = row.textContent.toLowerCase();
                if (rowText.includes(input)) {
                    row.style.display = ''; // Show row if it matches the search query
                } else {
                    row.style.display = 'none'; // Hide row if it doesn't match
                }
            });
        });

    // Clear modal data and backdrop when it is hidden
    $('#activityViewModla').on('hidden.bs.modal', function() {
        // Optional: Ensure backdrop is removed
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
    });

    </script>
@endpush
