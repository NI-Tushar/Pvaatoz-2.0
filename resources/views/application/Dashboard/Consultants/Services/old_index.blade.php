@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Sercices')
@section('breadcrumb', 'Assessment Declaration')
@section('previous-menu', 'Assessment')
@section('active-menu', 'Assessment Declaration')

@section('master-content')
<div class="card">
    <div class="card-header d-flex justify-content-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-outline-primary">Add New</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Index</th>
                  <th>Name of University</th>
                  <th>Name of Country</th>
                  <th>Name of Subject</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($services_data as $data)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $data->country }}</td>
                        <td>{{ $data->university }}</td>
                        <td>{{ $data->subject }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('consultant.services.detete', $data->id) }}" class="btn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Your Assessment Declaration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('consultant.service.add') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="name" class="text-gray mb-2" class="form-label">Add University</label>
                            <input type="text" name="university" type="text" class="form-control" placeholder="Enter University Name" required>
                        </div>
                        @error('name')
                        <div id="emailHelp" class="form-text">{{ $error_error_message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email" class="text-gray mb-2" class="form-label">Add Country:</label>
                            <input type="text" class="form-control" name="country" placeholder="Add Country Name" required>
                        </div>
                        @error('email')
                        <div id="emailHelp" class="form-text">{{ $error_error_message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email" class="text-gray mb-2" class="form-label">Add Subject:</label>
                            <input type="text" class="form-control" name="subject" placeholder="Add Subject Name" required>
                        </div>
                        @error('email')
                        <div id="emailHelp" class="form-text">{{ $error_error_message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
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
