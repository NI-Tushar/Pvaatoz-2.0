@extends("Backend.Layouts.master")
@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'slider')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Manage Sliders</h5>
            @canAny(['isAdmin', 'isEditor'])
             <a href="{{ route('admin.slider.create') }}" class="btn btn-md btn-outline-primary"><i class="mr-1 fa-solid fa-plus"></i> Add New</a>
            @endcanAny
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 20px">Sl</th>
                  <th>Sub Title</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($sliders as $slider)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $slider->sub_title }}</td>
                    <td>{{ $slider->title }}</td>
                    @php
                      $strippedContent  = strip_tags($slider->description)
                    @endphp
                  <td> {!! Purifier::clean(Str::limit($strippedContent, 100)) !!}</td>
                    <td>
                       <div style="width: 100px; height:50px;">
                        <img style="width: 100%;height:100%;object-fit:cover" src="{{ asset($slider->image) }}" alt="">
                       </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.slider.show', $slider->slug) }}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-eye"></i></a>
                        @canAny(['isAdmin', 'isEditor'])
                            <a href="{{ route('admin.slider.edit', $slider->slug) }}" class="btn btn-sm btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="d-inline-block" action="{{ route('admin.slider.destroy', $slider->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger show_confirm" data-toggle="tooltip" title='Delete'><i class="fa-solid fa-trash"></i></button>
                            </form>
                        @endcanAny
                    </td>
                </tr>
                @empty
                    <span>Data Not Found</span>
                @endforelse
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