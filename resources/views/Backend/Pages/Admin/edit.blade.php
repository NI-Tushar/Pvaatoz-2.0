@extends("Backend.Layouts.master")
@section('title', 'User/Create')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Update User</h5>
            <a href="{{ route('admin.user.index') }}" class="btn btn-md btn-outline-success"><i class="fa-solid fa-reply"></i></a>
        </div>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.user.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group">
                                <label for="name" class="text-gray" class="form-label">Name</label>
                                <input type="text" name="name" type="text" class="form-control" value="{{ $admin->name }}">
                            </div>
                            @error('name')
                              <div id="emailHelp" class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="related" class="text-gray">Role</label>
                                  <select name="role" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="Admin" {{ $admin->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Editor" {{ $admin->role === 'Editor' ? 'selected' : '' }}>Editor</option>
                                    <option value="Moderator" {{ $admin->role === 'Moderator' ? 'selected' : '' }}>Moderator</option>
                                  </select>
                            </div>
                            @error('role')
                            <div id="emailHelp" class="form-text">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
                </div>
                <div class="m-2 mt-4 card">
                    <div class="card-header">
                        <h6>Image Gallary</h6>
                    </div>
                    <div class="card-body">
                        <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; margin-top: 10px;">
                            <img id="ImagePreview" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset($admin->image ? $admin->image : 'img-preview.png') }}" alt="">
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;"
                                 onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                <input style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" type="file" name="image" id="image">
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
                        <h6>Content Body</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="email" class="text-gray" class="form-label">Email</label>
                                <input type="text" name="email" type="text" class="form-control" value="{{ $admin->email }}">
                            </div>
                            @error('email')
                              <div id="emailHelp" class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="phone" class="text-gray" class="form-label">Phone</label>
                                <input type="number" name="phone" type="text" class="form-control" value="{{ $admin->phone }}">
                            </div>
                            @error('phone')
                              <div id="emailHelp" class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="state" class="text-gray">Password</label>
                                <div class="mb-3 input-group">
                                    <input type="password" name="password" class="form-control" id="passwordInput">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="togglePassword">
                                            <i id="showPasswordIcon" class="fa-solid fa-eye-slash"></i>
                                        </span>
                                        <span class="input-group-text" id="generatePasswordButton">
                                            <i class="fa-solid fa-arrows-rotate"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('password')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="repassword" class="text-gray" class="form-label">Re-password</label>
                                <input type="password" name="repassword" class="form-control" id="repasswordInput">
                            </div>
                            @error('repassword')
                              <div id="emailHelp" class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end;margin-top:10px">
            <button type="submit" class="btn btn-primary d-flex justify-content-end align-items-center" style="gap: .5em;">
                <i class="fa-solid fa-floppy-disk"></i>Save
            </button>
        </div>
      </form>
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

    document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('passwordInput');
            var icon = document.getElementById('showPasswordIcon');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.type = "password";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
        document.getElementById('generatePasswordButton').addEventListener('click', function() {
            var passwordInput = document.getElementById('passwordInput');
            var repasswordInput = document.getElementById('repasswordInput');
            var generatedPassword = generateRandomPassword();
            passwordInput.value = generatedPassword;
            repasswordInput.value = generatedPassword;
        });

        function generateRandomPassword() {
            var length = 10;
            var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-+=?";
            var password = "";
            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }
            return password;
        }

</script>
@endpush
