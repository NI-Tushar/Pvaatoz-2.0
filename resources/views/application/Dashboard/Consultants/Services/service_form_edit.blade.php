@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')

<style>
    label{
        font-weight:600;
    }
    .submit_button{
        width: 100%;
        padding:15px;
        display:flex;
        gap:15px;
    }
    .submit_button button{
        background-color:transparent;
        border-radius:7px;
        padding-top:7px;
        padding-bottom:7px;
        border:1px solid green;
        width: 100%;
        color:black
    }
    .submit_button button:hover{
        background-color:green;
        color:aliceblue;
    }
    .submit_button .active{
        background-color:green;
        color:aliceblue;
        font-weight:600;
    }
    .submit_button .active:hover{
        background-color:rgb(0, 184, 0);
        border:1px solid rgb(0, 184, 0);
    }
</style>



<div class="row">
    <div class="col-md-6 com-sm-12">
        <form method="POST" action="{{ route('consultant.service.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id"  value="{{ $service_data['id'] }}">
            <div class="m-2 card">
                <div class="card-header">
                    <h4>Edit Your Consultancy Services:</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="name" class="text-gray" class="form-label">Add University</label>
                            <input type="text" name="university" type="text" class="form-control" value="{{ $service_data['university'] }}" required>
                        </div>
                        @error('name')
                        <div id="emailHelp" class="form-text">{{ $error_error_message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email" class="text-gray" class="form-label">Edit Country:</label>
                            <input type="text" class="form-control" name="country" value="{{ $service_data['country'] }}" required>
                        </div>
                        @error('email')
                        <div id="emailHelp" class="form-text">{{ $error_error_message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="email" class="text-gray" class="form-label">Edit Subject:</label>
                            <input type="text" class="form-control" name="subject" value="{{ $service_data['subject'] }}" required>
                        </div>
                        @error('email')
                        <div id="emailHelp" class="form-text">{{ $error_error_message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="submit_button">
                <button type="reset">Clear</button>
                <button type="submit" class="active">Save</button>
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
