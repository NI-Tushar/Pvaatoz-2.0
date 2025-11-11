@extends("Backend.Layouts.master")
@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Pro User Packages')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Manage Pro User Packages</h5>
            @canAny(['isAdmin', 'isEditor'])
             <a href="{{ route('admin.userPackages.create') }}" class="btn btn-md btn-outline-primary"><i class="mr-1 fa-solid fa-plus"></i> Add New Package</a>
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
                  <th>Package Name</th>
                  <th>Level</th>
                  <th>Duration</th>
                  <th>Short Text</th>
                  <th>Price</th>
                  <th>Features</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($pro_packages as $data)
                <tr>
                    <td>{{ $loop-> index + 1 }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->level }}</td>
                    <td>{{ $data->duration }} month</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->price }} BDT</td>
                    <td>
                      @php
                          $features = !empty($data->features) ? json_decode($data->features, true) : [];
                          $index = 1;
                          $count = 0;
                      @endphp

                      <ul style="margin: 0; padding: 0;">
                          @foreach ($features as $feature)
                              @if ($count < 2)
                                  <li style="text-align: left; font-size: 14px; list-style:none;">
                                      <span style="font-weight: 700;">{{ $index }}:</span> {{ $feature }}
                                  </li>
                                  @php $count++; @endphp
                              @else
                                  @break
                              @endif
                              @php $index++; @endphp
                          @endforeach
                      </ul>
                  </td>

                    <td style="display:flex;gap:4px;">
                        <!-- <a href="" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-eye"></i></a> -->
                         @if( $data->status == 'active')
                          <a style="margin-top:3px;" href="{{ route('admin.userPackages.disabled', $data->id) }}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-toggle-on"></i></a>
                         @else
                          <a style="margin-top:3px;" href="{{ route('admin.userPackages.enabled', $data->id) }}" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-toggle-off"></i></a>
                         @endif
                          <a style="margin-top:3px;" href="{{ route('admin.userPackages.update', $data->id) }}" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
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
