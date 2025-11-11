@extends('Backend.Layouts.master')
@push('css')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush
@section('title', 'Schedule')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Manage Class Schedule</h5>
                @canAny(['isAdmin', 'isEditor'])
                    <a href="#" class="btn btn-md btn-outline-success" data-toggle="modal" data-target="#createModal"><i
                            class="mr-1 fa-solid fa-plus"></i> Add Schedule</a>
                @endcanAny
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 20px">Sl</th>
                            <th>Date & Time</th>
                            <th>Class Name</th>
                            <th>Class link</th>
                            <th>Status</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->date_time)->format('M d, Y h:i A') }}</td>
                                <td>{{ $schedule->name }}</td>
                                <td>
                                    <!-- Hidden Link -->
                                    <input type="text" value="{{ $schedule->link }}" id="link_{{ $schedule->id }}" style="display: none;">
                                    <!-- Copy Button -->
                                    <button class="btn btn-sm btn-outline-primary copy-btn" data-id="{{ $schedule->id }}">
                                        <i class="fa-solid fa-copy"></i>
                                    </button>
                                </td>
                                <td>
                                    <!-- AJAX Status Update -->
                                    <select name="status" class="form-control update-status" data-id="{{ $schedule->id }}">
                                        <option value="Active" {{ $schedule->status == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="In-active" {{ $schedule->status == 'In-active' ? 'selected' : '' }}>In-active</option>
                                        <option value="Completed" {{ $schedule->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="flex-row d-flex bd-highlight" style="gap: .5em">
                                        <a href="#" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#editModal"
                                            data-id="{{ $schedule->id }}" data-name="{{ $schedule->name }}"
                                            data-link="{{ $schedule->link }}" data-date_time="{{ $schedule->date_time }}"
                                            data-status="{{ $schedule->status }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>

                                        @canAny(['isAdmin', 'isEditor'])
                                            <form action="{{ route('admin.schedule.destroy', $schedule->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger show_confirm" data-toggle="tooltip" title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcanAny
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--- Create Modal --->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.schedule.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create New Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="class_name">Class Name</label>
                            <input type="text" name="name" id="class_name" class="form-control"
                                placeholder="Enter a class name" required>
                        </div>

                        <div class="form-group">
                            <label for="class_link">Class Link</label>
                            <input type="text" name="link" id="class_link" class="form-control"
                                placeholder="Enter a class link" required>
                        </div>

                        <div class="form-group">
                            <label for="schedule">Select Schedule</label>
                            <input type="datetime-local" name="date_time" id="schedule" class="form-control" required>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status_active" value="Active"
                                checked>
                            <label class="form-check-label" for="status_active">
                                Active
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status_inactive"
                                value="In-active">
                            <label class="form-check-label" for="status_inactive">
                                In-active
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Schedule</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.schedule.update', ['schedule' => 'schedule_id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="class_name">Class Name</label>
                            <input type="text" name="name" id="class_name" class="form-control" placeholder="Enter a class name" required>
                        </div>

                        <div class="form-group">
                            <label for="class_link">Class Link</label>
                            <input type="text" name="link" id="class_link" class="form-control" placeholder="Enter a class link" required>
                        </div>

                        <div class="form-group">
                            <label for="schedule">Select Schedule</label>
                            <input type="datetime-local" name="date_time" id="schedule" class="form-control" required>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status_active" value="Active" required>
                            <label class="form-check-label" for="status_active">Active</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status_inactive" value="In-active">
                            <label class="form-check-label" for="status_inactive">In-active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).on('click', '.show_confirm', function(event) {
            var form = $(this).closest("form");
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form if the user confirms
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function () {
            // Copy link to clipboard
            document.querySelectorAll('.copy-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const linkInput = document.getElementById(`link_${id}`);
                    linkInput.style.display = 'block'; // Temporarily show the input to copy the value
                    linkInput.select();
                    document.execCommand('copy');
                    linkInput.style.display = 'none'; // Hide it again

                    Swal.fire({
                        toast: true,
                        position: 'bottom-end', // Position at the bottom-right
                        icon: 'success',
                        title: 'Link copied to clipboard!',
                        showConfirmButton: false,
                        timer: 1500, // Automatically disappears after 1.5 seconds
                        timerProgressBar: true, // Shows a progress bar
                        background: '#fff', // Optional: customize background color
                        color: '#000' // Optional: customize text color
                    });


                });
            });

            // CSRF Token (directly embedded)
            const csrfToken = '{{ csrf_token() }}';

            // Update status dynamically using AJAX
            document.querySelectorAll('.update-status').forEach(select => {
                select.addEventListener('change', function () {
                    const id = this.getAttribute('data-id');
                    const status = this.value;

                    fetch(`/admin/schedule/${id}/update-status`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ status }),
                    })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                title: 'Success!',
                                text: 'The status has been updated successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });

                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Success!',
                                text: 'The status has been updated successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        });
                });
            });

        });


        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var scheduleId = button.data('id');
            var name = button.data('name');
            var link = button.data('link');
            var dateTime = button.data('date_time');
            var status = button.data('status');

            var modal = $(this);

            // Set form inputs
            modal.find('#class_name').val(name);
            modal.find('#class_link').val(link);
            modal.find('#schedule').val(dateTime);

            if (status === 'Active') {
                modal.find('#status_active').prop('checked', true);
                modal.find('#status_inactive').prop('checked', false);
            } else {
                modal.find('#status_inactive').prop('checked', true);
                modal.find('#status_active').prop('checked', false);
            }

            // Update the form action URL with the schedule ID
            var formAction = '{{ route('admin.schedule.update', ['schedule' => ':id']) }}';
            formAction = formAction.replace(':id', scheduleId);
            modal.find('form').attr('action', formAction);
        });


    </script>
@endpush
