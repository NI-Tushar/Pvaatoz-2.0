@extends("Backend.Layouts.master")
@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Course')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Manage Course</h5>
            @canAny(['isAdmin', 'isEditor'])
             <a href="{{ route('admin.course.create') }}" class="btn btn-md btn-outline-primary"><i class="mr-1 fa-solid fa-plus"></i> Add New</a>
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
                  <th>Course Name</th>
                  <th>Image</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($courses as $course)
                <tr>
                    <td>{{ $loop-> index + 1 }}</td>
                    <td>{{ $course->name }}</td>
                    <td>
                       <div style="width: 100px; height:50px;">
                        <img style="width: 100%;height:100%;object-fit:cover" src="{{ $course->image ? asset('storage/' . $course->image) : asset('no_image.jpg') }}" alt="">
                       </div>
                    </td>
                    <td style="display:flex;gap:4px;">
                        <!-- <a href="" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-eye"></i></a> -->
                         @if( $course->status == 'active')
                          <a style="margin-top:3px;" href="{{ route('admin.course.disable', $course->id) }}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-toggle-on"></i></a>
                         @else
                          <a style="margin-top:3px;" href="{{ route('admin.course.active', $course->id) }}" class="btn btn-sm"><i class="fa-solid fa-toggle-off" style="color: rgba(0, 0, 0, 0.627);"></i></a>
                         @endif
                        @canAny(['isAdmin', 'isEditor'])
                            <a href="javascript:void(0);"  class="show_confirm" data-id="{{ $course->id }}">
                            <button style="margin-top:3px !important;" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title='Delete'><i class="fa-solid fa-trash"></i>
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
    $('.show_confirm').click(function(event) {
        var CourseId = $(this).data('id');
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
                window.location.href = "{{ route('admin.course.delete', '') }}/" + CourseId;
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
