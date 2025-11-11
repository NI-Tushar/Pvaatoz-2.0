@extends("Backend.Layouts.master")
@section('title', 'Educational Info/Create')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Create a new Info</h5>
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
            <form action="{{ route('admin.eduinfo.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="m-2 card">
                            <div class="card-header">
                                <h6>Educational Information</h6>
                            </div>
                            <div class="card-body">
                                <div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control char-count" data-limit="30" value="{{ old('title') }}"
                                        placeholder="Enter the Title">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Country</label>
                                        <input type="text" name="country" class="form-control char-count" data-limit="30" value="{{ old('country') }}"
                                        placeholder="Enter the country name">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Institution</label>
                                        <input type="text" name="institution" class="form-control char-count" data-limit="30" value="{{ old('institution') }}"
                                        placeholder="Enter the University/College name">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Location</label>
                                        <input type="text" name="location" class="form-control char-count" data-limit="30" value="{{ old('location') }}"
                                        placeholder="Enter the location">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="name" class="form-label">Next Branch</label>
                                        <input type="text" name="next_batch" class="form-control char-count" data-limit="30" value="{{ old('next_batch') }}"
                                        placeholder="Enter the Next Batch">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Entry Score</label>
                                        <input type="number" name="entry_score" class="form-control char-count" data-limit="30" value="{{ old('entry_score') }}"
                                        placeholder="Enter the Entry Score">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Course</label>
                                        <input type="text" name="course" class="form-control char-count" data-limit="30" value="{{ old('course') }}"
                                        placeholder="Enter the course name/title">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
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
                                        <label for="name" class="form-label">Study Level</label>
                                        <input type="text" name="study_level" class="form-control char-count" data-limit="30" value="{{ old('study_level') }}"
                                        placeholder="Enter the study Leve (Post Graduate, Bachelor, Masters, PhD)">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Budget</label>
                                        <input type="number" name="budget" class="form-control char-count" data-limit="30" value="{{ old('budget') }}"
                                        placeholder="Enter the course budget (in doller)">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Is Scholarship ?</label>
                                        <input type="checkbox" name="is_scholarship" style="margin-left:15px;height:20px;width:20px;">
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Scholership Percentage</label>
                                        <input type="number" name="scholarship_percentage" class="form-control char-count" data-limit="30" value="{{ old('scholarship_percentage') }}"
                                        placeholder="Enter the percangtage of of scholership">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>

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
