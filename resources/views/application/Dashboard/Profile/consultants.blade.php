@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Profile | EduWise')
@section('breadcrumb', 'Consultants/profile')
@section('previous-menu', 'Profile')
@section('active-menu', 'Consultnts/Profile')
@section('master-content')

<link rel="stylesheet" href="{{ url('Frontend/assets/css/consultants_profile.css') }}">
<!-- ____________ for review -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- _________________________ PROFILE START -->
<div class="profile_section">
    <div class="centered_profile">
        <div class="card">
            <div class="profile_info">
                <div class="card_heading">
                    <div class="user_img">

                        <img src="{{ $service->user?->image ? asset($service->user->image) : asset('no-profile-img.png') }}" alt="User Image">
                    </div>
                    <div class="user_title">
                        <h3>{{$service->user->name ?? 'Name Not Provided'}}</h3>
                        <p class="address"><i class="fa-solid fa-location-dot"></i>{{ $service->user->present_address ?? 'No address provided' }}</p>
                        <p class="about_me">{{ $service->title ?? 'No description provided' }}</p>
                        <div class="start_review below_name">
                            <ul>
                                @php
                                    $rating = $averageRating ?? 0;
                                    $fullStars = floor($rating); // Whole stars
                                    $hasHalfStar = ($rating - $fullStars) >= 0.5; // Check for half star
                                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0); // Remaining empty stars
                                @endphp
                                <!-- Full stars -->
                                @for($i = 1; $i <= $fullStars; $i++)
                                    <li class="active"><i class="fa-solid fa-star"></i></li>
                                @endfor
                                <!-- Half star -->
                                @if($hasHalfStar)
                                    <li class="active"><i class="fa-solid fa-star-half-alt"></i></li>
                                @endif
                                <!-- Empty stars -->
                                @for($i = 1; $i <= $emptyStars; $i++)
                                    <li><i class="fa-regular fa-star"></i></li>
                                @endfor
                                <strong>({{ number_format($averageRating ?? 0, 1) }})</strong>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="experiences">
                    <div class="exp_div">
                        <div class="icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="exp_text">
                            <p>3+ Years Job</p>
                            <span>Experience</span>
                        </div>
                    </div>
                    <div class="exp_div">
                        <div class="icon">
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                        <div class="exp_text">
                            <p>5 Certificates</p>
                            <span>Achived</span>
                        </div>
                    </div>
                    <div class="exp_div">
                        <div class="icon">
                            <i class="fa-solid fa-clipboard-check"></i>
                        </div>
                        <div class="exp_text">
                            <p>2 Internship</p>
                            <span>Completed</span>
                        </div>
                    </div>
                </div>

                <div class="buttons">
                    <button class="active">Experience</button>
                    <button>Biography</button>
                    <button>Skills</button>
                    <button>Portfolio</button>
                </div>

                <div class="buttons_desc">
                    <!-- _____________ -->
                    <div class="experience">
                        <div class="in_details">
                            <div class="icon">
                                <i class="fa-solid fa-ribbon"></i>
                            </div>
                            <div class="details">
                                <div>
                                    <h3>Job Experience</h3>
                                    <span>3 Job history</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vero alias cum expedita harum officia possimus voluptas commodi
                                     culpa repellat ut beatae laudantium officiis error provident deserunt molestias aspernatur, rem consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <!-- _____________ -->
                    <div class="biography">
                        <div class="in_details">
                            <div class="icon">
                                <i class="fa-solid fa-address-card"></i>
                            </div>
                            <div class="details">
                                <div>
                                    <h3>Biography</h3>
                                    <span>3 Job history</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vero alias cum expedita harum officia possimus voluptas commodi culpa repellat ut beatae laudantium officiis error provident deserunt molestias aspernatur, rem consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <!-- _____________ -->
                    <div class="skills">
                        <div class="in_details">
                            <div class="icon">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                            </div>
                            <div class="details">
                                <div>
                                    <h3>Skills</h3>
                                    <span>3 Job history</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vero alias cum expedita harum officia possimus voluptas commodi culpa repellat ut beatae laudantium officiis error provident deserunt molestias aspernatur, rem consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <!-- _____________ -->
                    <div class="portfolio">
                        <div class="in_details">
                            <div class="icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div class="details">
                                <div>
                                    <h3>Portfolio</h3>
                                    <span>3 Job history</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vero alias cum expedita harum officia possimus voluptas commodi culpa repellat ut beatae laudantium officiis error provident deserunt molestias aspernatur, rem consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <!-- _____________ -->
                </div>

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
                </script>

            </div>

            <div class="updgrade_info" style="display:none;">

            </div>

            <!-- ______________ reveiw section start -->
            <div class="testimonials-wrap">
                <div class="container">
                    <div class="heading-section">
                        <h2>Happy Students & Feedbacks</h2>
                    </div>
                    @if($reviews->isNotEmpty())
                        <div class="carousel-testimonial owl-carousel">
                            @foreach($reviews as $review)
                                <div class="item">
                                    <div class="testimonial-box">
                                        <div class="user-img" style="background-image: url({{ $review->student?->image ? asset($review->student->image) : asset('no-profile-img.png') }})"></div>
                                        <div class="start_review">
                                            <ul>
                                                @php
                                                    $rating = $review->review_rating ?? 0;
                                                    $fullStars = floor($rating); // Whole stars
                                                    $hasHalfStar = ($rating - $fullStars) >= 0.5; // Check for half star
                                                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0); // Remaining empty stars
                                                @endphp
                                                <!-- Full stars -->
                                                @for($i = 1; $i <= $fullStars; $i++)
                                                    <li class="active"><i class="fa-solid fa-star"></i></li>
                                                @endfor
                                                <!-- Half star -->
                                                @if($hasHalfStar)
                                                    <li class="active"><i class="fa-solid fa-star-half-alt"></i></li>
                                                @endif
                                                <!-- Empty stars -->
                                                @for($i = 1; $i <= $emptyStars; $i++)
                                                    <li><i class="fa-regular fa-star"></i></li>
                                                @endfor
                                                <strong>({{ number_format($review->review_rating ?? 0, 1) }})</strong>
                                            </ul>

                                        </div>
                                        <div class="text pl-4">
                                            <span class="quote"><i class="fa fa-quote-left"></i></span>
                                            <p class="text_review">{{ $review->review_message ?? 'No review provided' }}</p>
                                            <div class="review_name">
                                                <p class="name">{{ $review->student->name ?? 'Anonymous' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-reviews">
                            <p>No reviews available for this consultant yet.</p>
                        </div>
                    @endif
                </div>
            </div>
                    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
                    <script>
                        $(".carousel-testimonial").owlCarousel({
                        loop: true,
                        margin: 0,
                        responsiveClass: true,
                        responsive: {
                            0: {
                            items: 1,
                            nav: true
                            },
                            600: {
                            items: 3,
                            nav: false
                            },
                            1000: {
                            items: 3,
                            nav: true,
                            loop: false
                            }
                        }
                        });

                    </script>
            <!-- ______________ reveiw section end -->
        </div>
    </div>
</div>
<!-- _________________________ PROFILE END -->
@endsection

@push('script')
    <script type="text/javascript">

    </script>
@endpush
