@extends('Frontend.app')
@section('title', 'SignUp')
@section('app-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="flex justify-center items-center min-h-screen pt-5 bg-gray-50">
        <div class="relative w-full max-w-[1200px] bg-white shadow rounded-lg p-2 md:p-10 flex flex-col md:flex-row gap-4" style="border:1px solid #00000030;">

            <!-- Left Part -->
            <div class="w-full md:w-1/2 flex flex-col justify-center items-center text-center px-4">
                <img src="{{ asset('Frontend/assets/img/logo/logo-red.png') }}" alt="Logo" class="w-32 mb-4">
                <h4 class="font-bold text-gray-700 mb-5">{{ __('message.sign_up_logo_text') }}</h4>
                <img src="{{ asset('Frontend/assets/img/icon/registration.png') }}" alt="Register Icon" class="w-1/2 hidden md:block">
            </div>

            <!-- Right Part -->
            <div class="w-full md:w-1/2 flex justify-center p-5 rounded-lg items-center border borde-black">
                <div class="w-full rounded-lg">
                    <!-- <h4 class="text-center text-xl font-bold text-gray-800 mb-4">{{ __('message.sign_up') }}</h4> -->

                    <!-- Select Option (moved above form inputs) -->
                    <div class="mb-6">
                        <h4 class="text-[24px] font-semibold text-center mb-3">{{ __('message.get_reg_as') }}</h4>

                        <div class="flex max-w-[250px] mx-auto justify-center border-2 border-[var(--primary-color)] rounded-lg">
                            <!-- Student (default selected) -->
                            <div onclick="selectOption(this)" data-value="Student"
                                class="radio_part w-full py-2 text-center cursor-pointer text-[13px] bg-[var(--primary-color)] text-white transition-all rounded-l-md">
                                <input type="radio" name="user_type" value="Student" hidden checked>
                                <label class="font-semibold">
                                    <i class="fa-solid fa-user-graduate mr-1"></i>{{ __('message.opt_student') }}
                                </label>
                            </div>

                            <!-- Consultant -->
                            <div onclick="selectOption(this)" data-value="Consultant"
                                class="radio_part w-full py-2 text-center cursor-pointer transition-all text-[13px]  rounded-r-md">
                                <input type="radio" name="user_type" value="Consultant" hidden>
                                <label class="font-semibold">
                                    <i class="fa-solid fa-user-tie mr-1"></i>{{ __('message.opt_consultant') }}
                                </label>
                            </div>
                        </div>

                        @error('user_type')
                            <p class="text-red-500 text-sm mt-1 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div class="relative mb-4">
                    <input type="text" name="name" value="{{ old('name') }}" required
                            class="peer px-3 rounded w-full border border-gray-400 focus:border-[var(--primary-color)] outline-none py-2 text-gray-700 bg-transparent">
                    <label class="absolute bg-white px-2 left-2 top-2.5 text-gray-500 text-sm peer-focus:-top-2 peer-focus:text-xs peer-valid:-top-2 peer-valid:text-xs transition-all">
                        {{ __('message.enter_name') }}
                    </label>
                    </div>
                    @error('name') <p class="text-red-500 text-sm -mt-3 mb-2">{{ $message }}</p> @enderror

                    <!-- Phone -->
                    <div class="relative mb-4">
                    <input type="tel" name="phone" value="{{ old('phone') }}" required
                            class="peer px-3 rounded w-full border border-gray-400 focus:border-[var(--primary-color)] outline-none py-2 text-gray-700 bg-transparent">
                    <label class="absolute bg-white px-2 left-2  top-2.5 text-gray-500 text-sm peer-focus:-top-2 peer-focus:text-xs peer-valid:-top-2 peer-valid:text-xs transition-all">
                        {{ __('message.enter_phone') }}
                    </label>
                    </div>
                    @error('phone') <p class="text-red-500 text-sm -mt-3 mb-2">{{ $message }}</p> @enderror

                    <!-- Email -->
                    <div class="relative mb-4">
                    <input type="email" name="email" value="{{ old('email') }}" required
                            class="peer rounded px-3 w-full border border-gray-400 focus:border-[var(--primary-color)] outline-none py-2 text-gray-700 bg-transparent">
                    <label class="absolute bg-white px-2 left-2 top-2.5 text-gray-500 text-sm peer-focus:-top-2 peer-focus:text-xs peer-valid:-top-2 peer-valid:text-xs transition-all">
                        {{ __('message.enter_email') }}
                    </label>
                    </div>
                    @error('email') <p class="text-red-500 text-sm -mt-3 mb-2">{{ $message }}</p> @enderror

                    <!-- Password -->
                    <div class="relative mb-4">
                        <input type="password" id="password" name="password" required
                                class="peer rounded px-3 w-full border border-gray-400 focus:border-[var(--primary-color)] outline-none py-2 text-gray-700 bg-transparent"
                                oninput="validatePassword(this.value)">
                        <span class="absolute right-2 top-2.5 cursor-pointer text-gray-600" onclick="togglePassword('password', this)">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                        <label class="absolute bg-white px-2 left-2 top-2.5 text-gray-500 text-sm peer-focus:-top-2 peer-focus:text-xs peer-valid:-top-2 peer-valid:text-xs transition-all">
                            {{ __('message.enter_pass') }}
                        </label>
                    </div>

                    <!-- Password Rules (Initially Hidden) -->
                    <ul id="password-rules" class="hidden text-[15px] text-gray-600 mb-5 pb-4 transition-all">
                        <li id="rule-length" class="flex items-center gap-2 text-red-600"><span>✘</span> Use at least 8 characters</li>
                        <li id="rule-uppercase" class="flex items-center gap-2 text-red-600"><span>✘</span> Add at least one uppercase letter</li>
                        <li id="rule-lowercase" class="flex items-center gap-2 text-red-600"><span>✘</span> Add at least one lowercase letter</li>
                        <li id="rule-number" class="flex items-center gap-2 text-red-600"><span>✘</span> Include at least one number</li>
                        <li id="rule-special" class="flex items-center gap-2 text-red-600"><span>✘</span> Include at least one special character</li>
                    </ul>
                    @error('password') 
                        <p class="text-red-500 text-sm -mt-3 mb-2">{{ $message }}</p> 
                    @enderror


                    @error('password') <p class="text-red-500 text-sm -mt-3 mb-2">{{ $message }}</p> @enderror
                    

                    <!-- Confirm Password -->
                    <div class="relative mb-4">
                        <input type="password" id="confirm_password" name="password_confirmation" required
                                class="peer rounded px-3 w-full border border-gray-400 focus:border-[var(--primary-color)] outline-none py-2 text-gray-700 bg-transparent">
                        <span class="absolute right-2 top-2.5 cursor-pointer text-gray-600" onclick="togglePassword('confirm_password', this)">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                        <label class="absolute bg-white px-2 left-2 top-2.5 text-gray-500 text-sm peer-focus:-top-2 peer-focus:text-xs peer-valid:-top-2 peer-valid:text-xs transition-all">
                            {{ __('message.enter_repass') }}
                        </label>
                    </div>
                    @error('password_confirmation') <p class="text-red-500 text-sm -mt-3 mb-2">{{ $message }}</p> @enderror

                    <!-- Terms -->
                    <div class="flex items-center mb-4 text-sm text-gray-700 gap-2 select-none relative">
                        <input type="checkbox" id="accept" name="accept" checked class="accent-[var(--primary-color)] cursor-pointer w-4 h-4" style="display:block;">

                        <label for="accept" class="cursor-pointer">
                            {{ __('message.i_accept') }}
                            <a href="{{ route('terms.condition') }}" 
                                class="text-[var(--primary-color)] font-bold underline hover:text-red-600 ml-1">
                                {{ __('message.terms_cond') }}
                            </a>
                        </label>
                    </div>


                    <!-- Submit -->
                    <button type="submit"
                            class="w-full bg-[var(--primary-color)] hover:bg-transparent hover:text-[var(--primary-color)] border border-[var(--primary-color)] text-white font-bold py-2 rounded-full transition-all">
                    {{ __('message.sign_up') }}
                    </button>

                    <div class="text-center mt-6 text-black font-bold">
                        <p>{{ __('message.had_acc') }}
                            <a href="{{ route('login') }}" class="bg-[var(--primary-color)] mt-2 md:mt-0 text-white border border-black hover:underline px-4 rounded ml-2 hover:bg-white hover:borderlack hover:text-black">
                            {{ __('message.sign_in') }}
                            </a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</form>

<!-- JavaScript -->
<script>
function selectOption(selectedDiv) {
    // Remove active styles from all options
    document.querySelectorAll('.radio_part').forEach(div => {
        div.classList.remove('bg-[var(--primary-color)]', 'text-white');
        div.classList.add('bg-transparent', 'text-black');
        div.querySelector('input').checked = false;
    });

    // Add active style to selected option
    selectedDiv.classList.add('bg-[var(--primary-color)]', 'text-white');
    selectedDiv.classList.remove('bg-transparent', 'text-black');

    // Mark radio as checked
    selectedDiv.querySelector('input').checked = true;
}
</script>


<!-- for password suggession start -->
<script>
function validatePassword(password) {
    const rulesList = document.getElementById('password-rules');

    // Show the rule list only when typing begins
    if (password.length > 0) {
        rulesList.classList.remove('hidden');
    } else {
        rulesList.classList.add('hidden');
    }

    // Define validation rules
    const rules = {
        length: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /[0-9]/.test(password),
        special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
    };

    // Update UI for each rule
    Object.keys(rules).forEach(rule => {
        const li = document.getElementById(`rule-${rule}`);
        if (rules[rule]) {
            li.classList.remove("text-red-600");
            li.classList.add("text-green-600", "font-semibold");
            li.querySelector("span").textContent = "✔";
        } else {
            li.classList.remove("text-green-600", "font-semibold");
            li.classList.add("text-red-600");
            li.querySelector("span").textContent = "✘";
        }
    });
}

function togglePassword(id, el) {
    const input = document.getElementById(id);
    const icon = el.querySelector("i");
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>


<!-- for password suggession end -->



@endsection
