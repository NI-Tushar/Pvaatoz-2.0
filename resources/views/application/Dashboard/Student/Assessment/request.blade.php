@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('breadcrumb', 'All Request')
@section('previous-menu', 'Assessment')
@section('active-menu', 'All Request')
@section('master-content')

<link rel="stylesheet" href="{{ url('Frontend/assets/css/assessment_requested_list.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">


<!-- _____________ student choices start -->

<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <!-- <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
        <i class="fa-solid fa-pen fa-2x"></i>
    </div> -->
    <div>
        <h3 class="fw-bold fs-4 mb-0">{{ __('message.student_all_service') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">All Services</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->

<!-- PAGE MESSAGE -->
<div id="text_div_last_edu" class="relative bg-white border-2 border-[#FB7B0B] rounded-lg shadow-[0_1px_3px_0_rgba(0,0,0,0.02),0_0_0_1px_rgba(27,31,35,0.15)] p-4 mt-3 mb-3">
        <div onclick="closeServiceMsg()" class="absolute top-2 right-2 h-5 w-5 flex cursor-pointer hover:text-black text-gray-600">
        <i class="fa-solid fa-xmark m-auto"></i>
    </div>
    <h3 class="font-bold text-[25px] mb-2">
        <h3 class="font-bold text-[20px] md:text-[25px] mb-2 text-[var(--consultant-primary-color)] font-[Poppins,sans-serif]">
            {{ __("message.student_service_heading") }}
        </h3>
    </h3>
    
    @php
        $message = __("message.student_service_paragraph");

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
    function closeServiceMsg() {
        document.getElementById("text_div_last_edu").style.display = "none";
    }
</script>

<!-- PAGE MESSAGE -->
<section class="selected_assessment_section border pb-3 mb-3 rounded-lg overflow-hidden shadow-[0_0_0_1px_#0000003d]">

    <div class="w-full px-3 py-3 bg-[#e0e4e7] flex items-center justify-between">
        <!-- Left side -->
        <div class="flex items-center gap-1">
            <img class="w-auto h-6 md:h-10" src="{{ asset('Frontend/assets/icons/checklist.png') }}" alt="" />
            <h3 class="text-left text-[15px] md:text-[20px]">{{ __('message.student_service_heading') }}</h3>
        </div>

        @php
            $statusColors = [
                'Pending'   => ['border' => 'rgb(233, 179, 0)', 'text' => 'rgb(233, 179, 0)'],
                'Accepted'  => ['border' => 'rgb(13, 90, 255)', 'text' => 'rgb(13, 90, 255)'],
                'Submited'  => ['border' => 'rgb(1, 235, 231)', 'text' => 'rgb(1, 235, 231)'],
                'Completed' => ['border' => 'green', 'text' => 'green'],
                'Rejected'  => ['border' => 'red', 'text' => 'red'],
                'all'       => ['border' => 'gray', 'text' => 'black'],
            ];

            $currentBorder = $statusColors[$status]['border'] ?? 'gray';
            $currentText = $statusColors[$status]['text'] ?? 'black';
        @endphp

        <form method="GET" action="{{ route('student.assessment.filter') }}">
            <select name="status" 
                style="border: 2px solid {{ $currentBorder }}; color: {{ $currentText }};"
                class="rounded-md px-3 py-1 text-[16px] bg-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                onchange="this.form.submit()">
                <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Accepted" {{ $status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="Submited" {{ $status == 'Submited' ? 'selected' : '' }}>Submited</option>
                <option value="Completed" {{ $status == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Rejected" {{ $status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All</option>
            </select>
        </form>
    </div>

    @if ($assessments->isNotEmpty())
    <div class="search_bar bg-transparent px-3">
        <p class="font-bold text-black text-[18px]">{{ __('message.student_all_service') }}</p>
        <input type="text" id="searchInput" class="form-control rounded-full pr-4" placeholder="Search by country, institute/university, subject/course, budget...">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    @foreach ($assessments as $data)
    <div class="searchable-item w-100 px-3">
        <!-- __________________ -->
        <div class="accordian">
            <div class="accordian_head">
                <div class="head_elelments">
                    <!-- ___________ -->
                    <div class="accordian_part border-white flex">
                        <div class="pr-2">
                            <img class="h-[50px] w-auto rounded-full shadow-md border border-red-500" src="{{ $data->consultant->image ? asset($data->consultant->image) : asset('no-profile-img.png') }}" alt="User Image">
                        </div>
                        <div class="flex md:block">
                            <p class="span desctop_element"><i class="fa-solid fa-user"></i> Consultants Name</p>
                            <p class="mt-auto mb-auto">{{$data->consultant->name}}</p>
                        </div>
                    </div>
                    <!-- ___________ -->
                    <!-- <div class="accordian_part desctop_element">
                        <p class="span"><i class="fa-solid fa-book"></i> Subject</p>
                        <p>{{$data->assessment_subject}}</p>
                    </div> -->
                    <!-- ___________ -->
                    <div class="accordian_part desctop_element">
                        <p class="span"> <i class="fa-solid fa-earth-americas"></i> Country</p>
                        <p>{{$data->assessment_country}}</p>
                    </div>
                    <!-- ___________ -->
                    <div class="accordian_part desctop_element">
                        <p class="span"><i class="fa-solid fa-bangladeshi-taka-sign"></i> Service Charge</p>
                        <p>{{$data->assessment_charge}} BDT</p>
                    </div>
                    <!-- ___________ -->
                    <div class="accordian_part desctop_element">
                        <p class="span"><i class="fa-regular fa-clock"></i> Duration of Assessment</p>
                        <p>{{$data->assessment_duration}}</p>
                    </div>
                    <!-- ___________ -->
                    <div class="accordian_part border border-white desctop_element">
                        <span>Assessment Status</span>
                        @if($data->status == 'Pending')
                            <p style="background-color: rgb(233, 179, 0);font-weight:700; color: white;">{{$data->status}}</p>
                        @elseif($data->status == 'Accepted')
                            <p style="background-color: rgb(13, 90, 255);font-weight:700; color: white;">{{$data->status}}</p>
                        @elseif($data->status == 'Submited')
                            <p style="background-color: rgb(1, 235, 231);color:black;font-weight:700;">{{$data->status}}</p>
                        @elseif($data->status == 'Completed')
                            <p style="background-color: green; color: white;font-weight:700;">{{$data->status}}</p>
                        @elseif($data->status == 'Rejected')
                            <p style="background-color: red; color: white;font-weight:700;">{{$data->status}}</p>
                        @endif
                    </div>

                    @if($data->status == 'Pending')
                        <div style="background-color: rgb(233, 179, 0); color:black;font-weight:700;" class="mov_status">{{$data->status}}</div>
                    @elseif($data->status == 'Accepted')
                        <div style="background-color: rgb(13, 90, 255);font-weight:700;" class="mov_status">{{$data->status}}</div>
                    @elseif($data->status == 'Completed')
                        <div style="background-color: green;font-weight:700;" class="mov_status">{{$data->status}}</div>
                    @elseif($data->status == 'Submited')
                        <div style="background-color: rgb(1, 235, 231); color:black;font-weight:700;" class="mov_status">{{$data->status}}</div>
                    @elseif($data->status == 'Rejected')
                        <div style="background-color: red;font-weight:700;" class="mov_status">{{$data->status}}</div>
                    @elseif($data->status == 'Completed')
                        <p style="background-color: green; color: white;font-weight:700;">{{$data->status}}</p>
                    @endif

                    <div class="accordian_toggler toggler_arrow">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="accordian_body">
                <div class="accordian_description">

                <div class="mov_consultant_section">
                    <div class="item"><i class="fa-solid fa-book"></i> {{$data->assessment_subject}}</div>
                    <div class="item"><i class="fa-solid fa-earth-americas"></i> {{$data->assessment_country}}</div>
                    <div class="item"><i class="fa-solid fa-bangladeshi-taka-sign"></i> {{$data->assessment_charge}} BDT</div>
                    <div class="item"><i class="fa-regular fa-clock"></i> {{$data->assessment_duration}}</div>

                    @if($data->status == 'Submited')
                    <div class="mov_attachment">
                        <p>Attachment:</p>
                        <div class="attach_buttons">
                                @if(!$data->hasReview)
                                    <a href="{{ route('reviews.create', ['assessment_id' => $data->id, 'consultant_id' => $data->consultant_id]) }}" class="text-nowrap">Refund Report</a>
                                @endif
                            <a href="{{ route('consultant.assessment.report.download', $data->id) }}">Download</a>
                        </div>
                    </div>
                    @endif
                    @if($data->status == 'Completed')
                    <div class="mov_attachment">
                        <p>Attachment:</p>
                        <div class="attach_buttons">
                                @if(!$data->hasReview)
                                    <a href="{{ route('reviews.create', ['assessment_id' => $data->id, 'consultant_id' => $data->consultant_id]) }}" class="text-nowrap">Submit Review</a>
                                @endif
                            <a class="text-center" href="{{ route('consultant.assessment.report.download', $data->id) }}">Download</a>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="detail_part_section">

                <!-- ___________ -->
                <div class="detail_part">
                    <div class="icon"><i class="fa-solid fa-earth-americas"></i></div>
                    <div class="part_text">
                        <span>Preferred Country</span>
                        <p>{{$data->preferred_country}}</p>
                    </div>
                </div>
                <!-- ___________ -->
                <div class="detail_part">
                    <div class="icon"><i class="fa-solid fa-building-columns"></i></div>
                    <div class="part_text">
                        <span> Preferred Institute</span>
                        <p>{{$data->preferred_institute}}</p>
                    </div>
                </div>
                <!-- ___________ -->
                <div class="detail_part">
                    <div class="icon"><i class="fa-solid fa-book"></i></div>
                    <div class="part_text">
                        <span>Preferred Subject</span>
                        <p>{{$data->preferred_subject}}</p>
                    </div>
                </div>
                <!-- ___________ -->
                <div class="detail_part">
                    <div class="icon"><i class="fa-solid fa-sack-dollar"></i></div>
                    <div class="part_text">
                        <span>Your Budget</span>
                        <p>{{$data->student_budget}}</p>
                    </div>
                </div>
                <!-- ___________ -->
                <div class="detail_part bottom_part">
                    <div class="icon">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <div class="part_text">
                        <span>Assessment Status</span>
                        @if($data->status == 'Pending')
                            <p style="background-color: rgb(233, 179, 0);font-weight:700; color: white;">{{$data->status}}</p>
                        @elseif($data->status == 'Accepted')
                            <p style="background-color: rgb(13, 90, 255);font-weight:700; color: white;">{{$data->status}}</p>
                        @elseif($data->status == 'Submited')
                            <p style="background-color: rgb(1, 235, 231);color:black;font-weight:700;">{{$data->status}}</p>
                        @elseif($data->status == 'Completed')
                            <p style="background-color: green; color: white;font-weight:700;">{{$data->status}}</p>
                        @elseif($data->status == 'Rejected')
                            <p style="background-color: red; color: white;font-weight:700;">{{$data->status}}</p>
                        @endif
                        @if($data->status == 'Submited')
                        <div class="desktop_attachment">
                            
                            <div class="attach_buttons">
                                @if(!$data->hasReview)
                                    <select onchange="handleAction(this)" style="cursor: pointer; background-color:rgba(3, 102, 23, 0.99); border:0.5px solid rgba(3, 102, 23, 0.99); color:white; border-radius:3px;">
                                        <option selected disabled hidden>Accept</option>
                                        <option style="cursor: pointer;" value="{{ route('service.accept', ['service_id' => $data->id]) }}">
                                            Accept
                                        </option>
                                        <option style="cursor: pointer; background-color:rgba(239, 88, 1, 0.99); rgba(239, 88, 1, 0.99);"
                                        value="{{ route('report.service', ['service_id' => $data->id]) }}">
                                            Report
                                        </option>
                                    </select>

                                <script>
                                    function handleAction(select) {
                                        const url = select.value;

                                        // Hide the placeholder option
                                        const firstOption = select.options[0];
                                        if (firstOption.disabled) {
                                            firstOption.style.display = "none";
                                        }

                                        if (url) {
                                            window.location.href = url;
                                        }
                                    }
                                </script>

                                @endif

                                @if(!empty($data->attachment))
                                    <a href="{{ route('consultant.assessment.report.download', $data->id) }}" download>Download</a>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if($data->status == 'Completed')
                        <div class="desktop_attachment">
                            <p>Attachment:</p>
                            <div class="attach_buttons">
                                @if(!$data->hasReview)
                                    <a href="{{ route('reviews.create', ['assessment_id' => $data->id, 'consultant_id' => $data->consultant_id]) }}" class="text-nowrap">Submit Review</a>
                                @endif
                                <a href="{{ route('consultant.assessment.report.download', $data->id) }}" download>Download</a>
                            </div>
                        </div>
                        @endif
                    </div>
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
    <div class="no_data_section">
        <div class="empty-state">
            <div class="empty-state__content">
                <div class="empty-state__icon"><img src="{{asset('no-data-image.png')}}" alt=""></div>
                <div class="empty-state__message">No Service Found</div>
                <div class="empty-state__help">Send Request by seleting your choice to get Assessment.</div>
            </div>
        </div>
    </div>
    @endif

</section>


@endsection

@push('script')
    <!-- ___________ jquery search start -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#searchInput').on('keyup', function () {
            let value = $(this).val().toLowerCase();

            $('.searchable-item').filter(function () {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(value) > -1);
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
            console.log(current_target);
            accordianHead.map((item) => {
                const togglerArrowIcon = item.querySelector(".toggler_arrow i");
                if (current_target !== item) {
                    const accordianBody = item.nextElementSibling;
                    const togglerBtn = item.firstElementChild;
                    togglerBtn.classList.remove("active");
                    accordianBody.classList.remove("active_body");
                    togglerArrowIcon.classList.remove("rotate");
                } else {
                    const accordianBody = current_target.nextElementSibling;
                    const togglerBtn = item.firstElementChild;
                    togglerBtn.classList.toggle("active");
                    accordianBody.classList.toggle("active_body");
                    togglerArrowIcon.classList.toggle("rotate");
                }
            });
            }

        // __________________ request list expend end



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

        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#activityTable tbody tr');

            rows.forEach(function(row) {
                // Convert row text content to lowercase and check if it includes the search input
                var rowText = row.textContent.toLowerCase();
                if (rowText.includes(input)) {
                    row.style.display = ''; // Show row if it matches the search query
                } else {
                    row.style.display = 'none'; // Hide row if it doesn't match
                }
            });
        });

    // Clear modal data and backdrop when it is hidden
    $('#activityViewModla').on('hidden.bs.modal', function() {
        // Optional: Ensure backdrop is removed
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
    });

    </script>
@endpush
