@extends("Backend.Layouts.master")
@section('title', 'Studylevel/Create')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Create a new StudyLevel</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="{{ route('admin.slider.index') }}" class="btn btn-md btn-outline-primary"><i class="fa-solid fa-reply"></i></a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.studylevel.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="m-2 card">
                            <div class="card-header">
                                <h6>StudyLevel Information</h6>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="form-group">
                                        <label for="name" class="form-label">StudyLevel Name</label>
                                        <input type="text" name="name" type="text" class="form-control char-count" data-limit="30" value="{{ old('name') }}">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                  @error('sub_title')
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
