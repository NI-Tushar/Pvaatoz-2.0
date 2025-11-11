@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('breadcrumb', 'All Assessment')
@section('previous-menu', 'Assessment')
@section('active-menu', 'All Assessment')
@section('master-content')
<div class="row">
    <div class="col-md-12">
        <section>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end align-items-center">
                        <div>
                            <!-- Search input -->
                            <input type="text" id="searchInput" placeholder="Search..." class="form-control mb-3"
                                style="width: 250px;margin-left:auto">
                        </div>
                    </div>
                    <div class="table-wrapper table-responsive"
                        style="height: calc(100vh - 280px);overflow-x: auto;overflow-x: auto;white-space: nowrap;">
                        <table id="activityTable" class="table table-bordered">
                            <thead class="table">
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Proffered Education</th>
                                    <th>Proffered Country</th>
                                    <th>Price</th>
                                    <th>Duration</th>
                                    <th>Cousultants</th>
                                    <th>Status</th>
                                    <th>Report</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($assessments as $assessment)
                                    <tr>
                                        <td class="sticky">{{ $loop->index + 1 }}</td>
                                        <td>{{ $assessment->created_at->format('l, F j, Y') }}</td>
                                        <td>{{ $assessment->proffered_education }}</td>
                                        <td>{{ $assessment->proffered_country }}</td>
                                        <td>{{ $assessment->amount }}</td>
                                        <td>{{ $assessment->duration }}</td>
                                        <td>{{ $assessment->consultant->name }}</td>
                                        <td>{{ $assessment->status }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                @if ($assessment->status == 'Completed')
                                                <a href="" class="btn btn-sm btn-outline-primary">Report</a>
                                                @else
                                                    <span>Processing</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-end">
                        {{ $assessments->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </section>
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

        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#activityTable tbody tr');

            rows.forEach(function(row) {
                // Convert row text content to lowercase and check if it includes the search input
                var rowText = row.textContent.toLowerCase();
                if (rowText.includes(input)) {
                    row.style.display = ''; // Show row if it matches the search query
                } else {
                    row.style.display = 'none'; // Hide row if it doesn't match
                }
            });
        });

    // Clear modal data and backdrop when it is hidden
    $('#activityViewModla').on('hidden.bs.modal', function() {
        // Optional: Ensure backdrop is removed
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
    });

    </script>
@endpush
