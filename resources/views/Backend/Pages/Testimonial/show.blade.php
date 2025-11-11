@extends("Backend.Layouts.master")
@section('title', 'Testimonial/Show')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">View Testimonial</h5>
            <a href="{{ route('admin.testimonial.index') }}" class="btn btn-md btn-outline-success"><i class="fa-solid fa-reply"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 com-sm-12">
                <div class="m-2 card">
                    <div class="card-header">
                        <h6>Basic Informations</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="title" class="form-label">Name</label>
                                <input type="text" name="name" type="text" class="form-control char-count" value="{{ $testimonial->name }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="title" class="form-label">Designation</label>
                                <input type="text" name="designation" type="text" class="form-control char-count" value="{{ $testimonial->designation }}" disabled>
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
                            <img id="ImagePreview" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset($testimonial->image ? $testimonial->image : 'img-preview.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 com-sm-12">
                <div class="m-2 card">
                    <div class="card-header">
                        <h6>Content Body</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <textarea name="description" class="form-control char-count" rows="14" disabled>{{ strip_tags($testimonial->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

