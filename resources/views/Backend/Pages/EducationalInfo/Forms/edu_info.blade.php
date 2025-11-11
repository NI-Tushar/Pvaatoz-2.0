 <form action="{{ route('admin.existInfo.update', ['id' => $existInfo->id ?? 0]) }}" method="POST" enctype="multipart/form-data" id="myForm">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="m-2 card">
                <div class="card-header">
                    <h6>Educational Information for <span style="font-weight:600;">{{$existInfo->country}}</span></h6>
                </div>
                <div class="card-body">
                    <div>

                        @if(isset($existInfo))
                            <input type="hidden" name="id" value="{{ $existInfo->id }}">
                        @endif

                        <style>
                            input{
                                border:1px solid black !important;
                            }
                        </style>

                        <div class="form-group">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control char-count" data-limit="100" value="{{ old('title', $existInfo->title ?? '') }}"
                            placeholder="Enter the Title">
                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/100</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Country</label>
                            <input type="text" name="country" class="form-control char-count" data-limit="30" value="{{ old('country', $existInfo->country ?? '') }}"
                            placeholder="Enter the country name">
                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Institution</label>
                            <input type="text" name="institution" class="form-control char-count" data-limit="30" value="{{ old('institution', $existInfo->institution ?? '') }}"
                            placeholder="Enter the University/College name">
                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Location</label>
                            <input type="text" name="location" class="form-control char-count" data-limit="30" value="{{ old('location', $existInfo->location ?? '') }}"
                            placeholder="Enter the location">
                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Next Branch</label>
                            <input type="text" name="next_batch" class="form-control char-count" data-limit="30" value="{{ old('next_batch', $existInfo->next_batch ?? '') }}"
                            placeholder="Enter the Next Batch">
                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Entry Score</label>
                            <input type="number" name="entry_score" class="form-control char-count" data-limit="30" value="{{ old('entry_score', $existInfo->entry_score ?? '') }}"
                            placeholder="Enter the Entry Score">
                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Course</label>
                            <input type="text" name="course" class="form-control char-count" data-limit="30" value="{{ old('course', $existInfo->course ?? '') }}"
                            placeholder="Enter the course name/title">
                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="m-2 mt-4 card">
                            <div class="card-header">
                                <h6>Card Banner Image</h6>
                            </div>
                            <div class="card-body">
                                <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; margin-top: 10px;">
                                    <img id="ImagePreview" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset($existInfo->card_banner ? $existInfo->card_banner : 'img-preview.png') }}" alt="">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;"
                                        onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                        <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                        <input style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" type="file" name="card_banner" id="image">
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
                            <label for="name" class="form-label">Study Level</label>
                            <input type="text" name="study_level" class="form-control char-count" data-limit="30" value="{{ old('study_level', $existInfo->study_level ?? '') }}"
                            placeholder="Enter the study Leve (Post Graduate, Bachelor, Masters, PhD)">
                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Budget</label>
                            <input type="number" name="budget" class="form-control char-count" data-limit="30" value="{{ old('budget', $existInfo->budget ?? '') }}"
                            placeholder="Enter the course budget (in doller)">
                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Is Scholarship ?</label>
                            <input type="checkbox" name="is_scholarship" style="margin-left:15px;height:20px;width:20px;" {{ old('is_scholarship', $existInfo->is_scholarship ?? false) ? 'checked' : '' }}>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Scholership Percentage</label>
                            <input type="number" name="scholarship_percentage" class="form-control char-count" data-limit="30" value="{{ old('scholarship_percentage', $existInfo->scholarship_percentage ?? '') }}"
                            placeholder="Enter the percangtage of of scholership">
                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control char-count" rows="17" data-limit="500">{{ old('description', $existInfo->description ?? '') }}</textarea>
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
            <i class="fa-solid fa-floppy-disk"></i>Update
        </button>
    </div>
</form>  