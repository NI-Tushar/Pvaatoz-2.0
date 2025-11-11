<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        // Return a response
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }
}


