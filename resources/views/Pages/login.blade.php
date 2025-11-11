@extends('layouts.app')
@section('title', 'SignIn')
@section('app-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">



<!-- Login Page -->
<div class="flex justify-center items-center min-h-screen bg-gray-50 pt-0 mt-0 border border-black flex-col gap-4">
    <!-- Login Message -->
    @if(session('login_msg'))
        <div id="login_msg" class="w-full max-w-4xl relative bg-[#fb7b0b54] border-2 border-[#FB7B0B] rounded-lg p-3 mt-3 mb-1">
            <p class="text-black font-bold text-[16px] w-full text-center">{{ __('message.sign_in_msg') }}</p>
            <div onclick="closeChoiceMessage()" class="absolute top-2 right-2 h-5 w-5 flex cursor-pointer hover:text-black text-gray-600">
                <i class="fa-solid fa-xmark m-auto"></i>
            </div>
        </div>
    @endif

    <script>
        function closeChoiceMessage() {
            document.getElementById("login_msg").style.display = "none";
        }
    </script>

    <!-- Main Form Container -->
    <div class="flex flex-col md:flex-row bg-white rounded-lg max-w-4xl w-full p-2 md:p-6 gap-6" style="border:1px solid #00000030;">

        <!-- Left Part -->
        <div class="w-full md:w-1/2 flex flex-col items-center text-center px-4">
          <img src="{{ asset('Frontend/assets/img/logo/logo-red.png') }}" alt="Logo" class="w-32 mb-4">
          <h4 class="text-gray-700 font-bold mb-5 text-lg">{{ __('message.sign_in_logo_text') }}</h4>
          <img src="{{ asset('Frontend/assets/img/icon/login.png') }}" alt="Login Icon" class="w-1/2 hidden md:block">
        </div>

        <!-- Right Part -->
        <div class="w-full md:w-1/2 flex justify-center items-center">
          <div class="w-full max-w-sm p-6 rounded-lg" style="border:1px solid #00000030;">

            <h4 class="text-center text-xl font-bold text-gray-800 mb-4">{{ __('message.sign_in') }}</h4>

            <!-- Error Messages -->
            @if ($errors->has('email'))
              <div class="text-red-500 text-sm mb-3 text-center">
                {{ $errors->first('email') }}
              </div>
            @elseif (session('error'))
              <div class="text-red-500 text-sm mb-3 text-center">
                {{ session('error') }}
              </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <!-- Email -->
              <div class="relative mb-4">
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="peer w-full border rounded border-gray-400 outline-none p-2 text-gray-700 bg-transparent">
                <label class="absolute bg-white px-2 left-2 top-2.5 text-gray-500 text-sm peer-focus:-top-2 peer-focus:text-xs peer-valid:-top-2 peer-valid:text-xs transition-all">
                  {{ __('message.email_placeholder') }}
                </label>
              </div>

              <!-- Password -->
              <div class="relative mb-4">
                <input type="password" id="password" name="password" value="{{ old('password') }}" required
                       class="peer w-full border rounded border-gray-400 outline-none p-2 text-gray-700 bg-transparent">
                <span class="absolute right-2 top-2.5 cursor-pointer text-gray-600" onclick="togglePassword()">
                  <i id="toggleIcon" class="fa-solid fa-eye"></i>
                </span>
                <label class="absolute bg-white px-2 left-2 top-2.5 text-gray-500 text-sm peer-focus:-top-2 peer-focus:text-xs peer-valid:-top-2 peer-valid:text-xs transition-all">
                  {{ __('message.password_placeholder') }}
                </label>
              </div>

              <!-- Remember & Forgot -->
            <div class="flex items-center gap-3 mb-4 text-sm text-gray-700">
                <input type="checkbox" id="remember" name="remember" checked class="accent-[var(--primary-color)] cursor-pointer w-4 h-4" style="display:block;">
                <a href="{{ route('password.request') }}" class="text-black hover:text-[var(--primary-color)] underline">
                    {{ __('message.forgot_pass') }}
                </a>
            </div>


              <!-- Submit Button -->
              <button type="submit" class="w-full bg-[var(--primary-color)] hover:bg-transparent hover:text-[var(--primary-color)] border border-[var(--primary-color)] text-white font-bold py-2 rounded-full transition-all">
                {{ __('message.sign_in') }}
              </button>

              <!-- Sign Up Link -->
              <div class="text-center mt-4 text-gray-700 font-semibold">
                <p>{{ __('message.have_acc') }}
                  <a href="{{ route('register') }}" class="bg-[var(--primary-color)] text-white border border-black hover:underline px-4 rounded ml-2 hover:bg-white hover:borderlack hover:text-black">
                    {{ __('message.sign_up') }}
                  </a>
                </p>
              </div>
            </form>

          </div>
        </div>
    </div>
</div>


<!-- Toggle Password JS -->
<script>
function togglePassword() {
  const passwordInput = document.getElementById("password");
  const toggleIcon = document.getElementById("toggleIcon");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    toggleIcon.classList.remove("fa-eye");
    toggleIcon.classList.add("fa-eye-slash");
  } else {
    passwordInput.type = "password";
    toggleIcon.classList.remove("fa-eye-slash");
    toggleIcon.classList.add("fa-eye");
  }
}
</script>


@endsection
