@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Student')
@section('master-content')
<link rel="stylesheet" href="{{ url('Frontend/assets/css/academic_info.css') }}">
<link rel="stylesheet" href="{{ asset('Frontend') }}/assets/css/page_message.css">



<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <!-- <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
        <i class="fa-solid fa-pen fa-2x"></i>
    </div> -->
    <div>
        <h3 class="fw-bold fs-4 mb-0">{{ __('message.qualification_heading') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Educational Qualification</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->
    
<!-- ___________ page message start -->
<div class="page_message_section" id="page_message_section">
    <div class="page_message_box page_message_box_center">
        <div class="msg_box">
            <p>{{ __('message.academic_info_page_message') }} <i class="fa-solid fa-turn-down"></i></p>
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
<!-- ___________ page message start -->

<!-- __________________ form start -->
 <section class="form_section">
     <div class="form_div">
        <div class="head_icon">
            <i class="fa-solid fa-building-columns"></i>
            <h3>Update Your Academic Information</h3>
        </div>

        <form method="POST" action="{{ route('student.info.add') }}" method="POST" enctype="multipart/form-data">
        @csrf

         <div class="row g-3">
             <label for="" class="bold_heading">Select Academic Status:</label>
             <div class="col">
                <div class="input_box">
                    <div class="icon_box"><i class="fa-solid fa-bars-staggered"></i></div>
                    <select class="form-control" name="academic_status" id="academicStatus">
                        <!-- <option value="" disabled selected>Select an Option</option> -->
                        <option value="under_graduate" selected>Under Graduate</option>
                        <option value="post_graduate">Post Graduate</option>
                    </select>
                </div>
                </div>
            </div>
            
            <!-- ________________________ GRADUATION INFO FORM START -->
         <div class="graduation" id="postGraduateDiv" style="display: none;">
             <div class="row g-3">
                <label for="" class="bold_heading">Your Graduation Info:</label>
                <div class="col">
                    <label for="">Graduation Title:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="text" class="form-control" name="title" placeholder="Enter Your graduation title">
                    </div>
                </div>
                <div class="col">
                    <label for="">Enter Grade/CGPA:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-award"></i></div>
                        <input type="text" class="form-control" name="grade" placeholder="Enter Your Grade/CGPA">
                    </div>
                </div>
            </div>

             <div class="row g-3">
                <div class="col">
                    <label for="">Duration:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-regular fa-clock"></i></div>
                        <input type="text" class="form-control" name="duration" placeholder="Enter Duration">
                    </div>
                </div>
                <div class="col">
                    <label for="">Department/Subject:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-book"></i></div>
                        <input type="text" class="form-control" name="department" placeholder="Enter Your Department/subject">
                    </div>
                </div>
            </div>

             <div class="row g-3">
                <div class="col">
                    <label for="">Stat Date:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-calendar-days"></i></div>
                        <input type="date" class="form-control" name="start_time" placeholder="Enter Start Date">
                    </div>
                </div>
                <div class="col">
                    <label for="">End Date:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-calendar-check"></i></div>
                        <input type="date" class="form-control" name="end_time" placeholder="Enter End Date">
                    </div>
                </div>
            </div>

             <div class="row g-3">
                <div class="col">
                    <label for="certificate">Your Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="certificate" class="form-control" accept="application/pdf">
                    </div>
                </div>
            </div>
        </div>
        <!-- ________________________ GRADUATION INFO FORM END -->


        
        <div class="row g-3">
            <label for="" class="bold_heading">Select Medium:</label>
            <div class="col">
                <div class="input_box">
                    <div class="icon_box"><i class="fa-solid fa-globe"></i></div>
                    <select class="form-control" name="academic_type" id="academicMedium">
                        <option value="" disabled selected>Select an Option</option>
                        <option value="bangla">Bangla Medium</option>
                        <option value="english">English Medium</option>
                        <option value="madrashah">Madrashah Medium</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- ________________________ bangla section start -->
        <div class="bangla" id="bangla" style="display: none;">
            <div class="row g-3">
                <div class="col">
                    <label for="">HSC Result (GPA):</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="text" name="hsc_result" class="form-control" placeholder="Enter Your HSC Grade">
                    </div>
                </div>
                <div class="col">
                    <label for="">HSC Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="hsc_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col">
                    <label for="">SSC Result (GPA):</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-user-graduate"></i></div>
                        <input type="text" name="ssc_result" class="form-control" placeholder="Enter Your SSC Grade">
                    </div>
                </div>
                <div class="col">
                    <label for="">SSC Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="ssc_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
            </div>
        </div>
        <!-- ________________________ bangla section end -->


        <!-- ________________________ English section start -->
        <div class="english" id="english" style="display: none;">
            <div class="row g-3">
                <div class="col">
                    <label for="">O Level Result:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="text" name="o_lavel_result" class="form-control" placeholder="Enter Your O Level Result">
                    </div>
                </div>
                <div class="col">
                    <label for="">O Level Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="o_lavel_certificate" class="form-control" accept="application/pdf">
                    </div>
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col">
                    <label for="">A Level Result:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-user-graduate"></i></div>
                        <input type="text" name="a_lavel_result" class="form-control" placeholder="Enter Your A Level Result">
                    </div>
                </div>
                <div class="col">
                    <label for="">A Level Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="a_lavel_certificate" class="form-control" accept="application/pdf">
                    </div>
                </div>
            </div>
        </div>
        <!-- ________________________ English section end -->


        <!-- ________________________ madrashah section start -->
        <div class="madrashah" id="madrashah" style="display: none;">
            <div class="row g-3">
                <div class="col">
                    <label for="">Dakhil Result:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="text" name="dakhil_result" class="form-control" placeholder="Enter Your Dakhil Result">
                    </div>
                </div>
                <div class="col">
                    <label for="">Dakhil Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="dakhil_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col">
                    <label for="">Alim Result:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-user-graduate"></i></div>
                        <input type="text" name="alim_result" class="form-control" placeholder="Enter Your Alim Result">
                    </div>
                </div>
                <div class="col">
                    <label for="">Alim Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="alim_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
            </div>
        </div>
        <!-- ________________________ madrashah section end -->

        <!-- ________________________ IELTS start -->
        <div class="row g-3">
            <div class="col">
                <label for="">Is IELTS?</label>
                <input id="toggleCheckbox" type="checkbox" name="ielts">
            </div>
        </div>

        <div class="ielts" id="ielts" style="display:none;">
            <div class="row g-3">
                <label for=""class="bold_heading">Your IELTS Info:</label>
                <div class="col">
                    <label for="">Enter IELTS Score:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-chart-simple"></i></div>
                        <input type="text" class="form-control" name="ielts_score" placeholder="Enter Your IELTS Score">
                    </div>
                </div>
                <div class="col">
                    <label for="">Enter IELTS Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" class="form-control" name="ielts_certificate">
                    </div>
                </div>
            </div>
        </div>
        <!-- ________________________ IELTS end -->

        <div class="button">
            <input type="submit" value="Save">
        </div>
    </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    // _______________________________ for academic medium
    $(document).ready(function () {
        $('#academicMedium').change(function () {
            var selectedValue = $(this).val();
            
            // Hide all elements first
            $("#bangla, #english, #madrashah").hide();

            // Show the relevant div based on selection
            if (selectedValue === "bangla") {
                $("#bangla").show();
            } else if (selectedValue === "english") {
                $("#english").show();
            }else if(selectedValue === "madrashah"){
                $("#madrashah").show();
            }
        });
    });
    
    // _______________________________ for post or pre graduate
    $(document).ready(function () {
        $('#academicStatus').change(function () {
            var selectedValue = $(this).val();
            
            // Hide all elements first
            $("#postGraduateDiv").hide();

            // Show the relevant div based on selection
            if (selectedValue === "postGraduateDiv") {
                $("#underGraduateDiv").show();
            } else if (selectedValue === "post_graduate") {
                $("#postGraduateDiv").show();
            }
        });
    });
    // _______________________________ FOR IELTS
    $(document).ready(function () {
        $('#toggleCheckbox').change(function () {
            if ($(this).is(':checked')) {
                $("#ielts").show();
            } else {
                $("#ielts").hide();
            }
        });
    });
</script>
<!-- __________________ form end -->

@endsection

@push('script')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('#ImagePreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function(){
            readURL(this);
    });


</script>
@endpush
