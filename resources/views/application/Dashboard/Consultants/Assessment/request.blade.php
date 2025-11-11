@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('breadcrumb', 'Request')
@section('previous-menu', 'Request')
@section('active-menu', 'Request')
@section('master-content')

    <link rel="stylesheet" href="{{ url('Frontend/assets/css/assessment_requested_list_consultant.css') }}">
    <link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">

    <!-- Heading section start -->
    <div class="d-flex align-items-center mb-2 mt-2">
        <!-- <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
            <i class="fa-solid fa-pen fa-2x"></i>
        </div> -->
        <div>
            <h3 class="fw-bold fs-4 mb-0">{{ __('message.service_request') }} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Service Request</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Heading section end -->

    <!-- Toaster -->
    @if(session('submitted_success'))
    <div x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 3000)" 
        class="fixed top-5 right-5 border-[#1ae503] bg-[#0a6000] text-white px-4 py-3 shadow-lg"
        style="z-index: 999999999; border-left:5px solid #1cef05;">
        {{ session('submitted_success') }}
    </div>
    @endif



    <div class="card rounded-lg overflow-hidden">
        <div class="card-body p-0 rounded-lg overflow-hidden" style="border: 1px solid rgba(0, 0, 0, 0.4);">
            <!-- _____________ student choices start -->
            <div class="selected_assessment_section">
                <div class="w-full block md:flex bg-primary-gray p-2">
                    <div class="w-full flex">
                        <h3 class="mt-auto mb-auto text-[20px]"><i class="fa-solid fa-layer-group"></i> {{ ucfirst($statusName) }} Request</h3>
                    </div> 
                    <div class="flex mt-2 md:mt-0 w-full gap-2">
                        <!-- Search Input Added -->
                        <div class="w-full">
                            <input class="h-full px-3 py-1 w-full text-[14px] outline-none rounded" style="border: 1px solid rgba(0, 0, 0, 0.4);" type="text" id="searchInput" placeholder="Search requests...">
                        </div>
                        <!-- Search Input Added -->
                        <div class="w-full">
                            <select id="statusSelect" class="w-full h-full outline-none p-1 text-black rounded" style="border: 1px solid rgba(0, 0, 0, 0.4);">
                                <option value="">Select Status</option>
                                <option value="{{ route('consultant.assessment.all-request', ['status' => 'Pending']) }}">Pending</option>
                                <option value="{{ route('consultant.assessment.all-request', ['status' => 'Rejected']) }}">Rejected</option>
                                <option value="{{ route('consultant.assessment.all-request', ['status' => 'Draft']) }}">Draft</option>
                                <option value="{{ route('consultant.assessment.all-request', ['status' => 'Submited']) }}">Submited</option>
                                <option value="{{ route('consultant.assessment.all-request', ['status' => 'Accepted']) }}">Accepted</option>
                                <option value="{{ route('consultant.assessment.all-request', ['status' => 'Completed']) }}">Completed</option>
                            </select>
                        </div>

                        <script>
                            document.getElementById('statusSelect').addEventListener('change', function() {
                                const url = this.value;
                                if (url) {
                                    window.location.href = url;
                                }
                            });
                        </script>

                    </div>
                </div>
                <div class="w-full hidden md:flex py-2 bg-[#dfedfd]">
                    <div class="w-[200px] px-2 text-black font-bold text-[14px]">Index</div>
                    <div class="w-full px-2 text-black font-bold text-[16px]">Student Name</div>
                    <div class="w-full px-2 text-black font-bold text-[16px]">Services</div>
                    <div class="w-full px-2 text-black font-bold text-[16px]">Country</div>
                    <div class="w-full px-2 text-black font-bold text-[16px]">Subject</div>
                    <div class="w-full px-2 text-black font-bold text-[16px]">Study Level</div>
                    <div class="w-full px-2 text-black font-bold text-[16px]">Duration</div>
                    <div class="w-full px-2 text-black font-bold text-[16px]">Charge</div>
                    <div class="w-full px-2 text-black font-bold text-[16px]">Status</div>
                    <div class="w-[100px] pr-3 text-black font-bold text-[16px]"></div>
                </div>
                @if ($assessments->isNotEmpty())
                    @foreach ($assessments as $data)
                        <!-- __________________ -->
                        <div class="accordian searchable-card pb-6" style="border-top: 1px solid rgba(0, 0, 0, 0.4);"
                            data-search="{{ strtolower($data->student->name . ' ' . $data->service_name . ' ' . $data->preferred_country . ' ' . $data->status) }}">
                            <div class="accordian_head">
                                <div class="flex py-2">
                                    <!-- ___________ -->
                                    <div class="w-[200px] px-2 hidden md:flex text-black font-bold text-[14px] ">
                                        <p class="text-black font-bold m-auto">{{ $loop->iteration }}</p>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="w-full px-2 text-black flex font-bold text-[14px] ">
                                        <img class="h-[40px] w-[40px] mt-auto mb-auto rounded-full" src="{{ $data->student->image ? asset($data->student->image) : asset('no-profile-img.png') }}"
                                            alt="User Image">
                                        <p class="mt-auto mb-auto ml-2 text-black font-bold text-[14px]">{{ $data->student->name }}</p>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="w-full hidden md:block px-2 text-black font-bold text-[14px] ">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(json_decode($data->assessment_service_name) as $service)
                                                <span class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded text-sm leading-tight w-fit h-fit">
                                                    {{ $service }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="w-full hidden md:block px-2 text-black font-bold text-[14px] ">
                                        <p>{{ $data->assessment_country }}</p>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="w-full hidden md:block px-2 text-black font-bold text-[14px] ">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(json_decode($data->assessment_subject) as $subject)
                                                <span class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded text-sm leading-tight w-fit h-fit">
                                                    {{ $subject }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="w-full hidden md:block px-2 text-black font-bold text-[14px] ">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(json_decode($data->assessment_study_level) as $study)
                                                <span class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded text-sm leading-tight w-fit h-fit">
                                                    {{ $study }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- ___________ -->
                                    @if($data->assessment_charge !== null && $data->assessment_charge !== '')
                                    <div class="w-full hidden md:block px-2 text-black font-bold text-[14px] ">
                                        <!-- <p class="span"><i class="fa-solid fa-bangladeshi-taka-sign"></i> Charge</p> -->
                                        <p>{{ $data->assessment_charge }} BDT</p>
                                    </div>
                                    @endif
                                    <!-- ___________ -->
                                    <div class="w-full hidden md:block px-2 text-black font-bold text-[14px] ">
                                        <!-- <p class="span"><i class="fa-regular fa-clock"></i> Duration</p> -->
                                        <p>{{ $data->assessment_duration }}</p>
                                    </div>
                                    <!-- ___________ -->
                                    <div class="w-full px-2 flex text-black font-bold text-[14px] ">
                                        @if ($data->status == 'Pending')
                                            <div class="px-3 py-1 ml-auto md:ml-0 my-auto rounded h-[25px] text-[13px]" style="width:fit-content; background-color: rgb(233, 179, 0);"
                                                class="mov_status ">{{ $data->status }}</div>
                                        @elseif($data->status == 'Accepted')
                                            <div class="px-3 py-1 ml-auto md:ml-0 my-auto rounded h-[25px] text-[13px] text-white" style="background-color: rgb(13, 90, 255);" 
                                                class="mov_status">{{ $data->status }}</div>
                                        @elseif($data->status == 'Completed')
                                            <div class="px-3 py-1 ml-auto md:ml-0 my-auto rounded h-[25px] text-[13px] text-white" style="background-color: green;"
                                            class="mov_status">{{ $data->status }}</div>
                                        @elseif($data->status == 'Rejected')
                                            <div class="px-3 py-1 ml-auto md:ml-0 my-auto rounded h-[25px] text-[13px]" style="background-color: red;" 
                                            class="mov_status">{{ $data->status }}</div>
                                        @endif
                                    </div>

                                    <div class="accordian_toggler">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="accordian_body">
                                <div class="accordian_description">

                                    <div class="mov_consultant_section">
                                        <div class="item">
                                            <span>Requested Service</span>
                                            <div class="flex flex-wrap gap-2">
                                            @foreach(json_decode($data->assessment_service_name) as $service)
                                                <span class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded text-sm leading-tight w-fit h-fit">
                                                    {{ $service }}
                                                </span>
                                            @endforeach
                                            </div>
                                        </div>
                                        <div class="item"><i class="fa-solid fa-earth-americas"></i>
                                            {{ $data->assessment_country }}</div>
                                        <div class="item"><i class="fa-solid fa-bangladeshi-taka-sign"></i>
                                            {{ $data->assessment_charge }} BDT</div>
                                        <div class="item"><i class="fa-regular fa-clock"></i>
                                            {{ $data->assessment_duration }}
                                        </div>

                                        @if ($data->status == 'Completed' && $data->attachment)
                                            <div class="mov_attachment">
                                                <p>Attachment:</p>
                                                <div class="attach_buttons">
                                                    <button class="_df_button"
                                                        source="{{ asset('storage/' . $data->attachment) }}">View</button>
                                                    <a href="{{ asset('storage/' . $data->attachment) }}"
                                                        download>Download</a>
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
                                                <p>{{ $data->preferred_country }}</p>
                                            </div>
                                        </div>
                                        <!-- ___________ -->
                                        <div class="detail_part">
                                            <div class="icon"><i class="fa-solid fa-building-columns"></i></div>
                                            <div class="part_text">
                                                <span> Preferred Institute</span>
                                                <p>{{ $data->preferred_institute }}</p>
                                            </div>
                                        </div>
                                        <!-- ___________ -->
                                        <div class="detail_part">
                                            <div class="icon"><i class="fa-solid fa-book"></i></div>
                                            <div class="part_text">
                                                <span>Preferred Subject</span>
                                                <p>{{ $data->preferred_subject }}</p>
                                            </div>
                                        </div>
                                        <!-- ___________ -->
                                        <div class="detail_part">
                                            <div class="icon"><i class="fa-solid fa-sack-dollar"></i></div>
                                            <div class="part_text">
                                                <span>Student Budget</span>
                                                <p>{{ $data->student_budget }} BDT</p>
                                            </div>
                                        </div>
                                        <!-- ___________ -->
                                        <div class="detail_part bottom_part">
                                            <div class="icon">
                                                <i class="fa-solid fa-tags"></i>
                                            </div>
                                            <div class="part_text">
                                                <span>Assessment Status</span>
                                                @if ($data->status == 'Pending')
                                                    <p style="background-color: rgb(233, 179, 0);font-weight:700;">
                                                        {{ $data->status }}</p>
                                                @elseif($data->status == 'Accepted')
                                                    <p style="background-color: rgb(13, 90, 255);font-weight:700;">
                                                        {{ $data->status }}</p>
                                                @elseif($data->status == 'Completed')
                                                    <p style="background-color: green;font-weight:700;">{{ $data->status }}
                                                    </p>
                                                @elseif($data->status == 'Rejected')
                                                    <p style="background-color: red;font-weight:700;">{{ $data->status }}
                                                    </p>
                                                @endif
                                                @if ($data->status == 'Completed' && $data->attachment)
                                                    <div class="desktop_attachment">
                                                        <p>Attachment:</p>
                                                        <div class="attach_buttons">
                                                            <button class="_df_button"
                                                                source="{{ asset('storage/' . $data->attachment) }}">View</button>
                                                            <a href="{{ asset('storage/' . $data->attachment) }}"
                                                                download>Download</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- ___________ -->
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="action-buttons mt-3 d-flex justify-content-between p-1 m-1">
                                        <div class="action-btn-group me-1 p-1">
                                            <!-- View Details Button -->
                                            <a href="{{ route('consultant.assessment.details', $data->id) }}"
                                                class="btn btn-outline-primary btn-sm text-nowrap" title="View Details">
                                                <i class="fas fa-eye"></i>
                                                <span>View Details</span>
                                            </a>
                                        </div>

                                        <div class="action-btn-group ms-1 p-1">
                                            @if ($data->status == 'Pending' || $data->status == 'Rejected')
                                                <!-- Accept Request Button -->
                                                <form action="{{ route('consultant.assessment.status') }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="assessment_id" value="{{ $data->id }}">
													<input type="hidden" name="status" value="Accepted">
													<button type="submit" class="btn btn-primary btn-sm text-nowrap show_confirm" title="Accept Request">
														<i class="fas fa-check"></i>
														<span>Accept Request</span>
													</button>
                                                </form>
                                            @elseif ($data->status == 'Accepted' && $data->service_name == 'Assessment')

                                                <!-- Prepare Report Button -->
                                                <a href="{{ route('consultant.assessment.report.create', $data->id) }}"
                                                    class="btn btn-success btn-sm text-nowrap" title="Prepare Report">
                                                    <i class="fas fa-file-alt"></i>
                                                    <span>Prepare Report</span>
                                                </a>
											@elseif ($data->status == 'Completed' && $data->service_name == 'Assessment')
                                                <!-- Prepare Report Button -->
                                                <div class="btn btn-success btn-sm text-nowrap" title="View Report">
                                                    <i class="fas fa-eye"></i>
                                                    <span>View Report</span>
                                                </div>
                                            @else
                                                <a href="{{ route('consultant.assessment.submitted', $data->id) }}"
                                                    class="btn btn-success btn-sm text-nowrap" title="Prepare Report">
                                                    <i class="fa-solid fa-circle-check mr-1"></i>
                                                    <span>Mark as Submit</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- __________________ -->
                    @endforeach

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $assessments->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <div class="no_data_section">
                        <div class="empty-state">
                            <div class="empty-state__content">
                                <div class="empty-state__icon">
                                    <img src="{{ asset('no-data-image.png') }}"alt="">
                                </div>
                                <div class="empty-state__message">No Requests Found</div>
                                <div class="empty-state__help">When students make requests, they will appear here</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        // Accordion functionality
        let accordianHead = Array.from(document.querySelectorAll(".accordian_head"));

        accordianHead.map((item) =>
            item.addEventListener("click", () => {
                closeAllAccordian(item);
            })
        );

        function closeAllAccordian(current_target) {
            accordianHead.map((item) => {
                if (current_target !== item) {
                    const accordianBody = item.nextElementSibling;
                    const togglerBtn = item.firstElementChild;
                    togglerBtn.classList.remove("active");
                    accordianBody.classList.remove("active_body");
                } else {
                    const accordianBody = current_target.nextElementSibling;
                    const togglerBtn = item.firstElementChild;
                    togglerBtn.classList.toggle("active");
                    accordianBody.classList.toggle("active_body");
                }
            });
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.searchable-card');
            let hasVisibleCards = false;

            cards.forEach(card => {
                const searchText = card.getAttribute('data-search');
                if (searchText.includes(searchTerm)) {
                    card.style.display = '';
                    hasVisibleCards = true;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide no data section
            const noDataSection = document.querySelector('.no_data_section');
            if (noDataSection) {
                noDataSection.style.display = hasVisibleCards ? 'none' : 'block';
            }
        });

        // Confirmation dialog
        $('.show_confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");

            Swal.fire({
                title: "Accept Request?",
                text: "Are you sure you want to accept this assessment request?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes, Accept",
                cancelButtonText: "Cancel",
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // PDF viewer for attachments
        document.querySelectorAll('._df_button').forEach(button => {
            button.addEventListener('click', () => {
                const pdfUrl = button.getAttribute('source');
                window.open(pdfUrl, '_blank');
            });
        });
    </script>
@endpush
