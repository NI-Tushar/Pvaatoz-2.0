@extends("Backend.Layouts.master")
@section('title', 'Educational Info/Create')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Create a Service Charge</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="{{ route('admin.user.serviceCharge') }}" class="btn btn-md btn-outline-primary"><i class="fa-solid fa-reply"></i></a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.serviceCharge.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="m-2 card">
                            <div class="card-header">
                                <h6>Selection</h6>
                            </div>
                            <div class="card-body">
                                <div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Select Service</label>
                                        <select id="service" name="service" class="form-control" required>
                                            <option value="" disabled selected>Select a Service</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->name }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">User Type</label>
                                        <select id="service" name="user_type" class="form-control" required>
                                            <option value="" disabled selected>Select User Type</option>
                                            <option value="pro">Pro-Consultant</option>
                                            <option value="Verified">Verified</option>
                                            <option value="Non-verified">Non Verified</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-label">Commission (%)</label>
                                        <input type="number" name="commission" class="form-control char-count" data-limit="50" value="{{ old('address') }}"
                                        placeholder="Enter Commission Charge">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/50</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                    
                                    

                                </div>
                            </div>
                            <div class="mb-3 mr-3" style="display: flex; justify-content: flex-end;">
                                <button type="submit" class="btn btn-primary d-flex justify-content-end align-items-center" style="gap: .5em;">
                                    <i class="fa-solid fa-floppy-disk"></i>Save
                                </button>
                            </div>
                        </div>
                    </div>

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
