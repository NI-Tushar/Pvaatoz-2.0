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

class SmsController extends Controller
{

    public function index()
    {
        return view('Frontend.Pages.otp_verification');
    }

    public function store(Request $request)
    {
        $inputOtp = implode('', $request->otp);
        $sessionOtp = session('new_otp');
        $registrationData = session('registration_data');

        // Check if registration data exists
        if (!$registrationData) {
            return redirect()->route('register')
                ->with('reg_error', 'Registration session expired. Please try again.');
        }

        // Verify OTP
        if ($inputOtp == $sessionOtp) {
            // Create user
            $user = User::create([
                'name' => $registrationData['name'],
                'email' => $registrationData['email'],
                'phone' => $registrationData['phone'],
                'user_type' => $registrationData['user_type'],
                'password' => Hash::make($registrationData['password']),
                'email_verified_at' => now(), // Mark as verified
            ]);

            // Fire Registered event
            event(new Registered($user));

            // Log in the user
            Auth::guard('web')->login($user);

            // Clear session data
            session()->forget(['new_otp', 'registration_data']);

            return redirect(RouteServiceProvider::HOME)
                ->with('reg_success', 'Registration successful!');
        }

        return redirect()->back()
            ->with('reg_error', 'OTP did not match!');
    }

    public function sendSmsUser($phone)
    {
        $phone = "88" . $phone; // Adjust phone number format
        $new_otp = rand(1000, 9999); // Generate OTP
        session(['new_otp' => $new_otp]);

        $name = config('app.name');
        $message = "Your OTP for $name is: $new_otp";
        $queryParams = [
            "UserName" => "neoshah121@gmail.com",
            "Apikey" => "81GE7QJJS4KIGIY",
            "MobileNumber" => $phone,
            "CampaignId" => "null",
            "SenderName" => "BOOTCAMP",
            "TransactionType" => "T",
            "Message" => $message,
        ];

        $url = "https://api.mimsms.com/api/SmsSending/Send";

        try {
            $client = new Client();
            $response = $client->get($url, ['query' => $queryParams]);
            $responseBody = json_decode($response->getBody(), true);

            return redirect()->route('otp.verify');
        } catch (\Exception $e) {
            return redirect()->route('register')
                ->with('reg_error', 'Failed to send OTP. Please try again.');
        }
    }

    public function orderConfirmedSms($phone)
    {
        // sending sms to customer start
        $phone = "88" . $phone; // Example phone number
        // $new_otp = rand(100000, 999999); // Example OTP generation

        $message = "Thank you! Your order has been confirmed by EduWise. To learn more about your order, please check your email or log in";
        $queryParams = [
            "UserName" => "neoshah121@gmail.com",  // MiMSMS registered email
            "Apikey" => "81GE7QJJS4KIGIY",        // MiMSMS API Key
            "MobileNumber" => $phone,             // Must be in international format
            "CampaignId" => "null",               // Keep it 'null' unless required
            "SenderName" => "BOOTCAMP",           // Provided by "Company Name"
            "TransactionType" => "T",             // 'T' for transactional messages
            "Message" =>  $message,  // Valid message
        ];


        $url = "https://api.mimsms.com/api/SmsSending/Send";

        try {
            $client = new Client();
            $response = $client->get($url, [
                'query' => $queryParams, // Send query parameters
            ]);

            // Decode the response body
            $responseBody = json_decode($response->getBody(), true);

            $smsSent = true;
            return $smsSent;

            // return response()->json([
            //     'success' => true,
            //     'response' => $responseBody,
            // ]);

        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
        // ___________ sending sms to customer start
    }

    public function cashIn($phone)
    {
        // sending sms to customer start
        $phone = "88" . $phone; // Example phone number
        // $new_otp = rand(100000, 999999); // Example OTP generation

        $message = "Thank you! Your payment has been completed correctly. Please check your balance from your dashboard.";
        $queryParams = [
            "UserName" => "neoshah121@gmail.com",  // MiMSMS registered email
            "Apikey" => "81GE7QJJS4KIGIY",        // MiMSMS API Key
            "MobileNumber" => $phone,             // Must be in international format
            "CampaignId" => "null",               // Keep it 'null' unless required
            "SenderName" => "BOOTCAMP",           // Provided by "Company Name"
            "TransactionType" => "T",             // 'T' for transactional messages
            "Message" =>  $message,  // Valid message
        ];


        $url = "https://api.mimsms.com/api/SmsSending/Send";

        try {
            $client = new Client();
            $response = $client->get($url, [
                'query' => $queryParams, // Send query parameters
            ]);

            // Decode the response body
            $responseBody = json_decode($response->getBody(), true);

            $smsSent = true;
            return $smsSent;

            // return response()->json([
            //     'success' => true,
            //     'response' => $responseBody,
            // ]);

        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
        // ___________ sending sms to customer start
    }
}
