{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends("Backend.Layouts.master")
@section('title', 'Profile')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Update Profile</h5>
            <a href="{{ route('admin.user.index') }}" class="btn btn-md btn-outline-success"><i class="fa-solid fa-reply"></i></a>
        </div>
    </div>
    <div class="card-body">
          <div class="row">
            <div class="col-md-6 com-sm-12">
                <form method="post" action="{{ route('admin.profile.update.information') }}">
                    @csrf
                    @method('patch')
                    <div class="m-2 card">
                        <div class="card-header">
                            <h6>Profile Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="name" class="text-gray" class="form-label">Name</label>
                                    <input type="text" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}">
                                </div>
                                @error('name')
                                <div id="emailHelp" class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="email" class="text-gray" class="form-label">Email</label>
                                    <input type="text" name="email" type="text" class="form-control" value="{{ old('email', $user->email) }}">
                                </div>
                                @error('email')
                                <div id="emailHelp" class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="phone" class="text-gray" class="form-label">Phone</label>
                                    <input type="text" name="phone" type="text" class="form-control" value="{{ old('email', $user->phone) }}">
                                </div>
                                @error('phone')
                                <div id="emailHelp" class="form-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <button class="btn btn-outline-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="m-2 mt-4 card">
                    <div class="card-header">
                        <h6>Profile Picture</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update.image') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div style="position: relative; border: 1px solid #ddd; padding: 5px; width: 150px; height: 150px; margin-top: 10px;">
                                <img id="ImagePreview" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset($user->image ? $user->image : 'img-preview.png') }}" alt="">
                                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #0e0e0e70; opacity: 0; cursor: pointer;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                    <i class="text-white fa-solid fa-pen-to-square" style="font-size: 35px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                    <input style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" type="file" name="image" id="image">
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="form-group">
                                    <button class="btn btn-outline-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                        @error('image')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 com-sm-12">
                <div class="m-2 card">
                    <form method="post" action="{{ route('admin.profile.update.password') }}">
                        @csrf
                        @method('patch')
                        <div class="card-header">
                            <h6>Update Password</h6>
                        </div>
                        <div class="card-body">
                            <div class="card-body p-0">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="current_password" class="text-gray" class="form-label">Current Password</label>
                                        <input type="password" name="current_password" class="form-control">
                                    </div>
                                    @error('current_password')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="password" class="text-gray" class="form-label">New Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    @error('password')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="text-gray" class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                    @error('password_confirmation')
                                    <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <button class="btn btn-outline-primary" type="submit">Update Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="m-2 mt-4 card">
                    <div class="card-header">
                        <h6>Profile Delete</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-danger">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                        <div class="mt-3">
                            <div class="form-group">
                                <button data-toggle="modal" class="btn btn-outline-danger" data-target="#deleteAccount">Delete Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>

  <!--Edit Modal-->
  <div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('admin.profile.destroy') }}" method="POST">
            @csrf
            @method('delete')
        <div class="modal-body">
            <p class="text-danger">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
            <div class="mb-3">
              <input type="password" name="password" class="form-control" id="sub-title" placeholder="Password">
              @error('password')
                <div id="emailHelp" class="form-text">{{ $message }}</div>
              @enderror
            </div>
            <div class="mt-2">
                @if ($messages = $errors->userDeletion->get('password'))
                <ul>
                    @foreach ((array) $messages as $message)
                        <li class="text-danger">{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete Account</button>
        </div>
      </div>
    </form>
    </div>
  </div>
  <!--End Edit Modal-->

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

