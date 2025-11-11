<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Add these imports
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

class EmailController extends Controller
{
    public function sendEmailUser($email)
    {
        $new_otp = rand(1000, 9999); // Generate OTP
        session(['new_otp' => $new_otp]);
        
        // Send email
        Mail::to($email)->send(new SendOtpMail($new_otp));
        
        // Redirect to OTP verification page
        return view('Frontend.Pages.otp_verification');
    }
}
