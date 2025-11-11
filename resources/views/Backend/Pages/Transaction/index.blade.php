@extends("Backend.Layouts.master")
@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Educational Info')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Manage Service Charge</h5>
            @canAny(['isAdmin', 'isEditor'])
             <a href="{{ route('admin.add.charge') }}" class="btn btn-md btn-outline-primary"><i class="mr-1 fa-solid fa-plus"></i> Add New</a>
            @endcanAny
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 20px">Sl</th>
                  <th>Service</th>
                  <th>User Type</th>
                  <th>Commission</th>
                  <th style="width: 100px">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($charge_data as $data)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{$data->service}}</td>
                    <td>@if($data->user_type == 'pro')
                        Pro Consultant
                        @else
                        {{$data->user_type}}
                        @endif
                    </td>
                    <td>{{$data->commission}} %</td>
                    <td class="d-flex">
                        <a href="javascript:void(0);" class="text-danger delete-charge" data-id="{{ $data->id }}"> <i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
</div>


<!--  alert message for sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 2000
    });
@endif
</script>

@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-charge').forEach(function (el) {
      el.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const url = `{{ url('/admin/delete-charge') }}/${id}`;

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to undo this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        });
      });
    });
  });

</script>
@endpush
