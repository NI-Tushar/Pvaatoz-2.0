@extends("Backend.Layouts.master")
@section('title', 'Slider/Create')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Create a new slider</h5>
                <a href="{{ route('admin.slider.index') }}" class="btn btn-md btn-outline-primary"><i class="fa-solid fa-reply"></i></a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="m-2 card">
                            <div class="card-header">
                                <h6>Basic Information</h6>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="form-group">
                                        <label for="sub_title" class="form-label">Sub Title</label>
                                        <input type="text" name="sub_title" type="text" class="form-control char-count" data-limit="30">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                  @error('sub_title')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                  @enderror
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" type="text" class="form-control char-count" data-limit="80">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/80</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                  @error('title')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                  @enderror
                                </div>
                            </div>
                        </div>
                        <div class="m-2 mt-4 card">
                            <div class="card-header">
                                <h6>Image Gallary</h6>
                            </div>
                            <div class="card-body">
                                <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; margin-top: 10px;">
                                    <img id="ImagePreview" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('img-preview.png') }}" alt="">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;"
                                         onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                        <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                        <input style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" type="file" name="image" id="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="m-2 card">
                            <div class="card-header">
                                <h6>Content Body</h6>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control char-count" rows="17" data-limit="500"></textarea>
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                            <small style="font-size: 16px" class="form-text text-muted counter">0/500</small>
                                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                    @error('description')
                                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; margin-top:10px">
                    <button type="submit" class="btn btn-primary d-flex justify-content-end align-items-center" style="gap: .5em;">
                        <i class="fa-solid fa-floppy-disk"></i>Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('#ImagePreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function(){
            readURL(this);
    });

</script>
@endpush
