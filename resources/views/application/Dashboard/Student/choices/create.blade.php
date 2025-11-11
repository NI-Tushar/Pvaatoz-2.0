@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Choices | EduWise')
@section('breadcrumb', 'Create Your Choice')
@section('previous-menu', 'Choice')
@section('active-menu', 'Your Prefered/Choices')
@section('master-content')

<link rel="stylesheet" href="{{ url('Frontend/assets/css/dashboard_form_section.css') }}"/>
<link rel="stylesheet" href="{{ url('Frontend/assets/css/choice_create.css') }}">
<link rel="stylesheet" href="{{ asset('Frontend') }}/assets/css/page_message.css">

<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <!-- <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
        <i class="fa-solid fa-pen fa-2x"></i>
    </div> -->
    <div>
        <h3 class="fw-bold fs-4 mb-0">{{ __('message.student_choice_create_page_heading') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Choice Create</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->
<div id="text_div" 
     class="relative bg-white border-2 border-[#FB7B0B] rounded-lg shadow-[0_1px_3px_0_rgba(0,0,0,0.02),0_0_0_1px_rgba(27,31,35,0.15)] 
            px-4 mt-3 mb-1 max-h-[150px] md:h-[300px] overflow-y-auto">

    <!-- Sticky header container -->
    <div class="sticky top-0 left-0 w-!full bg-white z-10 pt-3">

        <!-- Close icon -->
        <div onclick="closeChoiceMessage()" 
             class="absolute top-2 right-[-20px] h-5 w-5 flex cursor-pointer hover:text-black text-gray-600">
            <i class="fa-solid fa-xmark m-auto"></i>
        </div>

        <!-- Heading -->
        <h3 class="font-bold text-[20px] md:text-[25px] mb-2 text-[var(--consultant-primary-color)] font-[Poppins,sans-serif]">
            {{ __("message.choice_create_message_heading") }}
        </h3>
    </div>

    <!-- Scrollable content -->
    <p class="mt-1 font-[Poppins,sans-serif] font-semibold text-black text-[15px]">
        {{ __("message.choice_create_page_message") }}
    </p>
</div>

<script>
    function closeChoiceMessage() {
        document.getElementById("text_div").style.display = "none";
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
                        <div class="heading_part border flex items-center gap-1">
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
                                                            <p class="text-black font-bold font-[13px]">Start:</p>
                                                            <input name="last_edu_startDate" type="date" value="{{ $last_edu->last_edu_startDate ?? '' }}" class="w-full border border-gray-700 rounded px-3 py-2 text-black font-semibold outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                                        </div>

                                                        <div class="date flex items-center gap-2 w-full sm:w-auto">
                                                            <p class="text-black font-bold font-[13px]">End:</p>
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


@endsection
@push('script')
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
@endpush
