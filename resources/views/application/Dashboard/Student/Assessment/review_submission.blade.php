@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('breadcrumb', 'Request')
@section('previous-menu', 'Request')
@section('active-menu', 'Request')
@section('master-content')

<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <!-- <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
        <i class="fa-solid fa-pen fa-2x"></i>
    </div> -->
    <div>
        <h3 class="fw-bold fs-4 mb-0">{{ __('message.service_request') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Service Request</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->

    <script>
        @if(session('success_review'))
            toastr.success("{{ session('success_review') }}");
        @endif

        @if(session('error_review'))
            toastr.error("{{ session('error_review') }}");
        @endif
    </script>

<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0">Rate Your Consultant</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('reviews.store') }}" method="POST" id="reviewForm">
                @csrf
                <input type="hidden" name="assessment_id" value="{{ $data->id }}">
                <input type="hidden" name="consultant_id" value="{{ $data->consultant_id }}">
                <input type="hidden" name="consultancy_service_id" value="{{ $data->consultancy_service_id }}">
                <input type="hidden" name="review_rating" id="rating-input" value="0" required>

                <div class="mb-2">
                    <label class="form-label">Your Rating</label>
                    <div class="d-flex align-items-center mb-2">
                        <div class="rating-stars" id="star-rating">
                            <i class="star-icon" data-value="1">★</i>
                            <i class="star-icon" data-value="2">★</i>
                            <i class="star-icon" data-value="3">★</i>
                            <i class="star-icon" data-value="4">★</i>
                            <i class="star-icon" data-value="5">★</i>
                        </div>
                        <span class="ms-3" id="rating-display"></span>
                    </div>
                    <div class="text-danger" id="rating-error"></div>
                </div>
                @error('review_rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="mb-2">
                    <label for="review-message" class="form-label">Your Review</label>
                    <textarea name="review_message" id="review-message" class="form-control" rows="4" maxlength="200" placeholder="Share your experience with this consultant..." oninput="updateCharCount(this)"></textarea>
                    <div class="form-text">
                        <span id="charCount">0</span> / 200 characters
                    </div>
                </div>

                @error('review_message')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary px-4 mt-3 py-2">Submit Review</button>
            </form>
        </div>
    </div>
</div>

<style>
    .rating-stars {
        display: inline-flex;
        cursor: pointer;
    }

    .star-icon {
        font-size: 45px; /* Increased from 30px to 45px */
        margin-right: 12px; /* Increased spacing */
        color: #ddd;
        cursor: pointer;
        position: relative;
    }

    .star-icon.filled {
        color: #FFD700;
    }

    .star-icon.half-filled:before {
        content: '★';
        position: absolute;
        color: #FFD700;
        width: 50%;
        overflow: hidden;
    }

    @media (max-width: 576px) {
        .star-icon {
            font-size: 36px; /* Increased from 24px to 36px for mobile */
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ratingInput = document.getElementById('rating-input');
        const ratingDisplay = document.getElementById('rating-display');
        const ratingError = document.getElementById('rating-error');
        const stars = document.querySelectorAll('.star-icon');
        const form = document.getElementById('reviewForm');

        // Function to update star display based on rating
        function updateStars(rating) {
            // Ensure rating is between 0 and 5, rounded to nearest 0.5
            rating = Math.max(0, Math.min(5, parseFloat(rating) || 0));
            rating = Math.round(rating * 2) / 2;

            // Update hidden input and display
            ratingInput.value = rating;
            ratingDisplay.textContent = rating > 0 ? `(${rating})` : '';

            // Clear any error message
            ratingError.textContent = '';

            // Update stars appearance
            stars.forEach(star => {
                const value = parseFloat(star.getAttribute('data-value'));

                // Remove existing classes
                star.classList.remove('filled', 'half-filled');

                if (value <= Math.floor(rating)) {
                    // Full star
                    star.classList.add('filled');
                } else if (value === Math.ceil(rating) && rating % 1 !== 0) {
                    // Half star
                    star.classList.add('half-filled');
                }
            });
        }

        // Add click event to stars for rating selection
        stars.forEach(star => {
            star.addEventListener('click', function(e) {
                const starValue = parseFloat(this.getAttribute('data-value'));
                const rect = this.getBoundingClientRect();
                const clickPosition = e.clientX - rect.left;

                // If click is on the left half of the star, select half-star rating
                if (clickPosition < rect.width / 2) {
                    updateStars(starValue - 0.5);
                } else {
                    updateStars(starValue);
                }
            });

            // Add touch event for mobile
            star.addEventListener('touchend', function(e) {
                e.preventDefault();
                const starValue = parseFloat(this.getAttribute('data-value'));
                const rect = this.getBoundingClientRect();
                const touchPosition = e.changedTouches[0].clientX - rect.left;

                if (touchPosition < rect.width / 2) {
                    updateStars(starValue - 0.5);
                } else {
                    updateStars(starValue);
                }
            });
        });

        // Form validation
        form.addEventListener('submit', function(e) {
            const rating = parseFloat(ratingInput.value);
            if (!rating || rating <= 0) {
                e.preventDefault();
                ratingError.textContent = 'Please select a rating before submitting';
                return false;
            }
        });

        // Initialize with any existing value
        const initialRating = parseFloat(ratingInput.value) || 0;
        if (initialRating > 0) {
            updateStars(initialRating);
        }
    });
    
    // maximum character for review text
    function updateCharCount(textarea) {
        const maxLength = parseInt(textarea.getAttribute('maxlength'));
        const currentLength = textarea.value.length;
        document.getElementById('charCount').textContent = currentLength;

        // Optional: Prevent typing beyond limit (redundant if maxlength is used)
        if (currentLength >= maxLength) {
            document.getElementById('charCount').style.color = 'red';
        } else {
            document.getElementById('charCount').style.color = 'inherit';
        }
    }

</script>
@endsection
