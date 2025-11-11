<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.css">

<!-- ______________________ for bootstrap search filter with selection tag start -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('Frontend') }}/assets/css/filter.css">
<!-- ______________________ for bootstrap search filter with selection tag end -->

    <div class="filter_section side_filter_section">
        <div class="centered_filter centered_filter_border">
            <div class="down_border">
                <div class="filter_head">
                    @include('Frontend.layouts.search')
                    <div class="head">
                        <p>{{ __('message.filter_heading') }}</p>
                    </div>
                    <div class="buttons">
                       <div class="selection">
                        <div class="selected" onclick="show_list()">
                            <p class="flex"><img src="{{ asset('Frontend/assets/img/icon/filter_inon.png') }}">{{ __('message.filter_course') }}</p>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                            <ul id="filter_ul" class="hidden">
                                <button class="active"><i class="fa-solid fa-book"></i> {{ __('message.filter_course') }}</button>
                                <button><i class="fa-solid fa-user-graduate"></i> {{ __('message.filter_scholarships') }}</button>
                                <button><i class="fa-solid fa-building-columns"></i> {{ __('message.university') }}</button>
                                <button><i class="fa-solid fa-sack-dollar"></i> {{ __('message.budget') }}</button>
                            </ul>
                       </div>
                    </div>
                    <div class="buttons" style="display:none;">
                        <button class="active"><i class="fa-solid fa-book"></i> {{ __('message.filter_course') }}</button>
                        <button><i class="fa-solid fa-user-graduate"></i> {{ __('message.filter_scholarships') }}</button>
                        <button><i class="fa-solid fa-building-columns"></i> {{ __('message.university') }}</button>
                        <button><i class="fa-solid fa-sack-dollar"></i> {{ __('message.budget') }}</button>
                    </div>
                </div>

                <script>
                    function show_list() {
                        const ul = document.getElementById('filter_ul');
                        ul.classList.toggle('hidden');
                    }

                    // Handle click outside and on button
                    document.addEventListener('click', function(event) {
                        const ul = document.getElementById('filter_ul');
                        const trigger = document.querySelector('.selected');

                        // Hide when clicking outside
                        if (!ul.contains(event.target) && !trigger.contains(event.target)) {
                            ul.classList.add('hidden');
                        }

                        // If a button is clicked inside ul
                        if (ul.contains(event.target) && event.target.tagName.toLowerCase() === 'button') {
                            // Get icon and text from the button
                            const icon = event.target.querySelector('i')?.outerHTML || '';
                            const text = event.target.innerText.trim();

                            // Set content inside .selected
                            trigger.innerHTML = `<p>${icon}${text}</p> <i class="fa-solid fa-chevron-down ms-2"></i>`;

                            // Hide the list
                            ul.classList.add('hidden');
                        }
                    });
                </script>

                <div class="buttons_desc">
        
                    <!-- _____________ COURSE SEARCH-->
                    <div class="courses">
                        <form method="GET" action="{{ route('filter.course') }}">
                            <div class="in_details">

                                <!-- Courses Selector -->
                                <div class="input_box p-0">
                                    <div class="input_label">
                                        <p>{{ __('message.filter_course_level') }}</p>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-14">
                                                <select name="course[]" class="courseSelect for border-0" multiple="multiple" style="width: 100%">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Study Level Selector -->
                                <div class="input_box">
                                    <div class="input_label">
                                        <p>{{ __('message.filter_study_level') }}</p>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-14">
                                                <select name="studyLevel[]" class="study_level_Select for" multiple="multiple" style="width: 100%">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Country Selector -->
                                <div class="input_box">
                                    <div class="input_label">
                                        <p>{{ __('message.filter_country_level') }}</p>
                                    </div>
                                <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-14">
                                                <select name="country[]" class="country_Select for" multiple="multiple" style="width: 100%">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="button_section">
                                <button type="submit"> {{ __('message.filter_search') }} <i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>

                        </form>
                    </div>
                    <!-- _____________ SCHOLARSHIPS SEARCH-->
                    <div class="scholarships">
                        <form method="GET" action="{{ route('filter.scholarship') }}">
                            <div class="in_details">

                                <!-- Study Level Selector -->
                                <div class="input_box">
                                    <div class="input_label">
                                        <p>{{ __('message.filter_study_level') }}</p>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-14">
                                                <select name="studyLevel[]" class="scholershipSudyLevelSelect for" multiple="multiple" style="width: 100%">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Country Selector -->
                                <div class="input_box">
                                    <div class="input_label">
                                        <p>{{ __('message.filter_country_level') }}</p>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-14">
                                                <select name="country[]" class="scholershipCountrySelect for" multiple="multiple" style="width: 100%">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="button_section">
                                <button type="submit"> {{ __('message.filter_search') }} <i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>

                        </form>
                    </div>
                    <!-- _____________ UNIVERSITIES SEARCH-->
                    <div class="universities">
                        <form method="GET" action="{{ route('filter.universities') }}">
                        <div class="in_details">

                            <!-- Study Level Selector -->
                            <div class="input_box">
                                <div class="input_label">
                                    <p>{{ __('message.filter_universities') }}</p>
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-14">
                                            <select name="university[]" class="universitySelect for" multiple="multiple" style="width: 100%">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Country Selector -->
                            <div class="input_box">
                                <div class="input_label">
                                    <p>{{ __('message.filter_country_level') }}</p>
                                </div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-14">
                                            <select name="country[]" class="universityCountrySelect for" multiple="multiple" style="width: 100%">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                         <div class="button_section">
                                <button type="submit"> {{ __('message.filter_search') }} <i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- _____________ BUDGET SEARCH-->
                    <div class="budget">
                        <form method="GET" action="{{ route('filter.budget') }}">
                            
                            <div class="in_details">
                                <!-- Country Selector -->
                                <div class="input_box">
                                    <div class="input_label">
                                        <p>{{ __('message.filter_country_level') }}</p>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-14">
                                                <select name="country[]" class="budgetCountrySelect for" multiple="multiple" style="width: 100%">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Country Selector -->
                                <div class="input_box">
                                    <div class="input_label">
                                        <p>{{ __('message.filter_budget') }}</p>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-14">
                                                <input name="budget" type="number" placeholder="Enter Your Budget (BDT)" 
                                                style="width: 100%; padding:3px;outline:none; border-radius:3px; border:0.5px solid gray;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="button_section">
                                <button type="submit"> {{ __('message.filter_search') }} <i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- _____________ -->
                </div>
            </div>
        </div>
    </div>


    <!-- ______________________ for bootstrap search filter with selection tag start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script>
        // ====================== Course
        // __________ course
        var course_data = ["Engineering",
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
        var placeholder = " Search";
            $(".courseSelect").select2({
                data: course_data,
                placeholder: placeholder,
                allowClear: false,
                minimumResultsForSearch: 5
        });
        // __________ study label
        var study_level_data = ["Doctorate", "PostGraduate", "Undergraduate", "University Preparation", "EldVocational (VET)",
            "School", "Foundation", "Pre-Degree & Vocational"
        ];
        var placeholder = " Search";
            $(".study_level_Select").select2({
                data: study_level_data,
                placeholder: placeholder,
                allowClear: false,
                minimumResultsForSearch: 5
        });
        // __________ country
        var country_data = [  "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda",
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
        ];
        var placeholder = " Search";
            $(".country_Select").select2({
                data: country_data,
                placeholder: placeholder,
                allowClear: false,
                minimumResultsForSearch: 5
        });

        // ====================== schollership
        // __________ study label
        var placeholder = " Search";
            $(".scholershipSudyLevelSelect").select2({
                data: study_level_data,
                placeholder: placeholder,
                allowClear: false,
                minimumResultsForSearch: 5
        });
        // __________ country
         var placeholder = " Search";
            $(".scholershipCountrySelect").select2({
                data: country_data,
                placeholder: placeholder,
                allowClear: false,
                minimumResultsForSearch: 5
        });
        // ====================== University
        // __________ university
        var university_data = [
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
        var placeholder = " Search";
            $(".universitySelect").select2({
                data: university_data,
                placeholder: placeholder,
                allowClear: false,
                minimumResultsForSearch: 5
        });
        // __________ country
         var placeholder = " Search";
            $(".universityCountrySelect").select2({
                data: country_data,
                placeholder: placeholder,
                allowClear: false,
                minimumResultsForSearch: 5
        });

        // ====================== Budget
        // __________ country
        var placeholder = " Search";
        $(".budgetCountrySelect").select2({
            data: country_data,
            placeholder: placeholder,
            allowClear: false,
            minimumResultsForSearch: 5
        });
        // __________ budget

    </script>
    <!-- ______________________ for bootstrap search filter with selection tag end -->
    <script src="{{ asset('Frontend') }}/./assets/js/filter.js"></script>
      <script>
        document.addEventListener("DOMContentLoaded", function () {
            const buttons = document.querySelectorAll(".buttons button");
            const sections = document.querySelectorAll(".buttons_desc > div");

            // Show the first section and mark the first button as active
            buttons[0].classList.add("active");
            sections[0].style.display = "block";
            sections[0].style.opacity = "1";
            sections[0].style.transform = "translateY(0)";

            buttons.forEach((button, index) => {
                button.addEventListener("click", () => {
                    // Remove active class from all buttons
                    buttons.forEach(btn => btn.classList.remove("active"));

                    // Hide all sections
                    sections.forEach(section => {
                        section.style.display = "none";
                        section.style.opacity = "0";
                        section.style.transform = "translateY(20px)";
                    });

                    // Add active class to the clicked button
                    button.classList.add("active");

                    // Show the corresponding section with smooth effect
                    sections[index].style.display = "block";
                    setTimeout(() => {
                        sections[index].style.opacity = "1";
                        sections[index].style.transform = "translateY(0)";
                    }, 50); // Delay for transition effect
                });
            });
        });


        // Close all dropdowns if clicked outside
        window.onclick = function (event) {
            if (!event.target.closest(".dropdown")) {
                    document.querySelectorAll(".dropdown-content").forEach(drop => {
                    drop.style.display = "none";
                });
            }
        };

    </script>


@stack('script')
