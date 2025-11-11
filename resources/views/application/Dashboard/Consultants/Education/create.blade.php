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
        <svg viewBox="0 0 76 76" class="success-message__icon icon-checkmark">
            <circle cx="38" cy="38" r="36"/>
            <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7"/>
        </svg>
        <h1 class="success-message__title">Success</h1>
        <div class="success-message__content">
            <p class="payment_text_msg">{{ Session::get('edu_success_message') }}</p>
            <button onclick="closePopup()" class="payment_text_msg button">Ok</button>
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




    <!-- ________________________________________ ADD EDUCAITONAL QUALIFICAIION START -->
    <div class="w-full bg-white my-3 rounded overflow-hidden border">
        <div class="flex items-center bg-gray-300 p-2 px-3 gap-3">
            <img src="{{ asset('Frontend/assets/img/icon/education.png') }}" alt="Education Icon" class="w-10 h-10">
            <h4 class="text-[20px] font-semibold">
                Add Your Educational Qualification
            </h4>
        </div>
        <div class="w-full p-3">

            <form class="row g-3" method="POST" action="{{ route('consultant.education') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <label for="inputAddress" class="form-label text-black">Title of Your Last Education</label>
                    <input type="text" name="degree_title" class="form-control" id="inputAddress" placeholder="Enter the title of Education" value="{{ old('degree_title') }}">
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label text-black">Result (Grade/GPA/CGPA)</label>
                    <input type="text" name="cgpa" class="form-control" id="inputEmail4" placeholder="Grade/GPA/CGPA" value="{{ old('cgpa') }}">
                </div>

                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label text-black">Duration</label>
                    <input type="text" name="duration" class="form-control" id="inputPassword4" placeholder="Duration (3 years/4 years)" value="{{ old('duration') }}">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label text-black">Passing Year</label>
                    <input type="month" name="passing_year" class="form-control" id="inputEmail4" placeholder="Your passing Year" value="{{ old('passing_year') }}">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label text-black">Institution</label>
                    <input type="text" name="institution" class="form-control" id="inputEmail4" placeholder="Institution Name" value="{{ old('institution') }}">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label text-black">Certificate/Document</label>
                    <div class="form-control certificate flex">
                        <i class="fa-solid fa-paperclip mt-auto mb-auto mr-2"></i>
                        <label for="bank-file-upload" style="display: flex; align-items: left;cursor: pointer; width:100%;">
                            <span style="color:rgba(0, 0, 0, 0.529);" id="bank-file-name">(Documents of the Certificate)</span>
                            <input type="file" name="documents" id="bank-file-upload" style="display: none;" onchange="bankFileName(this)">
                        </label>
                    </div>
                </div>

                <div class="col-12 flex justify-end">
                    <button type="submit" 
                        class="w-full sm:w-auto bg-primary-main text-white font-semibold px-5 py-2 rounded-md hover:opacity-90 transition">
                        Save
                    </button>
                </div>

            </form>
        </div>
    </div>
    <script>
          function bankFileName(input) {
                let fileName = input.files.length > 0 ? input.files[0].name : "(Image of the Certificate(s))";
                document.getElementById("bank-file-name").innerText = fileName;
            }
    </script>
    <!-- ________________________________________ ADD EDUCAITONAL QUALIFICATION END -->






    <!-- ________________________________________ UPDATE EDUCAITONAL QUALIFICAIION START -->
    <div id="update_edu_section" class="update_edu_section hidden">
        <div class="update_edu_center" style="max-width: 700px;">
                <div class="close_icon">
                    <i onclick="closeUpdate()" class="fa-regular fa-circle-xmark"></i>
                </div>
            <div class="heading">
                <div class="heading_title">
                    <h4 style="color:var(--consultant-primary-color);">Update Your Educational Qualification</h4>
                </div>
            </div>
            <form class="row g-3" method="POST" action="{{ route('consultant.education.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="id" id="id">
                <div class="col-12">
                    <label for="inputAddress" class="form-label text-black">Title of Your Last Education</label>
                    <input type="text" name="degree_title" class="form-control" id="degree_title">
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Result (Grade/GPA/CGPA)</label>
                    <input type="text" name="cgpa" class="form-control" id="cgpa">
                </div>

                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Duration</label>
                    <input type="text" name="duration" class="form-control" id="duration">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Passing Year</label>
                    <input type="month" name="passing_year" class="form-control" id="passing_year">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Institution</label>
                    <input type="text" name="institution" class="form-control" id="institution">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Certificate/Document</label>
                    <br>
                    <label for="inputPassword4" id="pdf_name" class="form-label" style="color:var(--consultant-primary-color)"></label>
                    <div class="form-control certificate">
                        <i class="fa-solid fa-paperclip"></i>
                        <label for="bank-file-upload">
                            <input style="margin-left:10px; cursor:pointer;" type="file" name="documents" id="bank-file-upload">
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="save_btn consultant_save_btn">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script>

        function showUpdate(id, degree_title, cgpa, duration, passing_year, institution, documents ) {

            document.getElementById("update_edu_section").classList.add("show");

            // ________ elements id
            var id_elem = document.getElementById("id");
            var degree_title_elem = document.getElementById("degree_title");
            var cgpa_elem = document.getElementById("cgpa");
            var duration_elem = document.getElementById("duration");
            var passing_year_elem = document.getElementById("passing_year");
            var institution_elem = document.getElementById("institution");
            var pdf_name_elem = document.getElementById("pdf_name");

            id_elem.value  = id;
            degree_title_elem.value  = degree_title;
            cgpa_elem.value  = cgpa;
            duration_elem.value  = duration;
            passing_year_elem.value = passing_year;
            institution_elem.value = institution;
            pdf_name_elem.textContent = documents;
        }

        function closeUpdateProfile(){
            document.getElementById("update_assessment").classList.remove("show");
        }

    </script>
    <!-- ________________________________________ UPDATE EDUCAITONAL QUALIFICATION END -->







@endsection
@push('script')
    <script src="{{ asset('Frontend') }}/./assets/js/popUpAlert.js"></script>
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
