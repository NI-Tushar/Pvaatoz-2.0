@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Student')
@section('master-content')
<link rel="stylesheet" href="{{ url('Frontend/assets/css/academic_info.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">
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

@if ($info_data || $post_graduate_data)
<!-- __________________ form start -->
 <section class="form_section">
     <div class="form_div">
        <div class="head_icon">
            <i class="fa-solid fa-building-columns"></i>
            <h3>Your Academic Qualification</h3>
        </div>
            
        <!-- ________________________ GRADUATION INFO FORM START -->
        @if ($post_graduate_data)
        <div class="graduation" id="postGraduateDiv">
             <div class="row g-3">
                <label for="" class="bold_heading">Your Graduation Info:</label>
                <div class="col">
                    <label for="">Graduation Title:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="text" class="form-control" value="{{ $post_graduate_data->title}}" readonly>
                    </div>
                </div>
                <div class="col">
                    <label for="">Enter Grade/CGPA:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-award"></i></div>
                        <input type="text" class="form-control" value="{{ $post_graduate_data->grade}}" readonly>
                    </div>
                </div>
            </div>

             <div class="row g-3">
                <div class="col">
                    <label for="">Duration:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-regular fa-clock"></i></div> 
                        <input type="text" class="form-control" value="{{ $post_graduate_data->duration}}" readonly>
                    </div>
                </div>
                <div class="col">
                    <label for="">Department/Subject:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-book"></i></div>
                        <input type="text" class="form-control" value="{{ $post_graduate_data->department}}" readonly>
                    </div>
                </div>
            </div>

             <div class="row g-3">
                <div class="col">
                    <label for="">Stat Date:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-calendar-days"></i></div>
                        <input type="date" class="form-control" value="{{ $post_graduate_data->start_time}}" readonly>
                    </div>
                </div>
                <div class="col">
                    <label for="">End Date:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-calendar-check"></i></div>
                        <input type="date" class="form-control" value="{{ $post_graduate_data->end_time}}" readonly>
                    </div>
                </div>
            </div>

             <div class="row g-3">
                <div class="col">
                    <label for="certificate">Update Your Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="certificate" class="form-control" accept="application/pdf">
                    </div>
                </div>
                @if(!empty($post_graduate_data->certificate))
                <div class="col">
                    <label for="certificate">View Your Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <div class="_df_button" style="padding:0px;background:transparent;border:none !important; display:flex;" source="{{ asset($post_graduate_data->certificate) }}">
                            <div class="open"><button>View Certificate</button></div>
                        </div>
                    </div>
                </div>
                @else
                    <span>No Documents Found</span>
                @endif
            </div>
        </div>
        @endif
        <!-- ________________________ GRADUATION INFO FORM END -->

        
        @if ($info_data && $info_data->academic_type == 'bangla')
        <!-- ________________________ bangla section start -->
        <div class="bangla" id="bangla" >
            <label for="" class="bold_heading">Your HSC Info:</label>
            <div class="row g-3">
                <div class="col">
                    <label for="">HSC Result (GPA):</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="text" class="form-control" value="{{ $info_data->hsc_result}}" readonly>
                    </div>
                </div>
                @if(!empty($info_data->hsc_certificate))
                <div class="col">
                    <label for="">HSC Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="hsc_certificate" class="form-control"  accept="application/pdf">
                        <div class="_df_button" style="padding:0px;background:transparent;border:none !important; display:flex;" source="{{ asset($info_data->hsc_certificate) }}">
                            <div class="open" ><button>View</button></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col">
                <label for="">HSC Certificate:</label>
                <span style="color:red;">No Documents Found</span>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="file" name="hsc_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
                @endif
            </div>
            
            <div class="row g-3">
                <div class="col">
                    <label for="">SSC Result (GPA):</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-user-graduate"></i></div>
                        <input type="text" class="form-control" value="{{ $info_data->ssc_result}}" readonly>
                    </div>
                </div>
                @if(!empty($info_data->ssc_certificate))
                <div class="col">
                    <label for="">SSC Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="ssc_certificate" class="form-control"  accept="application/pdf">
                        <div class="_df_button" style="padding:0px;background:transparent;border:none !important; display:flex;" source="{{ asset($info_data->ssc_certificate) }}">
                            <div class="open" ><button>View</button></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col">
                <label for="">SSC Certificate:</label>
                <span style="color:red;">No Documents Found</span>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="file" name="ssc_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- ________________________ bangla section end -->
        
        @elseif($info_data && $info_data->academic_type == 'english')
        <!-- ________________________ English section start -->
        <div class="english" id="english" >
            <label for="" class="bold_heading">Your O Lavel Info:</label>
            <div class="row g-3">
                <div class="col">
                    <label for="">O Level Result:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="text" class="form-control" value="{{$info_data->o_lavel_result}}" readonly>
                    </div>
                </div>
                @if(!empty($info_data->o_lavel_certificate))
                <div class="col">
                    <label for="">Dakhil Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="o_lavel_certificate" class="form-control"  accept="application/pdf">
                        <div class="_df_button" style="padding:0px;background:transparent;border:none !important; display:flex;" source="{{ asset($info_data->o_lavel_certificate) }}">
                            <div class="open" ><button>View</button></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col">
                <label for="">O Lavel Certificate:</label>
                <span style="color:red;">No Documents Found</span>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="file" name="o_lavel_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
                @endif
            </div>
            
            <div class="row g-3">
                <div class="col">
                    <label for="">A Level Result:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-user-graduate"></i></div>
                        <input type="text" class="form-control"  value="{{$info_data->a_lavel_result}}" readonly>
                    </div>
                </div>
                @if(!empty($info_data->a_lavel_certificate))
                <div class="col">
                    <label for="">A Lavel Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="a_lavel_certificate" class="form-control"  accept="application/pdf">
                        <div class="_df_button" style="padding:0px;background:transparent;border:none !important; display:flex;" source="{{ asset($info_data->a_lavel_certificate) }}">
                            <div class="open" ><button>View</button></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col">
                <label for="">A Lavel Certificate:</label>
                <span style="color:red;">No Documents Found</span>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="file" name="a_lavel_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- ________________________ English section end -->


        @elseif($info_data && $info_data->academic_type == 'madrashah')
        <!-- ________________________ madrashah section start -->
        <div class="madrashah" id="madrashah" >
            <label for="" class="bold_heading">Your Dakhil Info:</label>
            <div class="row g-3">
                <div class="col">
                    <label for="">Dakhil Result:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="text" class="form-control" value="{{$info_data->dakhil_result}}" readonly>
                    </div>
                </div>
                @if(!empty($info_data->dakhil_certificate))
                <div class="col">
                    <label for="">Dakhil Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="dakhil_certificate" class="form-control"  accept="application/pdf">
                        <div class="_df_button" style="padding:0px;background:transparent;border:none !important; display:flex;" source="{{ asset($info_data->dakhil_certificate) }}">
                            <div class="open" ><button>View</button></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col">
                <label for="">Dakhil Certificate:</label>
                <span style="color:red;">No Documents Found</span>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="file" name="dakhil_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
                @endif
            </div>
            
            <div class="row g-3">
                <div class="col">
                    <label for="">Alim Result:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-user-graduate"></i></div>
                        <input type="text" class="form-control" value="{{$info_data->alim_result}}" readonly>
                    </div>
                </div>
                @if(!empty($info_data->alim_certificate))
                <div class="col">
                    <label for="">Alim Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="alim_certificate" class="form-control"  accept="application/pdf">
                        <div class="_df_button" style="padding:0px;background:transparent;border:none !important; display:flex;" source="{{ asset($info_data->alim_certificate) }}">
                            <div class="open" ><button>View</button></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col">
                <label for="">Alim Certificate:</label>
                <span style="color:red;">No Documents Found</span>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="file" name="alim_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- ________________________ madrashah section end -->
        @endif
        
        @if($info_data && $info_data->ielts_score != null)
        <!-- ________________________ IELTS start -->
        <div class="ielts" id="ielts">
            <div class="row g-3">
                <label for=""class="bold_heading">Your IELTS Info:</label>
                <div class="col">
                    <label for="">Enter IELTS Score:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-chart-simple"></i></div>
                        <input type="text" class="form-control" value="{{$info_data->ielts_score}}" readonly>
                    </div>
                </div>
                @if(!empty($info_data->ielts_certificate))
                <div class="col">
                    <label for="">IELTS Certificate:</label>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-paperclip"></i></div>
                        <input type="file" name="ielts_certificate" class="form-control"  accept="application/pdf">
                        <div class="_df_button" style="padding:0px;background:transparent;border:none !important; display:flex;" source="{{ asset($info_data->ielts_certificate) }}">
                            <div class="open" ><button>View</button></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col">
                <label for="">IELTS Certificate:</label>
                <span style="color:red;">No Documents Found</span>
                    <div class="input_box">
                        <div class="icon_box"><i class="fa-solid fa-graduation-cap"></i></div>
                        <input type="file" name="ielts_certificate" class="form-control"  accept="application/pdf">
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- ________________________ IELTS end -->
         @endif
         

        <div class="button">
            <a href="{{ route('student.info.add') }}">Update</a>
        </div>
  
    </div>
</section>
@else
    <div class="no_data_section">
        <div class="empty-state">
            <div class="empty-state__content">
                <div class="empty-state__icon"><img src="{{asset('no-data-image.png')}}" alt=""></div>
                <div class="empty-state__message">You did not update your education yet.</div>
                <div class="empty-state__help">Please Update Your Educational Qualification for a Consultants Review your Profile</div>
                <a href="{{ route('student.info.add') }}">
                    <button>Add Education</button>
                </a>
            </div>
        </div>
    </div>
@endif

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
