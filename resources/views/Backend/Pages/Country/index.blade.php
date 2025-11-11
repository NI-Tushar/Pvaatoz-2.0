@extends("Backend.Layouts.master")
@push('css')

@endpush
@section('title', 'Country')
@section('master-content')
<div class="card">
  
    <div class="card-header">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <h5 class="fw-bold mb-0">Manage Country</h5>

        <form id="filterForm" action="{{ route('admin.country.filter') }}" method="POST" class="flex-grow-1 mx-3 position-relative">
          @csrf
          <input type="text" id="country-search" name="name" class="form-control" placeholder="Search country...">
          <div id="search-suggestions" class="list-group position-absolute w-100" style="z-index: 1000; display:none;"></div>
        </form>

        <a href="{{ route('admin.country.index') }}" class="btn btn-outline-primary mx-3">
          All
        </a>

        @canAny(['isAdmin', 'isEditor'])
          <a href="{{ route('admin.country.create') }}" class="btn btn-outline-primary">
            <i class="fa-solid fa-plus me-1"></i> Add New
          </a>
        @endcanAny
      </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="country-table">
              <thead>
                @if (Session::has('success_message'))
                  <p style="color:aliceblue;font-weight:700;background-color:green; padding:5px; text-align:center;border-radius:3px;">{{ Session::get('success_message') }}</p>
                @endif
                @if (Session::has('error_message'))
                  <p style="color:aliceblue;font-weight:700;background-color:red; padding:5px; text-align:center;border-radius:3px;">{{ Session::get('success_message') }}</p>
                @endif
                <tr>
                  <th style="width: 20px">Sl</th>
                  <th>Country Name</th>
                  <th>Image</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody id="country-data">
              @foreach ($countries as $country)
                <tr>
                    <td>{{ $loop-> index + 1 }}</td>
                    <td>{{ $country->name }}</td>
                    <td>
                      <div class="image-container">
                        <img 
                          src="{{ $country->image ? asset('storage/' . $country->image) : asset('no_image.jpg') }}" 
                          alt="country image"
                          class="img-fluid rounded border selectable-img"
                          data-id="{{ $country->id }}"
                          style="width: 100px; height: 50px; object-fit: cover; cursor: pointer;">
                      </div>
                    </td>

                    <td style="display:flex;gap:4px;">
                        <!-- <a href="" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-eye"></i></a> -->
                         @if( $country->status == 'active')
                          <a style="margin-top:3px;" href="{{ route('admin.country.disable', $country->id) }}" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-toggle-on"></i></a>
                         @else
                          <a style="margin-top:3px;" href="{{ route('admin.country.active', $country->id) }}" class="btn btn-sm"><i class="fa-solid fa-toggle-off" style="color: rgba(0, 0, 0, 0.627);"></i></a>
                         @endif
                        @canAny(['isAdmin', 'isEditor'])
                            <a href="javascript:void(0);"  class="show_confirm" data-id="{{ $country->id }}">
                            <button style="margin-top:3px !important;" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title='Delete'><i class="fa-solid fa-trash"></i>
                          </button>
                          </a>
                        @endcanAny
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>


            <div class="d-flex justify-content-center mt-3">
                {{ $countries->links() }}
            </div>

            
          </div>
        </div>
      </div>
      
      <!-- Hidden form for image upload -->
      <form id="imageSelectForm" action="{{ route('admin.country.imageSelect') }}" method="POST" enctype="multipart/form-data" class="d-none">
        @csrf
        <input type="hidden" name="id" id="selectedCountryId">
        <input type="file" name="image" id="selectedImageFile" accept="image/*">
      </form>

@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
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
                window.location.href = "{{ route('admin.country.delete', '') }}/" + countryId;
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

@push('script')
<!-- country flag upload start -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
$(document).on('click', '.selectable-img', function() {
    // Get the country ID
    const countryId = $(this).data('id');
    $('#selectedCountryId').val(countryId);

    // Open file selector
    $('#selectedImageFile').click();
});

$('#selectedImageFile').on('change', function() {
    if (this.files.length > 0) {
        // Submit the form automatically after selecting a file
        $('#imageSelectForm').submit();
    }
});
</script>
<!-- country flag upload end -->

<script>
  $(document).ready(function() {
      const searchInput = $('#country-search');
      const suggestionBox = $('#search-suggestions');

      // Fetch suggestions
      searchInput.on('keyup', function() {
          let query = $(this).val().trim();
          if (query.length < 1) {
              suggestionBox.hide();
              return;
          }

          $.ajax({
              url: "{{ route('admin.country.search') }}",
              type: "GET",
              data: { q: query },
              success: function(data) {
                  suggestionBox.empty();
                  if (data.length > 0) {
                      data.forEach(item => {
                          suggestionBox.append(`
                              <button class="list-group-item list-group-item-action suggestion-item" data-name="${item.name}">
                                  ${item.name}
                              </button>
                          `);
                      });
                      suggestionBox.show();
                  } else {
                      suggestionBox.hide();
                  }
              }
          });
      });

      // Click suggestion → auto-submit form
      $(document).on('click', '.suggestion-item', function() {
          const name = $(this).data('name');
          searchInput.val(name);
          suggestionBox.hide();
          $('#filterForm').submit();
      });

      // Press Enter → submit form
      searchInput.on('keypress', function(e) {
          if (e.which === 13) {
              e.preventDefault();
              $('#filterForm').submit();
          }
      });
  });
</script>

@endpush
