@php
    $configer = App\Models\Configer::latest()->first();
@endphp
@extends('Backend.Layouts.app')
@section('title', 'Admin | Login')
@section('app-content')
    <div class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card">
              <div class="card-body login-card-body">
                {{-- <p class="login-box-msg">Admin</p> --}}
                <div style="width: 100%; margin:auto; text-align:center; margin-bottom:20px">
                  <img style="height: 70px" src="{{ asset($configer->logo) }}" alt="">
                </div>

                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                  <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  @error('email')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                  <div class="row">
                    <div class="col-8">
                      <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                          Remember Me
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
              <!-- /.login-card-body -->
            </div>
          </div>
    </div>
    <!-- /.login-box -->
@endsection