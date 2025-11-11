@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Experience')
@section('breadcrumb', 'Consultant/Experience')
@section('previous-menu', 'Experience')
@section('active-menu', 'Consultant Experience')

@section('master-content')
<link rel="stylesheet" href="{{ url('Frontend/assets/css/education_list.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/add-update-modal.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/last_edu.css') }}">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">"> -->
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">

<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
        <i class="fa-solid fa-toolbox fa-2x"></i>
    </div>
    <div>
        <h3 class="fw-bold fs-4 mb-0">Your Experience</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Experience</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->

@if (Session::has('edu_success_message'))
    <p style="color:green;font-weight:700; font-size:25px; width:100%;text-align:center;">{{ Session::get('edu_success_message') }}</p>
@endif
@if (Session::has('delete_message'))
    <p style="color:green;font-weight:700; font-size:20px; width:100%;text-align:center;">{{ Session::get('delete_message') }}</p>
@endif

<!-- ________________ Education list start -->
 <div class="education_section mt-2 rounded-lg overflow-hidden">
    <div class="w-full">
        @if($experience_data->isEmpty())
        <div class="no_data_section">
            <div class="empty-state">
                <div class="empty-state__content">
                    <div class="empty-state__icon"><img src="{{asset('no-data-image.png')}}" alt=""></div>
                    <div class="empty-state__message for_consultant">You did not add any work experience yet.</div>
                    <div class="empty-state__help">Please add your work experience to engage with your clients</div>
                    <a href="{{ route('consultant.experience.add') }}">
                        <button class="button_for_consultant">Add Work Experience <i class="fa-solid fa-plus ml-2"></i></button>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="w-full bg-white border rounded-md overflow-hidden">
            <div class="flex flex-wrap justify-between items-center w-full px-2 py-2 bg-primary-gray gap-2">
                <!-- Left: Title -->
                <h3 class="text-[18px] md:text-[20px] font-bold text-primary-main m-0">
                    Your Experience
                </h3>

                <!-- Right: Search + Button -->
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <input type="text" id="searchInput" placeholder="Search education..."
                        class="border border-gray-300 rounded-md px-3 py-2 w-full md:w-[200px] focus:outline-none focus:ring-2 focus:ring-primary-main"
                        onkeyup="searchEducation()">
                    <a href="{{ route('consultant.experience.add') }}"
                        class="bg-primary-main text-white rounded-md px-3 py-2 w-full md:w-auto text-center hover:bg-primary-dark transition">
                        Add Experience <i class="fa-solid fa-plus ml-2"></i>
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
            
            <div>
                <ul class="responsive-table bg-primary-gray p-2 md:!p-0">
                    <li class="table-header">
                        <div class="col col-1 p-2" style="width: 12.15%;">
                            <div class="icon">
                                <!-- <i class="fa-solid fa-graduation-cap"></i> -->
                                <p>Organization Name</p>
                            </div>
                        </div>
                        <div class="col col-2 p-2" style="width: 12.15%;">
                            <div class="icon">
                                <!-- <i class="fa-solid fa-ribbon"></i> -->
                                <p>Designation</p>
                            </div>
                        </div>
                        <div class="col col-3 p-2" style="width: 12.15%;">
                            <div class="icon">
                                <!-- <i class="fa-regular fa-clock"></i> -->
                                <p>Responsibilities</p>
                            </div>
                        </div>
                        <div class="col col-4 p-2" style="width: 12.15%;">
                            <div class="icon">
                                <!-- <i class="fa-solid fa-calendar-days"></i> -->
                                <p>Dates</p>
                            </div>
                        </div>
                        <div class="col col-5 p-2" style="width: 12.15%;">
                            <div class="icon">
                                <!-- <i class="fa-regular fa-clock"></i> -->
                                <p>Duration</p>
                            </div>
                        </div>
                        <div class="col col-6 p-2" style="width: 12.15%;">
                            <div class="icon">
                                <!-- <i class="fa-solid fa-building-columns"></i> -->
                                <p>Language</p>
                            </div>
                        </div>
                        <div class="col col-7 p-2" style="width: 70px; border-bottom:none !important; padding:0px;">
                            <div class="icon">
                                <!-- <i class="fa-solid fa-paperclip"></i> -->
                                <p>Any Doc</p>
                            </div>
                        </div>
                        <div class="col col-8 p-2" style="width: 60px; border-bottom:none !important; padding:0px;">
                            <div class="icon">
                                <!-- <i class="fa-solid fa-paperclip"></i> -->
                                <p>Resume</p>
                            </div>
                        </div>
                        <div class="col col-8 p-2" style="width: 130px; border-bottom:none !important; padding:0px;">
                            <div class="icon">
                                <!-- <i class="fa-solid fa-paperclip"></i> -->
                                <p>Action</p>
                            </div>
                        </div>
                    </li>
                    @foreach($experience_data as $data)
                    <li class="table-row mb-3 md:!mb-0 pb-3 md:!pb-0 border-b">
                        <!-- _______________ -->
                        <div class="edu_list" style="width: 12.15%; border:none;">
                            <div class="icon">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <div class="body">
                                <span>Organization Name</span>
                                <p>{{$data->organization}}</p>
                            </div>
                        </div>
                        <!-- _______________ -->
                        <div class="edu_list" style="width: 12.15%;">
                            <div class="icon">
                                <i class="fa-solid fa-ribbon"></i>
                            </div>
                            <div class="body">
                                <span>Designation</span>
                                <p>{{$data->designation}}</p>
                            </div>
                        </div>
                        <!-- _______________ -->
                        <div class="edu_list" style="width: 12.15%;">
                            <div class="icon">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <div class="body">
                                <span>Responsibilities</span>
                                <p>{{$data->responsibilities}}</p>
                            </div>
                        </div>
                        <!-- _______________ -->
                        <div class="edu_list" style="width: 12.15%;">
                            <div class="icon">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <div class="body">
                                <span>Dates</span>
                                <p>Start at:{{$data->start_date}}</p>
                                <p>{{$data->end_date}}</p>
                            </div>
                        </div>
                        <!-- _______________ -->
                        <div class="edu_list" style="width: 12.15%;">
                            <div class="icon">
                                <i class="fa-solid fa-building-columns"></i>
                            </div>
                            <div class="body">
                                <span>Duration</span>
                                <p>{{$data->duration}}</p>
                            </div>
                        </div>
                        <!-- _______________ -->
                        <div class="edu_list" style="width: 12.15%;">
                            <div class="icon">
                                <i class="fa-solid fa-building-columns"></i>
                            </div>
                            <div class="body">
                                <span>Language</span>
                                <p>{{$data->other_language}}</p>
                            </div>
                        </div>
                        <!-- _______________ -->
                        <div class="edu_list edu_list_center" style="width: 60px; border-bottom:none !important; padding:0px;">
                            <div class="icon">
                                <i class="fa-solid fa-paperclip"></i>
                            </div>
                            <div class="body">
                                <span>Any Documents</span>
                                <div class="buttons">
                                    @if($data->documents !='null')
                                    <div class="_df_button" style="padding:0px; background:transparent; border:none !important; padding:5px;" source="{{ asset('storage/' . $data->documents) }}">
                                        <button>View</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- _______________ -->
                        <div class="edu_list edu_list_center" style="width: 60px; border-bottom:none !important;">
                            <div class="icon">
                                <i class="fa-solid fa-paperclip"></i>
                            </div>
                            <div class="body">
                                <span>Resume</span>
                                <div class="buttons">
                                    @if($data->cv_documents !='null')
                                    <div class="_df_button" style="padding:0px; background:transparent;border:none !important;" source="{{ asset('storage/' . $data->cv_documents) }}">
                                        <button>View</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- _______________ -->
                        <div class="edu_list edu_list_center" style="width: 130px; border-bottom:none !important;">
                            <div class="icon">
                                <i class="fa-solid fa-paperclip"></i>
                            </div>
                            <div class="body">
                                <span>Action</span>
                                <div class="buttons">
                                    <a href="{{route('consultant.experience.edit',['id' => $data->id])}}"><button>Update</button></a>
                                    <a href="{{route('consultant.experience.detete',['id' => $data->id])}}"><button class="show_confirm_delete delete">Delete</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- _______________ -->
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        @endif
    </div>
 </div>
<!-- ________________ Education list end -->



@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">

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
