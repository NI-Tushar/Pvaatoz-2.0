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
             <a href="{{ route('admin.eduinfo.create') }}" class="btn btn-md btn-outline-primary"><i class="mr-1 fa-solid fa-plus"></i> Add New</a>
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
                  <th>Country</th>
                  <th>Institution</th>
                  <th>Next Branch</th>
                  <th>Location</th>
                  <th>Course</th>
                  <th>Entry Score</th>
                  <th>Study Level</th>
                  <th>Description</th>
                  <th>Budget</th>
                  <th>Scholarship</th>
                  <th>Home Enabled</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($eduIinfo as $info)
                <tr>
                    <td>{{ $loop-> index + 1 }}</td>
                    <td>{{$info->title}}</td>
                    <td>{{$info->country}}</td>
                    <td>{{$info->institution}}</td>
                    <td>{{$info->next_batch}}</td>
                    <td>{{$info->location}}</td>
                    <td>{{$info->course}}</td>
                    <td>{{$info->entry_score}}</td>
                    <td>{{$info->study_level}}</td>
                    <td>{{$info->description}}</td>
                    <td>{{$info->budget}} $</td>
                    <td>
                      @if($info->is_scholarship=='on')
                        {{$info->scholarship_percentage}} %
                      @endif
                    </td>
                    <td style="display:flex;gap:4px;">
                         @if( $info->home_enabled == 'active')
                          <a style="margin-top:3px;" href="{{ route('admin.existInfo.homeDisable', ['id' => $info->id]) }}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-toggle-on"></i></a>
                         @else
                          <a style="margin-top:3px;" href="{{ route('admin.existInfo.homeActive', ['id' => $info->id]) }}" class="btn btn-sm"><i class="fa-solid fa-toggle-off" style="color: rgba(0, 0, 0, 0.627);"></i></a>
                         @endif
                    </td>
                    <td style="display:flex;gap:4px;">
                        <!-- <a href="" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-eye"></i></a> -->
                         @if( $info->status == 'active')
                          <a style="margin-top:3px;" href="{{ route('admin.existInfo.disable', ['id' => $info->id]) }}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-toggle-on"></i></a>
                         @else
                          <a style="margin-top:3px;" href="{{ route('admin.existInfo.active', ['id' => $info->id]) }}" class="btn btn-sm"><i class="fa-solid fa-toggle-off" style="color: rgba(0, 0, 0, 0.627);"></i></a>
                         @endif
                        @canAny(['isAdmin', 'isEditor'])

                        <a href="{{ route('admin.eduinfo.delete', ['id' => $info->id]) }}">
                            <button style="margin-top:3px !important;" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </a>

                        <!-- <a href="javascript:void(0);" class="show_confirm" data-id="{{ $info->id }}">
                            <button style="margin-top:3px !important;" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </a> -->

                          <a href="{{ route('admin.existInfo.update', ['id' => $info->id]) }}">
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
    document.addEventListener("DOMContentLoaded", function() {
        $('.show_confirm').click(function(event) {
            event.preventDefault();

            const countryId = $(this).data('id');
            const deleteUrl = "{{ url('admin/eduinfo/delete') }}/" + countryId;

            swal({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = deleteUrl;
                }
            });
        });
    });
</script>
@endpush

