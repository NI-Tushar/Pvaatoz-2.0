@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Choices | EduWise')
@section('breadcrumb', 'Create Your Choice')
@section('previous-menu', 'Choice')
@section('active-menu', 'Your Prefered/Choices')
@section('master-content')

<link rel="stylesheet" href="{{ url('Frontend/assets/css/choices.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">
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

<!-- ___________ page message start -->
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
<!-- ___________ page message start -->

<!-- ________________________________________ CHOICES LIST START -->
<section class="selected_assessment_section">
    <div class="choice_list">

        <div class="choice_table_heading bm-0 px-3 py-2">
            <div class="heading_left d-flex">
                <img class="w-13 h-10" src="{{ asset('Frontend/assets/icons/edit.png') }}" alt="" />
                <h3 class="mt-auto mb-auto text-[20px]">{{ __('message.choice_create') }}</h3>
            </div>
            <div class="heading_right">
                <a href="{{route('create.choice.form')}}"><button class="choice_create">Create Choice +</button></a>
            </div>
        </div>

        <div class="w-full flex items-center gap-4 px-3 py-2">
            <!-- Left side -->
            <div class="w-1/2 flex">
                <img class="w-8 h-8" src="{{ asset('Frontend/assets/icons/task.png') }}" alt="" />
                <h1 class="text-[18px] font-semibold mt-auto mb-auto ml-1">Your Choices</h1>
            </div>

            <!-- Right side -->
            <div class="w-1/2 flex items-center">
                <div class="relative w-full">
                    <input type="text" id="searchInput" 
                        class="w-full border border-black rounded-full py-2 px-3 text-[16px] pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Search by country, institute/university, subject/course, budget...">
                    <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                </div>
            </div>
        </div>

        <div class="px-3 py-2 pb-4">
            <div class="border border-black-700 rounded">
                <div class="w-full bg-[#f6f6f6] hidden md:flex items-start text-black text-[16px] font-bold p-2">
                    <div class="w-[35px] text-center">ID</div>
                    <div class="flex-1 text-left">Service Name</div>
                    <div class="flex-1 text-left">Your Preferred Country</div>
                    <div class="flex-1 text-left">Your Preferred Institute</div>
                    <div class="flex-1 text-left">Your Budget</div>
                    <div class="flex-1 text-left">Your preferred Subject</div>
                </div>
                @if ($choices->isNotEmpty())
                    @foreach ($choices as $data)
                    <div class="searchable-item">
                        <!-- __________________ -->
                            <div class="accordian mt-0 pt-0">
                                <div class="accordian_head" @if($loop->first) style="border-top: none;" @endif>
                                    <div class="head_elelments">
                                        <div class="index"><p>{{ $loop->iteration }}</p></div>
                                        <!-- ___________ -->
                                        <div class="accordian_part">
                                            <p>{{$data->services->name}}</p>
                                        </div>
                                        <!-- ___________ -->
                                        <div class="accordian_part desctop_element">
                                            <p>{{$data->country}}</p>
                                        </div>
                                        <!-- ___________ -->
                                        <div class="accordian_part desctop_element">
                                            <p>{{$data->institute}}</p>
                                        </div>
                                        <!-- ___________ -->
                                        <div class="accordian_part desctop_element">
                                            <p>{{$data->budget}} BDT</p>
                                        </div>
                                        <!-- ___________ -->
                                        <div class="accordian_part desctop_element" style="border:none;">
                                            <p>{{$data->subject}}</p>
                                        </div>
                                        <!-- ___________ -->

                                        <div class="accordian_toggler toggler_arrow">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </div>

                                    </div>
                                </div>

                                <div class="accordian_body">
                                    <div class="accordian_description">

                                    <div class="detail_part_section justify-content-end">

                                    <!-- ___________ -->
                                    <div class="detail_part mobile_element">
                                        <div class="icon"><i class="fa-solid fa-earth-americas"></i></div>
                                        <div class="part_text">
                                            <span>Preferred Country</span>
                                            <p>{{$data->country}}</p>
                                        </div>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="detail_part mobile_element">
                                        <div class="icon"><i class="fa-solid fa-building-columns"></i></div>
                                        <div class="part_text">
                                            <span> Preferred Institute</span>
                                            <p>{{$data->institute}}</p>
                                        </div>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="detail_part mobile_element">
                                        <div class="icon"><i class="fa-solid fa-book"></i></div>
                                        <div class="part_text">
                                            <span>Preferred Subject</span>
                                            <p>{{$data->subject}}</p>
                                        </div>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="detail_part">
                                        <div class="icon hidden"><i class="fa-solid fa-calendar-days"></i></div>
                                        <div class="part_text">
                                            <span>Your Session/Year</span>
                                            @if($data->session && strlen($data->session) >= 7)
                                                <p>{{ \Carbon\Carbon::parse($data->session . '-01')->format('F Y') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="detail_part mobile_element">
                                        <div class="icon"><i class="fa-solid fa-sack-dollar"></i></div>
                                        <div class="part_text">
                                            <span>Your Budget</span>
                                            <p>{{$data->budget}} BDT</p>
                                        </div>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="detail_part bottom_part">
                                        <div class="part_text">
                                            <a class="mb-1" href="{{route('consultant.list',  ['choice_id' => $data->id])  }}">
                                                <button class="bg-primary-main text-white px-3 py-2 border border-black rounded hover:bg-primary-light transition-colors">
                                                    <i class="fa-solid fa-user-tie text-white mr-1"></i>
                                                    Choose Consultant
                                                </button>
                                            </a>
                                        <button 
                                            onclick="openUpdateForm(
                                                {{ $data->id }}, 
                                                '{{ addslashes($data->country) }}', 
                                                '{{ addslashes($data->institute) }}', 
                                                '{{ addslashes($data->session) }}', 
                                                '{{ addslashes($data->budget) }}', 
                                                '{{ addslashes($data->subject) }}'
                                            )" 
                                            class="group px-3 py-2 rounded border border-black hover:bg-primary-main text-black hover:!text-white transition-colors">
                                            <i class="fa fa-pen-to-square me-1 group-hover:!text-white transition-colors"></i>Update
                                        </button>
                                    </div>
                                    <!-- ___________ -->
                                    </div>

                                    </div>
                                </div>
                            </div>
                        <!-- __________________ -->
                    </div>
                    @endforeach
                @else
            </div>
        </div>
    </div>
    
    <div class="no_data_section">
        <div class="empty-state">
            <div class="empty-state__content">
                <div class="empty-state__icon"><img src="{{asset('no-data-image.png')}}" alt=""></div>
                <div class="empty-state__message">No Choice has been added yet.</div>
                <div class="empty-state__help">Add a new Choice by simpley clicking the button at bottom here.</div>
                <a href="{{ route('create.choice.form') }}">
                    <button>Create Choices</button>
                </a>
            </div>
        </div>
    </div>
    @endif
</section>
<!-- ________________________________________ CHOICES LIST END -->

<!-- ________________________________________ UPDATE LAST EDU START -->
<div id="update_edu_section" class="update_edu_section">
    <div class="update_edu_center">
        <div class="heading">
            <div class="heading_title">
                <h4>Update Your Choice</h4>
            </div>
                <div class="close_icon">
                <i onclick="closeForm()" class="fa-regular fa-circle-xmark"></i>
            </div>
        </div>
        <form class="row g-3" method="POST" action="{{route('student.choice.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="assessment_id" name="id">

            <div class="col-12">
                <label for="inputAddress" class="form-label">Your Preferred Country</label>
                <input type="text" name="country" class="form-control" id="country">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Your Preferred Insititute</label>
                <input type="text" name="institute" class="form-control" id="institute">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Your Preferred Subject</label>
                <input type="text" name="subject" class="form-control" id="subject">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Your Preferred Session/Year</label>
                <input type="month" name="session" class="form-control" id="session">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Your Budget</label>
                <input type="number" name="budget" class="form-control" id="budget">
            </div>

            <div class="col-12" style="border:none;box-shadow:none;padding:0px;">
                <button type="submit" class="save_btn">Save</button>
            </div>
        </form>
    </div>
</div>
<!-- ________________________________________ UPDATE LAST EDU END -->

@endsection
@push('script')

<!-- ___________ jquery search start -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(function () {
        $('#searchInput').on('input', function () {
            const query = $(this).val().toLowerCase().trim();

            // Loop through each searchable-item
            $('.searchable-item').each(function () {
                // get all text content inside the item (country, institute, subject, etc.)
                const text = $(this).text().toLowerCase();

                // show item only if it includes the search term
                if (text.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

<!-- ___________ jquery search end -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

    // __________________ request list expend start
    let accordianHead = Array.from(document.querySelectorAll(".accordian_head"));

    accordianHead.map((item) =>
    item.addEventListener("click", () => {
        closeAllAccordian(item);
    })
    );

    function closeAllAccordian(current_target) {
    accordianHead.map((item) => {
        const accordianBody = item.nextElementSibling;
        const togglerBtn = item.querySelector(".head_elelments");
        const togglerArrowIcon = item.querySelector(".toggler_arrow i");

        if (current_target !== item) {
        togglerBtn.classList.remove("active");
        togglerArrowIcon.classList.remove("rotate");
        accordianBody?.classList.remove("active_body");
        } else {
        togglerBtn.classList.toggle("active");
        togglerArrowIcon.classList.toggle("rotate");
        accordianBody?.classList.toggle("active_body");
        }
    });
    }
    // __________________ request list expend end

    function openCreateChoice(){
        document.getElementById("create_choice").classList.add("show");
    }
    function closeCreateChoice(){
        document.getElementById("create_choice").classList.remove("show");
    }

    function openUpdateForm(id, country, institute, session, budget, subject) {

        // ________ elements id
        var assessment_id_elem = document.getElementById("assessment_id");
        var country_elem = document.getElementById("country");
        var institute_elem = document.getElementById("institute");
        var budget_elem = document.getElementById("budget");
        var subject_elem = document.getElementById("subject");
        var session_elem = document.getElementById("session");

        assessment_id_elem.value  = id;
        country_elem.value  = country;
        institute_elem.value  = institute;
        budget_elem.value  = budget;
        session_elem.value  = session;
        subject_elem.value  = subject;
        document.getElementById("update_edu_section").classList.add("show");
    }

    function closeForm() {
        document.getElementById("update_edu_section").classList.remove("show");
    }


    $('.show_confirm').click(function(event) {
        event.preventDefault(); // Prevent form submission

        var form = $(this).closest("form"); // Get the closest form

        Swal.fire({
            title: "Are you sure you want to delete this record?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            customClass: {
                confirmButton: 'text-white',
                cancelButton: 'btn btn-secondary'
            },
            dangerMode: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit the form if the user confirms
            }
        });
    });


</script>

@endpush
