@extends("Backend.Layouts.master")
@section('title', 'Package/Create')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Create a new Package</h5>
                <a href="{{ route('admin.proUser.packages') }}" class="btn btn-md btn-outline-primary"><i class="fa-solid fa-reply"></i></a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.userPackages.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="m-2 card">
                            <div class="card-header">
                                <h6>Package Information</h6>
                            </div>  
                            <div class="card-body">
                                <!-- _____________ -->
                                <div>
                                    <div class="form-group">
                                        <label for="name" class="form-label">Package Name</label>
                                        <input type="text" name="name" type="text" placeholder="Basic, Standard, Premium etc" class="form-control char-count" data-limit="30">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                  @error('sub_title')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                  @enderror
                                </div>
                                <!-- _____________ -->
                                <div>
                                    <div class="form-group">
                                        <label for="name" class="form-label">Package Level</label>
                                        <input type="text" name="level" placeholder="Starter, Populer, Best Value etc" type="text" class="form-control char-count" data-limit="30">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                  @error('sub_title')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                  @enderror
                                </div>
                                <!-- _____________ -->
                                <div>
                                    <div class="form-group">
                                        <label for="name" class="form-label">Package Duration</label>
                                        <input name="duration" type="number" placeholder="Duration in month" class="form-control char-count" data-limit="30">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                  @error('sub_title')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                  @enderror
                                </div>
                                <!-- _____________ -->

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="m-2 card">
                            <div class="card-header">
                                <h6>Content Body</h6>
                            </div>
                            <div class="card-body">
                                <!-- _____________ -->
                                <div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Short Text</label>
                                        <textarea name="description" class="form-control char-count" rows="3" data-limit="50"></textarea>
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                            <small style="font-size: 16px" class="form-text text-muted counter">0/50</small>
                                            <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                    @error('description')
                                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- _____________ -->
                                <div>
                                    <div class="form-group">
                                        <label for="name" class="form-label">Package Price</label>
                                        <input name="price" type="number" placeholder="Package Price" class="form-control char-count" data-limit="30">
                                        <div class="d-flex align-items-center" style="gap: 1em">
                                          <small style="font-size: 16px" class="form-text text-muted counter">0/30</small>
                                          <small style="font-size: 16px" class="form-text text-danger error d-none">Character limit exceeded!</small>
                                        </div>
                                    </div>
                                  @error('sub_title')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                  @enderror
                                </div>
                                <!-- _____________ -->
                                <div class="form-group">
                                    <label for="features">Package Features</label>
                                    <div id="features-container">
                                        <div class="input-group mb-2">
                                            <input type="text" name="features[]" class="form-control" placeholder="Enter Package Feature" value="{{ old('features[]') }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-feature">X</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="add-feature" class="btn btn-secondary">Add Feature</button>
                                </div>
                                <!-- _____________ -->
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; margin-top:10px">
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
  document.getElementById('add-feature').addEventListener('click', function() {
        var container = document.getElementById('features-container');
        var inputGroup = document.createElement('div');
        inputGroup.classList.add('input-group', 'mb-2');

        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'features[]';
        input.placeholder = 'Enter Package Feature';
        input.classList.add('form-control');

        var inputGroupAppend = document.createElement('div');
        inputGroupAppend.classList.add('input-group-append');

        var button = document.createElement('button');
        button.type = 'button';
        button.classList.add('btn', 'btn-danger', 'remove-feature');
        button.textContent = 'X';

        inputGroupAppend.appendChild(button);
        inputGroup.appendChild(input);
        inputGroup.appendChild(inputGroupAppend);
        container.appendChild(inputGroup);

        button.addEventListener('click', function() {
            container.removeChild(inputGroup);
        });
    });

    document.querySelectorAll('.remove-feature').forEach(function(button) {
        button.addEventListener('click', function() {
            var inputGroup = button.parentElement.parentElement;
            var container = document.getElementById('features-container');
            container.removeChild(inputGroup);
        });
    });
</script>

@endpush
