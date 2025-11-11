@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

<style>
    .testimonials-wrap { padding: 20px 0; width: 100%; }
    .review-list { list-style: none; padding: 0; margin: 0; width: 100%; }
    .review-item { background: #fff; padding: 15px; margin-bottom: 10px; display: flex; align-items: center; width: 100%; border-bottom: 1px solid #eee; box-sizing: border-box; }
    .user-img { width: 50px; height: 50px; border-radius: 50%; background-size: cover; background-position: center; margin-right: 15px; flex-shrink: 0; }
    .text { flex-grow: 1; display: flex; align-items: center; gap: 15px; }
    .text-content { display: flex; flex-direction: column; gap: 5px; flex-grow: 1; }
    .start_review ul { list-style: none; padding: 0; margin: 0; display: flex; }
    .start_review ul li { color: #ccc; font-size: 12px; position: relative; }
    .start_review ul li.marked { color: #f1c40f; }
    .start_review ul li.half-marked { position: relative; }
    .start_review ul li.half-marked::before { content: '\f089'; font-family: 'Font Awesome 5 Free'; position: absolute; color: #f1c40f; width: 50%; overflow: hidden; }
    .quote { color: #ccc; font-size: 18px; margin-right: 5px; flex-shrink: 0; }
    .review-message { font-size: 14px; color: #555; margin: 0; line-height: 1.4; }
    .review_name { flex-shrink: 0; min-width: 120px; }
    .review_name .name { font-weight: 700; font-size: 14px; color: #333; margin: 0; }
    .no_review_section { text-align: center; padding: 50px 0; }
    .no_review_section img { max-width: 160px; margin-bottom: 20px; }
    .add_review button { background: #007bff; color: #fff; padding: 10px 20px; border: 0; border-radius: 5px; cursor: pointer; font-size: 15px; }
    .add_review button:hover { background: #0056b3; }
    @media (max-width: 768px) { .text { flex-wrap: wrap; gap: 10px; } .review_name { min-width: 100px; } }
    @media (max-width: 576px) { .user-img { width: 40px; height: 40px; } .review-message { font-size: 13px; } }
</style>

<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <!-- <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
        <i class="fa-solid fa-toolbox fa-2x"></i>
    </div> -->
    <div>
        <h3 class="fw-bold fs-4 mb-0">Students Reviews</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Reviews</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->

<div class="testimonials-wrap w-full">
    <div class="w-full">
        @if ($reviews->isNotEmpty())
            <div class="text-black font-bold text-[20px] mb-2 flex gap-2">
                <i class="fa-regular fa-comments"></i>
                <h2>Happy Students & Feedbacks</h2>
            </div>
            <ul class="review-list w-full">
                @foreach ($reviews as $data)
                    <li class="review-item">
                        <div class="user-img" style="background-image: url('{{ $data->user->image ? asset($data->user->image) : asset('no-profile-img.png') }}')"></div>
                        <div class="text">
                            <span class="quote"><i class="fa fa-quote-left"></i></span>
                            <div class="text-content">
                                <p class="review-message">{{ $data->review_message }}</p>
                                <div class="start_review">
                                    <ul>
                                        @for ($i = 1; $i <= 5; $i++)
                                            @php
                                                $difference = $data->review_rating - $i;
                                            @endphp

                                            @if ($difference >= 0)
                                                <li class="marked"><i class="fa-solid fa-star"></i></li>
                                            @elseif ($difference >= -0.5 && $difference < 0)
                                                <li class="half-marked"><i class="fa-solid fa-star"></i></li>
                                            @else
                                                <li><i class="fa-solid fa-star"></i></li>
                                            @endif
                                        @endfor
                                         ({{ ($data->review_rating) }})
                                    </ul>
                                </div>
                            </div>
                            <div class="review_name">
                                Service
                                <div class="flex flex-wrap gap-2">
                                    @foreach(json_decode($data->assessment->assessment_service_name) as $service)
                                    <span class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded text-sm leading-tight w-fit h-fit">
                                        {{ $service }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="review_name">
                                Customer name
                                <p class="name">{{ $data->student->name }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="flex flex-col items-center justify-center">
                <img src="{{ asset('no_review.png') }}" alt="No Review" class="mx-auto">
                <p class="text-center mt-4 text-[25px] font-bold">No Review</p>
            </div>
        @endif
    </div>
</div>

@endsection
