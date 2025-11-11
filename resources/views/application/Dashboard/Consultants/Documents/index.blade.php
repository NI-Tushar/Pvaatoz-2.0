@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Qualification')
@section('breadcrumb', 'Qualification')
@section('previous-menu', 'Documents')
@section('active-menu', 'Qualification')
@section('master-content')
    <div class="card p-3">
        <div class="d-flex justify-content-end w-full mb-3">
            <a href="{{ route('consultant.qualification.add') }}" class="btn btn-outline-primary">Add New</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>SL</th>
                <th>Lavel Of Education</th>
                <th>Degree/Title</th>
                <th>Institution</th>
                <th>Department</th>
                <th>Passing Year</th>
                <th>GPA/CGPA</th>
                <th>Duration</th>
                <th>Documents</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @php $sl = 1; @endphp
                @foreach ($qualification_data as $data)
                    <tr>
                        <th scope="row">{{ $sl++ }}</th>
                        <td>{{ $data->level_of_education }}</td>
                        <td>{{ $data->degree_title }}</td>
                        <td>{{ $data->institution }}</td>
                        <td>{{ $data->department }}</td>
                        <td>{{ $data->passing_year }}</td>
                        <td>{{ $data->cgpa }}</td>
                        <td>{{ $data->duration }}</td>
                        <td class="d-flex justify-content-center align-content-center">
                            @if ($data->documents)
                            <a target="_blank" href="{{ asset($data->documents) }}"><i class="fa-regular fa-file-lines" style="font-size: 25px"></i></a>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                            <a href="{{ route('consultant.qualification.edit', $data->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="{{ route('consultant.qualification.detete', $data->id) }}" class="delete btn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($qualification_data->isEmpty())
            <p style="color:crimson;font-weight:600; width:100%;text-align:center;">No Qualification Documents available.</p>
        @endif
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            event.preventDefault(); // Prevent form submission

            var form = $(this).closest("form"); // Get the closest form

            Swal.fire({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                customClass: {
                    confirmButton: 'text-white',
                    cancelButton: 'btn btn-secondary'
                },
                dangerMode: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form if the user confirms
                }
            });
        });


    </script>
@endpush
