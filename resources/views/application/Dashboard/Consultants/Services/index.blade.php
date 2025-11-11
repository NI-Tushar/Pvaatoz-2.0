@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Services')
@section('breadcrumb', 'Assessment/Service')
@section('previous-menu', 'Assessment')
@section('active-menu', 'Assessment Declaration')

@section('master-content')
    <link rel="stylesheet" href="{{ url('Frontend/assets/css/services_card.css') }}">
    <link rel="stylesheet" href="{{ url('Frontend/assets/css/create_assessment.css') }}">
    <link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">
    <!-- Add DataTables CSS -->
    <link href="{{ url('Frontend/assets/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('Frontend/assets/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('Frontend/assets/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('Frontend/assets/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        /* Custom styles for responsive table */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .custom-table thead {
            background-color: #f8f9fa;
        }

        .custom-table th,
        .custom-table td {
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        /* Hide thead on small screens */
        @media (max-width: 768px) {
            .custom-table thead {
                display: none;
            }

            .custom-table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 0.25rem;
                padding: 0.5rem;
            }

            .custom-table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border: none;
                border-bottom: 1px solid #eee;
                padding: 0.5rem;
                text-align: right;
            }

            .custom-table tbody td:last-child {
                border-bottom: none;
            }

            .custom-table tbody td:before {
                content: attr(data-label);
                font-weight: bold;
                text-align: left;
                flex: 1;
            }

            .custom-table tbody td .action-buttons {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
                justify-content: flex-end;
            }
        }

        /* Ensure buttons look good on all screens */
        .action-buttons button,
        .action-buttons a button {
            margin: 0;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: nowrap;
        }

    </style>


    <!-- Heading section start -->
    <div class="d-flex align-items-center mb-2 mt-2">
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
            <i class="fa-solid fa-clipboard-list fa-2x"></i>
        </div>
        <div>
            <h3 class="fw-bold fs-4 mb-0">Your Service Details</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Services</a></li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Details</li> -->
                </ol>
            </nav>
        </div>
    </div>
    <!-- Heading section end -->

    <!-- Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-transparent md:!bg-white border-0 md:!shadow-lg">
                <div class="card-body">
                    <h4 class="header-title text-black text-[20px] font-bold">Your Services</h4>
                    <p class="text-muted text-[17px] mb-4">
                        View and manage your services.
                    </p>
                    
                    <div class="w-full flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Search and Filter Section -->
                        <div class="w-full flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-2">
                            <div class="flex flex-col md:flex-row gap-2 w-full md:w-2/3">
                                <!-- Search Input -->
                                <div class="relative w-full h-full md:w-1/2">
                                    <input 
                                        type="text" 
                                        placeholder="Search with keyword..." 
                                        class="w-full border border-gray-500 rounded-md px-2 py-2 text-[17px] focus:outline-none focus:ring-2 focus:ring-blue-500 
                                        pr-10 text-black placeholder-black" 
                                        id="serviceSearch"/>
                                    <i class="fas fa-search absolute right-3 top-1/2 text-[20px] transform -translate-y-1/2 text-gray-400"></i>
                                </div>

                                <!-- Service Filter Dropdown -->
                                <select 
                                    class="w-full md:w-1/2 border border-gray-500 rounded-md px-2 py-1 text-[17px] 
                                        focus:outline-none focus:ring-2 focus:ring-blue-500 text-black bg-white"
                                    id="serviceFilter"
                                    onchange="filterByService(this)">
                                    <option value="" disabled selected>Select Service</option>

                                    @foreach ($services as $service)
                                        <option value="{{ $service->name }}" class="text-black bg-white">
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                <script>
                                    function filterByService(select) {
                                        const service = select.value;
                                        if (service) {
                                            // Redirect with selected service as a query parameter
                                            window.location.href = `/dashboard/consultant-services-form?service=${encodeURIComponent(service)}`;
                                        }
                                    }
                                </script>





                            </div>

                            <!-- Create Service button (Desktop only) -->
                            <a href="{{ route('consultant.service.create') }}" 
                            class="hidden md:inline-block btn bg-primary-main text-white hover:bg-primary-light ml-auto">
                                Create Service <i class="fas fa-plus text-[12px] ml-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Floating Button for Mobile -->
                    <a href="{{ route('consultant.service.create') }}"
                        class="md:hidden fixed bottom-6 right-6 bg-primary-main text-white w-10 h-10 flex items-center justify-center rounded-full shadow-lg hover:bg-primary-light transition">
                        <i class="fas fa-plus text-[17px]"></i>
                    </a>


                    <table class="custom-table">
                    <thead class="text-[15px] text-black">
                        <tr class="whitespace-nowrap">
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Country</th>
                            <th>Services</th>
                            <th>Subject</th>
                            <th class="whitespace-nowrap">Study Level</th>
                            <th>Charge</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-[15px] text-black">
                        @if ($services_data->isNotEmpty())
                            @foreach ($services_data as $index => $data)
                                <tr class="bg-white">
                                    <td data-label="S/N">{{ $index + 1 }}</td>
                                    <td data-label="Title">{{ Str::limit($data->title, 30) }}</td>
                                    <td data-label="Description">{{ Str::limit($data->description, 50) }}</td>
                                    <td data-label="Country" class="whitespace-nowrap">{{ $data->country }}</td>

                                    <td data-label="Service">
                                        @if($data->services)
                                            <div class="flex flex-wrap gap-1 justify-end md:justify-start">
                                                @foreach(json_decode($data->services) as $service)
                                                    <span class="bg-blue-100 text-black text-sm px-2 py-1 rounded">
                                                        {{ $service }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td data-label="Subject">
                                        @if($data->subjects)
                                            <div class="flex flex-wrap gap-1 justify-end md:justify-start">
                                                @foreach(json_decode($data->subjects) as $subject)
                                                    <span class="bg-blue-100 text-black text-sm px-2 py-1 rounded">
                                                        {{ $subject }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td data-label="Study Level">
                                        @if($data->study_levels)
                                            <div class="flex flex-wrap gap-1 justify-end md:justify-start">
                                                @foreach(json_decode($data->study_levels) as $study)
                                                    <span class="bg-blue-100 text-black text-sm px-2 py-1 rounded">
                                                        {{ $study }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            N/A
                                        @endif
                                    </td>


                                    <td data-label="Price" class="whitespace-nowrap">
                                        {{ $data->price }} <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                                    </td>

                                    <td data-label="Duration">{{ $data->duration }}</td>

                                    @if($data->status == 'active')
                                        <td data-label="Status">
                                            <span class="bg-green-700 text-center rounded text-white px-2">{{ ucfirst($data->status) }}</span>
                                        </td>
                                    @else
                                        <td data-label="Status">
                                            <span class="bg-primary-dim rounded text-white px-2">{{ ucfirst($data->status) }}</span>
                                        </td>
                                    @endif

                                    <td data-label="Actions">
                                        <div class="action-buttons">
                                            <!-- Delete Button -->
                                            <a href="{{ route('consultant.service.delete', ['id' => $data->id]) }}" class="delete-link">
                                                <button type="button" class="btn btn-sm show_confirm_delete border !border-red-700 hover:bg-red-500 group" title="Delete">
                                                    <i class="fas fa-trash-alt text-red-500 group-hover:text-white"></i>
                                                </button>
                                            </a>

                                            <!-- Disable/Publish Button -->
                                            @if($data->status == 'active')
                                                <a href="{{ route('consultant.service.disbable', ['id' => $data->id]) }}" class="disable-link">
                                                    <button type="button" class="btn btn-sm show_confirm_disabled border !border-green-700 hover:bg-green-700 group" title="Disable">
                                                        <i class="fas fa-eye-slash group-hover:text-white"></i>
                                                    </button>
                                                </a>
                                            @else
                                                <a href="{{ route('consultant.service.enable', ['id' => $data->id]) }}" class="disable-link">
                                                    <button type="button" class="btn btn-sm show_confirm_enable border !border-green-700 hover:bg-green-700 group" title="Enable">
                                                        <i class="fas fa-eye text-green-500 group-hover:text-white"></i>
                                                    </button>
                                                </a>
                                            @endif

                                            <!-- Update Button -->
                                            <a href="{{ route('consultant.service.update_get', ['id' => $data->id]) }}" class="btn btn-sm !border-blue-700 hover:bg-blue-700 group" title="Update This Service">
                                                <i class="fas fa-edit text-blue-500 group-hover:text-white"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center py-6">
                                    <div class="empty-state">
                                        <div class="empty-state__icon w-full flex p-6">
                                            <img class="m-auto" src="{{ asset('no-data-image.png') }}" alt="">
                                        </div>
                                        <div class="empty-state__message for_consultant text-red-700 font-bold">
                                            You did not create any service yet.
                                        </div>
                                        <div class="empty-state__help">
                                            Create Your service to get Request
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                    
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <!-- Hidden input field for free service start -->
    <script>
        function showHideCharge(selectElement){
            // const selectedValue = selectElement.value;
            const selectedText = selectElement.options[selectElement.selectedIndex].text;
            const paidChargeInput = document.getElementById("paidChargeInput");
            console.log(selectedText);

            if (selectedText === "Assessment") {
                paidChargeInput.style.display = "block";
            } else {
                paidChargeInput.style.display = "none";
            }
        }
    </script>
    <!-- Hidden input field for free service end -->


    <!-- _________ for opening create service modal if create service hit from dashboard start -->
    @if(isset($action) && $action == 'create_service')
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                openForm();
            });

            function openForm() {
                document.getElementById("create_assessment").classList.add("show");
            }
        </script>
    @endif
    <!-- _________ for opening create service modal if create service hit from dashboard end -->
    

  <!-- Toast Notification -->
    <div id="toast" 
        class="fixed top-5 right-5 text-white p-3 rounded shadow-lg hidden z-[1000] flex items-center gap-2 min-w-[200px]">
        <i id="toast-icon" class="fa-regular fa-circle-check text-white"></i>
        <span id="toast-msg">Success!</span>
    </div>

    <!-- Show Toast for Any Session Message -->
    @if(session('success') || session('error') || session('service_disabled') || session('service_enabled') || session('service_delete'))
    <script>
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-msg');
        const toastIcon = document.getElementById('toast-icon');

        // Default values
        let bgColor = 'bg-green-500';
        let iconClass = 'fa-regular fa-circle-check';

        @if(session('success'))
            toastMsg.textContent = "{{ session('success') }}";
            bgColor = 'bg-green-500';
            iconClass = 'fa-regular fa-circle-check';
        @elseif(session('error'))
            toastMsg.textContent = "{{ session('error') }}";
            bgColor = 'bg-red-500';
            iconClass = 'fa-solid fa-triangle-exclamation';
        @elseif(session('service_disabled'))
            toastMsg.textContent = "{{ session('service_disabled') }}";
            bgColor = 'bg-yellow-500';
            iconClass = 'fa-solid fa-circle-exclamation';
        @elseif(session('service_enabled'))
            toastMsg.textContent = "{{ session('service_enabled') }}";
            bgColor = 'bg-green-500';
            iconClass = 'fa-regular fa-circle-check';
        @elseif(session('service_delete'))
            toastMsg.textContent = "{{ session('service_delete') }}";
            bgColor = 'bg-red-500';
            iconClass = 'fa-solid fa-trash';
        @endif

        // Update toast styles
        toast.classList.remove('hidden', 'bg-green-500', 'bg-red-500', 'bg-yellow-500');
        toast.classList.add(bgColor);
        toastIcon.className = iconClass + ' text-white';

        // Show toast
        toast.classList.remove('hidden');

        // Auto hide after 3 seconds
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);
    </script>
    @endif





@endsection

@push('script')
    <!-- Add jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        // function showUpdateProfile(id, name, title, description, country, subject, price, duration) {
        //     document.getElementById("update_assessment").classList.add("show");

        //     var assessment_id_elem = document.getElementById("assessment_id");
        //     var name_elem = document.getElementById("name");
        //     var title_elem = document.getElementById("title");
        //     var description_elem = document.getElementById("description");
        //     var country_elem = document.getElementById("country");
        //     var subject_elem = document.getElementById("subject");
        //     var price_elem = document.getElementById("price");
        //     var price_box = document.getElementById("price_box"); // wrap the whole div
        //     var duration_elem = document.getElementById("duration");

        //     assessment_id_elem.value = id;
        //     name_elem.textContent = name;
        //     title_elem.value = title;
        //     description_elem.value = description;
        //     country_elem.value = country;
        //     subject_elem.value = subject;
        //     duration_elem.value = duration;

        //     if (price === null || price === "") {
        //         price_box.style.display = "none";
        //     } else {
        //         price_box.style.display = "block";
        //         price_elem.value = price;
        //     }
        // }


        function closeUpdateProfile() {
            document.getElementById("update_assessment").classList.remove("show");
        }

        function openForm() {
            document.getElementById("create_assessment").classList.add("show");
        }

        function closeForm() {
            document.getElementById("create_assessment").classList.remove("show");
        }

        // SweetAlert for Disable
        $(document).on('click', '.show_confirm_disabled', function(event) {
            event.preventDefault();
            var link = $(this).closest('a').attr('href');
            Swal.fire({
                title: "Are you sure you want to disable this service?",
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, disable it!",
                cancelButtonText: "Cancel",
                confirmButtonColor: "var(--consultant-primary-color) !important",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        });

        // SweetAlert for Enable
        $(document).on('click', '.show_confirm_enable', function(event) {
            event.preventDefault();
            var link = $(this).closest('a').attr('href');
            Swal.fire({
                title: "Are you sure you want to Active this service?",
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Publish!",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#008000 !important",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        });

        // SweetAlert for Delete
        $(document).on('click', '.show_confirm_delete', function(event) {
            event.preventDefault();
            var link = $(this).closest('a').attr('href');
            Swal.fire({
                title: "Are you sure you want to Delete this service?",
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete it!",
                cancelButtonText: "Cancel",
                confirmButtonColor: "var(--consultant-primary-color) !important",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        });

        // Country Suggestions
        const countries = [
            "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda",
            "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas",
            "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin",
            "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei",
            "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon",
            "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia",
            "Comoros", "Congo", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic",
            "Democratic Republic of the Congo", "Denmark", "Djibouti", "Dominica",
            "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea",
            "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland", "France",
            "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada",
            "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras",
            "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland",
            "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati",
            "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia",
            "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi",
            "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania",
            "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia",
            "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal",
            "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea",
            "North Macedonia", "Norway", "Oman", "Pakistan", "Palau", "Palestine",
            "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland",
            "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis",
            "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino",
            "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles",
            "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands",
            "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka",
            "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Tajikistan", "Tanzania",
            "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia",
            "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates",
            "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu",
            "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
        ];

        // Create Service Country Suggestions
        const input = document.getElementById("country_form");
        const suggestionBox = document.getElementById("countrySuggestions");

        input.addEventListener("input", function() {
            const query = this.value.toLowerCase();
            suggestionBox.innerHTML = "";
            if (!query) return;
            const filtered = countries.filter(country => country.toLowerCase().startsWith(query));
            filtered.forEach(country => {
                const div = document.createElement("div");
                div.textContent = country;
                div.addEventListener("click", function() {
                    input.value = country;
                    suggestionBox.innerHTML = "";
                });
                suggestionBox.appendChild(div);
            });
        });

        document.addEventListener("click", function(e) {
            if (!suggestionBox.contains(e.target) && e.target !== input) {
                suggestionBox.innerHTML = "";
            }
        });

        // Update Service Country Suggestions
        const input_update = document.getElementById("country");
        const suggestionBox_update = document.getElementById("countrySuggestions_update");

        input_update.addEventListener("input", function() {
            const query = this.value.toLowerCase();
            suggestionBox_update.innerHTML = "";
            if (!query) return;
            const filtered = countries.filter(country => country.toLowerCase().startsWith(query));
            filtered.forEach(country => {
                const div = document.createElement("div");
                div.textContent = country;
                div.addEventListener("click", function() {
                    input_update.value = country;
                    suggestionBox_update.innerHTML = "";
                });
                suggestionBox_update.appendChild(div);
            });
        });

        document.addEventListener("click", function(e) {
            if (!suggestionBox_update.contains(e.target) && e.target !== input_update) {
                suggestionBox_update.innerHTML = "";
            }
        });
    </script>


    <!-- table search start -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Search filter
            $("#serviceSearch").on("keyup", function () {
                let value = $(this).val().toLowerCase();

                $(".custom-table tbody tr").filter(function () {
                    // Search across all text in the row
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Filter by service
            $("#serviceFilter").on("change", function () {
                let filterValue = $(this).val().toLowerCase();

                $(".custom-table tbody tr").filter(function () {
                    if (filterValue === "") {
                        $(this).show();
                    } else {
                        let serviceText = $(this).find("td[data-label='Service']").text().toLowerCase();
                        $(this).toggle(serviceText.includes(filterValue));
                    }
                });
            });
        });
    </script>
    <!-- table search end -->
@endpush
