@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Request')
@section('breadcrumb', 'Assessment Request')
@section('previous-menu', 'Request')
@section('active-menu', 'Send | Draft Request')
<link rel="stylesheet" href="{{ url('Frontend/assets/css/choice_selection.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/page_message.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/alert_popup.css') }}">


@section('master-content')
<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
        <i class="fa-solid fa-pen fa-2x"></i>
    </div>
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

<!-- no balance msg start -->
@if (Session::has('balance_message'))
    <div class="w-full py-2">
      <div class="border border-red-500 rounded-md flex items-center bg-[var(--primary-color-transparent)] px-6 py-2 w-full">
          <p class="text-red-500 font-bold text-[18px] flex-1 text-left m-0">
              {{ Session::get('balance_message') }}
          </p>
          <a href="{{ route('student.cashin') }}" class="max-w-[150px] w-full flex justify-end">
              <button
                  class="bg-[var(--primary-color)] text-white font-bold rounded-md px-6 py-2 hover:bg-[var(--primary-color-hover)] transition-all">
                  Add Balance
                  <i class="fa-solid fa-plus ml-1"></i>
              </button>
          </a>
      </div>
    </div>
@endif
<!-- no balance msg end -->

<!-- already requested start -->
@if (Session::has('already_message'))
    <div id="page_message_section" class="page_message_box_error w-full bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded-md flex justify-between items-center">
        <div class="msg_box">
            <p>{{ Session::get('already_message') }}</p>
        </div>
        <div class="close cursor-pointer" onclick="closeFunction()">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
@endif
<script>
    function closeFunction() {
        document.getElementById('page_message_section').style.display = "none";
    }
</script>
<!-- already requested end -->

<!-- Request send success popup start -->
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
<!-- Request send success popup start -->


<!-- selected consultant start -->
<div class="mt-3">
  <h3 class="text-[18px] font-bold"><i class="fa-solid fa-user"></i> Selected Consultants</h3>
  <!-- max-w-[500px] -->
  <div class="w-full bg-white relative rounded-lg shadow-md p-3 mt-2">

      <!-- Country flag (absolute top-right) -->
      <img class="hidden md:block absolute top-3 right-3 w-[55px] md:w-[65px] h-[30px] md:h-[40px] border border-gray-300"
          src="{{ $service->countryInfo && $service->countryInfo->image 
                  ? asset('storage/' . $service->countryInfo->image) 
                  : asset('img-preview.png') }}" 
          alt="Country Flag" title="{{ $service->countryInfo->name }}">

      <div class="flex">
          <!-- User Profile Image -->
          <div class="flex-shrink-0">
              <img class="h-16 w-16 rounded-full object-cover" 
                  src="{{ $service->user->image ? asset($service->user->image) : asset('no-profile-img.png') }}" 
                  alt="User Profile">
          </div>
          
          <!-- Content Area -->
          <div class="flex-1">
              <!-- Title and Country -->
              <div class="mb-2 ml-2">
                  <h2 class="text-[14px] md:!text-xl font-bold text-gray-800 mb-1 max-w-[900px]">{{ $service->title ? Str::limit($service->title, 150) : 'Not Provided' }}</h2>
                  <div class="flex items-center text-gray-600">
                      <span class="font-bold text-gray-600">{{ $service->user->name }}</span>
                  </div>
                  <div class="flex items-center text-gray-600 mt-2">

                      <i class="fa-solid fa-earth-americas mr-1"></i>
                      <span class="font-medium text-gray-600 mr-3">{{ $service->country }}</span>

                      <i class="fa-solid fa-bangladeshi-taka-sign mr-1"></i>
                      <span class="font-medium text-gray-600 mr-3">{{ $service->price }}</span>

                      <i class="fa-regular fa-clock mr-1"></i>
                      <span class="font-medium text-gray-600 mr-3">{{ $service->duration }}</span>

                  </div>
              </div>
          </div>
      </div>

      <div class="flex-1">     
          <!-- Services, Subjects, and Study Levels -->
          <div class="w-full rounded-lg">
              <!-- Services -->
              <div>
                  <h3 class="text-sm font-semibold text-gray-500 tracking-wider mb-2">Services</h3>
                  <div class="flex flex-wrap gap-1">
                      @php
                          $services = json_decode($service->services);
                          if (is_array($services)) {
                              foreach ($services as $service_item) {
                                  echo '<span class="px-2 py-1 bg-primary-gray text-black text-[12px] md:!text-[14px] rounded-full">' . $service_item . '</span>';
                              }
                          }
                      @endphp

                      @php
                          $subjects = json_decode($service->subjects);
                          if (is_array($subjects)) {
                              foreach ($subjects as $subject) {
                                  echo '<span class="px-2 py-1 bg-primary-gray text-black text-[12px] md:!text-[14px] rounded-full">' . $subject . '</span>';
                              }
                          }
                      @endphp
              
              <!-- Study Levels -->

                      @php
                          $study_levels = json_decode($service->study_levels);
                          if (is_array($study_levels)) {
                              foreach ($study_levels as $level) {
                                  echo '<span class="px-2 py-1 bg-primary-gray text-black text-[12px] md:!text-[14px] rounded-full">' . $level . '</span>';
                              }
                          }
                      @endphp
                  </div>
              </div>
          </div>

      </div>

  </div>
</div>
<!-- selected consultant end -->


<!-- _____________ student choices start -->
<section class="selected_assessment_section_choice">
  <h3 class="text-[18px] font-bold mb-2"><i class="fa-solid fa-layer-group"></i> Select Your Choice</h3>
  <div class="w-full bg-primary-gray hidden md:flex">
    <div class="w-[50px] text-black text-[16px] font-bold p-2">Index</div>
    <div class="w-full text-black text-[16px] font-bold p-2">Service Name</div>
    <div class="w-full text-black text-[16px] font-bold p-2">Preferred Country</div>
    <div class="w-full text-black text-[16px] font-bold p-2">Preferred Institute</div>
    <div class="w-full text-black text-[16px] font-bold p-2">Preferred Subject</div>
    <div class="w-full text-black text-[16px] font-bold p-2">Budget</div>
    <div class="w-full text-black text-[16px] font-bold p-2">Action</div>
  </div>
  @if ($choices->isNotEmpty())
    @foreach ($choices as $data)
      <!-- __________________ -->
      <div class="accordian_choice">
        @csrf
        <div class="accordian_head_choices flex">
            <div class="w-[30px] flex md:w-[50px] h-full p-2">
              <p class="m-auto">{{ $loop->index + 1 }}</p>
            </div>
            <div class="accordian_title_choice flex w-full">

              <div class="w-full p-2">
                <p class="text-black font-bold md:!font-normal md:!text-primary-dim">{{$data->services->name}}</p>
              </div>

              <div class="w-full p-2 hidden md:flex">
                <p>{{$data->country}}</p>
              </div>

              <div class="w-full p-2 hidden md:flex">
                <p>{{$data->institute}}</p>
              </div>

              <div class="w-full p-2 hidden md:flex">
                <p>{{$data->subject}}</p>
              </div>
              
              <div class="w-full p-2 hidden md:flex">
                <p>{{$data->budget}} BDT</p>
              </div>

              <div class="w-full p-2 hidden md:flex">
                  <a href="{{ route('service.requesting', ['service_id' => $service->id, 'choice_id' => $data->id]) }}" 
                  class="border bg-primary-main hover:bg-primary-light text-white 
                  h-[30px] rounded px-2 py-1">Send Request</a>
              </div>
              
            </div>
            <div class="accordian_toggler md:hidden"><i class="fa-solid fa-chevron-down"></i></div>
        </div>

        <div class="accordian_body_choice md:!hidden">
          <div class="accordian_description_choice">

            <div class="choice_info">

              <div class="w-auto mb-2">
                <span>Preferred Country</span>
                <p class="text-black">{{$data->country}}</p>
              </div>

              <div class="w-auto mb-2">
                <span>Preferred Institute</span>
                <p class="text-black">{{$data->institute}}</p>
                <input type="hidden" name="choice_institute" value="{{$data->institute}}">
              </div>

              <div class="w-auto mb-2">
                <span>Budget</span>
                <p class="text-black">{{$data->budget}} BDT</p>
                <input type="hidden" name="choice_budget" value="{{$data->budget}}">
              </div>

              <div class="w-auto mb-2">
                <span>Preferred Subject</span>
                <p class="text-black">{{$data->subject}}</p>
                <input type="hidden" name="choice_subject" value="{{$data->subject}}">
              </div>

            </div>

            <div class="buttons mt-2">
              <a href="{{ route('service.requesting', ['service_id' => $service->id, 'choice_id' => $data->id]) }}" 
                  class="border bg-primary-main hover:bg-primary-light text-white 
                  h-[30px] rounded px-2 py-1">Send Request</a>
            </div>
          </div>
        </div>
      </div>
      <!-- __________________ -->
      @endforeach
    @else
    <div class="no_data_section">
        <div class="empty-state">
            <div class="empty-state__content">
                <div class="empty-state__icon"><img src="{{asset('no-data-image.png')}}" alt=""></div>
                <div class="empty-state__message">No Choice has been added yet.</div>
                <div class="empty-state__help">Add a new Choice by simpley clicking the button at bottom here.</div>
                <a href="{{ route('student.profile.action', 'choice-create') }}">
                  <button>Create Choices</button>
                </a>
            </div>
        </div>
    </div>
  @endif
</section>
<!-- _____________ student choices end -->


@endsection

@push('script')
<script src="{{ asset('Frontend') }}/./assets/js/popUpAlert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
<!-- sweet alert -->
<!-- student choices start -->
<script>
    let accordianHead_choice = Array.from(document.querySelectorAll(".accordian_head_choices"));
    accordianHead_choice.map((item) =>
      item.addEventListener("click", () => {
        closeAllAccordian_choice(item);
      })
    );
  function closeAllAccordian_choice(current_target) {
    console.log(current_target);
    accordianHead_choice.map((item) => {
      if (current_target !== item) {
        const accordianBody = item.nextElementSibling;
        const togglerBtn = item.firstElementChild;
        togglerBtn.classList.remove("active");
        accordianBody.classList.remove("active_body_choice");
      } else {
        const accordianBody = current_target.nextElementSibling;
        const togglerBtn = item.firstElementChild;
        togglerBtn.classList.toggle("active");
        accordianBody.classList.toggle("active_body_choice");
      }
    });
  }
</script>
<!-- student choices end -->
@endpush
