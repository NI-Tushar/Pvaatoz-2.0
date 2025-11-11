@extends("Backend.Layouts.master")
@section('title', 'Educational Info/Create')
<link rel="stylesheet" href="{{ url('Backend/css/edu_info.css') }}">
<link rel="stylesheet" href="{{ url('Backend/css/color.css') }}">
@section('master-content')
    <div class="card">
        <div class="card-header">

            <div class="top_option">
                <ul>
                    <li><button data-target="edu_info">Educational Info</button></li>
                    <li><button data-target="page_content">Page Content</button></li>
                    <li><button data-target="why_this_country">Why this Country</button></li>
                    <li><button data-target="programs_duration">Programs & Duration</button></li>
                    <li><button data-target="top_university">Top Universities</button></li>
                    <li><button data-target="visa_checklist">Visa Checklist</button></li>
                    <li><button data-target="scholarship">Scholarships</button></li>
                    <li><button data-target="faq">F.A.Q</button></li>
                </ul>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Update Information</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="" class="btn btn-md btn-outline-primary"><i class="fa-solid fa-reply"></i></a>
            </div>
        </div>
        <div class="card-body">
            <!-- ___________ -->
            <section class="info_section" id="edu_info">
                @include('Backend.Pages.EducationalInfo.Forms.edu_info')
            </section>
             <!-- ___________ -->
            <section class="info_section" id="page_content">
                @include('Backend.Pages.EducationalInfo.Forms.page_content')
            </section>
            <!-- ___________ -->
            <section class="info_section" id="why_this_country">
                @include('Backend.Pages.EducationalInfo.Forms.why_this_country')
            </section>
            <!-- ___________ -->
            <section class="info_section" id="programs_duration">
                @include('Backend.Pages.EducationalInfo.Forms.programs_duration')
            </section>
            <!-- ___________ -->
            <section class="info_section" id="top_university">
                @include('Backend.Pages.EducationalInfo.Forms.top_universities')
            </section>
            <!-- ___________ -->
            <section class="info_section" id="visa_checklist">
                 @include('Backend.Pages.EducationalInfo.Forms.visa_checklist')
            </section>
            <!-- ___________ -->
            <section class="info_section" id="faq">
                @include('Backend.Pages.EducationalInfo.Forms.country_faq')
            </section>
            <!-- ___________ -->
            <section class="info_section" id="scholarship">
                @include('Backend.Pages.EducationalInfo.Forms.scholarships')
            </section>
             <!-- ___________ -->
        </div>
    </div>
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


// _________________ onclick active top button
document.querySelectorAll('.top_option button').forEach(button => {
    button.addEventListener('click', function () {
        // Remove 'active' from all buttons
        document.querySelectorAll('.top_option button').forEach(btn => {
            btn.classList.remove('active');
        });
        // Add 'active' to the clicked button
        this.classList.add('active');
    });
});

// _________________ section hide and show
 document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.top_option button');
        const sections = document.querySelectorAll('.info_section');

        // Restore last selected section from localStorage
        let lastTargetId = localStorage.getItem('activeSection') || buttons[0].getAttribute('data-target');

        // Function to activate a section by ID
        function activateSection(targetId) {
            // Remove 'active' class from all buttons
            buttons.forEach(btn => btn.classList.remove('active'));
            // Hide all sections
            sections.forEach(section => section.style.display = 'none');

            // Show the targeted section
            const targetSection = document.getElementById(targetId);
            const targetButton = document.querySelector(`.top_option button[data-target="${targetId}"]`);
            if (targetSection && targetButton) {
                targetSection.style.display = 'block';
                targetButton.classList.add('active');
            }

            // Save the last clicked section
            localStorage.setItem('activeSection', targetId);
        }

        // Set click listeners
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-target');
                activateSection(targetId);
            });
        });

        // Activate section on load
        activateSection(lastTargetId);
    });


    // __________________ add and remove feature
        document.getElementById('add-feature').addEventListener('click', function() {
        var container = document.getElementById('features-container');
        var inputGroup = document.createElement('div');
        inputGroup.classList.add('input-group', 'mb-2');

        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'populer_programs_name[]';
        input.classList.add('form-control');

        var inputGroupAppend = document.createElement('div');
        inputGroupAppend.classList.add('input-group-append');

        var button = document.createElement('button');
        button.type = 'button';
        button.classList.add('btn', 'btn-danger', 'remove-feature');
        button.textContent = 'X';

        inputGroupAppend.appendChild(button);
        inputGroup.appendChild(input);
        inputGroup.appendChild(inputGroupAppend);
        container.appendChild(inputGroup);

        button.addEventListener('click', function() {
            container.removeChild(inputGroup);
        });
    });

    document.querySelectorAll('.remove-feature').forEach(function(button) {
        button.addEventListener('click', function() {
            var inputGroup = button.parentElement.parentElement;
            var container = document.getElementById('features-container');
            container.removeChild(inputGroup);
        });
    });
</script>
@endpush
