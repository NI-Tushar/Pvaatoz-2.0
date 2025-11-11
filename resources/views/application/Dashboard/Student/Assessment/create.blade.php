@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('breadcrumb', 'Assessment Request')
@section('previous-menu', 'Assessment')
@section('active-menu', 'Request')
@section('master-content')

<div class="card">
    <div class="card-header">
        <h4>Preview Your Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>Name:</th>
                        <td>{{ auth()->guard('web')->user()->name }}</td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td>{{ auth()->guard('web')->user()->gender }}</td>
                    </tr>
                        <th>Date of Birth:</th>
                        <td>{{ auth()->guard('web')->user()->date_of_birth }}</td>
                    </tr>
                    </tr>
                        <th>Nationality:</th>
                        <td>{{ auth()->guard('web')->user()->nationality }}</td>
                    </tr>
                    <tr>
                        <th>Present City:</th>
                        <td>{{ auth()->guard('web')->user()->present_city }}</td>
                    </tr>
                    <tr>
                        <th>Present Country:</th>
                        <td>{{ auth()->guard('web')->user()->present_country }}</td>
                    </tr>
                    <tr>
                        <th>Present Address:</th>
                        <td>{{ auth()->guard('web')->user()->present_address }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <!---Qualificaion--->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Qualifications</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (auth()->user()->qualifications as $qualification)
                        <tr>
                            <td>
                                <h5 class="p-0 m-0">{{ $qualification->level_of_education }}</h5>
                                <p class="p-0 m-0">CGPA: {{ $qualification->cgpa }}</p>
                                <sapn>{{ $qualification->duration }}</sapn>
                            </td>
                            <td>
                                <h5 class="p-0 m-0">{{ $qualification->institution }}</h5>
                                <div class="d-flex gap-2">
                                    <sapn>{{ $qualification->passing_year }}</sapn>|
                                    <sapn>{{ $qualification->department }}</sapn>
                                </div>
                                <span style="text-transform: uppercase">{{ $qualification->degree_title }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!---Qualificaion End--->
            </div>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <div class="text-right tw-space-x-1" id="profile-save-section">
                <a href="{{ route('student.assessment.all-request') }}" class="btn btn-outline-primary only-save customer-form-submiter">
                    <div class="d-flex gap-2">
                        <span><i class="fa-solid fa-arrow-left-long"></i></span>
                        <span>Previous </span>
                    </div>
                </a>
                <a href="{{ route('student.assessment.consultant-select') }}" class="btn btn-primary only-save customer-form-submiter">
                    <div class="d-flex gap-2">
                        <span>Next</span>
                        <span><i class="fa-solid fa-arrow-right-long"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

@endpush

@push('script')
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="{{ asset('Backend/assets/datepicker/timedropper.js') }}"></script>

<script>
    $(document).ready(function() {
        // Set default values
        $("#start_time").val("09:00 AM");
        $("#end_time").val("06:00 PM");
        $("#delivery_time").val("06:00 PM");

        // Apply timeDropper to each input
        $("#start_time").timeDropper({
            setCurrentTime: false
        });
        $("#end_time").timeDropper({
            setCurrentTime: false
        });
        $("#delivery_time").timeDropper({
            setCurrentTime: false
        });
    });

    function toggleDateSection() {
        var filterSection = document.getElementById('filterSection');
        if (filterSection.style.display === 'none' || filterSection.style.display === '') {
            filterSection.style.display = 'block';
        } else {
            filterSection.style.display = 'none';
        }
    }

</script>
@endpush
