@extends("Backend.Layouts.master")
@section('title', 'slider/View')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">View Slider</h5>
                <a href="{{ route('admin.slider.index') }}" class="btn btn-md btn-outline-primary"><i class="fa-solid fa-reply"></i></a>
            </div>
        </div>
        <div class="card-body">
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
                                        <input type="text" name="sub_title" type="text" class="form-control char-count" data-limit="30" value="{{ old('sub_title', $slider->sub_title) }}" disabled>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" type="text" class="form-control char-count" data-limit="80" value="{{ old('title', $slider->title) }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-2 mt-4 card">
                            <div class="card-header">
                                <h6>Image Gallary</h6>
                            </div>
                            <div class="card-body">
                                <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; margin-top: 10px;">
                                    <img id="ImagePreview" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset($slider->image ? $slider->image : 'img-preview.png') }}" alt="{{ $slider->title }}">
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
                                        <textarea name="description" class="form-control char-count" rows="15" data-limit="500" disabled>{{ $slider->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

