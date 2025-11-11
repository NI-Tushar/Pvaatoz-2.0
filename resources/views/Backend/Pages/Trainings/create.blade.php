@extends("Backend.Layouts.master")
@section('title', 'Educational Info/Create')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Create a new Training</h5>
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
            <form action="{{ route('admin.trianingInfo.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="m-2 card">
                            <div class="card-header">
                                <h6>Training Information</h6>
                            </div>
                            <div class="card-body">
                                <div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control char-count" data-limit="50" value="{{ old('title') }}"
                                        placeholder="Enter the Title">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/50</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Training Type</label>
                                        <select id="service" name="service" class="form-control" required>
                                            <option value="" disabled selected>Select a Service</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->name }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Institution/Organization</label>
                                        <input type="text" name="organization" class="form-control char-count" data-limit="30" value="{{ old('organization') }}"
                                        placeholder="Enter the Organizaiton name">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control char-count" data-limit="50" value="{{ old('address') }}"
                                        placeholder="Enter the Address">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/50</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="name" class="form-label">language</label>
                                        <select id="service" name="language" class="form-control" required>
                                            <option value="" disabled selected>Select a Service</option>
                                            <option value="Bangla">Bangla</option>
                                            <option value="English">English</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Application Deadline</label>
                                        <input type="date" class="form-control char-count" name="app_deadline" id="" value="{{old('address')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control char-count" data-limit="30" value="{{ old('start_date') }}">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="m-2 mt-4 card">
                                        <div class="card-header">
                                            <h6>Thambnail</h6>
                                        </div>
                                        <div class="card-body">
                                            <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; margin-top: 10px;">
                                                <img id="ImagePreview" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('img-preview.png') }}" alt="">
                                                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;"
                                                    onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                                    <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                                    <input style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" type="file" name="thumbnail" id="image">
                                                </div>
                                            </div>
                                        </div>
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
                                        <label for="name" class="form-label">Duration</label>
                                        <input type="text" name="duration" class="form-control char-count" data-limit="30" value="{{ old('duration') }}"
                                        placeholder="Enter the duration of this trainig (In Month)">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Training Price/Charge</label>
                                        <input type="number" name="price" class="form-control char-count" data-limit="30" value="{{ old('price') }}"
                                        placeholder="Enter the Training Charge/Price">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="overview" class="form-label">Trainings Overview</label>
                                        <textarea style="color: rgba(0, 0, 0, 0.664);" name="overview" class="form-control char-count" rows="5" data-limit="500">
                                            Training Point one 
                                            Training Point two 
                                            Training Point three
                                        </textarea>
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                            <small style="font-size: 16px" class="form-text text-muted counter">0/500</small>
                                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                    @error('overview')
                                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror


                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control char-count" rows="8" data-limit="500"></textarea>
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                            <small style="font-size: 16px" class="form-text text-muted counter">0/500</small>
                                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                    @error('description')
                                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="name" class="form-label">Documents</label>
                                        <input type="file" name="documents" class="form-control char-count" value="{{ old('documents') }}">
                                    </div>

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
