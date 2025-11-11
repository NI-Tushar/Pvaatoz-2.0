@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')
    <link rel="stylesheet" href="{{ url('Frontend/assets/css/dashboard_card_old2.css') }}">
    <link rel="stylesheet" href="{{ url('Frontend/dashboard/assets/css/user_navbar_custom.css') }}">
    <link rel="stylesheet" href="{{ url('Frontend/assets/css/alert_popup.css') }}">

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


<!-- ___________ Request send success popup start -->
@if (Session::has('not_verified_msg'))
<div id="alert_msg_section" class="alert_msg_section">
    <div class="success-message alert_message">
        <div class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></div>
        <i class="fa-solid fa-circle-exclamation"></i>
        <h1 class="success-message__title">Warning</h1>
        <div class="success-message__content">
            <p class="payment_text_msg warning_msg">{{ Session::get('not_verified_msg') }}</p>
            <a href="{{ route('profile.edit') }}">
                <button class="payment_text_msg button">Update Profile</button>
            </a>
        </div>
    </div>
</div>
<script>
    function closePopup() {
        document.getElementById('alert_msg_section').style.display = "none";
    }
</script>
@endif
@if (Session::has('verification_request_success_msg'))
<div id="alert_msg_section" class="alert_msg_section">
    <div class="success-message">
            <svg viewBox="0 0 76 76" class="success-message__icon icon-checkmark">
                <circle cx="38" cy="38" r="36"/>
                <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7"/>
            </svg>
        <h1 class="success-message__title">Success</h1>
        <div class="success-message__content">
            <p class="payment_text_msg">{{ Session::get('verification_request_success_msg') }}</p>
            <button onclick="closePopup()" class="payment_text_msg button">Ok</button>
        </div>
    </div>
</div>
<script>
    function closePopup() {
        document.getElementById('alert_msg_section').style.display = "none";
    }
</script>
@endif
<!-- ___________ Request send success popup start -->


    <div class="dashboard_section">
        <div class="row top_summery">
            <!-- ________________________ -->
            <div class="col-md-6 col-xl-3">
                <div class="card bg-1 h-100">
                    <div class="card-body">
                        <div class="mb-1">
                            <h4 class="card-title text-dark mb-0">{{ __('message.Earnings') }}</h4>
                        </div>
                        <div class="row d-flex align-items-center mb-0">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    <div class="d-f" style="gap: 2em;">
                                        <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                                        {{ number_format(auth()->user()->balance, 2) }}
                                    </div>
                                </h2>
                            </div>
                        </div>
                        <div class="mb-0 last_earning">
                            <h5 class="card-title mb-0"><i
                                    class="fa-solid fa-caret-up"></i><span>+{{ number_format(auth()->user()->balance, 2) }}</span>Last
                                10 Days Earnings</h5>
                        </div>
                        <div class="icon_box">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->
            <!-- ________________________ -->
            <div class="col-md-6 col-xl-3">
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
            <!-- ________________________ -->
            <div class="col-md-6 col-xl-3">
                <div class="card bg-3 h-100">
                    <div class="card-body">
                        <div class="mb-1">
                            <h5 class="card-title text-dark mb-0">{{ __('message.complete_request') }}</h5>
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
                                10 Days Completed Request</h5>
                        </div>
                        <div class="icon_box">
                            <i class="fa-solid fa-clipboard-check"></i>
                        </div>
                    </div>
                    <!--end card body-->
                </div>
                <!--end card-->
            </div> <!-- end col-->
            <!-- ________________________ -->
            <div class="col-md-6 col-xl-3">
                <div class="card bg-4 h-100">
                    <div class="card-body">
                        <div class="mb-0">
                            <h5 class="card-title text-dark mb-0">{{ __('message.total_review') }}</h5>
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
                                10 Days Reviews</h5>
                        </div>
                        <div class="icon_box">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->
            <!-- ________________________ -->
        </div>
        <style>
            .dashboard_section .top_summery .col-xl-3{
                height:100px;
            }
            @media (max-width: 1200px) {
                .dashboard_section .top_summery .col-xl-3{
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
                    <p>{{ __('message.welcome_text_consultant') }}</p>
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
                                <h5>{{ __('message.new_requests') }}</h5>
                                <div class="request_list">
                                    <div class="list_card">
                                        <div class="student_img">
                                            <img src="https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg"
                                                alt="">
                                        </div>
                                        <div class="student_info">
                                            <div class="info_text">
                                                <h5>NI Tushar <span class="new" title="New Request">New</span></h5>
                                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, possimus
                                                    alias placeat deserunt quia</p>
                                                <span class="desktop_span">Assessment</span>
                                            </div>
                                            <div class="button">
                                                <span>Assessment</span>
                                                <div class="open_btn">
                                                    <a href="">Open</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ______________ last completed request start -->
                                <h5>{{ __('message.last_completed') }}</h5>
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
                                            <div class="button">
                                                <span>Assessment</span>
                                                <div class="open_btn">
                                                    <a href="">Open</a>
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
                                            <div class="button">
                                                <span>Assessment</span>
                                                <div class="open_btn">
                                                    <a href="">Open</a>
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
                        <h4>{{ __('message.quick_access') }} <i class="fa-solid fa-arrow-turn-down"></i></h4>
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
                                        <a href="{{ route('consultant.transaction.details', ['action' => 'add_bank_acc']) }}">
                                            <div class="list_icon"><i class="fa-solid fa-money-check-dollar"></i></div>
                                            {{ __('message.bank_account') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.edit') }}">
                                            <div class="list_icon"><i class="fa-solid fa-key"></i></div>
                                            {{ __('message.change_password') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('consultant.transaction.history') }}">
                                            <div class="list_icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                                            {{ __('message.transaction') }}
                                        </a>
                                    </li>
                                    @if( Auth::guard('web')->user()->is_verified != 'Verified')
                                    <li>
                                        <a href="{{ route('consultant.verify.request') }}">
                                            <div class="list_icon"><i class="fa-solid fa-user-check"></i></div>
                                            {{ __('message.verify_request') }}
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5>{{ __('message.your_activities') }}</h5>
                                <ul>
                                    <li>
                                        <a href="{{ route('consultant.services', ['action' => 'create_service'])}}">
                                            <div class="list_icon"><i class="fa-solid fa-bars-staggered"></i></div>
                                            {{ __('message.create_service') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('consultant.assessment.all-request', ['status' => 'accepted']) }}">
                                            <div class="list_icon"><i class="fa-solid fa-layer-group"></i></div>
                                            {{ __('message.accepted_service') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('consultant.education') }}">
                                            <div class="list_icon"><i class="fa-solid fa-graduation-cap"></i></div>
                                            {{ __('message.your_education') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('consultant.experience') }}">
                                            <div class="list_icon"><i class="fa-solid fa-bars-progress"></i></div>
                                            {{ __('message.your_experience') }}
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

@push('script')
<!-- JavaScript for dynamic button visibility -->
<script src="{{ asset('Frontend') }}/./assets/js/popUpAlert.js"></script>

@endpush
