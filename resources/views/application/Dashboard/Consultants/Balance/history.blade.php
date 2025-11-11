@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Balance')
@section('breadcrumb', 'Transactions')
@section('previous-menu', 'Profile')
@section('active-menu', 'Transactions')

<link rel="stylesheet" href="{{ url('Frontend/assets/css/balance.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">

@section('master-content')
    @push('css')
        <style>
            .copy-notification {
                animation: fadeIn 0.3s ease;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }
        </style>
    @endpush
@section('master-content')

    <div class="card">
        <div class="card-body">
            <div class="table-wrapper table-responsive"
                style="height: calc(100vh - 320px);overflow-x: auto;white-space: nowrap;">
                <table class="table table-bordered" id="sectorTable">
                    @if (Session::has('amount_error'))
                        <p
                            style="color:red;font-weight:700; font-size:17px; width:100%;text-align:center; margin:0;padding:0;">
                            {{ Session::get('amount_error') }}</p>
                    @endif
                    @if ($withdrawals->isNotEmpty())
                        <thead>
                            <tr style="background-color:#0e589166 !important;">
                                <th style="color:var(--primary-color) !important;">Sl</th>
                                <th style="color:var(--primary-color) !important;">Payment Method</th>
                                <th style="color:var(--primary-color) !important;">E-mail</th>
                                <th style="color:var(--primary-color) !important;">Amount</th>
                                <th style="color:var(--primary-color) !important;">Transaction Status</th>
                                <th style="color:var(--primary-color) !important;">Request Date</th>
                                <th style="color:var(--primary-color) !important;">Finish Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdrawals as $withdrawal)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $withdrawal->payment_method }}</td>
                                    <td>{{ $withdrawal->email_address }}</td>
                                    <td>{{ $withdrawal->amount }}</td>
                                    <td>{{ $withdrawal->transaction_status }}</td>
                                    <td>{{ $withdrawal->created_at->format('l, F j, Y') }}</td>
                                    <td>{{ $withdrawal->updated_at->format('l, F j, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <div class="no_data_section">
                            <div class="empty-state" style="margin-top:-30px !important;">
                                <div class="empty-state__content">
                                    <div class="empty-state__icon"><img style="height:100px; width:auto;"
                                            src="{{ asset('no-transaction-image.png') }}" alt=""></div>
                                    <div class="empty-state__message" style="font-size:14px;margin-top:-30px;">No Transaction Request Yet</div>
                                    <div class="empty-state__help" style="font-size:14px;">Create transaction request to see
                                        them here</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </table>
            </div>
            <!-- Pagination Links -->
            @if ($withdrawals->isNotEmpty())
                <div class="d-flex flex-wrap justify-content-end align-items-center mt-2">
                    {{ $withdrawals->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>

@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
                dangerMode: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form if the user confirms
                }
            });
        });

        // Search
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#sectorTable tbody tr');

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
    </script>
@endpush
