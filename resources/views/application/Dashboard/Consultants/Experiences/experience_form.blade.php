@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')

<div class="row">
    <div class="col-md-6 com-sm-12">
        <form method="POST" action="{{ route('consultant.experience.add') }}" enctype="multipart/form-data" method="POST">
        @csrf
            <div class="m-2 card">
                <div class="card-header">
                    <h4>Experiences:</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="name" class="text-gray" class="form-label">Organization Name:</label>
                            <input type="text" name="organization" type="text" class="form-control" placeholder="Previous Organization name" required>
                        </div>
                        @error('name')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email" class="text-gray" class="form-label">Designation:</label>
                            <input type="text" class="form-control" name="designation" placeholder="Your Designation" required>
                        </div>
                        @error('email')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email" class="text-gray" class="form-label">Responsibilites:</label>
                            <input type="text" class="form-control" name="responsibilities" placeholder="Your Role" required>
                        </div>
                        @error('email')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>
            </div>

    </div>
    <div class="col-md-6 com-sm-12">
        <div class="m-2 card">

                <div class="card-header">
                    <h4>Experience Duration:</h4>
                </div>
                <div class="card-body">
                    <div class="card-body p-0">

                                            
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Joining Date:</label>
                            <input type="date" name="start_date" class="form-control" placeholder="Your Joining date" required>
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>


                     <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Resigning Date:</label>
                            <input type="date" name="end_date" class="form-control" placeholder="Your resigning date" required>
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Duration:</label>
                            <input type="text" name="duration" class="form-control" placeholder="Total service duration" required>
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Other Languages</label>
                            <input type="text" name="other_language" class="form-control" placeholder="Your GPA/CGPA">
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Documents</label>
                            <input type="file" name="documents" class="form-control" placeholder="Any Documents have" accept="application/pdf">
                        </div>
                        @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="phone" class="text-gray" class="form-label">Resume</label>
                            <input type="file" name="cv_documents" class="form-control" placeholder="Your Resume" accept="application/pdf">
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
