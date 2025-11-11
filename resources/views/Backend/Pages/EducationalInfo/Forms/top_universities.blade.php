@push('css')

<style>
  input{
    border: 1px solid rgba(0, 0, 0, 0.17) !important;
  }
  form p{
      font-weight:700;
      margin:0;
      padding:0;
      margin-top:15px
  }
  .auto-height-input {
      height: auto !important;
      padding: 4px 8px;
      line-height: 1.4;
  }
  .whole_data_box{
    display:flex;
    gap:5px;
  }
  .whole_data_box .data_box{
    width: 100%;
  }
  .update_form{
    padding:15px; 
    border-radius:7px; 
    background-color: aliceblue; 
    box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;"
  }
  </style>

    <script>
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.auto-grow').forEach(function (textarea) {
            autoResize(textarea);
        });
    });
</script>

@endpush
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Top Universities in <span style="font-weight:600;">{{$existInfo->country}}</span></h5>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('faild'))
            <div class="alert alert-success">
                {{ session('faild') }}
            </div>
        @endif

    </div>
    <div class="card-body">
        <div class="table-responsive" style="padding:10px;">

        @foreach ($top_universities as $university)
            <form class="update_form" action="{{route('admin.topUniversities.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($existInfo))
                <input type="hidden" name="id" value="{{ $university->id }}">
            @endif
            <div class="whole_data_box">
              <div class="data_box">
                <p>University or Institution Name</p>
                <input name="institution" class="form-control" type="text" value="{{ $university->institution }}">
              </div>
              <div class="data_box">
                <p>Global Ranking</p>
                <input name="ranking" class="form-control" type="number" value="{{ $university->ranking }}">
              </div>
            </div>

            <div class="whole_data_box">
              <div class="data_box">
                <p>Total Number of Students</p>
                <input name="number_of_students" class="form-control auto-grow" type="number" oninput="autoResize(this)" value="{{ $university->number_of_students }}">
              </div>
              <div class="data_box">
                <p>Short Description</p>
                <textarea name="short_desc" class="form-control auto-grow" oninput="autoResize(this)">{{ $university->short_desc }}</textarea>
              </div>
            </div>
            <div class="whole_data_box">
              <div class="data_box">
                <p>University Logo</p>
                <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 100px; height: 100px; margin-top: 10px;">
                  <img class="image-preview" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset($university->logo ? $university->logo : 'img-preview.png') }}" alt="">
                  <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;"
                      onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                      <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                      <input type="file" name="logo" class="image-input" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                  </div>
                </div>

              </div>
              <div class="data_box" style="display:flex;">
                           
                <div class="mt-auto" style="display:flex; gap:4px;">
                    <p style="margin-top:auto;margin-bottom:auto;">Action</p>
                    <a href="{{ route('admin.topUniversities.delete', $university->id) }}">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </a>
                    <button type="submit" class="btn btn-success p-0 pl-3 pr-3" style="font-size: 14px;">Update</button>
                </div>

              </div>
            </div>
          
          
            </form>
        @endforeach
        
          <h5 class="fw-bolder mt-5">Add New University</h5>
          <form action="{{route('admin.topUniversities.create')}}" method="POST" enctype="multipart/form-data">
              @csrf
                  @if(isset($existInfo))
                      <input type="hidden" name="info_id" value="{{ $existInfo->id }}">
                  @endif
                  <!-- ___________ blank input field start -->
                  <p>University or Institution Name</p>
                  <input class="form-control" name="institution" type="text"/>
                  <p>Short Description</p>
                  <textarea name="short_desc" rows="5" class="form-control auto-grow"></textarea>
                  <p>Global Ranking</p>
                  <input class="form-control" name="ranking" type="number">
                  <p>Total Number of Students</p>
                  <input class="form-control" name="number_of_students" type="number">
                  
                  <p>University Logo</p>
                  <div class="card-body">
                    <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 100px; height: 100px; margin-top: 10px;">
                      <img class="image-preview" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('img-preview.png') }}" alt="">
                      <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;"
                          onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                          <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                          <input type="file" name="logo" class="image-input" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                      </div>
                    </div>
                  </div>
                  <!-- ___________ blank input field start -->
              <button type="submit" class="btn btn-success mt-5">Save</button>
          </form>
          </div>
    </div>
</div>

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

$(document).ready(function () {
    $('.image-input').on('change', function () {
        let input = this;
        let reader = new FileReader();
        let previewImg = $(this).closest('div').siblings('img.image-preview');

        reader.onload = function (e) {
            previewImg.attr('src', e.target.result);
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    });
});

</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

