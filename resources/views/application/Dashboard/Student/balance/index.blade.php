@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Balance')
@section('breadcrumb', 'Balance')
@section('previous-menu', 'Profile')
@section('active-menu', 'Balance')

<link rel="stylesheet" href="{{ url('Frontend/assets/css/balance.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/no_data_section.css') }}">

@section('master-content')
@push('css')
    <style>
        .copy-notification {
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    </style>
@endpush
@section('master-content')

<!-- Heading section start -->
<div class="d-flex align-items-center mb-2 mt-2">
    <div class="bg-primary bg-opacity-10 text-primary-main rounded-circle p-2 me-3">
        <i class="fa-solid fa-bangladeshi-taka-sign fa-2x"></i>
    </div>
    <div>
        <h3 class="fw-bold fs-4 mb-0">{{ __('message.your_balance') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Balance</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Heading section end -->

    <div class="bg-white mt-2 shadow-lg rounded-lg border border-gray-300">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center px-3 py-3 gap-3 border-b border-gray-200">
            <!-- Left side: Title -->
            <div class="sm:w-1/2 w-full">
                <h1 class="font-semibold text-primary-main text-[25px]"><i class="fa-solid fa-money-bill-transfer mr-2"></i>Your Transaction history</h1>
            </div>

            <!-- Right side: Search and Button -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3 w-full sm:w-auto">
                <input type="text" id="searchInput" placeholder="Search..."
                    class="border border-gray-300 rounded-md px-3 py-2 w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-[#0e5891]" />

                <button type="button"
                    class="bg-[#0e5891] text-white font-semibold px-4 py-2 rounded-md hover:bg-[#0c4a7a] transition w-full sm:w-auto"
                    data-bs-toggle="modal" data-bs-target="#addModal">
                    {{ __('message.add_balance') }} <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>


        <!-- Body -->
        <div class="p-3 overflow-x-auto h-[calc(100vh-320px)]">
            @if (Session::has('amount_error'))
                <p class="text-red-600 font-bold text-center text-lg mb-2">
                    {{ Session::get('amount_error') }}
                </p>
            @endif

            @if ($transactions->isNotEmpty())
                <!-- ✅ Added id="sectorTable" -->
                <table id="sectorTable" class="min-w-full border border-gray-200">
                    <thead class="bg-primary-gray">
                        <tr>
                            <th class="px-4 py-2 text-black font-semibold text-left">Sl</th>
                            <th class="px-4 py-2 text-black font-semibold text-left">Deposite Date</th>
                            <th class="px-4 py-2 text-black font-semibold text-left">Amount</th>
                            <th class="px-4 py-2 text-black font-semibold text-left">Method</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($transactions as $transaction)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $loop->index + 1 }}</td>
                                <td class="px-4 py-2">{{ $transaction->created_at->format('l, F j, Y') }}</td>
                                <td class="px-4 py-2">{{ $transaction->amount }}</td>
                                <td class="px-4 py-2">{{ $transaction->payment_method }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="flex flex-col items-center justify-center py-8 text-center">
                    <img src="{{ asset('no-data-image.png') }}" alt="No Data" class="h-24 mb-2" />
                    <p class="text-gray-600 text-sm font-medium">You Do Not Have Balance Yet</p>
                    <p class="text-gray-500 text-sm">Please Add Your Balance to Request Your Consultant</p>
                    <button type="button"
                        class="bg-[#0e5891] mt-3 text-white font-semibold px-4 py-2 rounded-md hover:bg-[#0c4a7a] transition"
                        data-bs-toggle="modal" data-bs-target="#addModal">
                        {{ __('message.add_balance') }} <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            @endif

            <!-- Pagination -->
            <div class="flex justify-end mt-3">
                {{ $transactions->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>


    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('student.transaction.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="number" name="amount" id="name" class="form-control"
                                placeholder="Minimum 500 BDT">
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
        document.getElementById('searchInput').addEventListener('keyup', function () {
            const input = this.value.toLowerCase();
            const rows = document.querySelectorAll('#sectorTable tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? '' : 'none';
            });
        });

    </script>
@endpush

