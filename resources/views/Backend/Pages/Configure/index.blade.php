@extends('Backend.Layouts.master')
@section('title', 'Configurations')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Manage Configurations</h5>
                @canAny(['isAdmin', 'isEditor'])
                    <a href="#" id="edit_founder" class="btn btn-md btn-outline-primary">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                @endcanAny
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.configer.update', $configer->id) }}" method="POST" enctype="multipart/form-data" id="founder_form">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 com-sm-12">
                        <div class="m-2 card">
                            <div class="card-header">
                                <h6>Basic Informations</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Company Name</label>
                                    <input type="text" name="name" class="form-control" id="sub-title" value="{{ $configer->name }}" disabled>
                                    @error('name')
                                      <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Company Email</label>
                                    <input type="text" name="email" class="form-control" id="sub-title" value="{{ $configer->email }}" disabled>
                                    @error('email')
                                      <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Company Phone</label>
                                    <input type="text" name="phone" class="form-control" id="sub-title" value="{{ $configer->phone }}" disabled>
                                    @error('phone')
                                      <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Company Address</label>
                                    <textarea name="address" class="form-control" id="" cols="30" rows="3" disabled>{{ $configer->address }}</textarea>
                                    @error('address')
                                      <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="video" class="form-label">Promo Video</label>
                                    <p>For auto play pest it last inn the video url :  autoplay=1&mute=1</p>
                                    <input type="text" name="video" class="form-control" id="sub-title" value="{{ $configer->video }}" disabled>
                                    @error('video')
                                      <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="m-2 mt-4 card">
                            <div class="card-header">
                                <h6>Image Gallary</h6>
                            </div>
                            <div class="card-body d-flex" style="gap: 2em">
                                <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; margin-top: 10px;">
                                    <img id="ImagePreview" style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset($configer->logo ? $configer->logo : 'img-preview.png') }}" alt="">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;"
                                         onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                        <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                        <input style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" type="file" name="logo" id="image" disabled>
                                    </div>
                                </div>
                                <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; margin-top: 10px;">
                                    <img id="ImagePreview_two" style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset($configer->logo_two ? $configer->logo_two : 'img-preview.png') }}" alt="">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;"
                                         onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                        <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                        <input style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" type="file" name="logo_two" id="image_two" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 com-sm-12">
                        <div class="m-2 card">
                            <div class="card-header">
                                <h6>Social Media</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" name="facebook" class="form-control" id="sub-title" value="{{ $configer->facebook }}" disabled>
                                    @error('facebook')
                                      <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <input type="text" name="twitter" class="form-control" id="sub-title" value="{{ $configer->twitter }}" disabled>
                                    @error('twitter')
                                      <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" name="instagram" class="form-control" id="sub-title" value="{{ $configer->instagram }}" disabled>
                                    @error('instagram')
                                      <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="youtube" class="form-label">Youtube</label>
                                    <input type="text" name="youtube" class="form-control" id="sub-title" value="{{ $configer->youtube }}" disabled>
                                    @error('youtube')
                                      <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="m-2 mt-4 card">
                            <div class="card-header">
                                <h6>Content Body</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="companydetail" class="form-label">Company Details</label>
                                    @php
                                        $strippedContent  = strip_tags($configer->companydetail)
                                    @endphp
                                    <textarea id="text-area-show" class="form-control" rows="10" disabled>{{ $strippedContent }}</textarea>
                                    <div id="text-area-edit" class="d-none">
                                        <div class="form-group">
                                            <textarea name="companydetail" class="form-control char-count summernote" rows="10" data-limit="700">{!! $configer->companydetail !!}</textarea>
                                            <div class="d-flex align-items-center" style="gap: 1em">
                                                <small style="font-size: 16px" class="form-text text-muted counter">0/700</small>
                                                <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                            </div>
                                        </div>
                                    </div>
                                    @error('companydetail')
                                      <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end;margin-top:10px" class="d-none" id="update_btn">
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

    function readURLTwo(input) {
        if (input.files && input.files[0]) {
            var secondImagReader = new FileReader();

            secondImagReader.onload = function (e) {
            $('#ImagePreview_two').attr('src', e.target.result);
            }

            secondImagReader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_two").change(function(){
            readURLTwo(this);
    });

    $(document).ready(function(){
    $('#edit_founder').click(function(event){
        event.preventDefault(); // Prevent default action for the anchor tag

        var $form = $('#founder_form');
        var $this = $(this);
        var $icon = $this.find('i');

        if ($icon.hasClass('fa-pen-to-square')) {
            // Enable form inputs
            $form.find('input, select, textarea').removeAttr('disabled');

            // Show update button
            $('#update_btn').removeClass('d-none');

            // Hide static textarea and initialize Summernote
            $('#text-area-show').addClass('d-none');
            $('#text-area-edit').removeClass('d-none');

            // Change icon to back arrow
            $icon.removeClass('fa-pen-to-square').addClass('fa-arrow-left');
        } else {
            // Disable form inputs
            $form.find('input, select').attr('disabled', 'disabled');

            // Hide update button
            $('#update_btn').addClass('d-none');

            // Destroy Summernote and hide it, show static textarea
            $('#text-area-edit').addClass('d-none');
            $('#text-area-show').removeClass('d-none');

            // Change icon back to edit pen
            $icon.removeClass('fa-arrow-left').addClass('fa-pen-to-square');
        }
    });
});



</script>
@endpush
