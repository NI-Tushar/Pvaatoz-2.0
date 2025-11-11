@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')

<div class="row">
    <div class="col-md-6 com-sm-12">
        <form method="POST" action="{{ route('consultant.qualification.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id"  value="{{ $qualification_data['id'] }}">
            <div class="m-2 card">
                <div class="card-header">
                    <h4>Qualifications:</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="name" class="text-gray" class="form-label">Lavel of Education</label>
                            <input type="text" name="label_of_edu" class="form-control" value="{{ $qualification_data['level_of_education'] }}"  required>
                        </div>
                        @error('name')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email" class="text-gray" class="form-label">Degree/Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Degree Name" value="{{ $qualification_data['degree_title'] }}" required>
                        </div>
                        @error('email')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        <div class="m-2 mt-4 card">
            <div class="card-header">
                <h4>Certificate:</h4>
            </div>
            <div class="card-body">
                    <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; margin-top: 10px;">
                        <img id="ImagePreview" style="width: 100%; height: 100%; object-fit: cover;" src="https://www.kindpng.com/picc/m/157-1571844_upload-icon-png-image-free-download-searchpng-upload.png" alt="">
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                            <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                            <input style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" type="file" accept="application/pdf" name="documents" id="image">
                        </div>
                    </div>

                @error('image')
                <div id="emailHelp" class="form-text">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6 com-sm-12">
        <div class="m-2 card">

                <div class="card-header">
                    <h4>Institution:</h4>
                </div>
                <div class="card-body">
                    <div class="card-body p-0">


                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Institution</label>
                            <input type="text" name="institution" class="form-control" placeholder="Name of your institution"  value="{{ $qualification_data['institution'] }}" required>
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>


                     <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Department</label>
                            <input type="text" name="department" class="form-control" placeholder="Your Department"  value="{{ $qualification_data['department'] }}" required>
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Passing Year</label>
                            <input type="text" name="passing_year" class="form-control" placeholder="Your Passing Year" value="{{ $qualification_data['passing_year'] }}" required>
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">GPA/CGPA</label>
                            <input type="text" name="cgpa" class="form-control" placeholder="Your GPA/CGPA"  value="{{ $qualification_data['cgpa'] }}" required>
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Duration</label>
                            <input type="text" name="duration" class="form-control" placeholder="Duration of your Degree"  value="{{ $qualification_data['duration'] }}" required>
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>


                    </div>
                </div>

                <style>
                    label{
                        font-weight:600;
                    }
                    .submit_button{
                        width: 100%;
                        padding:15px;
                    }
                    .submit_button button{
                        background-color:green;
                        width: 100%;
                        border:none;
                        border-radius:7px;
                        padding-top:7px;
                        padding-bottom:7px;
                        color:aliceblue;
                        font-weight:600;
                    }
                    .submit_button button:hover{
                        background-color:rgb(0, 184, 0);
                    }
                </style>

                    <div class="submit_button">
                        <button type="submit">Update</button>
                    </div>

            </form>
        </div>

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
