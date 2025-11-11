@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Experience')
@section('breadcrumb', 'Consultant/Experience')
@section('previous-menu', 'Experience')
@section('active-menu', 'Consultant Experience')

@section('master-content')
<link rel="stylesheet" href="{{ url('Frontend/assets/css/education_list.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/add-update-modal.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/last_edu.css') }}">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">"> -->
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">
<link rel="stylesheet" href="{{ asset('Frontend') }}/assets/css/alert_popup.css">


<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
        <i class="fa-solid fa-toolbox fa-2x"></i>
    </div>
    <div>
        <h3 class="fw-bold fs-4 mb-0">Your Experience</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Experience</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->


@if (Session::has('delete_message'))
    <p style="color:green;font-weight:700; font-size:20px; width:100%;text-align:center;">{{ Session::get('delete_message') }}</p>
@endif

@if (Session::has('exp_update'))
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
            <p class="payment_text_msg mb-2">{{ Session::get('exp_update') }}</p>
            <a href="{{ route('consultant.experience') }}">
                <button class="payment_text_msg button">Ok</button>
            </a>
        </div>
    </div>
</div>
@endif



<!-- ________________________________________ UPDATE EDUCAITONAL QUALIFICAIION START -->
<div class="w-full bg-white my-3 rounded-lg overflow-hidden border">
    <div class="flex items-center bg-gray-300 p-2 px-3 gap-3">
        <img src="{{ asset('Frontend/assets/img/icon/experience.png') }}" alt="Experience Icon" class="w-10 h-10">
        <h4 class="text-[20px] font-semibold" style="color: var(--consultant-primary-color);">
            Update Your Educational Qualification
        </h4>
    </div>

    <div class="w-full p-3">
        <form class="row g-3" method="POST" action="{{ route('consultant.experience.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" id="id" value="{{ $experience_data->id }}">

            <div class="col-12">
                    <label for="inputAddress" class="form-label text-black text-black">Organization Name</label>
                    <input type="text" name="organization" class="form-control text-black font-bold" id="inputAddress" placeholder="Organization Name Your Worked" value="{{ $experience_data->organization }}">
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label text-black">Designation</label>
                    <input type="text" name="designation" class="form-control text-black font-bold" id="inputEmail4" placeholder="Designation/Role Your Played" value="{{ $experience_data->designation }}">
                </div>

                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label text-black">Responsibilities</label>
                    <input type="text" name="responsibilities" class="form-control text-black font-bold" id="inputPassword4" placeholder="Your Responsibilities there" value="{{ $experience_data->responsibilities }}">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label text-black">Start Date</label>
                    <input type="date" name="start_date" class="form-control text-black font-bold" id="inputEmail4" value="{{ $experience_data->start_date }}">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label text-black">End Date</label>
                    <input type="date" name="end_date" class="form-control text-black font-bold" id="inputEmail4" value="{{ $experience_data->end_date }}">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label text-black">Duration</label>
                    <input type="text" name="duration" class="form-control text-black font-bold" id="inputEmail4" placeholder="In Days/Months/Year" value="{{ $experience_data->duration }}">
                </div>

                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label text-black">Any Document</label>
                    <div class="form-control certificate flex">
                        <i class="fa-solid fa-paperclip mt-auto mb-auto mr-2"></i>
                        <label for="bank-file-upload1" style="display: flex; align-items: left;cursor: pointer; padding:3px; width:100%;">
                            <span style="color:rgba(0, 0, 0, 0.529);" id="bank-file-name1">(Place Any Documents You have Relevent)</span>
                            <input type="file" name="documents" id="bank-file-upload1" style="display: none;" onchange="bankFileName1(this)">
                        </label>
                    </div>
                    <div class="_df_button p-0 bg-transparent border-none" 
                        @if($experience_data->documents) 
                            source="{{ asset('storage/' . $experience_data->documents) }}" 
                        @endif>
                        @if($experience_data->documents)
                            <p class="text-primary-main mt-2 font-bold">{{ basename($experience_data->documents) }}</p>
                        @else
                            <p class="text-red-500 mt-2 font-bold">No document found</p>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label text-black">Resume Document</label>
                    <div class="form-control certificate flex">
                        <i class="fa-solid fa-paperclip mt-auto mb-auto mr-2"></i>
                        <label for="bank-file-upload2" style="display: flex; align-items: left;cursor: pointer; padding:5px; width:100%;">
                            <span style="color:rgba(0, 0, 0, 0.529);" id="bank-file-name2">(Place Your Resume)</span>
                            <input type="file" name="cv_documents" id="bank-file-upload2" style="display: none;" onchange="bankFileName2(this)">
                        </label>
                    </div>
                    <div class="_df_button p-0 bg-transparent border-none" 
                        @if($experience_data->cv_documents) 
                            source="{{ asset('storage/' . $experience_data->cv_documents) }}" 
                        @endif>
                        @if($experience_data->cv_documents)
                            <p class="text-primary-main mt-2 font-bold">{{ basename($experience_data->cv_documents) }}</p>
                        @else
                            <p class="text-red-500 mt-2 font-bold">No document found</p>
                        @endif
                    </div>
                </div>

            <div class="col-12 flex justify-end">
                <button type="submit" 
                    class="w-full sm:w-auto bg-primary-main text-white font-semibold px-5 py-2 rounded-md hover:opacity-90 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
<!-- ________________________________________ UPDATE EDUCAITONAL QUALIFICATION END -->




@endsection
@push('script')
<script src="{{ asset('Frontend') }}/./assets/js/popUpAlert.js"></script>
@endpush
