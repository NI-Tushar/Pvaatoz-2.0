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
        <div class="card-header px-2 py-2">
            <div class="d-flex justify-content-left align-items-left">
                <button type="button" style="color:aliceblue !important;" class="btn btn-success transaction_action" data-bs-toggle="modal"
                    data-bs-target="#addModal">
                   <i class="fa-solid fa-money-bill-transfer"></i> Request Withdrawals
                </button>
                <a href="{{ route('consultant.transaction.history') }}" class="btn btn-primary transaction_action"><i class="fa-solid fa-clock-rotate-left"></i> Transaction history</a>
                {{-- <a href="consultant.transaction.set-method" target="_blank"> --}}
                <button type="button" style="color:aliceblue !important;" class="btn btn-secondary transaction_action" data-bs-toggle="modal"
                    data-bs-target="#addModal2">
                    <i class="fa-solid fa-money-check-dollar"></i> Set withdrawal method
                </button>
                {{-- </a> --}}
                <button type="button" style="color:black !important;" class="btn transaction_action">
                    <i class="fa-solid fa-wallet"></i><span class="me-3"> Balance: {{auth()->user()->balance}} <i class="fa-solid fa-bangladeshi-taka-sign"></i></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table_heading">
                <h4><i class="fa-solid fa-money-bill-trend-up"></i> Your Earnings</h4>
            </div>
            <div class="table-wrapper table-responsive"
                style="height: calc(100vh - 320px);overflow-x: auto;white-space: nowrap;">
                <table class="table table-bordered" id="sectorTable" style="min-width:1000px;">
                    @if (Session::has('amount_error'))
                        <p
                            style="color:red;font-weight:700; font-size:17px; width:100%;text-align:center; margin:0;padding:0;">
                            {{ Session::get('amount_error') }}</p>
                    @endif
                    @if ($transactions->isNotEmpty())
                        <thead>
                            <tr style="background-color:#0e589166 !important;">
                                <th style="color:var(--primary-color) !important;">Sl</th>
                                <th style="color:var(--primary-color) !important;">Student Name</th>
                                <th style="color:var(--primary-color) !important;">Task Name</th>
                                <th style="color:var(--primary-color) !important;">Request Date</th>
                                <th style="color:var(--primary-color) !important;">Finish Date</th>
                                <th style="color:var(--primary-color) !important;">Amount</th>
                                <th style="color:var(--primary-color) !important;">Withdrawl Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $transaction->student->name ?? 'N/A' }}</td>
                                    <td>{{ $transaction->service_name }}</td>
                                    <td>{{ $transaction->created_at->format('l, F j, Y') }}</td>
                                    <td>{{ $transaction->updated_at->format('l, F j, Y') }}</td>
                                    <td>{{ $transaction->assessment_charge }} <i class="fa-solid fa-bangladeshi-taka-sign"></i></td>
                                    <td>{{ $transaction->assessment_charge }} <i class="fa-solid fa-bangladeshi-taka-sign"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <div class="no_data_section">
                            <div class="empty-state" style="margin-top:-30px !important;">
                                <div class="empty-state__content">
                                    <div class="empty-state__icon"><img style="height:100px; width:auto;"
                                            src="{{ asset('no-data-image.png') }}" alt=""></div>
                                    <div class="empty-state__message" style="font-size:14px;margin-top:-30px;">No Completed
                                        Assessments Yet</div>
                                    <div class="empty-state__help" style="font-size:14px;">Complete some assessments to see
                                        them here</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </table>
            </div>
            <!-- Pagination Links -->
            @if ($transactions->isNotEmpty())
                <div class="d-flex flex-wrap justify-content-end align-items-center mt-2">
                    {{ $transactions->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>


    <!-- Request Withdrawals Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-money-bill-transfer"></i> Request Withdrawal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('consultant.transaction.withdrawal.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <!-- Hidden Payment Method Field (Populated by JavaScript) -->
                        <input type="hidden" name="payment_method" id="payment_method"
                            value="{{ $accountDetails->account_type ?? '' }}">

                        <!-- Common Fields -->
                        <div class="form-group mb-3">
                            <label for="account_holder_name">Account Holder Name</label>
                            <input type="text" name="account_holder_name" id="account_holder_name" class="form-control"
                                value="{{ $accountDetails->account_holder_name ?? '' }}" required readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email_address">Email Address</label>
                            <input type="email" name="email_address" id="email_address" class="form-control"
                                value="{{ $accountDetails->email_address ?? '' }}" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control"
                                value="{{ $accountDetails->phone_number ?? '' }}" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control"
                                placeholder="Minimum 500 BDT" required>
                        </div>

                        <!-- Mobile Banking Fields (Initially Hidden) -->
                        <div id="mobile_banking_fields_modal1" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="mobile_bank_type_modal1">Mobile Bank Type</label>
                                <select name="mobile_bank_type" id="mobile_bank_type_modal1" class="form-control">
                                    <option value="" disabled>Select Mobile Bank</option>
                                    <option value="Bkash"
                                        {{ ($accountDetails->mobile_bank_type ?? '') == 'Bkash' ? 'selected' : '' }}>Bkash
                                    </option>
                                    <option value="Nagad"
                                        {{ ($accountDetails->mobile_bank_type ?? '') == 'Nagad' ? 'selected' : '' }}>Nagad
                                    </option>
                                    <option value="Rocket"
                                        {{ ($accountDetails->mobile_bank_type ?? '') == 'Rocket' ? 'selected' : '' }}>
                                        Rocket</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="mobile_bank_number_modal1">Mobile Banking Number</label>
                                <input type="text" name="mobile_bank_number" id="mobile_bank_number_modal1"
                                    class="form-control" value="{{ $accountDetails->mobile_bank_number ?? '' }}" readonly>
                            </div>
                        </div>

                        <!-- Bank Account Fields (Initially Hidden) -->
                        <div id="bank_account_fields_modal1" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="bank_name_modal1">Bank Name</label>
                                <input type="text" name="bank_name" id="bank_name_modal1" class="form-control"
                                    value="{{ $accountDetails->bank_name ?? '' }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="account_number_modal1">Account Number</label>
                                <input type="text" name="account_number" id="account_number_modal1"
                                    class="form-control" value="{{ $accountDetails->account_number ?? '' }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="branch_name_modal1">Branch Name</label>
                                <input type="text" name="branch_name" id="branch_name_modal1" class="form-control"
                                    value="{{ $accountDetails->branch_name ?? '' }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="routing_number_modal1">Routing Number</label>
                                <input type="text" name="routing_number" id="routing_number_modal1"
                                    class="form-control" value="{{ $accountDetails->routing_number ?? '' }}" readonly>
                            </div>
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
    <!-- Add Modal 2 -->
    <div class="modal fade" id="addModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-money-check-dollar"></i> Add Payment Method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('consultant.transaction.set-method') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <!-- Account Type Selection -->
                        <div class="form-group mb-3">
                            <label for="account_type">Account Type</label>
                            <select name="account_type" id="account_type" class="form-control" required>
                                <option value="" selected disabled>Select Account Type</option>
                                <option value="Bank Account"
                                    {{ ($accountDetails->account_type ?? '') === 'Bank Account' ? 'selected' : '' }}>Bank
                                    Account</option>
                                <option value="Mobile Banking"
                                    {{ ($accountDetails->account_type ?? '') === 'Mobile Banking' ? 'selected' : '' }}>
                                    Mobile Banking</option>
                            </select>
                        </div>

                        <!-- Mobile Banking Fields (initially hidden) -->
                        <div id="mobile_banking_fields_modal2" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="mobile_bank_type_modal2">Mobile Bank Type</label>
                                <select name="mobile_bank_type" id="mobile_bank_type_modal2" class="form-control">
                                    <option value="" selected disabled>Select Mobile Bank</option>
                                    <option value="Bkash"
                                        {{ ($accountDetails->mobile_bank_type ?? '') === 'Bkash' ? 'selected' : '' }}>Bkash
                                    </option>
                                    <option value="Nagad"
                                        {{ ($accountDetails->mobile_bank_type ?? '') === 'Nagad' ? 'selected' : '' }}>Nagad
                                    </option>
                                    <option value="Rocket"
                                        {{ ($accountDetails->mobile_bank_type ?? '') === 'Rocket' ? 'selected' : '' }}>
                                        Rocket</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="mobile_bank_number_modal2">Mobile Banking Number</label>
                                <input type="text" name="mobile_bank_number" id="mobile_bank_number_modal2"
                                    class="form-control" value="{{ $accountDetails->mobile_bank_number ?? '' }}">
                            </div>
                        </div>

                        <!-- Bank Account Fields (initially hidden) -->
                        <div id="bank_account_fields_modal2" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="bank_name_modal2">Bank Name</label>
                                <input type="text" name="bank_name" id="bank_name_modal2" class="form-control"
                                    value="{{ $accountDetails->bank_name ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="account_number_modal2">Account Number</label>
                                <input type="text" name="account_number" id="account_number_modal2"
                                    class="form-control" value="{{ $accountDetails->account_number ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="branch_name_modal2">Branch Name</label>
                                <input type="text" name="branch_name" id="branch_name_modal2" class="form-control"
                                    value="{{ $accountDetails->branch_name ?? '' }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="routing_number_modal2">Routing Number</label>
                                <input type="text" name="routing_number" id="routing_number_modal2"
                                    class="form-control" value="{{ $accountDetails->routing_number ?? '' }}">
                            </div>
                        </div>

                        <!-- Common Fields -->
                        <div class="form-group mb-3">
                            <label for="account_holder_name">Account Holder Name</label>
                            <input type="text" name="account_holder_name" id="account_holder_name"
                                class="form-control" value="{{ $accountDetails->account_holder_name ?? '' }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email_address">Email Address</label>
                            <input type="email" name="email_address" id="email_address" class="form-control"
                                value="{{ $accountDetails->email_address ?? '' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control"
                                value="{{ $accountDetails->phone_number ?? '' }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
    <script>
        document.getElementById('addModal').addEventListener('shown.bs.modal', function() {
            const paymentMethod = document.getElementById('payment_method').value;
            const mobileBankingFields = document.getElementById('mobile_banking_fields_modal1');
            const bankAccountFields = document.getElementById('bank_account_fields_modal1');

            function toggleFields() {
                if (paymentMethod === 'Mobile Banking') {
                    mobileBankingFields.style.display = 'block';
                    bankAccountFields.style.display = 'none';

                    document.getElementById('mobile_bank_type_modal1').setAttribute('required', '');
                    document.getElementById('mobile_bank_number_modal1').setAttribute('required', '');
                    if (document.getElementById('bank_name_modal1')) {
                        document.getElementById('bank_name_modal1').removeAttribute('required');
                        document.getElementById('account_number_modal1').removeAttribute('required');
                        document.getElementById('branch_name_modal1').removeAttribute('required');
                    }
                } else if (paymentMethod === 'Bank Account') {
                    mobileBankingFields.style.display = 'none';
                    bankAccountFields.style.display = 'block';

                    document.getElementById('bank_name_modal1').setAttribute('required', '');
                    document.getElementById('account_number_modal1').setAttribute('required', '');
                    document.getElementById('branch_name_modal1').setAttribute('required', '');
                    if (document.getElementById('mobile_bank_type_modal1')) {
                        document.getElementById('mobile_bank_type_modal1').removeAttribute('required');
                        document.getElementById('mobile_bank_number_modal1').removeAttribute('required');
                    }
                } else {
                    mobileBankingFields.style.display = 'none';
                    bankAccountFields.style.display = 'none';
                    alert('Please set a withdrawal method first.');
                    window.location.href = '#addModal2';
                }
            }

            toggleFields();
        });
    </script>

    <script>
        document.getElementById('addModal2').addEventListener('shown.bs.modal', function() {
            initializeAccountTypeLogic();
        });

        function initializeAccountTypeLogic() {
            const accountTypeSelect = document.getElementById('account_type');
            const mobileBankingFields = document.getElementById('mobile_banking_fields_modal2');
            const bankAccountFields = document.getElementById('bank_account_fields_modal2');

            if (!accountTypeSelect) {
                console.error('Account type select element not found');
                return;
            }

            function toggleFields() {
                if (accountTypeSelect.value === 'Mobile Banking') {
                    mobileBankingFields.style.display = 'block';
                    bankAccountFields.style.display = 'none';

                    document.getElementById('mobile_bank_type_modal2').setAttribute('required', '');
                    document.getElementById('mobile_bank_number_modal2').setAttribute('required', '');
                    if (document.getElementById('bank_name_modal2')) {
                        document.getElementById('bank_name_modal2').removeAttribute('required');
                        document.getElementById('account_number_modal2').removeAttribute('required');
                        document.getElementById('branch_name_modal2').removeAttribute('required');
                    }
                } else if (accountTypeSelect.value === 'Bank Account') {
                    mobileBankingFields.style.display = 'none';
                    bankAccountFields.style.display = 'block';

                    document.getElementById('bank_name_modal2').setAttribute('required', '');
                    document.getElementById('account_number_modal2').setAttribute('required', '');
                    document.getElementById('branch_name_modal2').setAttribute('required', '');
                    if (document.getElementById('mobile_bank_type_modal2')) {
                        document.getElementById('mobile_bank_type_modal2').removeAttribute('required');
                        document.getElementById('mobile_bank_number_modal2').removeAttribute('required');
                    }
                } else {
                    mobileBankingFields.style.display = 'none';
                    bankAccountFields.style.display = 'none';
                }
            }

            // Fetch data and populate fields
            fetchExistingData(toggleFields);

            // Add change listener for dynamic updates
            accountTypeSelect.addEventListener('change', toggleFields);
        }

        function fetchExistingData(callback) {
            @if (auth()->check())
                fetch("{{ route('consultant.account.details') }}", {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data) {
                            // Populate fields
                            const accountType = document.getElementById('account_type');
                            if (accountType) accountType.value = data.account_type || '';

                            if (data.account_type === 'Mobile Banking') {
                                const mobileBankType = document.getElementById('mobile_bank_type_modal2');
                                if (mobileBankType) mobileBankType.value = data.mobile_bank_type || '';
                                const mobileBankNumber = document.getElementById('mobile_bank_number_modal2');
                                if (mobileBankNumber) mobileBankNumber.value = data.mobile_bank_number || '';
                            } else if (data.account_type === 'Bank Account') {
                                const bankName = document.getElementById('bank_name_modal2');
                                if (bankName) bankName.value = data.bank_name || '';
                                const accountNumber = document.getElementById('account_number_modal2');
                                if (accountNumber) accountNumber.value = data.account_number || '';
                                const branchName = document.getElementById('branch_name_modal2');
                                if (branchName) branchName.value = data.branch_name || '';
                                const routingNumber = document.getElementById('routing_number_modal2');
                                if (routingNumber) routingNumber.value = data.routing_number || '';
                            }

                            const accountHolderName = document.getElementById('account_holder_name');
                            if (accountHolderName) accountHolderName.value = data.account_holder_name || '';
                            const emailAddress = document.getElementById('email_address');
                            if (emailAddress) emailAddress.value = data.email_address || '';
                            const phoneNumber = document.getElementById('phone_number');
                            if (phoneNumber) phoneNumber.value = data.phone_number || '';

                            // Trigger the toggleFields function after data is loaded
                            if (typeof callback === 'function') {
                                callback();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching account details:', error);
                        // Optional: Show user-friendly message
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to load account details. Please try again later.',
                        });
                    });
            @else
                console.warn('User not authenticated. Skipping data fetch.');
            @endif
        }
    </script>
@endpush
