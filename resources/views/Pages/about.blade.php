@extends('Frontend.app')
@section('title', 'About Us')
@section('app-content')

<link rel="stylesheet" href="{{ url('Frontend/assets/css/about_us.css') }}">
    <!-- Main Content -->
    <section class="about_section bg-light" id="about">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
                <div class="section_title_all text-center">
                <div class="logo">
                    <img src="{{ asset('Frontend') }}/assets/img/logo/logo-red.png" alt="">
                </div>
                <h3 class="font-weight-bold">{{ __('message.about_wellcome_text') }}</h3>
                <p class="section_subtitle mx-auto text-muted">{{ __('message.about_desc_text') }}</p>
                <div class="">
                    <i class=""></i>
                </div>
                </div>
            </div>
            </div>

            <div class="row vertical_content_manage mt-5">
            <div class="col-lg-6">
                <div class="about_header_main mt-3">
                <!-- <div class="about_icon_box">
                    <p class="text_custom font-weight-bold">Lorem Ipsum is simply dummy text</p>
                </div> -->
                <h4 class="about_heading text-capitalize font-weight-bold mt-4">
                   {{ __('message.about_desc_heading') }}
                </h4>
                <p class="text-muted mt-3">
                    {{ __('message.about_desc_detail') }}
                </p>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="img_about mt-3">
                <img src="https://i.ibb.co/qpz1hvM/About-us.jpg" alt="" class="img-fluid mx-auto d-block">
                </div>
            </div>
            </div>

            <div class="row mt-3">
            <div class="col-lg-4">
                <div class="about_content_box_all mt-3">
                <div class="about_detail text-center">
                    <div class="about_icon">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <h5 class="text-dark text-capitalize mt-3 font-weight-bold">{{ __('message.card_consultancy') }}</h5>
                    <p class="edu_desc mt-3 mb-0 text-muted">{{ __('message.card_consultancy_desc') }}</p>
                </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="about_content_box_all mt-3">
                <div class="about_detail text-center">
                    <div class="about_icon">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h5 class="text-dark text-capitalize mt-3 font-weight-bold">{{ __('message.card_info') }}</h5>
                    <p class="edu_desc mb-0 mt-3 text-muted">{{ __('message.card_info_desc') }}</p>
                </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="about_content_box_all mt-3">
                <div class="about_detail text-center">
                    <div class="about_icon">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <h5 class="text-dark text-capitalize mt-3 font-weight-bold">{{ __('message.card_training') }}</h5>
                    <p class="edu_desc mb-0 mt-3 text-muted">{{ __('message.card_training_desc') }}</p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- Main Content end -->
@endsection
    