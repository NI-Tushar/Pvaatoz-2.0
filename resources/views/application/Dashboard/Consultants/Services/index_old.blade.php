@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Sercices')
@section('breadcrumb', 'Assessment/Service')
@section('previous-menu', 'Assessment')
@section('active-menu', 'Assessment Declaration')

@section('master-content')
<link rel="stylesheet" href="{{ url('Frontend/assets/css/services_card.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/create_assessment.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">

<div class="add_btn">
    <button onclick="openForm()">Create Assessment</button>
</div>
        @if (Session::has('success_create'))
            <p style="color:green;font-weight:700; font-size:25px; width:100%;text-align:center;">{{ Session::get('success_create') }}</p>
        @endif
        @if (Session::has('success_message'))
            <p style="color:green;font-weight:700; font-size:25px; width:100%;text-align:center;">{{ Session::get('success_message') }}</p>
        @endif
        @if (Session::has('failed_message'))
            <p style="color:red;font-weight:700; font-size:25px; width:100%;text-align:center;">{{ Session::get('failed_message') }}</p>
        @endif
        @if (Session::has('service_disabled'))
            <p style="color:var(--consultant-primary-color);font-weight:700; font-size:25px; width:100%;text-align:center;">{{ Session::get('service_disabled') }}</p>
        @endif
        @if (Session::has('service_enabled'))
            <p style="color:green;font-weight:700; font-size:25px; width:100%;text-align:center;">{{ Session::get('service_enabled') }}</p>
        @endif
        @if (Session::has('service_delete'))
            <p style="color:red;font-weight:700; font-size:25px; width:100%;text-align:center;">{{ Session::get('service_delete') }}</p>
        @endif
        <div class="consultant_card">
            <div class="blank-1"></div>
                <div class="cards">

                @if ($services_data->isNotEmpty())
                    @foreach ($services_data as $data)
                    <!-- __________________________________________________ -->
                    <div class="card">
                        <div class="post_num_div">
                            <p class="post_num">{{ $loop->index + 1 }}</p>
                        </div>
                        <div class="jobs_body">

                            <div class="top_icon">
                                <i class="fa-solid fa-circle-info"></i>
                                <i class="fa-solid fa-share"></i>
                            </div>

                            <div class="job_heading">
                                <div class="giver_img">
                                    <img src="{{ auth()->guard('web')->user()->image ? asset(auth()->guard('web')->user()->image) : asset('no-profile-img.png') }}" alt="User Image">
                                </div>
                                <div class="job_title">
                                    <h3>{{ $data->title }}</h3>
                                    <p class="user_name">{{ auth()->guard('web')->user()->name ?? 'Guest' }}</p>
                                    <p class="address"><i class="fa-solid fa-location-dot"></i>{{ auth()->guard('web')->user()->present_address ?? 'Not Provided' }}</p>
                                </div>
                            </div>

                            <div class="gen_amnt">
                                <p><i class="fa-solid fa-restroom"></i><Span>{{ auth()->guard('web')->user()->gender ?? 'Not Provided' }}</Span></p>
                                <p><i class="fa-solid fa-calendar"></i><span>{{ $data->duration }}</span></p>
                                <p><i class="fa-solid fa-bangladeshi-taka-sign"></i><span>{{ $data->price }}</span></p>
                            </div>

                            <div class="jobs_desc">
                                <p>{{ $data->description }}</p>
                            </div>
                            <a href=""><button class="tag">{{ $data->services->name ?? 'N/A' }}</button></a>
                            <p class="posting_time"><i class="fa-solid fa-clock"></i><span>{{ $data->created_at->diffForHumans() }}</span></p>

                            <div class="request_button">
                                <a href="{{ route('consultant.service.delete', ['id' => $data->id]) }}" class="delete-link">
                                    <button type="button" class="show_confirm_delete delete">Delete</button>
                                </a>

                                @if($data->status == 'active')
                                    <a href="{{ route('consultant.service.disbable', ['id' => $data->id]) }}" class="disable-link">
                                        <button type="button" class="show_confirm_disabled">Disable</button>
                                    </a>
                                @else
                                    <a href="{{ route('consultant.service.enable', ['id' => $data->id]) }}" class="disable-link">
                                        <button type="button" class="show_confirm_enable disabled">Publish</button>
                                    </a>
                                @endif

                                <button class="active"
                                onclick="showUpdateProfile('{{ $data->id }}', '{{ $data->services->name }}', '{{ $data->title }}', '{{ $data->description }}', '{{ $data->country }}', '{{ $data->subject }}', '{{ $data->price}}','{{ $data->duration}}')">Update</button>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="no_data_section">
                        <div class="empty-state">
                            <div class="empty-state__content">
                                <div class="empty-state__icon"><img src="{{asset('no-data-image.png')}}" alt=""></div>
                                <div class="empty-state__message for_consultant">You did not create any service yet.</div>
                                <div class="empty-state__help">Please Create Your service to publish Your Assessment</div>
                                    <button class="button_for_consultant" onclick="openForm()">Create Assessment</button>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- __________________________________________________ -->
            </div>
            <div class="blank-2"></div>
        </div>





<!-- ________________________________________ UPDATE ASSESSMENT START -->
    <div id="update_assessment" class="update_assessment">
        <div class="update_edu_center">
            <div class="heading">
                <div class="heading_title">
                    <h4>Update Your Assessment</h4>
                </div>
                    <div class="close_icon">
                    <i onclick="closeUpdateProfile()" class="fa-regular fa-circle-xmark"></i>
                </div>
            </div>
            <form class="row g-3" method="POST" action="{{ route('consultant.service.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="assessment_id" name="assessment_id" value="">
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Your Selected Assessment</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                            <p type="text" id="name"  class="form-control"></p>
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Title of Your Assessment</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-quote-right"></i>
                        </div>
                        <input type="text" name="title" id="title"  class="form-control" required
                        value=""
                        placeholder="Enter the title of assessment">
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Description of Your Assessment</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i style="margin-left:auto:margin-right:auto; margin-top:10px;" class="fa-solid fa-pen-to-square"></i>
                        </div>
                        <textarea type="text" rows="3" name="description" class="form-control" id="description"
                        value="" placeholder="Enter the Description of your Assessment" required></textarea>
                    </div>
                </div>

                <div class="col-12">
                    <label for="inputAddress" class="form-label">Country of your Assessment</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-earth-americas"></i>
                        </div>
                        <input type="text" name="country" class="form-control" id="country" required
                        value=""
                        placeholder="Enter the Country name you want to Assess">
                    </div>
                    <div class="autocomplete-suggestions" id="countrySuggestions_update"></div>
                </div>

                <div class="col-12">
                    <label for="inputAddress" class="form-label">Subject of your Assessment</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-book"></i>
                        </div>
                        <input type="text" name="subject" class="form-control" id="subject" required
                        value=""
                        placeholder="Enter the Subject about You Assess">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Charge</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                        </div>
                        <input type="number" name="price" class="form-control" id="price" required
                        value="" placeholder="Enter the Charge of your Assessment">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Duration</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <input type="text" name="duration" class="form-control" id="duration" required
                        value="" placeholder="Enter the time/days you will you will take">
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="save_btn">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    // __________________________ UPDATE PROFILE FUNCTION
    function showUpdateProfile(id, name, title, description, country, subject, price, duration) {

        document.getElementById("update_assessment").classList.add("show");

        // ________ elements id
        var assessment_id_elem = document.getElementById("assessment_id");
        var name_elem = document.getElementById("name");
        var title_elem = document.getElementById("title");
        var description_elem = document.getElementById("description");
        var country_elem = document.getElementById("country");
        var subject_elem = document.getElementById("subject");
        var price_elem = document.getElementById("price");
        var duration_elem = document.getElementById("duration");

        assessment_id_elem.value  = id;
        name_elem.textContent = name;
        title_elem.value  = title;
        description_elem.value  = description;
        country_elem.value  = country;
        subject_elem.value  = subject;
        price_elem.value  = price;
        duration_elem.value  = duration;
    }

    function closeUpdateProfile(){
        document.getElementById("update_assessment").classList.remove("show");
    }
    </script>
<!-- ________________________________________ UPDATE ASSESSMENT END -->



<!-- ________________________________________ CREATE ASSESSMENT START -->
    <div id="create_assessment" class="update_assessment">
        <div class="update_edu_center">
            <div class="heading">
                <div class="heading_title">
                    <h4>Create Your Assessment</h4>
                </div>
                    <div class="close_icon">
                    <i onclick="closeForm()" class="fa-regular fa-circle-xmark"></i>
                </div>
            </div>
            <form class="row g-3" method="POST" action="{{ route('consultant.service.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Select Your Assessment</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <select id="service" name="service" class="form-control" required>
                        <option value="" disabled selected>Select a Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Title of Your Assessment</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-quote-right"></i>
                        </div>
                        <input type="text" name="title" id="inputAddress"  class="form-control" required
                        value=""
                        placeholder="Enter the title of assessment">
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Description of Your Assessment</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i style="margin-left:auto:margin-right:auto; margin-top:10px;" class="fa-solid fa-pen-to-square"></i>
                        </div>
                        <textarea type="text" rows="3" name="description" class="form-control" id="inputAddress"
                        value="" placeholder="Enter the Description of your Assessment" required></textarea>
                    </div>
                </div>

                <div class="col-12" style="position: relative;">
                    <label for="inputAddress" class="form-label">Country of your Assessment</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-earth-americas"></i>
                        </div>
                        <input type="text" name="country" class="form-control" id="country_form" required
                        placeholder="Enter the Country name you want to Assess">
                    </div>
                    <div class="autocomplete-suggestions" id="countrySuggestions"></div>
                </div>

                <div class="col-12">
                    <label for="inputAddress" class="form-label">Subject of your Assessment</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-book"></i>
                        </div>
                        <input type="text" name="subject" class="form-control" id="inputAddress" required
                        value=""
                        placeholder="Enter the Subject about You Assess">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Charge</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                        </div>
                        <input type="number" name="price" class="form-control" id="inputEmail4" required
                        value="" placeholder="Enter the Charge of your Assessment">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Duration</label>
                    <div class="input_div">
                        <div class="icon_div">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <input type="text" name="duration" class="form-control" id="inputPassword4" required
                        value="" placeholder="Enter the time/days you will you will take">
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="save_btn">Publish</button>
                </div>
            </form>
        </div>
    </div>
<!-- ________________________________________ UPDATE ASSESSMENT END -->




@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">

    function openForm() {
        document.getElementById("create_assessment").classList.add("show");
    }

    function closeForm() {
        document.getElementById("create_assessment").classList.remove("show");
    }

        $(document).on('click', '.show_confirm_disabled', function(event) {
            event.preventDefault(); // Prevent default action

            var link = $(this).closest('a').attr('href'); // Get the href of the closest <a>

            Swal.fire({
                title: "Are you sure you want to disable this service?",
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, disable it!",
                cancelButtonText: "Cancel",
                confirmButtonColor: "var(--consultant-primary-color) !important", // Using your RGB color
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link; // Redirect if confirmed
                }
            });
        });

        $(document).on('click', '.show_confirm_enable', function(event) {
            event.preventDefault(); // Prevent default action

            var link = $(this).closest('a').attr('href'); // Get the href of the closest <a>

            Swal.fire({
                title: "Are you sure you want to Active this service?",
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Publish!",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#008000 !important", // Using your RGB color
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link; // Redirect if confirmed
                }
            });
        });

        $(document).on('click', '.show_confirm_delete', function(event) {
            event.preventDefault(); // Prevent default action

            var link = $(this).closest('a').attr('href'); // Get the href of the closest <a>

            Swal.fire({
                title: "Are you sure you want to Delete this service?",
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete it!",
                cancelButtonText: "Cancel",
                confirmButtonColor: "var(--consultant-primary-color) !important", // Using your RGB color
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link; // Redirect if confirmed
                }
            });
        });





        // ____________ for country suggession
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

        // ___________________ for service create
        const input = document.getElementById("country_form");
        const suggestionBox = document.getElementById("countrySuggestions");

        input.addEventListener("input", function() {
        const query = this.value.toLowerCase();
        suggestionBox.innerHTML = "";

        if (!query) return;

        const filtered = countries.filter(country =>
            country.toLowerCase().startsWith(query)
        );

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

        // Optional: Hide suggestions on outside click
        document.addEventListener("click", function(e) {
        if (!suggestionBox.contains(e.target) && e.target !== input) {
            suggestionBox.innerHTML = "";
        }
        });

        // ________________ for update service
        const input_update = document.getElementById("country");
        const suggestionBox_update = document.getElementById("countrySuggestions_update");

        input_update.addEventListener("input", function() {
        const query = this.value.toLowerCase();
        suggestionBox_update.innerHTML = "";

        if (!query) return;

        const filtered = countries.filter(country =>
            country.toLowerCase().startsWith(query)
        );

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

        // Optional: Hide suggestions on outside click
        document.addEventListener("click", function(e) {
        if (!suggestionBox_update.contains(e.target) && e.target !== input_update) {
            suggestionBox_update.innerHTML = "";
        }
        });



    </script>

@endpush
