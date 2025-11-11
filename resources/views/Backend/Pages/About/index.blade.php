@extends("Backend.Layouts.master")
@push('css')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'About')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Manage About us</h5>
                @canAny(['isAdmin', 'isEditor'])
                    <a href="{{ route('admin.about.create') }}" class="btn btn-md btn-outline-primary"><i class="fa-solid fa-plus mr-1"></i> Add New</a>
                @endcanAny
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 20px">Sl</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th style="width: 100px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($abouts as $about)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $about->title }}</td>
                        @php
                          $strippedContent  = strip_tags($about->description)
                        @endphp
                      <td> {!! Purifier::clean(Str::limit($strippedContent, 100)) !!}</td>
                      <td>
                        <div style="width: 50px; height:50px;">
                         <img style="width: 100%;height:100%;object-fit:cover" src="{{ asset($about->image) }}" alt="">
                        </div>
                     </td>
                        <td>
                            <a href="{{ route('admin.about.show', $about->slug) }}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-eye"></i></a>
                            @canAny(['isAdmin', 'isEditor'])
                                <a href="{{ route('admin.about.edit', $about->slug) }}" class="btn btn-sm btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form class="d-inline-block" action="{{ route('admin.about.destroy', $about->slug) }}" method="POST">
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
