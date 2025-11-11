@extends("Backend.Layouts.master")
@push('css')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Testimonial')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Manage Leadership</h5>
                @canAny(['isAdmin', 'isEditor'])
                    <a href="{{ route('admin.testimonials.add') }}" class="btn btn-md btn-outline-success"><i class="mr-1 fa-solid fa-plus"></i> Add New</a>
                @endcanAny
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table  id="example1" class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 20px">Sl</th>
                      <th>Name</th>
                      <th>Designation</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th style="width: 200px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($testimonials as $testimonial)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $testimonial->name }}</td>
                        <td>{{ $testimonial->designation }}</td>
                        @php
                          $strippedContent  = strip_tags($testimonial->description)
                        @endphp
                      <td> {!! Purifier::clean(Str::limit($strippedContent, 100)) !!}</td>
                      <td>
                        <div style="width: 50px; height:50px;">
                          <img style="width: 100%; height: 100%; object-fit: cover" src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('no_image.jpg') }}" alt="asset('no_image.jpg');">
                        </div>
                     </td>
                        <td>
                            <!-- <a href="" class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></a> -->
                            @canAny(['isAdmin', 'isEditor'])
                                <!-- <a href="" class="btn btn-sm btn-info"><i class="fa-solid fa-pen-to-square"></i></a> -->
                                 <a  href="javascript:void(0);"  class="show_confirm text-danger" data-id="{{ $testimonial->id }}">
                                  <i class="fa-solid fa-trash"></i>
                                </a>
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
        var testimonial = $(this).data('id');
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
                window.location.href = "{{ route('admin.testimonials.delete', '') }}/" + testimonial;
            }
        });
    });
</script>
@endpush
