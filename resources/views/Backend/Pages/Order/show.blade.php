@extends("Backend.Layouts.master")
@push('css')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Blog')
@section('master-content')
<section id="column">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-4">
                            <form action="{{ route('admin.order.paymentStatus', $order->id) }}" onchange="submit()" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Payment Status</label>
                                    <select name="payment_status" class="form-control" id="">
                                        <option value="Seventy-percent" {{ $order->payment_status == 'Seventy-percent' ? 'selected' : '' }}>Seventy-percent</option>
                                        <option value="Thirty-percent" {{ $order->payment_status == 'Thirty-percent' ? 'selected' : '' }}>Thirty-percent</option>
                                        <option value="Un-paid" {{ $order->payment_status == 'Un-Paid' ? 'selected' : '' }}>Un-paid</option>
                                        <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="col-4">
                            <form action="{{ route('admin.order.orderStatus', $order->id) }}" onchange="submit()" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Order Status</label>
                                    <select name="delivery_status" class="form-control" id="">
                                        <option value="Pending" {{ $order->delivery_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Confirmed" {{ $order->delivery_status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="In-progress" {{ $order->delivery_status == 'In-progress' ? 'selected' : '' }}>In-progress</option>
                                        <option value="Delivered" {{ $order->delivery_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="" style="opacity: 0">Back</label>
                                <a style="display: block" class="btn btn-primary" href="{{ route('admin.order.index') }}"><i style="font-size: 18px" class="fa-solid fa-reply-all"></i></a>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="">
                            <table>
                                <tr>
                                    <td style="padding:5px 20px">{{ $order->user ? $order->user->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px 20px">{{ $order->user ? $order->user->email : '' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px 20px">{{ $order->user ? $order->user->mobile : '' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px 20px">{{ $order->user ? $order->user->address : '' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px 20px">{{ $order->user ? $order->user->country : 'Bangladesh' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="text-right">
                            <table>
                                <tr>
                                    <td style="padding:5px 20px">Order #</td>
                                    <td style="padding:5px 20px">{{ $order->order_id }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px 20px">Order status </td>
                                    <td style="padding:5px 20px"><span class="badge badge-primary ml-3">{{ $order->delivery_status }}</span></td>
                                </tr>
                                <tr>
                                    <td style="padding:5px 20px">Order date </td>
                                    <td style="padding:5px 20px">{{ $order->created_at->format('d-m-Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px 20px">Total amount </td>
                                    <td style="padding:5px 20px">{{ $order->total }} Tk</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px 20px">Payment method </td>
                                    <td style="padding:5px 20px">{{ $order->payment_method ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Bookkeeping: QuickBooks Online & Xero</td>
                                <td>{{$order->total }}</td>
                                <td>1</td>
                                <td>{{$order->total }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-4 col-of">
                            <table class="table">
                                <tr>
                                    <td>Sub Total :</td>
                                    <td>{{ number_format($order->sub_total) }} Taka</td>
                                </tr>
                                <tr>
                                    <td>Total :</td>
                                    <td style="font-weight: 900">{{ number_format($order->total) }} Taka</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <a target="_blank" href="{{ route('admin.order.DownloadOrderPDF', $order->id) }}"
                           style="width: 50px; height: 50px; background: #00a4f0; color: #fff; text-align: center; line-height: 50px; border-radius: 5px; margin-right: 10px;">
                            <i class="fa-solid fa-print" style="font-size: 20px"></i>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        $('.editProduct').click(function(event) {

            var categoryId = $(this).data("id");

            $.ajax({
                url: '/admin/quick-shopping-category/' + categoryId + '/' + 'edit'
                , type: 'GET'
                , dataType: 'json'
                , success: function(res) {
                    $('#editId').val(res.id);
                    $('#editName').val(res.name);
                }
                , error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

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
    </script>
@endpush

