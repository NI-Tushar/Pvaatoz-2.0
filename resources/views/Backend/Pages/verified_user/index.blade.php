@extends("Backend.Layouts.master")
@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Educational Info')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Manage User Verification Request</h5>
            <!-- @canAny(['isAdmin', 'isEditor'])
             <a href="{{ route('admin.trianingInfo.create') }}" class="btn btn-md btn-outline-primary"><i class="mr-1 fa-solid fa-plus"></i> Add New</a>
            @endcanAny -->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered">
              <thead>
                @if (Session::has('success_message'))
                        <p style="color:aliceblue;font-weight:700;background-color:green; padding:5px; text-align:center;border-radius:3px;">{{ Session::get('success_message') }}</p>
                @endif
                @if (Session::has('error_message'))
                        <p style="color:aliceblue;font-weight:700;background-color:red; padding:5px; text-align:center;border-radius:3px;">{{ Session::get('success_message') }}</p>
                @endif
                <tr>
                  <th style="width: 20px">Sl</th>
                  <th>Image</th>
                  <th>User Name</th>
                  <th>User Type</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Join Date</th>
                  <th>Request Date</th>
                  <th style="width: 100px">Status</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($user_data as $data)
                <tr>
                    <td>{{ $loop-> index + 1 }}</td>
                    <td class="d-flex">
                        <div class="m-auto" style="width: auto; d-flex height:auto;">
                            <img style=" margin-auto; width: 40px;height:40px;" src="{{ $data->image ? asset('storage/' . $data->image) : asset('no-profile-img.png') }}" alt="">
                        </div>
                    </td>
                    <td>{{$data->user->name}}</td>
                    <td>{{$data->user->user_type}}</td>
                    <td>{{$data->user->email}}</td>
                    <td>{{$data->user->phone}}</td>
                    <td>{{ \Carbon\Carbon::parse($data->user->created_at)->format('d-F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-F Y') }}</td>
                    <td class="status">
                        <a href=""><i class="fa-solid fa-eye"></i></a>
                        @if($data->status == 'Pending')
                            <select class="Pending" onchange="updateStatus({{ $data->id }}, {{ $data->user->id }}, this)">
                            @elseif($data->status == 'In-Progress')
                                <select class="In-Progress" onchange="updateStatus({{ $data->id }}, {{ $data->user->id }}, this)">
                            @elseif($data->status == 'Accepted')
                                <select class="Accepted" onchange="updateStatus({{ $data->id }}, {{ $data->user->id }}, this)">
                            @elseif($data->status == 'Rejected')
                                <select class="Rejected" onchange="updateStatus({{ $data->id }}, {{ $data->user->id }}, this)">
                            @endif
                                    <option style="border:2px solid rgb(245, 167, 0) !important; 
                                    color: rgb(245, 167, 0) !important;" 
                                    value="Pending" {{ $data->status === 'Pending' ? 'selected' : '' }}>Pending</option>

                                    <option style="border:2px solid rgb(6, 109, 244) !important;
                                    color: rgb(6, 109, 244) !important;"
                                    value="In-Progress" {{ $data->status === 'In-Progress' ? 'selected' : '' }}>In-Progress</option>

                                    <option style="border:2px solid rgb(0, 184, 31) !important;
                                    color: rgb(0, 184, 31) !important;"
                                    value="Accepted" {{ $data->status === 'Accepted' ? 'selected' : '' }}>Accepted</option>

                                    <option style="border:2px solid rgb(247, 23, 23) !important;
                                    color: rgb(247, 23, 23) !important"
                                    value="Rejected" {{ $data->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
</div>
<style>
    .status{
        display:flex;
        gap:5px;
    }
    .status select{
        margin: auto;
        padding:3px 5px;
        border-radius:5px;
        outline:none;
    }
    .status a{
        margin:auto;
        border:1px solid rgb(6, 109, 244) !important;
        padding:3px 3px;
        border-radius:3px;
        cursor:pointer;
        colorL:rgb(6, 109, 244) !important;
    }
     .status a:hover{
        background-color: rgb(6, 109, 244) !important;
        color:white;
     }
    .status .Pending{
        border:2px solid rgb(245, 167, 0) !important;
        color: rgb(245, 167, 0) !important;
    }
    .status .In-Progress{
        border:2px solid rgb(6, 109, 244) !important;
        color: rgb(6, 109, 244) !important;
    }
    .status .Accepted{
        border:2px solid rgb(0, 184, 31) !important;
        color: rgb(0, 184, 31) !important;
    }
    .status .Rejected{
        border:2px solid rgb(247, 23, 23) !important;
        color: rgb(247, 23, 23) !important;
    }
</style>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    var deleteUrl = "{{ url('trianingInfo-deleted') }}";

    $('.show_confirm').click(function(event) {
        var countryId = $(this).data('id');
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
                window.location.href = deleteUrl + '/' + countryId;
            }
        });
    });


   function updateStatus(orderId, userId, selectElement) {
    console.log(userId, orderId, selectElement);
    var status = selectElement.value;
    window.location.href = "{{ route('admin.verification.updateStatus', ['status' => '__status__', 'orderId' => '__orderId__', 'user_id' => '__userId__']) }}"
        .replace('__status__', status)
        .replace('__orderId__', orderId)
        .replace('__userId__', userId);
}


</script>
@endpush
