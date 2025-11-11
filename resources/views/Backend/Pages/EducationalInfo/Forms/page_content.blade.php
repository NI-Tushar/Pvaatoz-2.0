 <form action="{{ route('admin.pageContent.update') }}" method="POST" enctype="multipart/form-data" id="myForm">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="m-2 card">
                <div class="card-header">
                    <h5>Page Content for <span style="font-weight:600;">{{$existInfo->country}}</span></h5>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
        
                @if(isset($existInfo))
                    <input type="hidden" name="info_id" value="{{ $existInfo->id }}">
                @endif

                <div class="card-body">
                    <div>
                    
                        <div class="form-group">
                            <label for="name" class="form-label">Page Heading</label>
                            <input type="text" style="border: 1px solid #ddd !important;" name="headline" class="form-control char-count" data-limit="150" value="{{ old('headline', $page_content->headline ?? '') }}">

                            <div class="d-flex align-items-center" style="gap: 1em">
                            <small style="font-size: 16px" class="form-text text-muted counter">0/150</small>
                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="form-label">Heading Description</label>
                            <textarea name="head_desc" class="form-control char-count" rows="5" data-limit="1000">{{ old('head_desc', $page_content->head_desc ?? '') }}</textarea>
                            <div class="d-flex align-items-center" style="gap: 1em">
                                <small style="font-size: 16px" class="form-text text-muted counter">0/1000</small>
                                <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>
                        
                        @error('description')
                            <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror

                        <div class="m-2 mt-4 card">
                            <div class="card-header">
                                <h6>Page Banner Image</h6>
                            </div>
                            <div class="card-body">
                                <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; margin-top: 10px;">
                                    <img id="bannerImagePreview" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset($page_content?->banner_image ?? 'img-preview.png') }}" alt="">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;"
                                        onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                        <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                        <input style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" type="file" name="banner_image" id="page_banner_image">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="description" class="form-label">Living Cost Details</label>
                            <textarea name="living_cost" class="form-control char-count" rows="3" data-limit="500">{{ old('living_cost', $page_content->living_cost ?? '') }}</textarea>
                            <div class="d-flex align-items-center" style="gap: 1em">
                                <small style="font-size: 16px" class="form-text text-muted counter">0/500</small>
                                <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="description" class="form-label">Academic Intake to Study Text</label>
                            <textarea name="academic_intake" class="form-control char-count" rows="3" data-limit="500">{{ old('academic_intake', $page_content->academic_intake ?? '') }}</textarea>
                            <div class="d-flex align-items-center" style="gap: 1em">
                                <small style="font-size: 16px" class="form-text text-muted counter">0/500</small>
                                <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Deadline Details</label>
                            <textarea name="deadline" class="form-control char-count" rows="3" data-limit="500">{{ old('deadline', $page_content->deadline ?? '') }}</textarea>
                            <div class="d-flex align-items-center" style="gap: 1em">
                                <small style="font-size: 16px" class="form-text text-muted counter">0/500</small>
                                <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Popular Programs Text</label>
                            <textarea name="populer_programs_text" class="form-control char-count" rows="3" data-limit="500">{{ old('populer_programs_text', $page_content->populer_programs_text ?? '') }}</textarea>
                            <div class="d-flex align-items-center" style="gap: 1em">
                                <small style="font-size: 16px" class="form-text text-muted counter">0/500</small>
                                <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Popular Programs Title</label>
                                                                        
                            @if(!empty($page_content) && !empty($page_content->populer_programs_name))
                            <div class="form-group">
                                @php
                                    $populer_programs_name = json_decode($page_content->populer_programs_name, true);
                                @endphp

                                @foreach ($populer_programs_name as $feature)
                                <div id="features-container">
                                    <div class="input-group mb-2">
                                        <input type="text" name="populer_programs_name[]" class="form-control" placeholder="Enter Programs Name" value="{{$feature}}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-feature">X</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <button type="button" id="add-feature" class="btn btn-secondary">Add Program</button>
                            </div>
                            @else
                            <div id="features-container">
                                <div class="input-group mb-2">
                                    <input type="text" name="populer_programs_name[]" class="form-control" placeholder="Enter Programs Name">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-feature">X</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="add-feature" class="btn btn-secondary">Add Program</button>
                            @endif

                        </div>


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
@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('page_banner_image');
        const preview = document.getElementById('bannerImagePreview');

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
