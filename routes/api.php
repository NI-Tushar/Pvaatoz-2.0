<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Assessment;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\RegisterController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users',function(){
    $users = User::get();
    return response()->json($users);
});

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/consultants',function(){
    $consultants = User::where('user_type', 'Consultant')->get();
    return response()->json($consultants);
});

Route::get('/assessments',function(){
    $assessment = Assessment::get();
    return response()->json($assessment);
});



