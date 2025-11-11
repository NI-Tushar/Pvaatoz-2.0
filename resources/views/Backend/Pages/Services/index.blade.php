@extends("Backend.Layouts.master")
@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Services')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Manage Services</h5>
            @canAny(['isAdmin', 'isEditor'])
             <a href="{{ route('admin.services.create') }}" class="btn btn-md btn-outline-primary"><i class="mr-1 fa-solid fa-plus"></i> Add New</a>
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
                  <th>Service Title</th>
                  <th>Description</th>
                  <th>Icon</th>
                  <th>Thumbnail</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($services as $service)
                <tr>
                    <td>{{ $loop-> index + 1 }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>
                       <div style="width: 100px; height:50px;">
                        <img style="width: 100%;height:100%;object-fit:cover" src="{{ $service->icon_image ? asset('storage/' . $service->icon_image) : asset('no_image.jpg') }}" alt="">
                       </div>
                    </td>
                    <td>
                       <div style="width: 100px; height:50px;">
                        <img style="width: 100%;height:100%;object-fit:cover" src="{{ $service->image_path ? asset('storage/' . $service->image_path) : asset('no_image.jpg') }}" alt="">
                       </div>
                    </td>
                    <td style="display:flex;gap:4px;">
                        <!-- <a href="" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-eye"></i></a> -->
                         @if( $service->status == 'active')
                          <a style="margin-top:3px;" href="" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-toggle-on"></i></a>
                         @else
                          <a style="margin-top:3px;" href="" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-toggle-off"></i></a>
                         @endif
                          <a style="margin-top:3px;" href="{{ route('admin.adminService.update', $service->id) }}" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                        @canAny(['isAdmin', 'isEditor'])
                          <a href="{{ route('admin.services.delete', $service->id) }}">
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
