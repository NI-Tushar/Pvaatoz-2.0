@extends('Frontend.Dashboard.Layouts.master') 
@section('title', 'Consultant')
@section('master-content')
<link rel="stylesheet" href="{{ url('Frontend/assets/css/dashboard_card.css') }}"/>
<link rel="stylesheet" href="{{ url('Frontend/assets/css/dashboard_form_section.css') }}"/>
<link rel="stylesheet" href="{{ url('Frontend/dashboard/assets/css/user_navbar_custom.css') }}"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/github.min.css"/>
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

<!-- ACTION ALERT MESSAGES -->
@if(session('lastEdu_success_message'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('lastEdu_success_message') }}',
        confirmButtonColor: '#fb7b0b',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    });
</script>
@endif 

<div class="dashbaord_profile_section" style="background-image: url('{{ asset('Frontend/assets/img/bg/student_bg.png') }}')">
    <div class="summery_section">
        <div class="summery_card">
            <div class="summery_text">
                <p>{{ __("message.total_request") }}</p>
                <h2>06</h2>
            </div>
            <div class="summery_icon">
                <img src="{{ asset('Frontend/assets/icons/file.png') }}" alt="" />
            </div>
        </div>

        <div class="summery_card">
            <div class="summery_text">
                <p>{{ __("message.complete_request") }}</p>
                <h2>06</h2>
            </div>
            <div class="summery_icon">
                <img src="{{ asset('Frontend/assets/icons/healthy.png') }}" alt="" />
            </div>
        </div>

        <div class="summery_card">
            <div class="summery_text">
                <p>{{ __("message.active_consultants") }}</p>
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

<!-- ACTION SECTION -->
<div class="action_section">
    <div class="centered_action">

        <a class="action_button {{ $action == 'last-education' ? 'active' : '' }}" href="{{ route('student.profile.action', 'last-education') }}">
            <img src="{{ asset('Frontend/assets/icons/graduate-cap.png') }}" alt="" />
            <p>{{ __("message.last_education") }}</p>
            <div class="right_arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a class="action_button {{ $action == 'choice-create' ? 'active' : '' }}" href="{{ route('student.profile.action', 'choice-create') }}">
            <img src="{{ asset('Frontend/assets/icons/edit.png') }}" alt="" />
            <p>{{ __("message.choice_create_menu") }}</p>
            <div class="right_arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a class="action_button {{ $action == 'send-request' ? 'active' : '' }}" href="{{ route('consultant.list') }}">
            <img src="{{ asset('Frontend/assets/icons/send.png') }}" alt="" />
            <p>{{ __("message.send_request") }}</p>
            <div class="right_arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a class="action_button {{ $action == 'get-assessment' ? 'active' : '' }}" href="{{ route('student.profile.action', 'get-assessment') }}">
            <img src="{{ asset('Frontend/assets/icons/registered-document.png') }}" alt="" />
            <p>{{ __("message.get_assessment") }}</p>
        </a>

    </div>
</div>

<!-- LAST EDUCATION -->
@if($action == 'last-education')

<div id="text_div_last_edu" class="relative bg-white border-2 border-[#FB7B0B] rounded-lg shadow-[0_1px_3px_0_rgba(0,0,0,0.02),0_0_0_1px_rgba(27,31,35,0.15)] p-4 mt-3 mb-1">
        <div onclick="closelastedu()" class="absolute top-2 right-2 h-5 w-5 flex cursor-pointer hover:text-black text-gray-600">
        <i class="fa-solid fa-xmark m-auto"></i>
    </div>
    <h3 class="font-bold text-[25px] mb-2">
        <h3 class="font-bold text-[20px] md:text-[25px] mb-2 text-[var(--consultant-primary-color)] font-[Poppins,sans-serif]">
            {{ __("message.last_edu_heading") }}
        </h3>
    </h3>
    @php
        $message = __("message.last_edu_page_message");

        // Split message into words
        $words = preg_split('/\s+/', trim($message));

        $totalWords = count($words);
        $wordsPerPart = ceil($totalWords / 2);

        // Split words into 3 chunks
        $chunks = array_chunk($words, $wordsPerPart);

        // Convert each chunk back into a string
        $parts = array_map(fn($chunk) => implode(' ', $chunk), $chunks);
    @endphp

    <div class="text_p block md:flex gap-3">
        <div class="pr-2 text-black font-bold">{{ $parts[0] }}</div>
        <div class="px-2 text-black font-bold">{{ $parts[1] }}</div>
    </div>
</div>
<script>
    function closelastedu() {
        document.getElementById("text_div_last_edu").style.display = "none";
    }
</script>

<div class="dashboard_section">
    <div class="wellcome_text mt-2">
        <div class="row mt-1">
            <!-- ________________________ -->
            <div class="col-md-12 col-xl-12">
                <div class="card quick_card w-full p-0 h-auto bg-white rounded-lg shadow" style="padding: 0 !important">
                    <!-- Section Heading -->
                    <div class="section_heading mb-6">
                        <div class="heading_part flex items-center gap-3">
                            <img src="{{ asset('Frontend/assets/icons/graduate-cap.png') }}" alt="" class="w-8 h-8" />
                            <h5 class="text-[15px] md:text-xl font-semibold text-gray-800">
                                {{ __("message.update_last_education") }}
                            </h5>
                        </div>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('student.lastEducation') }}" enctype="multipart/form-data" class="w-full">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-[2rem] py-[1rem]">
                            <!-- Left Side -->
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-black font-bold text-[17px] mb-1">Title of Your Education:</label>
                                    <input type="text" name="last_edu_title" value="@if($last_edu && $last_edu->last_edu_title) {{ $last_edu->last_edu_title }} @endif"
                                        placeholder="Enter the title of your education"
                                        class="w-full border border-gray-300 outline-none text-black text-black text-[17px] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
                                </div>

                                <div>
                                    <label class="block text-black font-bold text-[17px] mb-1">Group/Department:</label>
                                    <input type="text" name="last_edu_department" value="@if($last_edu && $last_edu->last_edu_department) {{ $last_edu->last_edu_department }} @endif"
                                        placeholder="Enter your department"
                                        class="w-full border border-gray-300 outline-none text-black text-[17px] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
                                </div>

                                <div>
                                    <label class="block text-black font-bold text-[17px] mb-2">
                                        Session:
                                        <span class="font-normal">
                                            @if($last_edu && $last_edu->last_edu_startDate)
                                            {{ \Carbon\Carbon::parse($last_edu->last_edu_startDate)->format('d M Y') }}
                                            @endif - @if($last_edu && $last_edu->last_edu_endDate)
                                            {{ \Carbon\Carbon::parse($last_edu->last_edu_endDate)->format('d M Y') }}@endif
                                        </span>
                                    </label>
                                    <div class="flex gap-4">
                                        <!-- Start Date -->
                                        <div class="flex flex-col w-1/2">
                                            <label class="text-[15px] text-black mb-1">Start: @if($last_edu && $last_edu->last_edu_startDate) {{ $last_edu->last_edu_startDate }} @endif</label>
                                            <input type="date" name="last_edu_startDate" placeholder="Start Date"
                                                class="border border-gray-300 text-[17px] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-black"/>
                                        </div>

                                        <!-- End Date -->
                                        <div class="flex flex-col w-1/2">
                                            <label class="text-[15px] text-black mb-1">End: <span>@if($last_edu && $last_edu->last_edu_endDate) {{$last_edu->last_edu_endDate}} @endif</span></label>
                                            <input type="date" name="last_edu_endDate" placeholder="End Date"
                                                class="border border-gray-300 text-[17px] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-black"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side -->
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-black font-bold text-[17px] mb-1">Duration:</label>
                                    <input type="text" name="last_edu_Duration" value="@if($last_edu && $last_edu->last_edu_Duration) {{$last_edu->last_edu_Duration}} @endif"
                                        placeholder="Enter the duration"
                                        class="w-full border border-gray-300 outline-none text-black text-[17px] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
                                </div>

                                <div>
                                    <label class="block text-black font-bold text-[17px] mb-1">Result:</label>
                                    <input type="text" name="last_edu_result" value="@if($last_edu && $last_edu->last_edu_result) {{$last_edu->last_edu_result}} @endif"
                                        placeholder="Enter the result"
                                        class="w-full border border-gray-300 outline-none text-black text-[17px] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
                                </div>

                                <div>
                                    <div class="block">
                                        <label class="block text-black font-bold text-[17px] mb-1">Certificate/Documents:</label>
                                        <!-- Show "Open" button if file exists -->
                                        @if(isset($last_edu->last_edu_certificate) && $last_edu->last_edu_certificate)
                                        <div class="w-auto _df_button bg-transparent border-0 px-0 py-0 text-primary-main text-[15px] font-bold" source="{{ asset('storage/' . $last_edu->last_edu_certificate) }}">
                                            {{ basename($last_edu->last_edu_certificate) }}
                                        </div>
                                        @endif
                                    </div>
                                    <!-- File input to attach new file -->
                                    <input
                                        type="file" name="last_edu_certificate"
                                        class="border w-full border-gray-300 text-black text-[15px] rounded px-2 py-2 file:mr-3 file:py-2 file:px-2 file:rounded file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200"/>
                                </div>
                            </div>

                            <!-- Update Button -->
                            <div class="w-full flex justify-end md:col-span-2">
                                <button type="submit" class="w-full md:w-auto bg-primary-main text-white font-bold text-[18px] px-[4rem] py-2 rounded shadow-md hover:bg-primary-light transition duration-300">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CHOICE CREATION -->
@elseif($action == 'choice-create')
    <div id="text_div_choice" class="relative bg-white border-2 border-[#FB7B0B] rounded-lg shadow-[0_1px_3px_0_rgba(0,0,0,0.02),0_0_0_1px_rgba(27,31,35,0.15)] p-4 mt-3 mb-1">
            <div onclick="closeChoiceMessage()" class="absolute top-2 right-2 h-5 w-5 flex cursor-pointer hover:text-black text-gray-600">
            <i class="fa-solid fa-xmark m-auto"></i>
        </div>
        <h3 class="font-bold text-[25px] mb-2">
            <h3 class="font-bold text-[20px] md:text-[25px] mb-2 text-[var(--consultant-primary-color)] font-[Poppins,sans-serif]">
                {{ __("message.choice_create_message_heading") }}
            </h3>
        </h3>
        @php
            $message = __("message.choice_create_page_message");

            // Split message into words
            $words = preg_split('/\s+/', trim($message));

            $totalWords = count($words);
            $wordsPerPart = ceil($totalWords / 2);

            // Split words into 3 chunks
            $chunks = array_chunk($words, $wordsPerPart);

            // Convert each chunk back into a string
            $parts = array_map(fn($chunk) => implode(' ', $chunk), $chunks);
        @endphp

        <div class="text_p block md:flex gap-3">
            <div class="pr-2 text-black font-bold">{{ $parts[0] }}</div>
            <div class="px-2 text-black font-bold">{{ $parts[1] }}</div>
        </div>
    </div>
    <script>
        function closeChoiceMessage() {
            document.getElementById("text_div_choice").style.display = "none";
        }
    </script>

    <div class="dashboard_section">
        <div class="wellcome_text mt-2">
            <div class="row mt-1">
                <!-- ________________________ -->
                <div class="col-md-12 col-xl-12">
                    <div class="card quick_card w-full p-0 h-auto bg-white rounded-lg shadow" style="padding: 0 !important">
                        <!-- Section Heading -->
                        <div class="section_heading">
                            <div class="heading_part flex items-center gap-1">
                                <img src="{{ asset('Frontend/assets/icons/edit.png') }}" alt="" class="w-8 h-8" />
                                <h5 class="text-[15px] md:text-xl font-semibold text-primary-main">
                                    দেশ এবং বিশ্ববিদ্যালয়ের নাম দিয়ে চয়েজ তৈরি করুন
                                </h5>
                            </div>
                        </div>

                        <!-- Form start -->
                        <form  method="POST" action="{{route('student.choice.create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- last edu form -->
                            <div class="p-2">
                                <div class="bg-gray-200 p-3 border border-black rounded" x-data="{ open: false }">
                                    <!-- Toggle Button -->
                                    <button type="button" @click="open = !open" class="w-full flex justify-between items-center focus:outline-none">
                                        <span class="font-semibold text-black text-lg">Update Last Education</span>
                                        <svg :class="{'rotate-180': open}" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Collapsible Content -->
                                    <div x-show="open" x-transition class="mt-2">
                                        <div class="">
                                            <div class="choice_content pb-2">
                                                <div class="box_sec flex flex-col sm:flex-row sm:flex-wrap gap-2">
                                                    <!-- Title -->
                                                    <div class="box w-full sm:w-auto sm:border-l sm:border-gray-300 sm:pl-3 sm:pr-3">
                                                        <label class="block text-black font-bold mb-1">Title</label>
                                                        <input name="last_edu_title" type="text" value="{{ $last_edu->last_edu_title ?? '' }}" class="w-full border border-gray-700 rounded px-3 py-2 text-black font-semibold outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                                    </div>

                                                    <!-- Group/Department -->
                                                    <div class="box w-full sm:w-auto sm:border-l sm:border-gray-300 sm:pl-3 sm:pr-3">
                                                        <label class="block text-black font-bold mb-1">Group/Department</label>
                                                        <input name="last_edu_department" type="text" value="{{ $last_edu->last_edu_department ?? '' }}" class="w-full border border-gray-700 rounded px-3 py-2 text-black font-semibold outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                                    </div>

                                                    <!-- Duration -->
                                                    <div class="box w-full sm:w-auto sm:border-l sm:border-gray-300 sm:pl-3 sm:pr-3">
                                                        <label class="block text-black font-bold mb-1">Duration (In Years)</label>
                                                        <input name="last_edu_Duration" type="text" value="{{ $last_edu->last_edu_Duration ?? '' }}" class="w-full border border-gray-700 rounded px-3 py-2 text-black font-semibold outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                                    </div>

                                                    <!-- Result -->
                                                    <div class="box w-full sm:w-auto sm:border-l sm:border-gray-300 sm:pl-3 sm:pr-3">
                                                        <label class="block text-black font-bold mb-1">Result (GPA/CGPA)</label>
                                                        <input name="last_edu_result" type="text" value="{{ $last_edu->last_edu_result ?? '' }}" class="w-full border border-gray-700 rounded px-3 py-2 text-black font-semibold outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                                    </div>

                                                    <!-- Session -->
                                                    <div class="box w-full sm:w-auto sm:border-l sm:border-gray-300 sm:pl-3 sm:pr-3">
                                                        <label class="block text-black font-bold mb-1">Session</label>
                                                        <div class="session flex flex-col sm:flex-row gap-3">
                                                            <div class="date flex items-center gap-2 w-full sm:w-auto">
                                                                <p class="text-gray-600 font-medium">Start:</p>
                                                                <input name="last_edu_startDate" type="date" value="{{ $last_edu->last_edu_startDate ?? '' }}" class="w-full border border-gray-700 rounded px-3 py-2 text-black font-semibold outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                                            </div>

                                                            <div class="date flex items-center gap-2 w-full sm:w-auto">
                                                                <p class="text-gray-600 font-medium">End:</p>
                                                                <input name="last_edu_endDate" type="date" value="{{ $last_edu->last_edu_endDate ?? '' }}" class="w-full border border-gray-700 rounded px-3 py-2 text-black font-semibold outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Birth Date -->
                                                    <div class="box w-full sm:w-auto sm:border-l sm:border-gray-300 sm:pl-3 sm:pr-3">
                                                        <label class="block text-black font-bold mb-1">Your Birth Date</label>
                                                        <input name="date_of_birth" type="date" value="{{ Auth::guard('web')->user()->date_of_birth ?? '' }}" class="w-full border border-gray-700 rounded px-3 py-2 text-black font-semibold outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- choice form -->
                            @if($last_edu)
                            <div class="p-3">
                                <div>
                                    <h4 class="text-xl font-semibold mb-4">Create Your Choice</h4>
                                </div>

                                <div class="flex flex-col md:flex-row gap-6">
                                    <div class="flex-1 space-y-4">
                                        <div>
                                            <label for="service" class="block text-black font-bold text-[16px] mb-1">Select Service</label>
                                            <select id="service" name="service_id" required class="w-full border border-gray-300 outline-none rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                <option value="" disabled selected>Select a Service</option>
                                                @if($services && $services->count())
                                                    @foreach($services as $service)
                                                    <option class="text-black font-bold" value="{{ $service->id }}">{{ $service->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option disabled>No services available</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div>
                                            <label for="country" class="block text-black font-bold text-[16px] mb-1">
                                                Your Preferred Country
                                            </label>

                                            <!-- Searchable dropdown container -->
                                            <div class="relative">
                                                <input type="text" id="countrySearch" placeholder="Search Country..." 
                                                    class="w-full border border-gray-300 rounded-lg px-3 py-[12px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                    autocomplete="off">
                                                
                                                <!-- Dropdown list -->
                                                <ul id="countryList" 
                                                    class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-60 overflow-y-auto hidden">
                                                    @foreach($countries as $country)
                                                        <li class="px-3 py-2 text-black font-bold hover:bg-blue-100 cursor-pointer" data-value="{{ $country }}">
                                                            {{ $country }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <!-- Hidden input to hold selected value -->
                                            <input type="hidden" name="country" id="countryInput">
                                        </div>

                                    <div class="relative">
                                            <label for="institute" class="block text-black font-bold text-[16px] mb-1">
                                                Your Preferred Institution
                                            </label>

                                            <input type="text" id="institute" name="institute" placeholder="Write Institution/University Name" 
                                                class="w-full border border-gray-300 outline-none rounded-lg px-3 py-[12px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                autocomplete="off"/>

                                            <!-- Dropdown suggestion box -->
                                            <ul id="instituteList" 
                                                class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-60 overflow-y-auto hidden shadow-md">
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="flex-1 space-y-4">
                                        <div class="relative">
                                            <label for="subject" class="block text-black font-bold text-[16px] mb-1">
                                                Your Preferred Subject
                                            </label>

                                            <input type="text" id="subject" name="subject" placeholder="Write Subject Name" 
                                                class="w-full border border-gray-300 outline-none rounded-lg px-3 py-[12px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                autocomplete="off"/>

                                            <!-- Dropdown suggestion box -->
                                            <ul id="subjectList" 
                                                class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-60 overflow-y-auto hidden shadow-md">
                                            </ul>
                                        </div>

                                        <div>
                                            <label for="session" class="block text-black font-bold text-[16px] mb-1">Your Preferred Session/Year</label>
                                            <input type="month" id="session" name="session" class="w-full border border-gray-300 outline-none rounded-lg px-3 py-[12px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500"/>
                                        </div>

                                        <div>
                                            <label for="budget" class="block text-black font-bold text-[16px] mb-1">Your Budget</label>
                                            <input type="number" id="budget" name="budget" placeholder="Write Your Budget (BDT)" class="w-full border border-gray-300 outline-none rounded-lg px-3 py-[12px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-3 mt-4 max-w-md sm:justify-end ml-auto w-full">
                                    <button type="reset" class="w-full sm:w-1/2 text-[16px] py-2 border border-black rounded text-gray-800 font-bold hover:bg-gray-100 transition outline-none focus:outline-none">
                                        Clear
                                    </button>
                                    <button type="submit" class="w-full sm:w-1/2 text-[16px] py-2 bg-primary-main text-white rounded hover:bg-blue-700 transition outline-none focus:outline-none">
                                        Save
                                    </button>
                                </div>
                            </div>
                            @endif
                        </form>
                        <!-- Form end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
<!-- THREE CARDS -->
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
        <div id="text_div" class="text_div">
            <div onclick="closeFunction()" class="close_icon">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <h3 class="font-bold text-[25px] mb-2">
                {{ __("message.welcome") }}
                <span>{{ auth()->guard('web')->user()->name }}!</span>
            </h3>
            @php
                $message = __("message.welcome_text_student");

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
            function closeFunction() {
                document.getElementById("text_div").style.display = "none";
            }
        </script>
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
                            <p>Last Deposit: @if ($last_deposite) <span>{{ $last_deposite }} BDT</span> @endif</p>
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
                                                <a href="{{ route('service.requesting', ['service_id' => $pro_user->id]) }}">{{ __("message.request") }} <i class="fa-solid fa-arrow-right"></i></a>
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
                                                <a href="{{ route('service.requesting', ['service_id' => $verified_user->id]) }}">{{ __("message.request") }} <i class="fa-solid fa-arrow-right"></i></a>
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
                                                <a href="{{ route('service.requesting', ['service_id' => $reguler_user->id]) }}">{{ __("message.request") }} <i class="fa-solid fa-arrow-right"></i></a>
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
@endif
<!-- FOR SUBJECT SUGGESSION--> 
<script>
    const subjectInput = document.getElementById('subject');
    const subjectList = document.getElementById('subjectList');

    const course_data = [
        "Engineering",
        "Architecture",
        "Law",
        "Art",
        "Computer Science",
        "Science",
        "Financial Accounting",
        "Economics",
        "Education",
        "Social Sciences",
        "Agriculture",
        "Biology",
        "Health",
        "Business",
        "Chemistry",
        "Information Technology",
        "Nursing",
        "Business Administration",
        "Communications",
        "Politics",
        "Psychology",
        "Bachelor of Science",
        "Chemical Engineering",
        "Aeronautical and Aerospace Engineering"
    ];

    // Show suggestions dynamically
    subjectInput.addEventListener('input', () => {
        const value = subjectInput.value.toLowerCase();
        subjectList.innerHTML = '';

        if (value) {
            const filtered = course_data.filter(item => item.toLowerCase().includes(value));

            if (filtered.length > 0) {
                filtered.forEach(item => {
                    const li = document.createElement('li');
                    li.textContent = item;
                    li.className = 'px-3 py-2 text-black font-bold hover:bg-blue-100 cursor-pointer';
                    li.addEventListener('click', () => {
                        subjectInput.value = item;
                        subjectList.classList.add('hidden');
                    });
                    subjectList.appendChild(li);
                });
                subjectList.classList.remove('hidden');
            } else {
                subjectList.classList.add('hidden');
            }
        } else {
            subjectList.classList.add('hidden');
        }
    });

    // Hide when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('#subjectList') && e.target !== subjectInput) {
            subjectList.classList.add('hidden');
        }
    });
</script>

<!-- FOR INSTITUTION SUGGESSION -->
<script>
    const instituteInput = document.getElementById('institute');
    const instituteList = document.getElementById('instituteList');

    const institutes = [
        "Harvard University",
        "Stanford University",
        "Massachusetts Institute of Technology (MIT)",
        "University of Cambridge",
        "University of Oxford",
        "California Institute of Technology (Caltech)",
        "University of Chicago",
        "Princeton University",
        "Yale University",
        "Columbia University",
        "University of California, Berkeley",
        "University of Pennsylvania",
        "Imperial College London",
        "University of Toronto",
        "University of Michigan",
        "University of California, Los Angeles (UCLA)",
        "Cornell University",
        "University of Washington",
        "ETH Zurich - Swiss Federal Institute of Technology",
        "University of Edinburgh",
        "Johns Hopkins University",
        "National University of Singapore (NUS)",
        "Tsinghua University",
        "Peking University",
        "University of Melbourne",
        "University of Tokyo",
        "Seoul National University",
        "University of Sydney",
        "University of British Columbia",
        "University of Manchester",
        "London School of Economics and Political Science (LSE)",
        "New York University (NYU)",
        "University of Hong Kong",
        "University of Copenhagen",
        "Australian National University",
        "University of Zurich",
        "Ludwig Maximilian University of Munich",
        "Sorbonne University",
        "University of Amsterdam",
        "Technical University of Munich",
        "University of Helsinki",
        "University of São Paulo",
        "University of Cape Town",
        "McGill University",
        "Indian Institute of Technology Bombay (IITB)",
        "Indian Institute of Science (IISc)",
        "University of Auckland",
        "University of Waterloo",
        "University of Geneva",
        "Stanford University",
        "Harvard University",
        "University of Cambridge",
        "University of Oxford",
        "Imperial College London",
        "University of Chicago",
        "University of Toronto",
        "University of British Columbia",
        "McGill University",
        "University of Alberta",
        "McMaster University",
        "University of Montreal",
        "University of Waterloo",
        "Western University",
        "Queen’s University",
        "Simon Fraser University (SFU)"
    ];

    // Show suggestions as user types
    instituteInput.addEventListener('input', () => {
        const value = instituteInput.value.toLowerCase();
        instituteList.innerHTML = ''; // Clear previous results

        if (value) {
            const filtered = institutes.filter(item => item.toLowerCase().includes(value));

            if (filtered.length > 0) {
                filtered.forEach(item => {
                    const li = document.createElement('li');
                    li.textContent = item;
                    li.className = 'px-3 py-2 text-black font-bold hover:bg-blue-100 cursor-pointer';
                    li.addEventListener('click', () => {
                        instituteInput.value = item;
                        instituteList.classList.add('hidden');
                    });
                    instituteList.appendChild(li);
                });
                instituteList.classList.remove('hidden');
            } else {
                instituteList.classList.add('hidden');
            }
        } else {
            instituteList.classList.add('hidden');
        }
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('#instituteList') && e.target !== instituteInput) {
            instituteList.classList.add('hidden');
        }
    });
</script>

<!-- FOR COUNTRY SUGGESSION -->
<script>
    const searchInput = document.getElementById('countrySearch');
    const countryList = document.getElementById('countryList');
    const countryInput = document.getElementById('countryInput');

    searchInput.addEventListener('input', () => {
        const filter = searchInput.value.toLowerCase();
        const items = countryList.querySelectorAll('li');
        countryList.classList.remove('hidden');

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? 'block' : 'none';
        });
    });

    countryList.addEventListener('click', e => {
        if (e.target.tagName === 'LI') {
            const value = e.target.getAttribute('data-value');
            searchInput.value = value;
            countryInput.value = value;
            countryList.classList.add('hidden');
        }
    });

    // Hide the list when clicking outside
    document.addEventListener('click', e => {
        if (!e.target.closest('#countryList') && e.target !== searchInput) {
            countryList.classList.add('hidden');
        }
    });
</script>

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

@endsection