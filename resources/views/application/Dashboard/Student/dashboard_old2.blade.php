@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')
    <link rel="stylesheet" href="{{ url('Frontend/assets/css/dashboard_card_old2.css') }}">
    <link rel="stylesheet" href="{{ url('Frontend/dashboard/assets/css/user_navbar_custom.css') }}">
    <!-- Include SweetAlert2 -->
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
    <div class="dashboard_section">
        <div class="row top_summery">
            <!-- ________________________ -->
            <div class="col-md-6 col-xl-4">
                <div class="card bg-1 h-100">
                    <div class="card-body">
                        <div class="mb-1">
                            <h4 class="card-title text-dark mb-0">{{ __('message.total_request') }}</h4>
                        </div>
                        <div class="row d-flex align-items-center mb-0">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    <div class="d-f" style="gap: 2em;">
                                        {{ $total_request }}
                                    </div>
                                </h2>
                            </div>
                        </div>
                        <div class="mb-0 last_earning">
                            <h5 class="card-title mb-0"><i class="fa-solid fa-caret-up"></i><span>+{{ $total_request }}</span>
                                Last Request</h5>
                        </div>
                        <div class="icon_box">
                             <i class="fa-solid fa-clipboard-check"></i>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->
            <!-- ________________________ -->
             {{--
            <div class="col-md-6 col-xl-4">
                <div class="card bg-2 h-100">
                    <div class="card-body">
                        <div class="mb-1">
                            <h5 class="card-title text-dark mb-0">{{ __('message.total_request') }}</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-0">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    {{ '0' }}
                                </h2>
                            </div>
                        </div>
                        <div class="mb-0 last_earning">
                            <h5 class="card-title mb-0"><i
                                    class="fa-solid fa-caret-up"></i><span>+{{ number_format(auth()->user()->balance, 2) }}</span>Last
                                10 Days Request</h5>
                        </div>
                        <div class="icon_box">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->
            --}}
            <!-- ________________________ -->
            <div class="col-md-6 col-xl-4">
                <div class="card bg-3 h-100">
                    <div class="card-body">
                        <div class="mb-1">
                            <h5 class="card-title text-dark mb-0">{{ __('message.complete_request') }}</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-0">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    {{ $complete_request }}
                                </h2>
                            </div>
                        </div>
                        <div class="mb-0 last_earning">
                            <h5 class="card-title mb-0"><i
                                    class="fa-solid fa-caret-up"></i><span>+{{ $complete_request }}
                                    </span>Last Completed Request</h5>
                        </div>
                        <div class="icon_box">
                            <i class="fa-solid fa-check-double"></i>
                        </div>
                    </div>
                    <!--end card body-->
                </div>
                <!--end card-->
            </div> <!-- end col-->
            <!-- ________________________ -->
            <div class="col-md-6 col-xl-4">
                <div class="card bg-4 h-100">
                    <div class="card-body">
                        <div class="mb-0">
                            <h5 class="card-title text-dark mb-0">{{ __('message.available_consultant') }}</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-0">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    {{ $total_consultants }}
                                </h2>
                            </div>
                        </div>
                        <div class="mb-0 last_earning">
                            <h5 class="card-title mb-0">
                            <i class="fa-solid fa-caret-up"></i><span>+{{ $total_consultants }}</span>Available cosultants</h5>
                            <a href="{{ route('consultant.list') }}" style="font-weight:700;font-size:12px;color:black;">
                                <span style="color:black;">See All <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:12px;color:black;"></i></span>
                            </a>
                        </div>
                        <div class="icon_box">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->
            <!-- ________________________ -->
        </div>
        <style>
            .dashboard_section .top_summery .col-xl-4{
                height:100px;
            }
            @media (max-width: 1200px) {
                .dashboard_section .top_summery .col-xl-4{
                    margin-bottom:10px;
                }
            }
        </style>
        <!-- end row-->
                 
        
        <div class="wellcome_text mt-4">
            <div class="user_header_dashboard">
                @if (auth()->guard('web')->user()->user_type === 'Consultant')
                    <h4><i class="fa-solid fa-user-graduate"></i> {{ __('message.consultant_dashboard') }}</h4>
                @else
                    <h4><i class="fa-solid fa-user-graduate"></i> {{ __('message.student_dashboard') }}</h4>
                @endif
            </div>
            <div id="text_div" class="text_div">
                <div onclick="closeFunction()" class="close_icon">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <h3>{{ __('message.welcome') }} {{ auth()->guard('web')->user()->name }}!</h3>
                <div class="text_p">
                    <p>{{ __('message.welcome_text_student') }}</p>
                </div>
            </div>
            <script>
                function closeFunction() {
                    document.getElementById('text_div').style.display = "none";
                }
            </script>
            <div class="row mt-3">
                <!-- ________________________ -->
                <div class="col-md-12 col-xl-6">
                    <div class="card user_request_card">
                        <div class="card-body p-3">
                            <div class="body_list">
                                <!-- ______________ new request -->
                                <h5 class="quick_view_heading pro"><i class="fa-solid fa-crown"></i> {{ __('message.pro_consultant') }}</h5>
                                <div class="request_list">
                                    <div class="list_card">
                                        <div class="student_img">
                                            <img src="https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg"
                                                alt="">
                                        </div>
                                        <div class="student_info">
                                            <div class="info_text">
                                                <h5>NI Tushar</h5>
                                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, possimus
                                                    alias placeat deserunt quia</p>
                                                <span class="desktop_span">Assessment</span>
                                            </div>
                                            <div class="student_button">
                                                <span>Assessment</span>
                                                <div class="open_btn">
                                                    <a href="">{{ __('message.request') }} <i class="fa-solid fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="request_list">
                                    <div class="list_card">
                                        <div class="student_img">
                                            <img src="https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg"
                                                alt="">
                                        </div>
                                        <div class="student_info">
                                            <div class="info_text">
                                                <h5>NI Tushar</h5>
                                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, possimus
                                                    alias placeat deserunt quia</p>
                                                <span class="desktop_span">Assessment</span>
                                            </div>
                                            <div class="student_button">
                                                <span>Assessment</span>
                                                <div class="open_btn">
                                                    <a href="">{{ __('message.request') }} <i class="fa-solid fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ______________ last completed request start -->
                                <h5 class="quick_view_heading verrified"><i class="fa-solid fa-circle-check"></i> {{ __('message.verified_consultants') }}</h5>
                                <div class="request_list">
                                    <div class="list_card">
                                        <div class="student_img">
                                            <img src="https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg"
                                                alt="">
                                        </div>
                                        <div class="student_info">
                                            <div class="info_text">
                                                <h5>NI Tushar</h5>
                                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, possimus
                                                    alias placeat deserunt quia</p>
                                                <span class="desktop_span">Assessment</span>
                                            </div>
                                            <div class="student_button">
                                                <span>Assessment</span>
                                                <div class="open_btn">
                                                    <a href="">{{ __('message.request') }} <i class="fa-solid fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="request_list">
                                    <div class="list_card">
                                        <div class="student_img">
                                            <img src="https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg"
                                                alt="">
                                        </div>
                                        <div class="student_info">
                                            <div class="info_text">
                                                <h5>NI Tushar</h5>
                                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, possimus
                                                    alias placeat deserunt quia</p>
                                                <span class="desktop_span">Assessment</span>
                                            </div>
                                            <div class="student_button">
                                                <span>Assessment</span>
                                                <div class="open_btn">
                                                    <a href="">{{ __('message.request') }} <i class="fa-solid fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ______________ last completed request end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ________________________ -->
                <div class="col-md-12 col-xl-6">
                    <div class="card quick_card">
                        <h4>{{ __('message.quick_access') }}  <i class="fa-solid fa-arrow-turn-down"></i></h4>
                        <div class="quick_links">

                            <div class="card-body">
                                <h5>{{ __('message.profile_management') }}</h5>
                                <ul>
                                    <li>
                                        <a href="{{ route('profile.edit') }}">
                                            <div class="list_icon"><i class="fa-solid fa-user-tie"></i></div>
                                            {{ __('message.manageme_profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('student.transaction.cash-in') }}">
                                            <div class="list_icon"><i class="fa-solid fa-money-check-dollar"></i></div>
                                            {{ __('message.balance') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.edit') }}">
                                            <div class="list_icon"><i class="fa-solid fa-key"></i></div>
                                            {{ __('message.change_password') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5>{{ __('message.your_activities') }}</h5>
                                <ul>
                                    <li>
                                        <a href="{{ route('student.choice') }}">
                                            <div class="list_icon"><i class="fa-solid fa-bars-staggered"></i></div>
                                            {{ __('message.create_your_choice') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('student.lastEducation') }}">
                                            <div class="list_icon"><i class="fa-solid fa-layer-group"></i></div>
                                            {{ __('message.last_education') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('student.info') }}">
                                            <div class="list_icon"><i class="fa-solid fa-graduation-cap"></i></div>
                                            {{ __('message.academic_qualification') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('student.assessment.all-request') }}">
                                            <div class="list_icon"><i class="fa-solid fa-bars-progress"></i></div>
                                            {{ __('message.service_request') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>           

                        </div>
                    </div>
                </div>
                <!-- ________________________ -->
            </div>
        </div>
    </div>

@endsection
