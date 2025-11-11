@php
    $configure = App\Models\Configer::latest()->first();
    $userType = auth()->guard('web')->user()->user_type;
    $currentRoute = Route::currentRouteName();

    // Define active menu detection functions
    $isMenuActive = function($routeName, $parameters = []) use ($currentRoute) {
        // Check if the current route matches the provided route name
        if ($currentRoute !== $routeName) {
            return false;
        }

        // If no parameters are provided, the route match is sufficient
        if (empty($parameters)) {
            return true;
        }

        // Check if the current route's parameters match the provided parameters
        foreach ($parameters as $key => $value) {
            if (request()->route()->parameter($key) !== $value) {
                return false;
            }
        }

        return true;
    };

    $isSubmenuActive = function($routeNames) use ($currentRoute) {
        return in_array($currentRoute, $routeNames);
    };
@endphp

@if ($userType === 'Consultant')
    <div class="main-menu"
        style="background-color:white !important; color:var(--consultant-primary-color) !important;">
        <div class="logo-box">
            <style>
                .app-menu .menu-title {
                    color: black;
                }

                .menu-item a span {
                    color: var(--consultant-primary-color);
                    font-weight: 700;
                }

                /* Active menu styling for Consultant */
                .menu-item a.active,
                .menu-item a.active:hover {
                    background-color: transparent;
                    border-left: 3px solid var(--consultant-primary-color);
                }

                /* Remove active indicator from parent when child is active */
                .menu-item a[aria-expanded="true"].active {
                    border-left: none;
                }

                .menu-item a.active span {
                    color: var(--consultant-primary-color);
                }

                /* Sub-menu active item styling */
                .sub-menu .menu-item a.active {
                    border-left: 3px solid var(--consultant-primary-color);
                    padding-left: calc(1rem - 3px);
                    background-color: transparent;
                }

                /* Menu hover effects */
                .menu-item a:hover {
                    background-color: rgba(255, 172, 56, 0.1);
                }

                /* Expanded submenu styling */
                .menu-item a[aria-expanded="true"] {
                    background-color: transparent;
                }
            </style>
        @else
            <div class="main-menu">
                <!-- Brand Logo -->
                <div class="logo-box">
                <style>
                    /* Student menu text visibility */
                    .app-menu .menu-title {
                        color: #ffffff;
                    }

                    .menu-item a span {
                        color: #ffffff;
                        font-weight: 500;
                    }

                    /* Active menu styling for Student */
                    .menu-item a.active,
                    .menu-item a.active:hover {
                        background-color: transparent;
                        border-left: 3px solid var(--primary-color);
                    }

                    /* Remove active indicator from parent when child is active */
                    .menu-item a[aria-expanded="true"].active {
                        border-left: none;
                    }

                    .menu-item a.active span {
                        color: #ffffff;
                        font-weight: 700;
                    }

                    /* Sub-menu active item styling */
                    .sub-menu .menu-item a.active {
                        border-left: 3px solid var(--primary-color);
                        padding-left: calc(1rem - 3px);
                        background-color: transparent;
                    }

                    /* Ensure submenu items are visible */
                    .sub-menu {
                        display: block !important;
                        padding-left: 0;
                    }

                    .sub-menu .menu-item {
                        list-style-type: none;
                        margin-left: 0;
                    }

                    /* Menu hover effects */
                    .menu-item a:hover {
                        background-color: rgba(255, 255, 255, 0.1);
                    }

                    .menu-item a:hover span {
                        color: #ffffff;
                    }

                    /* Expanded submenu styling */
                    .menu-item a[aria-expanded="true"] {
                        background-color: transparent;
                    }

                    /* Fix for bullet points */
                    .sub-menu li::before {
                        display: none;
                    }

                    /* Fix dropdown indicators */
                    .menu-arrow {
                        color: #ffffff;
                    }
                </style>
@endif

<link rel="stylesheet" href="{{ url('Frontend/dashboard/assets/css/sidebar_custom.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/color.css') }}">

<!-- Brand Logo Light -->
<a href="{{ route('home') }}" class="logo-light">
    @if ($userType === 'Consultant')
        <img src="{{ asset('Frontend/assets/img/logo/logo-red.png') }}" alt="logo" class="logo-lg" width="80%">
        <img src="{{ asset('small-logo-red.png') }}" alt="small logo" class="logo-sm" width="80%">
    @else
        <img src="{{ asset('Frontend/assets/img/logo/logo-blue.png') }}" alt="logo" class="logo-lg" width="80%">
        <img src="{{ asset('small-logo.png') }}" alt="small logo" class="logo-sm h-[30px]">
    @endif
</a>

<!-- Brand Logo Dark -->
@if ($userType === 'Consultant')
    <a href="{{ route('dashboard') }}" class="logo-dark">
        <img src="{{ asset('Frontend/assets/img/logo/logo-red.png') }}" alt="dark logo" class="logo-lg" height="28">
        <img src="{{ asset('small-logo-red.png') }}" alt="small logo" class="logo-sm" height="28">
    </a>
@else
    <a href="{{ route('dashboard') }}" class="logo-dark">
        <img src="{{ asset('Frontend/assets/img/logo/logo-blue.png') }}" alt="dark logo" class="logo-lg h-[50px]" height="28">
        <img src="{{ asset('small-logo.png') }}" alt="small logo" class="logo-sm h-[30px]" height="10">
    </a>
@endif
</div>

<!--- Menu -->
<!-- bg-primary-main -->
<div class="overflow-y-auto border-r border-gray-200 p-4">
    <ul class="space-y-1 text-sm font-medium text-gray-700">

        <!-- Sidebar Title -->
        <li class="text-gray-500 uppercase tracking-wider text-xs font-semibold mb-3">
            {{ __('message.Menu') }}
        </li>


       <!-- Consultant Menu -->
        @if ($userType === 'Consultant')
            <!-- Dashboard -->
            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                    {{ $isMenuActive('dashboard')
                        ? 'text-primary-main font-semibold'
                        : 'text-black' }}">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 w-full group-hover:text-red ">
                    <i class="bx bx-home-smile text-lg"></i>
                    <span>{{ __('message.dashboard') }}</span>
                </a>
            </li>

            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                {{ $isMenuActive('consultant.services') 
                    ? 'text-primary-main font-semibold' 
                    : 'text-black' }}">
                <a href="{{ route('consultant.services') }}" class="flex items-center gap-2 w-full">
                    <i class="fa-regular fa-rectangle-list text-lg"></i>
                    <span>{{ __('message.dashboard_service') }}</span>
                </a>
            </li>


            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                        {{ $isMenuActive('consultant.education') ? 'text-primary-main font-semibold' : 'text-black' }}">
                <a href="{{ route('consultant.education') }}" class="flex items-center gap-2 w-full">
                    <i class="fa-solid fa-graduation-cap text-lg "></i>
                    <span>{{ __('message.dashbaord_my_education') }}</span>
                </a>
            </li>

            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                        {{ $isMenuActive('consultant.assessment.all-request') ? 'text-primary-main font-semibold' : 'text-black' }}">
                <a href="{{ route('consultant.assessment.all-request', ['status' => 'Pending']) }}" class="flex items-center gap-2 w-full">
                    <i class="fa-solid fa-list-ul text-lg "></i>
                    <span>{{ __('message.dashbaord_services') }}</span>
                </a>
            </li>

            <!-- Collapsible Submenu: Services -->
            <!-- @php
                $assessmentRoutes = ['consultant.assessment.all-request', 'consultant.assessment.index'];
                $isAssessmentActive = $isSubmenuActive($assessmentRoutes);
            @endphp

            <li>
                <button type="button"
                        onclick="document.getElementById('consultantServiceMenu').classList.toggle('hidden')"
                        class="group flex items-center justify-between w-full px-3 py-2 rounded-md transition-all duration-200
                            {{ $isAssessmentActive ? 'text-primary-main font-semibold' : 'text-black' }}">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-list-ul text-lg "></i>
                        {{ __('message.dashbaord_services') }}
                    </span>
                    <span><i class="fa-solid fa-angle-down"></i></span>
                </button>

                <ul id="consultantServiceMenu" class="ml-6 mt-1 space-y-1 {{ $isAssessmentActive ? '' : 'hidden' }}">
                    @php
                        $statuses = ['accepted', 'rejected', 'pending','Completed'];
                        $labels = [
                            'accepted' => __('message.accepted_service_sidebar'),
                            'rejected' => __('message.cancelled_service'),
                            'pending' => __('message.pending_service'),
                            'Completed' => __('message.completed_service')
                        ];
                    @endphp
                    @foreach($statuses as $status)
                        <li>
                            <a href="{{ route('consultant.assessment.all-request', ['status' => $status]) }}"
                            class="block px-3 py-1.5 rounded-md group {{ $isMenuActive('consultant.assessment.all-request', ['status' => $status]) ? 'text-primary-main font-semibold' : 'text-black' }}  ">
                                {{ $labels[$status] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li> -->

            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                        {{ $isMenuActive('consultant.experience') ? 'text-primary-main font-semibold' : 'text-black' }}">
                <a href="{{ route('consultant.experience') }}" class="flex items-center gap-2 w-full  ">
                    <i class="fa-solid fa-chart-simple text-lg "></i>
                    <span>{{ __('message.work_experience') }}</span>
                </a>
            </li>

            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                        {{ $isMenuActive('consultant.reviews') ? 'text-primary-main font-semibold' : 'text-black' }}">
                <a href="{{ route('consultant.reviews') }}" class="flex items-center gap-2 w-full  ">
                    <i class="fa-regular fa-comment-dots text-lg "></i>
                    <span>{{ __('message.reviews') }}</span>
                </a>
            </li>

            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                        {{ $isMenuActive('my.trainings') ? 'text-primary-main font-semibold' : 'text-black' }}">
                <a href="{{ route('my.trainings') }}" class="flex items-center gap-2 w-full  ">
                    <i class="fa-solid fa-gears text-lg "></i>
                    <span>{{ __('message.my_training') }}</span>
                </a>
            </li>
        @endif

        <!-- Student Menu -->
        @if ($userType === 'Student')
            <!-- Dashboard -->
            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                        {{ $isMenuActive('dashboard')
                            ? 'text-primary-light font-semibold'
                            : 'text-white' }}">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 w-full group-hover:text-red ">
                    <i class="bx bx-home-smile text-lg"></i>
                    <span>{{ __('message.dashboard') }}</span>
                </a>
            </li>

            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                        {{ $isMenuActive('student.choice') ? 'text-primary-light font-semibold' : 'text-white' }}">
                <a href="{{ route('student.choice') }}" class="flex items-center gap-2 w-full  ">
                    <i class="fa-solid fa-bars-staggered text-lg "></i>
                    <span>{{ __('message.your_choice') }}</span>
                </a>
            </li>

            <!-- Qualification Submenu -->
            @php
                $qualificationRoutes = ['student.lastEducation', 'student.info'];
                $isQualificationActive = $isSubmenuActive($qualificationRoutes);
            @endphp
            <li class="group">
                <button type="button"
                        onclick="document.getElementById('studentQualificationMenu').classList.toggle('hidden')"
                        class="group flex items-center justify-between w-full px-3 py-2 rounded-md transition-all duration-200
                            {{ $isQualificationActive ? 'text-primary-light font-semibold' : 'text-white' }} 
                              ">
                    <span class="flex items-center gap-2  ">
                        <i class="fa-solid fa-award text-lg "></i>
                        {{ __('message.Qualification') }}
                    </span>
                    <span class=""><i class="fa-solid fa-chevron-down"></i></span>
                </button>

                <ul id="studentQualificationMenu" class="ml-6 mt-1 space-y-1 {{ $isQualificationActive ? '' : 'hidden' }}">
                    <li>
                        <a href="{{ route('student.profile.action', 'last-education') }}"
                        class="block px-2 py-1 rounded-md {{ $isMenuActive('student.lastEducation') ? 'text-primary-light font-semibold' : 'text-white' }}">
                            {{ __('message.last_education') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.info.add') }}"
                        class="block px-3 py-1.5 rounded-md {{ $isMenuActive('student.info') ? 'text-primary-light font-semibold' : 'text-white' }}">
                            {{ __('message.Academic') }}
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Service Submenu -->
            @php
                $assessmentRoutes = ['student.assessment.index', 'student.assessment.all-request', 'student.assessment.draft'];
                $isAssessmentActive = $isSubmenuActive($assessmentRoutes);
            @endphp
            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                        {{ $isMenuActive('student.assessment.all-request') ? 'text-primary-light font-semibold' : 'text-white' }}">
                <a href="{{ route('student.assessment.all-request') }}" class="flex items-center gap-2 w-full  ">
                    <i class="bx bx-file text-lg "></i>
                    <span>{{ __('message.Service') }}</span>
                </a>
            </li>
            <li class="group flex items-center gap-2 px-3 py-2 rounded-md transition-all duration-200
                        {{ $isMenuActive('consultant.list') ? 'text-primary-light font-semibold' : 'text-white' }}">
                <a href="{{ route('consultant.list') }}" class="flex items-center gap-2 w-full  ">
                    <i class="fa-solid fa-user-tie text-lg "></i>
                    <span>{{ __('message.Consultants') }}</span>
                </a>
            </li>

            <!--             
                <li class="group hidden" style="display:none !important">
                    <button type="button"
                            onclick="document.getElementById('studentServiceMenu').classList.toggle('hidden')"
                            class="group flex items-center justify-between w-full px-3 py-2 rounded-md transition-all duration-200
                                {{ $isAssessmentActive ? 'text-primary-main font-semibold' : 'text-white' }}  ">
                        <span class="flex items-center gap-2  ">
                            <i class="bx bx-file text-lg "></i>
                            {{ __('message.Service') }}
                        </span>
                        <span class=""><i class="fa-solid fa-chevron-down"></i></span>
                    </button>

                    <ul id="studentServiceMenu" class="ml-6 mt-1 space-y-1 {{ $isAssessmentActive ? '' : 'hidden' }}">
                        <li>
                            <a href="{{ route('student.assessment.index') }}"
                            class="block px-3 py-1.5 rounded-md group {{ $isMenuActive('student.assessment.index') ? 'text-primary-main font-semibold' : 'text-white' }}">
                                {{ __('message.Request') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('student.assessment.all-request') }}"
                            class="block px-3 py-1.5 rounded-md group {{ $isMenuActive('student.assessment.all-request') ? 'text-primary-main font-semibold' : 'text-white' }}">
                                {{ __('message.all_service') }}
                            </a>
                        </li>
                    </ul>
                </li>
            -->

        @endif


    </ul>
</div>


</div>
