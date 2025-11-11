@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Update Service')
@section('breadcrumb', 'Assessment/Service/Update')
@section('previous-menu', 'Assessment')
@section('active-menu', 'Assessment Declaration')

@section('master-content')
    <link rel="stylesheet" href="{{ url('Frontend/assets/css/services_card.css') }}">
    <link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">
    <!-- Add DataTables CSS -->

<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
        <i class="fa-solid fa-clipboard-list fa-2x"></i>
    </div>
    <div>
        <h3 class="fw-bold fs-4 mb-0">Update Your Service</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->

<!-- Update Assessment Form -->
<div class="flex items-center justify-center">
    <div class="w-full bg-white rounded-xl p-6" id="formContainer">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-center w-full text-primary-main text-[25px] font-bold">
                Update Your Service
            </h4>
        </div>

        <form 
            class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-0 md:p-6 rounded-xl"
            method="POST"
            action="{{ route('consultant.service.update', $services->id) }}"
            enctype="multipart/form-data"
            id="serviceUpdateForm">
            @csrf
            @method('PUT')

            <!-- Select Country -->
            <div class="col-span-1 relative">
                <label class="block mb-1 text-gray-800 font-semibold">Select Country</label>
                <div class="flex items-center w-full border border-gray-300 rounded-md px-3 bg-white">
                    <i class="fa-solid fa-globe text-primary-main mr-2"></i>
                    <input 
                        id="countryInput" 
                        name="country"
                        type="text" 
                        placeholder="Type or click to select a country..." 
                        class="w-full py-[9px] outline-none bg-transparent text-gray-700 placeholder-gray-400 text-sm" 
                        autocomplete="off" 
                        value="{{ $services->country ?? old('country') }}" 
                        required
                    />
                </div>
                @error('country')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <ul 
                    id="countrySuggestions" 
                    class="absolute z-10 bg-white border border-gray-200 rounded-md mt-1 w-full hidden max-h-52 overflow-y-auto"
                ></ul>
            </div>

            <!-- Select Services -->
            <div class="col-span-1 relative">
                <label class="block mb-1 text-gray-800 font-semibold">Select Services</label>
                <div id="service-multiselect" class="relative">
                    <div class="flex flex-wrap gap-2 items-center min-h-[40px] border border-gray-300 rounded-md px-3 bg-white">
                         <i class="fa-solid fa-bars-staggered text-primary-main"></i>
                        <div id="service-tags" class="flex flex-wrap gap-1 items-center"></div>
                        <input 
                            id="service-input" 
                            type="text" 
                            autocomplete="off" 
                            placeholder="Search and select..." 
                            class="flex-1 min-w-[150px] p-1 outline-none text-sm bg-transparent" 
                        />
                    </div>
                    @error('services')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <div
                        id="service-dropdown"
                        class="absolute z-30 left-0 right-0 mt-1 bg-white border border-gray-200 rounded-lg max-h-56 overflow-auto hidden"
                    >
                        <ul id="service-options" class="py-1"></ul>
                        <div id="service-no-results" class="px-4 py-3 text-sm text-slate-500 hidden">
                            No results
                        </div>
                    </div>
                </div>
                <!-- Hidden inputs for services will be added here by JavaScript -->
            </div>

            <!-- Title -->
            <div class="col-span-1 md:col-span-2">
                <label class="block mb-1 text-gray-800 font-semibold">Title of Your Service</label>
                <div class="flex items-center border border-gray-300 rounded-md px-3">
                    <i class="fa-solid fa-quote-right text-primary-main mr-2"></i>
                    <input 
                        type="text" 
                        name="title" 
                        id="titleInput"
                        class="w-full p-2 outline-none text-gray-700 bg-transparent text-sm" 
                        placeholder="Enter the title of service" 
                        value="{{ $services->title ?? old('title') }}" 
                        maxlength="150"
                        required
                    />
                </div>
                <p class="text-gray-500 text-sm mt-1">
                    <span id="titleCount">{{ strlen($services->title ?? old('title') ?? '') }}</span>/150 characters
                </p>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <script>
                    const titleInput = document.getElementById('titleInput');
                    const titleCount = document.getElementById('titleCount');

                    titleInput.addEventListener('input', () => {
                        titleCount.textContent = titleInput.value.length;
                    });
                </script>
            </div>

            <!-- Subject Multiselect -->
            <div class="col-span-1 relative">
                <label class="block mb-1 text-gray-800 font-semibold">Select Subjects</label>
                <div id="subject-multiselect" class="relative">
                    <div class="flex flex-wrap gap-2 items-center min-h-[40px] border border-gray-300 rounded-md px-3 bg-white">
                        <i class="fa-solid fa-book text-primary-main"></i>
                        <div id="subject-tags" class="flex flex-wrap gap-1 items-center"></div>
                        <input 
                            id="subject-input" 
                            type="text" 
                            autocomplete="off" 
                            placeholder="Search and select subjects..." 
                            class="flex-1 min-w-[150px] p-1 outline-none text-sm bg-transparent" 
                        />
                    </div>
                    @error('subjects')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <div id="subject-dropdown" class="absolute z-30 left-0 right-0 mt-1 bg-white border rounded-lg max-h-56 overflow-auto hidden">
                        <ul id="subject-options" class="py-1"></ul>
                        <div id="subject-no-results" class="px-4 py-3 text-sm text-slate-500 hidden">No results</div>
                    </div>
                </div>
                <!-- Hidden inputs for subjects will be added here by JavaScript -->
            </div>

            <!-- Study Level Multiselect -->
            <div class="col-span-1 relative">
                <label class="block mb-1 text-gray-800 font-semibold">Study Level</label>
                <div id="study-level-multiselect" class="relative">
                    <div class="flex flex-wrap gap-2 items-center min-h-[40px] border border-gray-300 rounded-md px-3 bg-white">
                        <i class="fa-solid fa-graduation-cap text-primary-main"></i>
                        <div id="study-level-tags" class="flex flex-wrap gap-1 items-center"></div>
                        <input 
                            id="study-level-input" 
                            type="text" 
                            autocomplete="off" 
                            placeholder="Search and select study levels..." 
                            class="flex-1 min-w-[150px] p-1 outline-none text-sm bg-transparent"
                        />
                    </div>
                    @error('study_levels')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <div id="study-level-dropdown" class="absolute z-30 left-0 right-0 mt-1 bg-white border rounded-lg max-h-56 overflow-auto hidden">
                        <ul id="study-level-options" class="py-1"></ul>
                        <div id="study-level-no-results" class="px-4 py-3 text-sm text-slate-500 hidden">No results</div>
                    </div>
                </div>
                <!-- Hidden inputs for study levels will be added here by JavaScript -->
            </div>

            <!-- Description -->
            <div class="col-span-1 md:col-span-2">
                <label class="block mb-1 text-gray-800 font-semibold">Description of Your Service</label>
                <div class="flex items-start border border-gray-300 rounded-md px-3">
                    <i class="fa-solid fa-pen-to-square text-primary-main mt-3 mr-2"></i>
                    <textarea 
                        name="description" 
                        id="descriptionInput"
                        rows="5" 
                        class="w-full p-2 outline-none bg-transparent text-gray-700 text-sm resize-y"
                        placeholder="Enter the description of your service"
                        maxlength="300"
                        required
                    >{{ $services->description ?? old('description') }}</textarea>
                </div>
                <p class="text-gray-500 text-sm mt-1">
                    <span id="descriptionCount">{{ strlen($services->description ?? old('description') ?? '') }}</span>/300 characters
                </p>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <script>
                    const descriptionInput = document.getElementById('descriptionInput');
                    const descriptionCount = document.getElementById('descriptionCount');

                    descriptionInput.addEventListener('input', () => {
                        descriptionCount.textContent = descriptionInput.value.length;
                    });
                </script>
            </div>

            <!-- Charge -->
            <div class="col-span-1">
                <label class="block mb-1 text-gray-800 font-semibold">Charge</label>
                <div class="flex items-center border border-gray-300 rounded-md px-3">
                    <i class="fa-solid fa-bangladeshi-taka-sign text-primary-main mr-2"></i>
                    <input 
                        type="number" 
                        name="price" 
                        class="w-full p-2 outline-none bg-transparent text-gray-700 text-sm"
                        placeholder="Enter the charge of your assessment"
                        value="{{ $services->price ?? old('price') }}" 
                    />
                </div>
            </div>

            <!-- Duration -->
            <div class="col-span-1">
                <label class="block mb-1 text-gray-800 font-semibold">Duration</label>
                <div class="flex items-center border border-gray-300 rounded-md px-3">
                    <i class="fa-solid fa-clock text-primary-main mr-2"></i>
                    <input 
                        type="text" 
                        name="duration" 
                        class="w-full p-2 outline-none bg-transparent text-gray-700 text-sm"
                        placeholder="Enter the time/days you will take" 
                        value="{{ $services->duration ?? old('duration') }}"
                        required
                    />
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-span-1 md:col-span-2">
                <button 
                    type="submit"
                    class="w-full bg-primary-main hover:bg-primary-light text-white hover:text-black font-bold py-2.5 rounded-md transition-all duration-300 text-sm md:text-base"
                >
                    Update
                </button>
            </div>

        </form>

    </div>
</div>

@endsection

@push('script')
<script>
    // =============================
    //  Generic Multiselect System
    // =============================
    function initMultiSelect(config) {
        const { containerId, inputId, dropdownId, listId, noResultsId, name, selectedValues } = config;

        const container = document.getElementById(containerId);
        const input = document.getElementById(inputId);
        const dropdown = document.getElementById(dropdownId);
        const list = document.getElementById(listId);
        const noResults = document.getElementById(noResultsId);
        const form = container.closest("form");

        let selectedItems = selectedValues ? [...selectedValues] : [];
        let allOptions = config.options || [];

        // Create a container for hidden inputs
        const hiddenInputsContainer = document.createElement('div');
        hiddenInputsContainer.className = 'hidden-inputs-container';
        hiddenInputsContainer.style.display = 'none';
        form.appendChild(hiddenInputsContainer);

        // Render selected tags
        function renderTags() {
            const tagContainer = container.querySelector(".flex.flex-wrap.gap-1");
            tagContainer.innerHTML = "";

            // Clear previous hidden inputs
            hiddenInputsContainer.innerHTML = '';

            selectedItems.forEach((item, index) => {
                // Create tag
                const tag = document.createElement("span");
                tag.className = "flex items-center gap-1 bg-indigo-50 border border-indigo-200 text-indigo-800 text-sm px-2 py-1 rounded-full";

                const label = document.createElement("span");
                label.textContent = item;

                const removeBtn = document.createElement("button");
                removeBtn.textContent = "×";
                removeBtn.className = "ml-1 text-xs hover:bg-indigo-100 rounded-full px-1";
                removeBtn.addEventListener("click", () => removeItem(index));

                tag.appendChild(label);
                tag.appendChild(removeBtn);
                tagContainer.appendChild(tag);

                // Create hidden input for submission
                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = `${name}[]`;
                hiddenInput.value = item;
                hiddenInputsContainer.appendChild(hiddenInput);
            });
        }

        // Add item
        function addItem(value) {
            if (value && !selectedItems.includes(value)) {
                selectedItems.push(value);
                renderTags();
            }
            input.value = "";
            hideDropdown();
        }

        // Remove item
        function removeItem(index) {
            selectedItems.splice(index, 1);
            renderTags();
        }

        // Filter dropdown
        function filterOptions(query) {
            list.innerHTML = "";
            const filtered = allOptions.filter(opt => opt.toLowerCase().includes(query.toLowerCase()));

            if (filtered.length === 0) {
                noResults.classList.remove("hidden");
            } else {
                noResults.classList.add("hidden");
                filtered.forEach(option => {
                    const li = document.createElement("li");
                    li.textContent = option;
                    li.className = "px-4 py-2 text-black hover:bg-indigo-50 cursor-pointer";
                    li.addEventListener("click", () => addItem(option));
                    list.appendChild(li);
                });
            }
        }

        function showDropdown() {
            dropdown.classList.remove("hidden");
            filterOptions(input.value);
        }

        function hideDropdown() {
            dropdown.classList.add("hidden");
        }

        // Events
        input.addEventListener("focus", showDropdown);
        input.addEventListener("input", e => filterOptions(e.target.value));
        document.addEventListener("click", e => {
            if (!container.contains(e.target)) hideDropdown();
        });

        // Initialize
        renderTags();
    }


    // =============================
    //  Initialize Each Multiselect
    // =============================

    // Get all services from the database
    const allServices = @json(App\Models\Services::all());

    // Convert Laravel collection to a simple array of names
    const serviceOptions = allServices.map(s => s.name);
    
    // Get selected services from the current service data
    // Properly decode JSON if it's a string
    let selectedServices = {!! json_encode(isset($services->services) ? (is_array($services->services) ? $services->services : json_decode($services->services, true)) : []) !!};

    initMultiSelect({
        containerId: "service-multiselect",
        inputId: "service-input",
        dropdownId: "service-dropdown",
        listId: "service-options",
        noResultsId: "service-no-results",
        name: "services",
        options: serviceOptions, // dynamic data from DB
        selectedValues: selectedServices
    });

    // Get selected subjects from the service data
    // Properly decode JSON if it's a string
    let selectedSubjects = {!! json_encode(isset($services->subjects) ? (is_array($services->subjects) ? $services->subjects : json_decode($services->subjects, true)) : []) !!};

    initMultiSelect({
        containerId: "subject-multiselect",
        inputId: "subject-input",
        dropdownId: "subject-dropdown",
        listId: "subject-options",
        noResultsId: "subject-no-results",
        name: "subjects",
        options: [
            // Sciences
            "Mathematics",
            "Physics",
            "Chemistry",
            "Biology",
            "Computer Science",
            "Environmental Science",
            "Geology",
            "Astronomy",
            "Statistics",
            "Data Science",
            "Artificial Intelligence",
            "Biotechnology",
            "Genetics",
            "Ecology",

            // Social Sciences
            "Economics",
            "Psychology",
            "Sociology",
            "Political Science",
            "Anthropology",
            "History",
            "Geography",
            "International Relations",
            "Law",
            "Criminology",
            "Public Administration",

            // Business & Management
            "Marketing",
            "Finance",
            "Accounting",
            "Human Resource Management",
            "Operations Management",
            "Entrepreneurship",
            "Business Analytics",
            "Supply Chain Management",
            "Management Information Systems",
            "Econometrics",

            // Arts & Humanities
            "Literature",
            "Philosophy",
            "Linguistics",
            "Religious Studies",
            "Cultural Studies",
            "Fine Arts",
            "Music",
            "Theatre",
            "Creative Writing",
            "Design",

            // Engineering & Technology
            "Mechanical Engineering",
            "Civil Engineering",
            "Electrical Engineering",
            "Electronics Engineering",
            "Computer Engineering",
            "Software Engineering",
            "Chemical Engineering",
            "Aerospace Engineering",
            "Industrial Engineering",
            "Robotics",
            "Artificial Intelligence Engineering",

            // Health & Medicine
            "Medicine",
            "Nursing",
            "Pharmacy",
            "Dentistry",
            "Physiotherapy",
            "Public Health",
            "Veterinary Science",
            "Nutrition",
            "Biomedical Engineering",

            // Education
            "Early Childhood Education",
            "Primary Education",
            "Secondary Education",
            "Special Education",
            "Educational Leadership",
            "Curriculum Development",
            "Educational Technology",

            // Languages
            "English",
            "Spanish",
            "French",
            "German",
            "Mandarin Chinese",
            "Japanese",
            "Arabic",
            "Russian",
            "Hindi",
            "Portuguese",
            "Italian",

            // Others / Interdisciplinary
            "Law Enforcement",
            "Journalism",
            "Media Studies",
            "Tourism",
            "Hospitality Management",
            "Agriculture",
            "Forestry",
            "Architecture",
            "Urban Planning",
            "Sports Science",
            "Marine Biology",
            "Nanotechnology"
        ],
        selectedValues: selectedSubjects
    });

    // Get selected study levels from the service data
    // Properly decode JSON if it's a string
    let selectedStudyLevels = {!! json_encode(isset($services->study_levels) ? (is_array($services->study_levels) ? $services->study_levels : json_decode($services->study_levels, true)) : []) !!};

    initMultiSelect({
        containerId: "study-level-multiselect",
        inputId: "study-level-input",
        dropdownId: "study-level-dropdown",
        listId: "study-level-options",
        noResultsId: "study-level-no-results",
        name: "study_levels",
        options: [
            // Early / Basic Education
            "Pre-School",
            "Primary School",
            "Junior High",
            "High School",
            "Vocational",

            // Undergraduate / Tertiary
            "Associate Degree",
            "Diploma",
            "Bachelor's Degree",
            "Undergraduate Certificate",

            // Postgraduate / Advanced
            "Postgraduate Diploma",
            "Graduate Certificate",
            "Master's Degree",
            "Professional Master's",
            "Doctorate/PhD",
            "Postdoctoral Research",

            // Professional / Continuing Education
            "Professional Certification",
            "Short Course",
            "Executive Education"
        ],
        selectedValues: selectedStudyLevels
    });


    // =============================
    //  Country Input Search
    // =============================

    const countryInput = document.getElementById("countryInput");
    const countrySuggestions = document.getElementById("countrySuggestions");

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

    
    // Render the list in the dropdown
    function renderCountryList(list) {
        countrySuggestions.innerHTML = "";
        if (!list.length) {
            countrySuggestions.classList.add("hidden");
            return;
        }

        list.forEach(country => {
            const li = document.createElement("li");
            li.textContent = country;
            li.className = "px-4 py-2 text-black hover:bg-indigo-50 cursor-pointer";
            li.addEventListener("click", () => {
                countryInput.value = country;
                countrySuggestions.classList.add("hidden");
            });
            countrySuggestions.appendChild(li);
        });

        countrySuggestions.classList.remove("hidden");
    }

    // Show full list on focus
    countryInput.addEventListener("focus", () => {
        renderCountryList(countries);
    });

    // Filter list while typing
    countryInput.addEventListener("input", () => {
        const query = countryInput.value.toLowerCase();
        const filtered = countries.filter(c => c.toLowerCase().includes(query));
        renderCountryList(filtered);
    });

    // Hide when clicking outside
    document.addEventListener("click", e => {
        if (!countryInput.parentNode.contains(e.target)) {
            countrySuggestions.classList.add("hidden");
        }
    });

    // Debug form submission
    document.getElementById('serviceUpdateForm').addEventListener('submit', function(e) {
        // Log form data for debugging
        const formData = new FormData(this);
        console.log('Form data being submitted:');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
    });
</script>
@endpush