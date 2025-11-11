@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('breadcrumb', 'Assessment Fee Setup')
@section('previous-menu', 'Assessment Fee Setup')
@section('active-menu', 'Request')
@section('master-content')

<div class="card p-3">
    <form action="{{ route('consultant.assessment.assessment-fee-setup-update') }}" method="POST">
        @csrf
        @method('patch')

        <div class="form-group mb-3">
            <label for="" class="mb-1">Service Type</label>
            <input type="text" class="form-control" value="Assessment" readonly>
        </div>

        <div class="form-group mb-3">
            <label for="" class="mb-1">Assessment Durations</label>
            <input type="text" name="assessment_duration" class="form-control" placeholder="Durations, like- 3 days" value="{{ old('assessment_duration', auth()->user()->assessment_duration) }}">
        </div>

        <div class="form-group mb-3">
            <label for="" class="mb-1">Assessment Price</label>
            <input type="number" name="assessment_price" class="form-control" placeholder="Assessment price, like- 500" value="{{ old('assessment_price', auth()->user()->assessment_price) }}">
        </div>
        <div class="form-group mb-3 d-flex justify-content-end">
            <button class="btn btn-outline-primary">Save & Update</button>
        </div>
    </form>
</div>

@endsection
@push('script')
<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

@endpush
