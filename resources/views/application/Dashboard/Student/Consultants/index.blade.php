@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Student')
@section('breadcrumb', 'Consultants')
@section('previous-menu', 'Consultants')
@section('active-menu', 'Consultants/For You')
@section('master-content')

<link rel="stylesheet" href="{{ url('Frontend/assets/css/consultants_card.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/page_message.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/alert_popup.css') }}">
<!-- jQuery CDN -->

<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <div class="bg-primary bg-opacity-10 text-primary-main rounded-circle p-2 me-3">
        <i class="fa-solid fa-user-tie fa-2x"></i>
    </div>
    <div>
        <h3 class="fw-bold fs-4 mb-0">{{ __('message.student_consultant_page_heading') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Consultants</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->

@if (Session::has('balance_message'))
    <div class="no_balance_section">
        <div class="centered_balance">
            <p>{{ Session::get('balance_message') }}</p>
            <a href="{{ route('student.cashin')}}"><button>Add Balance
                <i class="fa-solid fa-plus"></i>
            </button></a>
        </div>
    </div>
@endif
@if (Session::has('empty_data'))
    <div class="no_balance_section">
        <div class="centered_balance">
            <p style="width:100%;text-align:center;">{{ Session::get('empty_data') }}</p>
        </div>
    </div>
@endif

<!-- request sent message -->

<!-- already have data -->
@if (Session::has('success_message') || Session::has('already_message'))
    <!-- ___________ page message start -->
    <div class="page_message_section w-full" id="page_message_section">
        @if (Session::has('success_message'))
            <div class="page_message_box_success w-full bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded-md flex justify-between items-center">
                <div class="msg_box">
                    <p>{{ __('message.choice_create_success_message') }} <i class="fa-solid fa-turn-down"></i></p>
                </div>
                <div class="close cursor-pointer" onclick="closeFunction()">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
        @elseif (Session::has('already_message'))
            <div class="page_message_box_error w-full bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded-md flex justify-between items-center">
                <div class="msg_box">
                    <p>{{ Session::get('already_message') }}</p>
                </div>
                <div class="close cursor-pointer" onclick="closeFunction()">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
        @endif
    </div>

    <script>
        function closeFunction() {
            document.getElementById('page_message_section').style.display = "none";
        }
    </script>
    <!-- ___________ page message end -->
@endif

<!-- ___________ Request send success popup start -->
@if (Session::has('request_success'))
<div id="alert_msg_section" class="alert_msg_section">
    <div class="success-message">
        <div class="flex item-center mb-4">
            <svg viewBox="0 0 76 76" class="m-auto h-[50px] success-message__icon icon-checkmark">
                <circle cx="38" cy="38" r="36"/>
                <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7"/>
            </svg>
        </div>
        <h1 class="success-message__title mb-2">Success</h1>
        <div class="success-message__content">
            <p class="payment_text_msg mb-2">{{ Session::get('request_success') }}</p>
            <a href="{{ route('student.assessment.all-request') }}">
                <button class="payment_text_msg button">Ok</button>
            </a>
        </div>
    </div>
</div>
@endif
<!-- ___________ Request send success popup start -->


<!-- ________________ LAST create Choices start -->
@if ($latest_choice)
<div class="consultants_list_heading">
    <div class="heading_left">
        <h3><i class="fa-solid fa-clipboard-check"></i> {{ __('message.latest_choice_heading') }}</h3>
    </div>
    <div class="latest_choice_section">
        <div class="choice_content">
            <label for="">Country</label>
            <h4>{{$latest_choice->country}}</h4>

            <div class="mobile_institute">
                <label for="">Institution</label>
                <p>{{$latest_choice->institute}}</p>
            </div>

            <div class="institute mt-2">
                <div class="desktop_institute">
                    <label for="">Institution</label>
                    <p>{{$latest_choice->institute}}</p>
                </div>
                <div class="box">
                    <label for="">Subject/Course</label>
                    <p>{{$latest_choice->subject}}</p>
                </div>
                <div class="box">
                    <label for="">Session/Year</label>
                    <p>{{ \Carbon\Carbon::parse($latest_choice->session . '-01')->format('F Y') }}</p>
                </div>
                <div class="box">
                    <label for="">Budget</label>
                    <p>{{$latest_choice->budget}} BDT</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- ________________ LAST create Choices end -->
@if ($services_data->isNotEmpty())
<div class="flex items-center justify-between border-b border-gray-300 mt-3 pb-2 mb-4">
    <div class="flex items-center space-x-2">
        <i class="fa-solid fa-clipboard-list text-primary-main text-xl"></i>
        <h3 class="text-[13px] md:text-lg font-bold text-gray-900">{{ __('message.consultants_heading') }}</h3>
    </div>
</div>
@endif

<!-- ____________ FILTER START -->
<div class="w-full flex flex-wrap gap-4 bg-primary-gray p-2 mb-3 border rounded border-black">

    <!-- Service -->
    <div class="relative hidden md:flex flex-1 min-w-[200px]">
        <input type="search" id="serviceSearch" placeholder="Search by Service"
               class="w-full px-4 py-2 pr-10 border border-gray-300 rounded outline-none focus:ring-2 focus:ring-indigo-500"
               autocomplete="off">
        <!-- Search Icon -->
        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div id="serviceSuggestions" class="absolute bg-white border border-gray-300 mt-[43px] w-full rounded shadow-lg max-h-60 overflow-y-auto hidden z-[9999]"></div>
    </div>

    <!-- Country -->
    <div class="relative hidden md:flex flex-1 min-w-[200px]">
        <input type="search" id="countrySearch" placeholder="Search by Country"
               class="w-full px-4 py-2 pr-10 border border-gray-300 rounded outline-none focus:ring-2 focus:ring-indigo-500"
               autocomplete="off">
        <!-- Search Icon -->
        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div id="countrySuggestions" class="absolute bg-white border border-gray-300 mt-[43px] w-full rounded shadow-lg max-h-60 overflow-y-auto hidden z-[9999]"></div>
    </div>

    <!-- Global Search -->
    <div class="relative flex-1 min-w-[200px]">
        <input type="search" id="globalSearch" placeholder="Search with Keywords"
               class="w-full px-4 py-2 pr-10 border border-gray-300 rounded outline-none focus:ring-2 focus:ring-indigo-500"
               autocomplete="off">
        <!-- Search Icon -->
        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div id="globalSuggestions" class="absolute bg-white border border-gray-300 mt-1 w-full rounded shadow-lg max-h-60 overflow-y-auto hidden z-[9999]"></div>
    </div>

</div>

<script>
    // Laravel data
    const services = @json($services->pluck('name'));
    const countries = @json($countries->pluck('name'));

    // Global arrays
    const subjects = ["Engineering","Architecture","Law","Art","Computer Science","Science","Financial Accounting","Economics","Education","Social Sciences","Agriculture","Biology","Health","Business","Chemistry","Information Technology","Nursing","Business Administration","Communications","Politics","Psychology","Bachelor of Science","Chemical Engineering","Aeronautical and Aerospace Engineering"];
    const study_level_data = ["Doctorate","PostGraduate","Undergraduate","University Preparation","EldVocational (VET)","School","Foundation","Pre-Degree & Vocational"];
    const university_data = ["Harvard University","Stanford University","MIT","University of Cambridge","University of Oxford","Caltech","University of Toronto","University of Melbourne","University of Tokyo","University of Sydney"];

    const globalData = [...new Set([...services, ...countries, ...subjects, ...study_level_data, ...university_data])];

    function setupAutocomplete(inputId, suggestionId, data) {
        const input = document.getElementById(inputId);
        const suggestionBox = document.getElementById(suggestionId);

        // Function to render suggestions
        function renderSuggestions(filtered) {
            suggestionBox.innerHTML = "";
            if(filtered.length === 0) {
                suggestionBox.classList.add("hidden");
                return;
            }
            filtered.forEach(item => {
                const div = document.createElement("div");
                div.textContent = item;
                div.className = "px-4 py-2 hover:bg-indigo-100 cursor-pointer text-black";
                div.onclick = () => {
                    input.value = item;
                    suggestionBox.classList.add("hidden");
                };
                suggestionBox.appendChild(div);
            });
            suggestionBox.classList.remove("hidden");
        }

        // Show all results on click/focus
        input.addEventListener("focus", () => renderSuggestions(data));
        input.addEventListener("click", () => renderSuggestions(data));

        // Filter on input
        input.addEventListener("input", function() {
            const query = this.value.toLowerCase();
            const filtered = data.filter(item => item.toLowerCase().includes(query));
            renderSuggestions(filtered);
        });

        // Hide suggestions if clicked outside
        document.addEventListener("click", (e) => {
            if(!e.target.closest(`#${inputId}`) && !e.target.closest(`#${suggestionId}`)) {
                suggestionBox.classList.add("hidden");
            }
        });
    }

    setupAutocomplete("serviceSearch", "serviceSuggestions", services);
    setupAutocomplete("countrySearch", "countrySuggestions", countries);
    setupAutocomplete("globalSearch", "globalSuggestions", globalData);
</script>

<!-- ____________ FILTER END -->

<!-- ____________ NEW CONSULTANTS CARD START -->
<form id="selectionForm" action="" method="POST">
    @csrf
    @if($services_data->isNotEmpty())
    <div class="w-full pb-4">
        <h2 class="text-black font-bold text-[20px] mb-2"><i class="fa-solid fa-user-tie mr-1"></i> Select Consultant</h2>
        <!-- Container with grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($services_data as $data)
            <!-- Card wrapper with flex to stretch all cards in the row -->
            <div class="flex">
                <div class="relative w-full bg-white rounded-[10px] shadow border border-black/20 p-6 flex flex-col">

                    <div class="relative flex flex-col md:flex-row items-start bg-white rounded-lg shadow w-full">

                        <!-- Country flag (absolute top-right) -->
                        <img class="absolute top-0 right-0 w-[55px] md:w-[65px] h-[30px] md:h-[40px] border border-gray-300"
                            src="{{ $data->countryInfo && $data->countryInfo->image 
                                    ? asset('storage/' . $data->countryInfo->image) 
                                    : asset('img-preview.png') }}" 
                            alt="Country Flag" title="{{ $data->countryInfo->name }}">

                        
                        <!-- Main content container -->
                        <div class="flex w-full md:w-auto md:flex-1 items-start">

                            <!-- Profile image -->
                            <img class="w-[80px] h-[80px] rounded object-cover flex-shrink-0"
                                src="{{ $data->user->image ? asset($data->user->image) : asset('no-profile-img.png') }}" 
                                alt="Consultants Image">

                            <div class="h-full w-full">    
                                <h5 class="hidden md:block md:mt-0 ml-4 text-[16px] font-bold text-black leading-6 w-full md:w-[calc(100%-100px)]">
                                    {{ $data->title ? Str::limit($data->title, 150) : 'Not Provided' }}
                                </h5>

                                <!-- User info: name + stars -->
                                <div class="ml-4 flex flex-col justify-center h-full md:justify-start w-full">

                                    <!-- User name + verification -->
                                    <div class="flex items-center space-x-2">
                                        <span class="text-black text-[16px] font-extrabold">
                                            {{ $data->user->name ?? 'Not Provided' }}
                                        </span>
                                        @if ($data->user->completion_percentage == 100)
                                            <i title="Verified Consultant" class="fa-solid fa-circle-check text-green-500 text-[16px]"></i>
                                        @endif
                                    </div>

                                    <!-- Stars -->
                                    <div class="flex space-x-1 mt-1 md:mt-2 relative">
                                        @php
                                            $Stars = $data->reviews->isNotEmpty() ? $data->reviews->avg('review_rating') : 0;
                                        @endphp
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < round($Stars))
                                                <i class="fa-solid fa-star text-yellow-500"></i>
                                            @else
                                                <i class="fa-solid fa-star text-gray-400"></i>
                                            @endif
                                        @endfor
                                        <!-- Share icon at right -->
                                        <i onclick="openShare('{{ url('/consultants-profile-details-view/' . $data->id) }}')" 
                                        class="absolute top-0 right-5 flex md:!hidden fa-solid fa-share-nodes ml-auto text-[18px] text-primary-dim hover:text-black cursor-pointer"></i>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Service title -->
                        <h5 class="mt-4 md:mt-0 md:hidden md:ml-6 text-[16px] font-bold text-black leading-6 w-full md:w-auto">
                            {{ $data->title ? Str::limit($data->title, 150) : 'Not Provided' }}
                        </h5>

                    </div>

                    <!-- Info Row -->
                    <div class="w-full flex items-center border-b border-black/10 mt-6 pb-2 overflow-hidden relative text-[13px] font-bold text-primary-dim">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span class="ml-3">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</span>

                        <i class="fa-regular fa-clock ml-8"></i>
                        <span class="ml-3">{{ $data->duration }}</span>

                        <i class="fa-solid fa-bangladeshi-taka-sign ml-8"></i>
                        <span class="ml-3">{{ $data->price ?? 'Free' }}</span>

                        <!-- Share icon at right -->
                        <i onclick="openShare('{{ url('/consultants-profile-details-view/' . $data->id) }}')" 
                        class="!hidden md:!flex fa-solid fa-share-nodes ml-auto text-[18px] text-primary-dim hover:text-black cursor-pointer"></i>
                    </div>

                    <!-- Description -->
                    <p class="mt-3 mb-2 text-[15px] flex-1">
                        {{ $data->description ? Str::limit($data->description, 300) : 'Not Provided' }}
                    </p>

                    <!-- Services / Subjects / Levels -->

                        <div class="mt-1 mb-3 flex flex-wrap gap-2">
                            @foreach(array_slice(json_decode($data->subjects), 0, 5) as $subject)
                                <span class="text-black leading-4 font-bold text-[16px]">
                                    {{ $subject }}{{ !$loop->last ? ',' : '' }}
                                </span>
                            @endforeach
                            @foreach(array_slice(json_decode($data->study_levels), 0, 5) as $level)
                                <span class="text-black leading-4 font-bold text-[16px]">
                                    {{ $level }}{{ !$loop->last ? ',' : '' }}
                                </span>
                            @endforeach
                        </div>

                        <div class="mt-1 mb-3 flex flex-wrap gap-2">
                            <span class="bg-blue-400/30 text-black px-3 py-1 rounded text-[13px] font-bold border border-black/20">
                                {{ $data->country }}
                            </span>
                            @foreach(json_decode($data->services) as $service)
                                <span class="bg-blue-400/30 text-black px-3 py-1 rounded text-[13px] font-bold border border-black/20">
                                    {{ $service }}
                                </span>
                            @endforeach
                        </div>

                        <!-- Buttons -->
                        @php
                            $isConsultant = auth()->guard('web')->check() && auth()->guard('web')->user()->user_type === 'Consultant';
                        @endphp

                        <div class="mt-3 flex space-x-3">
                            <a href="{{ route('consultant.profile.public', ['id' => $data->id]) }}" 
                                class="{{ $isConsultant 
                                            ? 'w-full bg-primary-main text-white hover:bg-primary-light hover:text-black' 
                                            : 'w-1/2 border border-black text-primary-main hover:bg-primary-main hover:text-white' }}
                                    rounded-md py-2 text-[14px] font-bold text-center transition-all">
                                View Profile
                            </a>
                            @unless($isConsultant)
                                <a href="{{ route('service.requesting', ['service_id' => $data->id, 'choice_id' => $choice_id]) }}"
                                    class="w-1/2 bg-primary-main text-white rounded-md py-2 text-[14px] font-bold text-center
                                        hover:bg-white hover:border hover:border-black hover:!text-primary-main transition-all">
                                    Send Request
                                </a>
                            @endunless
                        </div>


                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $services_data->links('vendor.pagination.tailwind') }}
        </div>

    </div>
    @else
        <div class="no_data_section">
            <div class="empty-state">
                <div class="empty-state__content">
                    <div class="empty-state__icon"><img src="{{asset('no-data-image.png')}}" alt=""></div>
                    <div class="empty-state__message">No Service Found</div>
                    <div class="empty-state__help">No available consultants for this service.</div>
                </div>
            </div>
        </div>
    @endif
</form>
<!-- ____________ NEW CONSULTANTS CARD END -->

<!-- for searching start -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function () {
        function filterCards() {
            const serviceQuery = $('#serviceSearch').val().toLowerCase();
            const countryQuery = $('#countrySearch').val().toLowerCase();
            const globalQuery  = $('#globalSearch').val().toLowerCase();

            // Collect active queries (non-empty)
            const activeQueries = [serviceQuery, countryQuery, globalQuery].filter(q => q.trim() !== '');

            // Loop through all cards
            $('.grid > div.flex').each(function () {
                const card = $(this);
                let matchesService = !serviceQuery || card.text().toLowerCase().includes(serviceQuery);
                let matchesCountry = !countryQuery || card.text().toLowerCase().includes(countryQuery);
                let matchesGlobal = !globalQuery || card.text().toLowerCase().includes(globalQuery);

                // Show card if it matches all active filters
                if (activeQueries.length === 0 || 
                    (serviceQuery && matchesService && !countryQuery && !globalQuery) ||
                    (countryQuery && matchesCountry && !serviceQuery && !globalQuery) ||
                    (globalQuery && matchesGlobal && !serviceQuery && !countryQuery) ||
                    (serviceQuery && countryQuery && matchesService && matchesCountry && !globalQuery) ||
                    (serviceQuery && globalQuery && matchesService && matchesGlobal && !countryQuery) ||
                    (countryQuery && globalQuery && matchesCountry && matchesGlobal && !serviceQuery) ||
                    (serviceQuery && countryQuery && globalQuery && matchesService && matchesCountry && matchesGlobal)) {
                    card.show();
                } else {
                    card.hide();
                }
            });

            // Check if any cards are visible
            const hasVisibleCards = $('.grid > div.flex:visible').length > 0;
            
            // Show/hide no data message
            if (!hasVisibleCards && activeQueries.length > 0) {
                if ($('.no-search-results').length === 0) {
                    $('.grid').parent().append('<div class="no-search-results p-4 text-center">No consultants found matching your search criteria.</div>');
                }
            } else {
                $('.no-search-results').remove();
            }
        }

        // Run filter whenever any search box changes
        $('#serviceSearch, #countrySearch, #globalSearch').on('input', filterCards);
    });
</script>
<!-- for searching end -->


<!-- ______________ share consultant modal start -->
    @include('Frontend.layouts.share_modal')
<!-- ______________ share consultant modal end -->

@endsection
@push('script')

<script>
    function copyLink(link) {
        navigator.clipboard.writeText(link).then(() => {
            alert("Link copied to clipboard:\n" + link);
        }).catch(err => {
            alert("Failed to copy link.");
            console.error(err);
        });
    }
</script>

<!-- JavaScript for dynamic button visibility -->
<script src="{{ asset('Frontend') }}/./assets/js/popUpAlert.js"></script>
<script>
    function checkFunc(){
        console.log('selected');
        const submitBtn = document.getElementById('multiple_button');
        submitBtn.style.opacity = '1';
        submitBtn.style.display = 'flex';
    }
</script>

@endpush