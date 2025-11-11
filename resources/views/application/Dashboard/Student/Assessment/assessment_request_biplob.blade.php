@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('breadcrumb', 'Assessment Request')
@section('previous-menu', 'Request')
@section('active-menu', 'Send | Draft Request')

@section('master-content')

    <div class="card p-3">

        <form action="{{ route('student.assessment.store-request') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="row">

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Your Provided Information
                        </div>
                        <div class="card-body">

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
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Consultant Information
                        </div>
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Select Country (*)</label>
                                <select name="country" class="form-control" id="">
                                    <option value="">Select one</option>
                                    <option value="US">US</option>
                                    <option value="UK">UK</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Sweden">Sweden</option>
                                </select>
                                @error('country')
                                    <h5 class="text-danger bold">{{ $message }}</h5>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Proffered Education (*)</label>
                                <input type="text" name="subject" placeholder="Your Proffered Education/ Subject" class="form-control">
                                @error('subject')
                                    <h5 class="text-danger bold">{{ $message }}</h5>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Budget (*)</label>
                                <input type="text" name="budget" placeholder="Budget : 10,0000 - 20,0000" class="form-control">
                                @error('budget')
                                    <h5 class="text-danger bold">{{ $message }}</h5>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row justify-content-end">
                <div class="col-md-4 col-of">
                    <table class="table">
                        <tr>
                            <td>Durations :</td>
                            <td>{{ $consultant->assessment_duration }} Days</td>
                        </tr>
                        <tr>
                            <td>Sub Total :</td>
                            <td>{{ number_format($consultant->assessment_price, 2) }} Taka</td>
                        </tr>
                        <tr>
                            <td>Total :</td>
                            <td style="font-weight: 900">{{ number_format($consultant->assessment_price, 2) }} Taka</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <div class="text-right tw-space-x-1" id="profile-save-section">
                    <a href="{{ route('student.assessment.consultant-select') }}" class="btn btn-outline-primary only-save customer-form-submiter">
                        <div class="d-flex gap-2">
                            <span><i class="fa-solid fa-arrow-left-long"></i></span>
                            <span>Previous </span>
                        </div>
                    </a>
                    <input type="hidden" name="duration" value="{{ $consultant->assessment_duration }}">
                    <input type="hidden" name="price" value="{{ $consultant->assessment_price }}">
                    <input type="hidden" name="consultant_id" value="{{ $consultant->id }}">
                    <button type="submit" name="draft" value="draft" class="btn btn-success only-save customer-form-submiter">
                        <div class="d-flex gap-2">
                            <span><i class="fa-solid fa-cloud"></i></span>
                            <span>Draft </span>
                        </div>
                    </button>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary only-save customer-form-submiter">
                        <div class="d-flex gap-2">
                            <span>Submit</span>
                        </div>
                    </button>
                </div>
            </div>

        </form>

    </div>




@endsection
@push('script')
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
@endpush

@push('script')
    <script>

    </script>
@endpush
