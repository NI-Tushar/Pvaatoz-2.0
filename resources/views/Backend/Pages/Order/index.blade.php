@extends("Backend.Layouts.master")
@push('css')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Blog')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Manage Orders</h5>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 20px">Sl</th>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th style="width: 100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop-> index + 1 }}</td>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->total }}</td>
                        <td>
                            <div class="badge badge-info">{{ $order->payment_status }}</div>
                        </td>
                        <td>
                            <div class="flex-row d-flex bd-highlight" style="gap: .5em">
                                <a href="{{ route('admin.order.details', $order->id) }}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-eye"></i></a>
                                @canAny(['isAdmin', 'isEditor'])
                                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger show_confirm" data-toggle="tooltip" title='Delete'><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                @endcanAny
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination Links -->
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                {{-- {{ $leads->links('pagination::bootstrap-4') }} --}}
            </div>
          </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">

     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });


</script>
@endpush
