@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Education')
@section('breadcrumb', 'Consultant/Education')
@section('previous-menu', 'Consultant')
@section('active-menu', 'Consultant Education')

@section('master-content')
<link rel="stylesheet" href="{{ url('Frontend/assets/css/education_list.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/add-update-modal.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/last_edu.css') }}">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">"> -->
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">
<link rel="stylesheet" href="{{ asset('Frontend') }}/assets/css/page_message.css">
<link rel="stylesheet" href="{{ asset('Frontend') }}/assets/css/alert_popup.css">

@if (Session::has('edu_success_message'))
<div id="alert_msg_section" class="alert_msg_section">
    <div class="success-message">
        <div class="flex item-center mb-4">
            <svg viewBox="0 0 76 76" class="m-auto h-[50px] success-message__icon icon-checkmark">
                <circle cx="38" cy="38" r="36"/>
                <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7"/>
            </svg>
        </div>
        <h1 class="success-message__title mb-2">Success</h1>
        <div class="success-message__content">
            <p class="payment_text_msg mb-2">{{ Session::get('edu_success_message') }}</p>
            <a href="{{ route('consultant.education') }}">
                <button class="payment_text_msg button">Ok</button>
            </a>
        </div>
    </div>
</div>
@endif
<script>
    function closePopup() {
        document.getElementById('alert_msg_section').style.display = "none";
    }
</script>

@if (Session::has('delete_message'))
    <p style="color:green;font-weight:700; font-size:20px; width:100%;text-align:center;">{{ Session::get('delete_message') }}</p>
@endif


<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
        <i class="fa-solid fa-graduation-cap fa-2x"></i>
    </div>
    <div>
        <h3 class="fw-bold fs-4 mb-0">Your Educational Qualification</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Education</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->
 
<!-- Page message start -->
<div class="page_message_section" id="page_message_section">
    <div class="page_message_box h-auto">
        <div class="msg_box h-auto">
            <p class="h-auto">{{ __('message.consultant_education_message') }} <i class="fa-solid fa-turn-down"></i></p>
        </div>
        <div class="close" onclick="closeFunction()">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
</div>
<script>
    function closeFunction() {
        document.getElementById('page_message_section').style.display = "none";
    }
</script>
<!-- Page message start -->

<!-- ________________ Education list start -->
 <div class="education_section mt-3 rounded overflow-hidden">
    <div class="w-full border bg-white">
        @if($qualification_data->isEmpty())
        <div class="no_data_section">
            <div class="empty-state">
                <div class="empty-state__content">
                    <div class="empty-state__icon"><img src="{{asset('no-data-image.png')}}" alt=""></div>
                    <div class="empty-state__message for_consultant">You did not add any Educational Information yet.</div>
                    <div class="empty-state__help">Please Add Your Educational Information to Engage Your Clients</div>
                    <a href="{{ route('consultant.education.create') }}" class="bg-primary-main text-white rounded-md mt-2 px-3 py-2 hover:bg-primary-dark transition">
                        Add Education <i class="fa-solid fa-plus ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div>
            <div class="flex flex-wrap justify-between items-center w-full p-2 bg-primary-gray rounded overflow-hidden gap-2">
                <!-- Left: Title -->
                <h3 class="text-[18px] md:text-[20px] font-bold text-primary-main m-0">
                    Your Educational Qualifications
                </h3>

                <!-- Right: Search + Button -->
                <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto justify-start sm:justify-end">
                    <input type="text" id="searchInput" placeholder="Search education..."
                    class="border border-gray-300 rounded-md px-3 py-2 w-full sm:w-[220px] focus:outline-none focus:ring-2 focus:ring-primary-main"
                    onkeyup="searchEducation()">
                    <a href="{{ route('consultant.education.create') }}"
                        class="bg-primary-main text-white rounded-md px-3 py-2 w-full sm:w-auto text-center hover:bg-primary-dark transition">
                        Add Education <i class="fa-solid fa-plus ml-2"></i>
                    </a>
                </div>
            </div>

            <script>
                function searchEducation() {
                    let input = document.getElementById("searchInput").value.toLowerCase();
                    let rows = document.querySelectorAll(".table-row");

                    rows.forEach(row => {
                        let text = row.innerText.toLowerCase();
                        row.style.display = text.includes(input) ? "" : "none";
                    });
                }
            </script>

            <ul class="responsive-table bg-primary-gray p-2 md:!p-0">
                <li class="table-header mb-0">
                    <div class="col col-2">
                        <div class="icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <p>Title of Education</p>
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class="icon">
                            <i class="fa-solid fa-ribbon"></i>
                            <p>Grade/GPA/CGPA</p>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="icon">
                            <i class="fa-regular fa-clock"></i>
                            <p>Duration</p>
                        </div>
                    </div>
                    <div class="col col-5">
                        <div class="icon">
                            <i class="fa-solid fa-calendar-days"></i>
                            <p>Passing Year</p>
                        </div>
                    </div>
                    <div class="col col-6">
                        <div class="icon">
                            <i class="fa-solid fa-building-columns"></i>
                            <p>Institution</p>
                        </div>
                    </div>
                    <div class="col col-7">
                        <div class="icon">
                            <i class="fa-solid fa-paperclip"></i>
                            <p>Documents/Certificates</p>
                        </div>
                    </div>
                </li>
                @foreach($qualification_data as $data)
                <li class="table-row mb-3 md:!mb-0 pb-3 md:!pb-0 border-b">
                    <!-- _______________ -->
                    <div class="edu_list" style="width: 25%; border:none;">
                        <div class="icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div class="body">
                            <span>Title of Education</span>
                            <p>{{$data->degree_title}}</p>
                        </div>
                    </div>
                    <!-- _______________ -->
                    <div class="edu_list" style="width: 15%;">
                        <div class="icon">
                            <i class="fa-solid fa-ribbon"></i>
                        </div>
                        <div class="body">
                            <span>Grade/GPA/CGPA</span>
                            <p>{{$data->cgpa}}</p>
                        </div>
                    </div>
                    <!-- _______________ -->
                    <div class="edu_list" style="width: 15%;">
                        <div class="icon">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="body">
                            <span>Duration</span>
                            <p>{{$data->duration}}</p>
                        </div>
                    </div>
                    <!-- _______________ -->
                    <div class="edu_list" style="width: 15%;">
                        <div class="icon">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div class="body">
                            <span>Passing Year</span>
                            <p>{{$data->passing_year}}</p>
                        </div>
                    </div>
                    <!-- _______________ -->
                    <div class="edu_list" style="width: 15%;">
                        <div class="icon">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <div class="body">
                            <span>Institution</span>
                            <p>{{$data->institution}}</p>
                        </div>
                    </div>
                    <!-- _______________ -->
                    <div class="edu_list" style="width: 15%; border-bottom:none !important;">
                        <div class="icon">
                            <i class="fa-solid fa-paperclip"></i>
                        </div>
                        <div class="body">
                            <span>Certificates</span>
                            <div class="buttons">
                            @if($data->documents) 
                            <div class="_df_button" style="padding:0px;background:transparent;border:none !important;" source="{{ asset('storage/' . $data->documents) }}">
                                <button>View</button>
                            </div>
                            @endif
                                <a href="{{route('consultant.education.updateForm',['id' => $data->id])}}"><button>Update</button></a>
                                <a href="{{route('consultant.education.delete',['id' => $data->id])}}"><button class="show_confirm_delete delete">Delete</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- _______________ -->
                </li>
                @endforeach
                
            </ul>
        </div>
        @endif
    </div>
 </div>
<!-- ________________ Education list end -->


@endsection
@push('script')
    <script src="{{ asset('Frontend') }}/./assets/js/popUpAlert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">


        function openForm() {
            document.getElementById("add_edu_section").classList.add("show");
        }

        function closeForm() {
            document.getElementById("add_edu_section").classList.remove("show");
        }
        function closeUpdate() {
            document.getElementById("update_edu_section").classList.remove("show");
        }


        $(document).on('click', '.show_confirm_delete', function(event) {
            event.preventDefault(); // Prevent default action

            var link = $(this).closest('a').attr('href'); // Get the href of the closest <a>

            Swal.fire({
                title: "Are you sure you want to Delete?",
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete it!",
                cancelButtonText: "Cancel",
                confirmButtonColor: "var(--consultant-primary-color) !important", // Using your RGB color
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link; // Redirect if confirmed
                }
            });
        });


    </script>
@endpush
