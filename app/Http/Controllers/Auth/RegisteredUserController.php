<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view("Frontend.Pages.register");
    }

    public function consultantCreate(): View
    {
        return view("Frontend.Pages.consultant_register");
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_type' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'digits:11'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Store validated data in session
        session(['registration_data' => $validated]);

        // Redirect to OTP sending route via Email
        return redirect()->route('send.emailOTP', ['email' => $validated['email']]);

        // Redirect to OTP sending route via phone number
        // return redirect()->route('send.otp', ['phone' => $validated['phone']]);
    }
}
