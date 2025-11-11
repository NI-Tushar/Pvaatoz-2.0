@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')
    <link rel="stylesheet" href="{{ url('Frontend/assets/css/dashboard_card.css') }}">
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


<div class="dashboard_section hidden"style="display:none !important;">
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

<!-- SUMMERY AND PROFILE SECTION START -->
 <div class="dashbaord_profile_section" style="background-image: url('{{ asset('Frontend/assets/img/bg/student_bg.png') }}')">
    <div class="summery_section">
        <div class="summery_card">
            <div class="summery_text">
                <p>{{ __("message.Earnings") }}</p>
                <h2>06</h2>
            </div>
            <div class="summery_icon">
                <img src="{{ asset('Frontend/assets/icons/file.png') }}" alt="" />
            </div>
        </div>

        <div class="summery_card">
            <div class="summery_text">
                <p>{{ __("message.total_request") }}</p>
                <h2>06</h2>
            </div>
            <div class="summery_icon">
                <img src="{{ asset('Frontend/assets/icons/healthy.png') }}" alt="" />
            </div>
        </div>

        <div class="summery_card">
            <div class="summery_text">
                <p>{{ __("message.complete_request") }}</p>
                <h2>06</h2>
            </div>
            <div class="summery_icon">
                <img src="{{ asset('Frontend/assets/icons/check.png') }}" alt="" />
            </div>
        </div>

        <div class="summery_card">
            <div class="summery_text">
                <p>{{ __("message.total_review") }}</p>
                <h2>06</h2>
            </div>
            <div class="summery_icon">
                <img src="{{ asset('Frontend/assets/icons/check.png') }}" alt="" />
            </div>
        </div>
    </div>

    <div class="profile_section">
        <div class="pro_img_name relative inline-block">
            <!-- Profile Image -->
            <img src="{{ auth()->guard('web')->user()->image ? asset(auth()->guard('web')->user()->image) : asset('no-profile-img.png') }}" alt="Profile Image"
                class="cursor-pointer pro_img inline-block"/>
            <!-- Edit Icon -->
            <i class="fa-regular fa-pen-to-square absolute left-[25px] top-[13px] md:top-[25px] text-[2rem] md:text-[5rem] cursor-pointer opacity-0 transition-opacity duration-300 selectable-profile-img cursor-pointer text-white"></i>
            <!-- Hidden Form -->
            <form id="profileImageForm" action="{{ route('update.profile.image') }}" method="POST" enctype="multipart/form-data" class="d-none">
                @csrf
                <input type="file" name="image" id="profileImageFile" accept="image/*"/>
            </form>

            <h3 class="text-[30px] font-bold text-white">
                {{ auth()->guard('web')->user()->name }}
            </h3>
        </div>

        <style>
            /* Show icon on image hover */
            .pro_img_name i:hover {
                opacity: 1 !important;
            }
        </style>
    </div>
</div>
<!-- SUMMERY AND PROFILE SECTION END -->

<!-- ACTION SECTION START -->
<div class="action_section">
    <div class="centered_action">

        <a class="action_button {{ $action == 'last-education' ? 'active' : '' }}" href="{{ route('consultant.service.create') }}">
            <img src="{{ asset('Frontend/assets/icons/services.png') }}" alt="" />
            <p>{{ __("message.create_service") }}</p>
        </a>

        <a class="action_button {{ $action == 'choice-create' ? 'active' : '' }}" href="{{ route('consultant.education') }}">
            <img src="{{ asset('Frontend/assets/icons/graduate-cap.png') }}" alt="" />
            <p>{{ __("message.dashbaord_my_education") }}</p>
        </a>

        <a class="action_button {{ $action == 'work_experience' ? 'active' : '' }}" href="{{ route('consultant.experience') }}">
            <img src="{{ asset('Frontend/assets/icons/experience.png') }}" alt="" />
            <p>{{ __("message.work_experience") }}</p>
        </a>

        <a class="action_button {{ $action == 'get-assessment' ? 'active' : '' }}" href="{{ route('consultant.assessment.all-request','Pending') }}">
            <img src="{{ asset('Frontend/assets/icons/filePending.png') }}" alt="" />
            <p>{{ __("message.Request") }}</p>
        </a>

    </div>
</div>
<!-- ACTION SECTION END -->

<!-- THREE CARDS START -->
<div class="dashboard_section">
    <div class="wellcome_text mt-4">
        <div class="user_header_dashboard">
            @if (auth()->guard('web')->user()->user_type === 'Consultant')
            <h4>
                <i class="fa-solid fa-user-graduate"></i>
                {{ __("message.consultant_dashboard") }}
            </h4>
            @else
            <h4>
                <i class="fa-solid fa-user-graduate"></i>
                {{ __("message.student_dashboard") }}
            </h4>
            @endif
        </div>
        <!-- page messsage start -->
        <div id="text_div_consultant" class="text_div">
            <div onclick="closeConsultantMsgFunction()" class="close_icon">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <h3 class="font-bold text-[25px] mb-2">
                {{ __("message.welcome") }}
                <span>{{ auth()->guard('web')->user()->name }}!</span>
            </h3>
            @php
                $message = __("message.welcome_text_consultant");
                
                // Split message into words
                $words = preg_split('/\s+/', trim($message));
                
                $totalWords = count($words);
                $wordsPerPart = ceil($totalWords / 3);
                
                // Split words into 3 chunks
                $chunks = array_chunk($words, $wordsPerPart);
                
                // Convert each chunk back into a string
                $parts = array_map(fn($chunk) => implode(' ', $chunk), $chunks);
            @endphp
                
            <div class="text_p block md:flex gap-3">
                <div class="pr-2 text-black font-bold">{{ $parts[0] }}</div>
                <div class="px-2 text-black font-bold">{{ $parts[1] }}</div>
                <div class="pl-2 text-black font-bold">{{ $parts[2] }}</div>
            </div>        
        </div>

        <script>
            function closeConsultantMsgFunction() {
                document.getElementById("text_div_consultant").style.display = "none";
            }
        </script>
        <!-- page messsage start -->
        <div class="row mt-3">
            <!-- ________________________ -->
            <div class="col-md-12 col-xl-4">
                <div class="card quick_card">
                    <div class="card_heading">
                        <h4>{{ __("message.your_profile") }}</h4>
                        <img src="{{ asset('Frontend/assets/icons/user.png') }}" alt="" />
                    </div>
                    @php $progress = auth()->user()->profile_completion; @endphp
                    <!-- progress -->
                    <div class="profile_info" style="height: 70%">
                        <div class="percent_circle" style="margin-top: auto; margin-bottom: auto">
                            <div class="circle" id="circle" style="--percent: 0">
                                <div class="inner" id="percent">{{ $progress }}%</div>
                            </div>
                        </div>
                        <div class="percent_text">
                            <div>
                                <h4>{{ __("message.profile_information") }}</h4>
                                <p>{{ __("message.profile_information_text") }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- progress -->
                    <div class="card_btn_section">
                        <a href="{{ route('profile.edit') }}"><button class="text-black hover:!text-white">{{ __("message.update_document") }}</button></a>
                        <a href="{{ route('profile.edit') }}"><button class="active">{{ __("message.update_profile") }}</button></a>
                    </div>

                    <script>
                        // Pass Laravel value into JS
                        let targetPercent = {{ $progress ?? 0 }}; // fallback 0 if null

                        function animatePercentage(target) {
                            let current = 0;
                            let circle = document.getElementById("circle");
                            let text = document.getElementById("percent");

                            let interval = setInterval(() => {
                                if (current >= target) {
                                    clearInterval(interval);
                                } else {
                                    current++;
                                    circle.style.setProperty("--percent", current);
                                    text.textContent = current + "%";
                                }
                            }, 20);
                        }

                        animatePercentage(targetPercent);
                    </script>
                </div>
            </div>
            <!-- ________________________ -->
            <div class="col-md-12 col-xl-4">
                <div class="card quick_card">
                    <div class="card_heading">
                        <h4>{{ __("message.your_account") }}</h4>
                        <img src="{{ asset('Frontend/assets/icons/wallet.png') }}" alt="" />
                    </div>
                    <!-- progress -->
                    <div class="profile_info">
                        <div class="percent_circle taka_sign">
                            <img src="{{ asset('Frontend/assets/icons/taka_icon.png') }}" alt="" />
                        </div>
                        <div class="percent_text">
                            <div>
                                <h4>{{ __("message.Balance") }}:</h4>
                                <p>{{auth()->user()->balance}} BDT</p>
                            </div>
                        </div>
                    </div>
                    <!-- progress -->
                    <div class="account_links">
                        <div>
                            <img src="{{ asset('Frontend/assets/icons/wallet.png') }}" alt="" />
                            <p>Last Deposit: <span> BDT</span></p>
                        </div>

                        <div>
                            <img src="{{ asset('Frontend/assets/icons/money-received.png') }}" alt="" />
                            <p>Last Transaction: <span>250.25 BDT</span></p>
                        </div>

                        <div>
                            <img src="{{ asset('Frontend/assets/icons/shopping.png') }}" alt="" />
                            <p>Total Transaction: <span>66850.25 BDT</span></p>
                        </div>
                    </div>

                    <div class="card_btn_section">
                        <a href="{{ route('student.cashin') }}"><button class="text-black hover:!text-white">{{ __("message.all_trans") }}</button></a>
                        <a href="{{ route('student.cashin') }}"><button class="active">{{ __("message.add_money") }}</button></a>
                    </div>
                </div>
            </div>
            <!-- ________________________ -->
            <div class="col-md-12 col-xl-4">
                <div class="card user_request_card">
                    <div class="card-body p-3">
                        <div class="body_list">
                            <!-- ______________ Pro consultants -->
                            @if(isset($pro_consultancyService) && $pro_consultancyService->isNotEmpty())
                            <div class="quick_view_heading pro">
                                <img src="{{ asset('Frontend/assets/icons/crown.png') }}" alt="" />
                                <span>{{ __("message.pro_consultant") }}</span>
                            </div>
                            @foreach($pro_consultancyService as $pro_user)
                            <div class="request_list">
                                <div class="list_card">
                                    <div class="student_img">
                                        <img src="{{ $pro_user->user && $pro_user->user->image ? asset($pro_user->user->image) : asset('no-profile-img.png') }}" alt="" />
                                    </div>
                                    <div class="student_info">
                                        <div class="info_text">
                                            <h5>{{ \Illuminate\Support\Str::limit($pro_user->title, 30) }}</h5>
                                            <p>{{ \Illuminate\Support\Str::limit($pro_user->description, 70) }}</p>
                                        </div>
                                        <div class="student_button">
                                            <div>
                                                <span>{{ $pro_user->country ?? 'N/A' }}</span>
                                            </div>
                                            <div class="open_btn">
                                                <a href="{{ route('assessment.requesting', ['service_id' => $pro_user->id]) }}">{{ __("message.request") }} <i class="fa-solid fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach 
                            @endif
                            <!-- ______________ verified consultants -->
                            @if(isset($verified_consultancyService) && $verified_consultancyService->isNotEmpty())
                            <h5 class="quick_view_heading verrified">
                                <img src="{{ asset('Frontend/assets/icons/approved.png') }}" alt="" />
                                <span>{{ __("message.verified_consultants") }}</span>
                            </h5>
                            @foreach($verified_consultancyService as $verified_user)
                            <div class="request_list">
                                <div class="list_card">
                                    <div class="student_img">
                                        <img src="{{ $verified_user->user && $verified_user->user->image ? asset($verified_user->user->image) : asset('no-profile-img.png') }}" alt="" />
                                    </div>
                                    <div class="student_info">
                                        <div class="info_text">
                                            <h5>{{ \Illuminate\Support\Str::limit($verified_user->title, 30) }}</h5>
                                            <p>{{ \Illuminate\Support\Str::limit($verified_user->description, 70) }}</p>
                                        </div>
                                        <div class="student_button">
                                            <div>
                                                <span>{{ $verified_user->country ?? 'N/A' }}</span>
                                            </div>
                                            <div class="open_btn">
                                                <a href="{{ route('assessment.requesting', ['service_id' => $verified_user->id]) }}">{{ __("message.request") }} <i class="fa-solid fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach 
                            @endif
                            <!-- ______________ consultants -->
                            @if(isset($reguler_consultancyService) && $reguler_consultancyService->isNotEmpty())
                            <h5 class="quick_view_heading verrified">
                                <img src="{{ asset('Frontend/assets/icons/profile.png') }}" alt="" />
                                <span>{{ __("message.reguler_consultants") }}</span>
                            </h5>
                            @foreach($reguler_consultancyService as $reguler_user)
                            <div class="request_list">
                                <div class="list_card">
                                    <div class="student_img">
                                        <img src="{{ $reguler_user->user && $reguler_user->user->image ? asset($reguler_user->user->image) : asset('no-profile-img.png') }}" alt="" />
                                    </div>
                                    <div class="student_info">
                                        <div class="info_text">
                                            <h5>{{ \Illuminate\Support\Str::limit($reguler_user->title, 30) }}</h5>
                                            <p>{{ \Illuminate\Support\Str::limit($reguler_user->description, 70) }}</p>
                                        </div>
                                        <div class="student_button">
                                            <div>
                                                <span>{{ $reguler_user->country ?? 'N/A' }}</span>
                                            </div>
                                            <div class="open_btn">
                                                <a href="{{ route('assessment.requesting', ['service_id' => $reguler_user->id]) }}">{{ __("message.request") }} <i class="fa-solid fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach 
                            @endif 
                            @if( (!isset($pro_consultancyService) || $pro_consultancyService->isEmpty() ) && ( !isset($verified_consultancyService) || $verified_consultancyService->isEmpty() ) && ( !isset($reguler_consultancyService) || $reguler_consultancyService->isEmpty() ) )
                            <p class="no_service_msg">No consultancy services found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- ________________________ -->
        </div>
    </div>
</div>
<!-- THREE CARDS END -->


@endsection

@push('script')
<!-- JavaScript for dynamic button visibility -->
<script src="{{ asset('Frontend') }}/./assets/js/popUpAlert.js"></script>


<!-- for update profile image start -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).on("click", ".selectable-profile-img", function () {
        // Trigger the file input
        $("#profileImageFile").click();
    });

    // When a file is selected, auto-submit the form
    $("#profileImageFile").on("change", function () {
        if (this.files.length > 0) {
            $("#profileImageForm").submit();
        }
    });
</script>
<!-- for update profile image end -->

@endpush
