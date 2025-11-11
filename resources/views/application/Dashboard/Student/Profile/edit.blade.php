@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Edit Profile')
@section('master-content')
<!-- Heading section start -->
<div class="flex items-center mb-2 mt-2">
    <div>
        <h3 class="font-bold text-xl md:text-2xl mb-0">{{ __('message.profile_information') }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="flex text-sm text-gray-500 space-x-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="hover:text-primary-main">Dashboard</a>
                </li>
                <li>/</li>
                <li>Update Profile</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->

<div id="text_div" class="relative bg-white border-2 border-[#FB7B0B] rounded-lg shadow-sm p-4 mt-3 mb-1">
    <div onclick="closeChoiceMessage()" class="absolute top-2 right-2 h-5 w-5 flex cursor-pointer text-gray-600 hover:text-black">
        <i class="fa-solid fa-xmark m-auto"></i>
    </div>

    <h3 class="font-bold text-[20px] md:text-[25px] mb-2 text-[var(--consultant-primary-color)] font-[Poppins,sans-serif]">
        {{ __("message.profile_information") }}
    </h3>

    <p class="font-[Poppins,sans-serif] font-semibold text-black text-[15px]">
        {{ __("message.academic_info_page_message") }}
    </p>
</div>

<script>
    function closeChoiceMessage() {
        document.getElementById("text_div").style.display = "none";
    }
</script>

<div class="w-full mt-4 bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 mb-3">
    <!-- Profile Completion Section -->
    <div class="p-4">
        <div class="flex items-center gap-3 mb-3">
            <img src="{{ asset('Frontend/assets/icons/graduate-cap.png') }}" alt="" class="w-8 h-8">
            <h5 class="text-[15px] md:text-xl font-semibold text-gray-800">{{ __("message.update_last_education") }}</h5>
        </div>

        <h4 class="font-bold text-black mb-2">Complete Your Profile</h4>
        <div class="w-full bg-gray-100 rounded-full h-[20px] border overflow-hidden">
            <div class="bg-primary-main h-full text-white text-sm font-semibold text-center transition-all duration-500"
                    style="width: {{ auth()->user()->profile_completion }}%;">
                {{ auth()->user()->profile_completion }}%
            </div>
        </div>
    </div>

    <!-- Profile Picture -->
    <div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 p-6 flex items-center justify-between" id="profile-section">
        <form action="{{ route('profile.update.image') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-6 w-full">
            @csrf
            @method('patch')

            <!-- Profile Picture -->
            <div class="relative w-[70px] md:w-[120px] h-[70px] md:h-[120px] rounded-full overflow-hidden cursor-pointer group">
                <!-- Profile Image -->
                <img id="ImagePreview" 
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                    src="{{ asset(auth()->user()->image ? auth()->user()->image : 'no-profile-img.png') }}" 
                    alt="Profile Picture">

                <!-- Edit Icon (visible only on hover) -->
                <div class="absolute bottom-0 right-0 flex bg-black/60 text-white p-2 rounded-full h-full w-full opacity-0 group-hover:!opacity-100 text-[35px] transition-all duration-300">
                    <i class="fa-regular fa-pen-to-square m-auto"></i>
                </div>

                <!-- Hidden File Input -->
                <input type="file" name="image" id="image" class="absolute inset-0 opacity-0 cursor-pointer">
            </div>


            <!-- Editable Name Section -->
            <div class="flex-1 flex items-center justify-between">
            <div class="flex flex-col">
                <label for="name" class="text-sm text-gray-500">Full Name</label>
                <input type="text" name="name" id="name"
                    value="{{ auth()->user()->name }}"
                    class="text-lg font-semibold text-gray-900 focus:border-primary-main focus:outline-none transition-all duration-200 w-full bg-transparent"
                    onchange="updateName(this.value)">
            </div>
            <script>
                function updateName(newName) {
                    fetch("{{ route('profile.update.image') }}", {
                        method: "PATCH",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ name: newName })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Name updated successfully!");
                        } else {
                            alert("Failed to update name.");
                        }
                    })
                }
            </script>


                <!-- Edit Button -->
                <button type="button" id="editNameBtn"
                    class="bg-primary-main text-white px-2 md:!px-4 py-2 rounded hover:text-primary-main/80 font-medium transition-all">
                    <span class="!hidden">Edit</span> <i class="fa-regular fa-pen-to-square"></i>
                </button>
            </div>
        </form>

        @error('image')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- JavaScript -->
    <script>
        // Click image to open file picker
        document.getElementById('ImagePreview').addEventListener('click', () => {
            document.getElementById('image').click();
        });

        // Auto-submit form when new image is selected
        document.getElementById('image').addEventListener('change', function () {
            if (this.files.length > 0) {
                this.form.submit();
            }
        });

    </script>

    <!-- ______ section buttons start -->
    <div class="flex items-center gap-2 md:!gap-4 w-full px-4 sm:px-6 bg-white">
        <!-- Personal Information -->
        <button type="button" id="personalBtn"
            class="relative flex-1 flex flex-col items-center justify-center bg-primary-main text-white font-semibold py-3 rounded-md shadow transition-all duration-200 active-tab">
            <div class="flex items-center justify-center gap-2">
                <i class="fas fa-user text-lg !hidden md:block"></i>
                <span>Personal Information</span>
            </div>
            <span class="absolute -bottom-[10px] left-1/2 -translate-x-1/2 w-0 h-0 
                border-l-[10px] border-l-transparent border-r-[10px] border-r-transparent border-t-[10px] border-t-primary-main arrow hidden"></span>
        </button>

        <!-- Academic Information -->
        <button type="button" id="academicBtn"
            class="relative flex-1 flex flex-col items-center justify-center bg-white text-black font-semibold py-3 rounded-md border border-gray-300 transition-all duration-200">
            <div class="flex items-center justify-center gap-2">
                <i class="fas fa-graduation-cap text-lg !hidden md:block"></i>
                <span>Academic Information</span>
            </div>
            <span class="absolute -bottom-[10px] left-1/2 -translate-x-1/2 w-0 h-0 
                border-l-[10px] border-l-transparent border-r-[10px] border-r-transparent border-t-[10px] border-t-primary-main arrow"></span>
        </button>
    </div>
    <!-- ______ seciton buttons end-->

    <form id="personalForm" method="POST" action="{{ route('profile.update.information') }}" enctype="multipart/form-data" class="hidden">
        @csrf
        @method('PATCH')
        <div class="p-4">
            <div class="bg-[#f3f4f6] p-2 border border-black-700 rounded gap-0 flex flex-col md:flex-row">
                  <!-- Left Column -->
                <div class="w-full md:w-1/2">
                    <!-- Profile Information -->
                    <div class="rounded-lg transition-all duration-300">
                        <div class="p-3 space-y-2">
                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Full Name</label>
                                <input type="text" name="name" class="w-full outline-none rounded-md border bg-white border focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black" value="{{ old('name', auth()->user()->name) }}" readonly>
                                @error('name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Email Address</label>
                                <input type="text" name="email" class="w-full rounded-md outline-none border bg-white border cursor-not-allowed p-2 text-sm font-semibold text-black" value="{{ old('email', auth()->user()->email) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Phone Number</label>
                                <input type="text" name="phone" class="w-full rounded-md border outline-none bg-white border focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black" value="{{ old('phone', auth()->user()->phone) }}" readonly>
                                @error('phone')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Gender <span class="text-red-500">*</span>({{ auth()->user()->gender }})</label>
                                <select name="gender" class="w-full rounded-md border border-gray-300 outline-none focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', auth()->user()->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', auth()->user()->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', auth()->user()->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div class="mb-5">
                                <div>
                                <label class="font-semibold text-gray-700 block mb-1">Present Address <span class="text-red-500">*</span></label>
                                <input type="text" name="present_address" class="w-full rounded-md border outline-none border-gray-300 focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black" value="{{ old('present_address', auth()->user()->present_address) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Present City <span class="text-red-500">*</span></label>
                                <input type="text" name="present_city" class="w-full rounded-md border outline-none border-gray-300 focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black" value="{{ old('present_city', auth()->user()->present_city) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Present Country <span class="text-red-500">*</span></label>
                                <input type="text" name="present_country" class="w-full rounded-md border outline-none border-gray-300 focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black" value="{{ old('present_country', auth()->user()->present_country) }}" readonly>
                            </div>

                        </div>
                    </div>
                </div>

                 <!-- Right Column -->
                <div class="w-full md:w-1/2">
                    <!-- Personal Details -->
                    <div class="rounded-lg transition-all duration-300">
                        <div class="p-3 space-y-2">
                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Date of Birth <span class="text-red-500">*</span></label>
                                <input type="date" name="date_of_birth" class="w-full outline-none rounded-md border border-gray-300 focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black" value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Nationality <span class="text-red-500">*</span></label>
                                <input type="text" name="nationality" class="w-full outline-none rounded-md border border-gray-300 focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black" value="{{ old('nationality', auth()->user()->nationality) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Passport or NID</label>
                                <input type="text" name="passport_or_nid" class="w-full outline-none rounded-md border border-gray-300 focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black" value="{{ old('passport_or_nid', auth()->user()->passport_or_nid) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Passport Issue Date</label>
                                <input type="date" name="passport_issue_date" class="w-full outline-none rounded-md border border-gray-300 focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black" value="{{ old('passport_issue_date', auth()->user()->passport_issue_date) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="font-semibold text-gray-700 block mb-1">Passport Expiry Date</label>
                                <input type="date" name="passport_expiry_date" class="w-full outline-none rounded-md border border-gray-300 focus:border-primary-main focus:ring focus:ring-primary-main focus:ring-opacity-30 p-2 text-sm font-semibold text-black" value="{{ old('passport_expiry_date', auth()->user()->passport_expiry_date) }}" readonly>
                            </div>

                            <div class="mb-3 w-aull flex items-end">
                                <button type="submit" class="max-w-xs w-full ml-auto bg-primary-main hover:bg-primary-main/90 text-white font-semibold py-2 rounded-md transition-all">Save Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- __________________ form start -->
    <form id="academicForm" method="POST" action="{{ route('student.info.add') }}" enctype="multipart/form-data">
        @csrf
        <div class="p-4">
            <div class="bg-[#f3f4f6] px-6 py-4 border border-black-700 rounded gap-4 flex flex-col md:flex-row">
                <section class="form_section w-full">
                    <div class="form_div w-full">

                        <!-- ________________________ SELECT GRADUATE ARE NOT-->
                        <div class="w-full flex items-center border mb-2 md:mb-0">
                            <div class="flex justify-center m-auto w-full md:w-auto rounded-lg bg-white border border-black">
                                <label class="cursor-pointer w-full">
                                    <!-- Check if post_graduate_data exists. If not, this is 'under_graduate' -->
                                    <input type="radio" name="academic_status" value="under_graduate" {{ !isset($post_graduate_data) ? 'checked' : '' }} class="hidden peer">
                                    <div class="w-full md:w-40 p-2 text-center rounded transition-all duration-200
                                                peer-checked:bg-primary-main peer-checked:text-white">
                                        Under Graduate
                                    </div>
                                </label>

                                <label class="cursor-pointer w-full">
                                    <!-- Check if post_graduate_data exists. If yes, this is 'post_graduate' -->
                                    <input type="radio" name="academic_status" value="post_graduate" {{ isset($post_graduate_data) ? 'checked' : '' }} class="hidden peer">
                                    <div class="md:w-40 p-2 text-center rounded transition-all duration-200
                                                peer-checked:bg-primary-main peer-checked:text-white">
                                        Post Graduate
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- ________________________ GRADUATION INFO FORM START -->
                        <!-- Conditionally remove the 'hidden' class if post_graduate_data exists -->
                        <div id="postGraduateDiv" class="graduation {{ !isset($post_graduate_data) ? 'hidden' : '' }}">
                            <div class="mb-6">
                                <label class="block text-primary-main font-bold text-lg mb-2">Your Graduation Info:</label>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Graduation Title -->
                                    <div>
                                        <label class="block text-black mb-1">Graduation Title:</label>
                                        <input type="text" name="title" placeholder="Enter Your graduation title"
                                            value="{{ $post_graduate_data->title ?? '' }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    </div>

                                    <!-- Grade / CGPA -->
                                    <div>
                                        <label class="block text-black mb-1">Enter Grade/CGPA:</label>
                                        <input type="text" name="grade" placeholder="Enter Your Grade/CGPA"
                                            value="{{ $post_graduate_data->grade ?? '' }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Duration -->
                                    <div>
                                        <label class="block text-black mb-1">Duration:</label>
                                        <input type="text" name="duration" placeholder="Enter Duration"
                                            value="{{ $post_graduate_data->duration ?? '' }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    </div>

                                    <!-- Department / Subject -->
                                    <div>
                                        <label class="block text-black mb-1">Department/Subject:</label>
                                        <input type="text" name="department" placeholder="Enter Your Department/subject"
                                            value="{{ $post_graduate_data->department ?? '' }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Start Date -->
                                    <div>
                                        <label class="block text-black mb-1">Start Date:</label>
                                        <input type="date" name="start_time"
                                            value="{{ $post_graduate_data->start_time ?? '' }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    </div>

                                    <!-- End Date -->
                                    <div>
                                        <label class="block text-black mb-1">End Date:</label>
                                        <input type="date" name="end_time"
                                            value="{{ $post_graduate_data->end_time ?? '' }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-black mb-1" for="certificate">Your Certificate:</label>
                                <input type="file" name="certificate" accept="application/pdf"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                @if(isset($post_graduate_data->certificate))
                                <div class="_df_button bg-transparent border-0 p-0 m-0" source="{{ asset($post_graduate_data->certificate) }}">
                                    <p class="text-[14px] font-semibold text-green-500 mt-1">
                                        Current file: {{ Str::limit(basename($post_graduate_data->certificate), 10, '') }}.pdf
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- ________________________ GRADUATION INFO FORM END -->

                        <div class="row g-3">
                            <div class="col mb-3">
                                <label for="" class="text-black">Select Medium:</label>
                                <div class="input_box">
                                    <select class="form-control" name="academic_type" id="academicMedium">
                                        <option value="" disabled>Select an Option</option>
                                        <option value="bangla" {{ (isset($student_info_data) && $student_info_data->academic_type == 'bangla') ? 'selected' : '' }}>Bangla Medium</option>
                                        <option value="english" {{ (isset($student_info_data) && $student_info_data->academic_type == 'english') ? 'selected' : '' }}>English Medium</option>
                                        <option value="madrashah" {{ (isset($student_info_data) && $student_info_data->academic_type == 'madrashah') ? 'selected' : '' }}>Madrashah Medium</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ________________________ bangla section start -->
                        <!-- Conditionally remove the 'hidden' class if this medium is selected -->
                        <div id="bangla" class="bangla {{ !(isset($student_info_data) && $student_info_data->academic_type == 'bangla') ? 'hidden' : '' }} mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- HSC Result -->
                                <div>
                                    <label class="block text-black mb-1">HSC Result (GPA):</label>
                                    <input type="text" name="hsc_result" placeholder="Enter Your HSC Grade"
                                        value="{{ $student_info_data->hsc_result ?? '' }}"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                </div>
                                <!-- HSC Certificate -->
                                <div>
                                    <label class="block text-black mb-1">HSC Certificate:</label>
                                    <input type="file" name="hsc_certificate" accept="application/pdf"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    @if(isset($student_info_data->hsc_certificate))
                                        <p class="text-xs text-gray-500 mt-1">Current file: {{ basename($student_info_data->hsc_certificate) }}</p>
                                    @endif
                                </div>
                                <!-- SSC Result -->
                                <div>
                                    <label class="block text-black mb-1">SSC Result (GPA):</label>
                                    <input type="text" name="ssc_result" placeholder="Enter Your SSC Grade"
                                        value="{{ $student_info_data->ssc_result ?? '' }}"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                </div>
                                <!-- SSC Certificate -->
                                <div>
                                    <label class="block text-black mb-1">SSC Certificate:</label>
                                    <input type="file" name="ssc_certificate" accept="application/pdf"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    @if(isset($student_info_data->ssc_certificate))
                                        <p class="text-xs text-gray-500 mt-1">Current file: {{ basename($student_info_data->ssc_certificate) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- ________________________ Bangla section end -->

                        <!-- ________________________ English section start -->
                        <div id="english" class="english {{ !(isset($student_info_data) && $student_info_data->academic_type == 'english') ? 'hidden' : '' }} mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- O Level Result -->
                                <div>
                                    <label class="block text-black mb-1">O Level Result:</label>
                                    <input type="text" name="o_lavel_result" placeholder="Enter Your O Level Result"
                                        value="{{ $student_info_data->o_lavel_result ?? '' }}"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                </div>
                                <!-- O Level Certificate -->
                                <div>
                                    <label class="block text-black mb-1">O Level Certificate:</label>
                                    <input type="file" name="o_lavel_certificate" accept="application/pdf"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    @if(isset($student_info_data->o_lavel_certificate))
                                    <div class="_df_button bg-transparent border-0 p-0 m-0" source="{{ asset($student_info_data->o_lavel_certificate) }}">
                                       <p class="text-[14px] font-semibold text-green-500 mt-1">
                                           Current file: {{ Str::limit(basename($student_info_data->o_lavel_certificate), 10, '') }}.pdf
                                       </p>
                                    </div>
                                    @endif
                                </div>
                                <!-- A Level Result -->
                                <div>
                                    <label class="block text-black mb-1">A Level Result:</label>
                                    <input type="text" name="a_lavel_result" placeholder="Enter Your A Level Result"
                                        value="{{ $student_info_data->a_lavel_result ?? '' }}"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                </div>
                                <!-- A Level Certificate -->
                                <div>
                                    <label class="block text-black mb-1">A Level Certificate:</label>
                                    <input type="file" name="a_lavel_certificate" accept="application/pdf"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    @if(isset($student_info_data->a_lavel_certificate))
                                        <div class="_df_button bg-transparent border-0 p-0 m-0" source="{{ asset($student_info_data->a_lavel_certificate) }}">
                                            <p class="text-[14px] font-semibold text-green-500 mt-1">
                                                Current file: {{ Str::limit(basename($student_info_data->a_lavel_certificate), 10, '') }}.pdf
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- ________________________ English section end -->

                        <!-- ________________________ Madrasha section start -->
                        <div id="madrashah" class="madrashah {{ !(isset($student_info_data) && $student_info_data->academic_type == 'madrashah') ? 'hidden' : '' }} mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Dakhil Result -->
                                <div>
                                    <label class="block text-black mb-1">Dakhil Result:</label>
                                    <input type="text" name="dakhil_result" placeholder="Enter Your Dakhil Result"
                                        value="{{ $student_info_data->dakhil_result ?? '' }}"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                </div>
                                <!-- Dakhil Certificate -->
                                <div>
                                    <label class="block text-black mb-1">Dakhil Certificate:</label>
                                    <input type="file" name="dakhil_certificate" accept="application/pdf"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    @if(isset($student_info_data->dakhil_certificate))
                                        <p class="text-xs text-gray-500 mt-1">Current file: {{ basename($student_info_data->dakhil_certificate) }}</p>
                                    @endif
                                </div>
                                <!-- Alim Result -->
                                <div>
                                    <label class="block text-black mb-1">Alim Result:</label>
                                    <input type="text" name="alim_result" placeholder="Enter Your Alim Result"
                                        value="{{ $student_info_data->alim_result ?? '' }}"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                </div>
                                <!-- Alim Certificate -->
                                <div>
                                    <label class="block text-black mb-1">Alim Certificate:</label>
                                    <input type="file" name="alim_certificate" accept="application/pdf"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    @if(isset($student_info_data->alim_certificate))
                                        <p class="text-xs text-gray-500 mt-1">Current file: {{ basename($student_info_data->alim_certificate) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- ________________________ Madrasha section end -->


                        <!-- ________________________ IELTS start -->
                        <div class="row g-3">
                            <div class="col mb-3 flex items-center gap-2">
                                <label for="toggleCheckbox" class="text-gray-800 font-medium cursor-pointer">Is IELTS? <i class="fa-solid fa-angle-down ml-2"></i></label>
                                <!-- Check if ielts_score has a value to determine if checkbox should be checked -->
                                <input id="toggleCheckbox" type="checkbox" name="ielts" class="form-check-input" {{ (isset($student_info_data) && !empty($student_info_data->ielts_score)) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <!-- Conditionally remove the 'hidden' class if ielts_score exists -->
                        <div id="ielts" class="ielts {{ !(isset($student_info_data) && !empty($student_info_data->ielts_score)) ? 'hidden' : '' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- IELTS Score -->
                                <div>
                                    <label class="block text-black mb-1">Enter IELTS Score:</label>
                                    <input type="text" name="ielts_score" placeholder="Enter Your IELTS Score"
                                        value="{{ $student_info_data->ielts_score ?? '' }}"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                </div>

                                <!-- IELTS Certificate -->
                                <div>
                                    <label class="block text-black mb-1">Enter IELTS Certificate:</label>
                                    <input type="file" name="ielts_certificate"
                                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary-main focus:outline-none font-bold text-black">
                                    @if(isset($student_info_data->ielts_certificate))
                                        <div class="_df_button bg-transparent border-0 p-0 m-0" source="{{ asset($student_info_data->ielts_certificate) }}">
                                            <p class="text-[14px] font-semibold text-green-500 mt-1">
                                                Current file: {{ Str::limit(basename($student_info_data->ielts_certificate), 10, '') }}.pdf
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- ________________________ IELTS end -->
                        <div class="flex justify-end mt-4">
                            <input type="submit" value="Save"
                                class="w-full md:max-w-[200px] w-full bg-primary-main text-white font-semibold py-2 px-4 rounded-lg hover:bg-opacity-90 transition-all duration-200 cursor-pointer">
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // The existing JS is fine, but we can simplify the page load logic
        // since we are now handling the initial visibility with server-side classes.

        // _______________________________ for academic medium
        $(document).ready(function () {
            $('#academicMedium').change(function () {
                var selectedValue = $(this).val();
                $("#bangla, #english, #madrashah").hide();
                if (selectedValue === "bangla") {
                    $("#bangla").show();
                } else if (selectedValue === "english") {
                    $("#english").show();
                } else if (selectedValue === "madrashah") {
                    $("#madrashah").show();
                }
            });
        });
        
        // _______________________________ for post or pre graduate
        $(document).ready(function () {
            $('input[name="academic_status"]').change(function () {
                var selectedValue = $(this).val();
                $("#postGraduateDiv").hide(); // Assuming only one div to show/hide
                if (selectedValue === "post_graduate") {
                    $("#postGraduateDiv").show();
                }
            });
        });

        // _______________________________ FOR IELTS
        $(document).ready(function () {
            $('#toggleCheckbox').change(function () {
                if ($(this).is(':checked')) {
                    $("#ielts").show();
                } else {
                    $("#ielts").hide();
                }
            });
        });
    </script>
    <!-- __________________ form end -->
    
    <script>

        // TO SWITCH ACADEMIC AND PERSONAL INFO FORM
        const personalBtn = document.getElementById('personalBtn');
        const academicBtn = document.getElementById('academicBtn');

        const personalForm = document.getElementById('personalForm');
        const academicForm = document.getElementById('academicForm');

        function setActive(button) {
            // Reset buttons
            [personalBtn, academicBtn].forEach(btn => {
                btn.classList.remove('bg-primary-main', 'text-white', 'shadow', 'border-none');
                btn.classList.add('bg-white', 'text-black', 'border', 'border-gray-300');
                const arrow = btn.querySelector('.arrow');
                if (arrow) arrow.classList.add('hidden');
            });

            // Activate the clicked button
            button.classList.add('bg-primary-main', 'text-white', 'shadow');
            button.classList.remove('bg-white', 'text-black', 'border', 'border-gray-300');
            const activeArrow = button.querySelector('.arrow');
            if (activeArrow) activeArrow.classList.remove('hidden');

            // Show/hide forms
            if (button === personalBtn) {
                personalForm.classList.remove('hidden');
                academicForm.classList.add('hidden');
                localStorage.setItem('activeSection', 'personal'); // Save state
            } else {
                personalForm.classList.add('hidden');
                academicForm.classList.remove('hidden');
                localStorage.setItem('activeSection', 'academic'); // Save state
            }
        }

        // On page load, check localStorage
        const savedSection = localStorage.getItem('activeSection');
        if (savedSection === 'academic') {
            setActive(academicBtn);
        } else {
            setActive(personalBtn); // Default to personal if nothing saved
        }

        // Event listeners
        personalBtn.addEventListener('click', () => setActive(personalBtn));
        academicBtn.addEventListener('click', () => setActive(academicBtn));


        // TO MAKE FORM EDITABLE
        const editAllBtn = document.getElementById('editNameBtn');

        editAllBtn.addEventListener('click', () => {
            // Select all input and select elements inside your form/container
            const inputs = document.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                // Remove readonly or disabled
                if (input.hasAttribute('readonly')) input.removeAttribute('readonly');
                if (input.hasAttribute('disabled')) input.removeAttribute('disabled');

                // Optional: add focus style
                input.classList.add('bg-white');
            });
            
            // Optionally, change button text/icon
            editAllBtn.innerHTML = '<i class="fas fa-check"></i>';
        });

    </script>

            <!-- Update Password -->
            <!-- <div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="p-4 border-b">
                    <h4 class="font-bold text-[var(--primary-color)]">Change Password</h4>
                </div>
                <div class="p-4 space-y-4">
                    <form method="POST" action="{{ route('profile.update.password') }}">
                        @csrf
                        @method('patch')
                        <div>
                            <label class="font-semibold text-gray-700">Current Password</label>
                            <input type="password" name="current_password" class="w-full rounded-md border border-gray-300 focus:border-primary-main focus:ring-primary-main p-2 text-sm font-semibold text-black">
                            @error('current_password')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="font-semibold text-gray-700">New Password</label>
                            <input type="password" name="password" class="w-full rounded-md border border-gray-300 focus:border-primary-main focus:ring-primary-main p-2 text-sm font-semibold text-black">
                            @error('password')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="font-semibold text-gray-700">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="w-full rounded-md border border-gray-300 focus:border-primary-main focus:ring-primary-main p-2 text-sm font-semibold text-black">
                        </div>
                        <button type="submit" class="w-full bg-primary-main hover:bg-primary-main/90 text-white font-semibold py-2 rounded-md transition-all">Update Password</button>
                    </form>
                </div>
            </div> -->

@endsection

@push('script')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#ImagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function(){
        readURL(this);
    });
</script>
@endpush
