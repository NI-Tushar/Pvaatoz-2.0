@extends("Backend.Layouts.master")
@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Educational Info')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Manage Educational Info</h5>
            @canAny(['isAdmin', 'isEditor'])
             <a href="{{ route('admin.trianingInfo.create') }}" class="btn btn-md btn-outline-primary"><i class="mr-1 fa-solid fa-plus"></i> Add New</a>
            @endcanAny
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
                  <th>Title</th>
                  <th>Training Type</th>
                  <th>Description</th>
                  <th>Overview</th>
                  <th>Organization</th>
                  <th>Address</th>
                  <th>Languages</th>
                  <th>Apply Deadline</th>
                  <th>Start Date</th>
                  <th>Duration</th>
                  <th>Price</th>
                  <th>Documents</th>
                  <th>Thumbnail</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($trianingInfos as $info)
                <tr>
                    <td>{{ $loop-> index + 1 }}</td>
                    <td>{{$info->title}}</td>
                    <td>{{$info->training_type}}</td>
                    <td>{{$info->description}}</td>
                    <td>{{$info->overview}}</td>
                    <td>{{$info->organization}}</td>
                    <td>{{$info->address}}</td>
                    <td>{{$info->language}}</td>
                    <td>{{$info->app_deadline}}</td>
                    <td>{{$info->start_date}}</td>
                    <td>{{$info->duration}}</td>
                    <td>{{$info->price}} BDT</td>
                    <td> 
                      @if ($info->documents != null)
                        <img style="height:30px; width:30px; cursor:pointer;" src="https://cdn-icons-png.freepik.com/512/9061/9061169.png" alt="">
                      @endif
                    </td>
                    <td>
                       <div style="width: 100px; height:50px;">
                        <img style="width: 100%;height:100%;object-fit:cover" src="{{ $info->thumbnail ? asset('storage/' . $info->thumbnail) : asset('no_image.jpg') }}" alt="">
                       </div>
                    </td>
                    <td style="display:flex;gap:4px;">
                        <!-- <a href="" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-eye"></i></a> -->
                         @if( $info->status == 'active')
                          <a style="margin-top:3px;" href="{{ route('admin.trianingInfo.disable', ['id' => $info->id]) }}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-toggle-on"></i></a>
                         @else
                          <a style="margin-top:3px;" href="{{ route('admin.trianingInfo.active', ['id' => $info->id]) }}" class="btn btn-sm"><i class="fa-solid fa-toggle-off" style="color: rgba(0, 0, 0, 0.627);"></i></a>
                         @endif
                        @canAny(['isAdmin', 'isEditor'])
                          <!-- <a href="javascript:void(0);"  class="show_confirm" data-id="{{ $info->id }}"> -->
                          <a href="{{route('admin.trianingInfo.delete', ['id' => $info->id])}}">
                            <button style="margin-top:3px !important;" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title='Delete'>
                              <i class="fa-solid fa-trash"></i>
                            </button>
                          </a>
                          <a href="{{ route('admin.existTrainingInfo.update', ['id' => $info->id]) }}">
                            <button style="margin-top:3px !important;" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" title='Edit'>
                              <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                          </a>
                        @endcanAny
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
</div>
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
</script>


<!-- 
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
      }); -->

</script>
@endpush
