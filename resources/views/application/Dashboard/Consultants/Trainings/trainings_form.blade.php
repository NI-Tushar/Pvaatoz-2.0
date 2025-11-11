@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')

<div class="row">
    <div class="col-md-6 com-sm-12">
        <form method="POST" action="{{ route('consultant.trainings.add') }}" method="POST">
        @csrf
            <div class="m-2 card">
                <div class="card-header">
                    <h4>Add Training:</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="name" class="text-gray" class="form-label">Title/Name of Training:</label>
                            <input type="text" name="training_title" type="text" class="form-control" placeholder="Title of training" required>
                        </div>
                        @error('name')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email" class="text-gray" class="form-label">Organization:</label>
                            <input type="text" class="form-control" name="organization" placeholder="Organization name" required>
                        </div>
                        @error('email')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email" class="text-gray" class="form-label">Duration of Training:</label>
                            <input type="text" class="form-control" name="duration" placeholder="Training Duration" required>
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
                    <h4>Year of Training:</h4>
                </div>
                <div class="card-body">
                    <div class="card-body p-0">

                                            
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Year:</label>
                            <input type="date" name="year" class="form-control" placeholder="Your Training Year" required>
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Result/Grade:</label>
                            <input type="text" name="result" class="form-control" placeholder="Result or Grade of your training" required>
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
                        <button type="submit">Save</button>
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
