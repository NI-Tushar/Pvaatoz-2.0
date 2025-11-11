<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if ($request->is('admin/*')) {
                if (!Auth::guard('admin')->check()) {
                    return route('admin.login');
                }
            }
        }  
        // Web routes
        if (!$request->expectsJson() && !Auth::guard('web')->check()) {
            // Redirect to login with message
            return redirect()->route('login')->with('login_msg', 'demo_msg');
            // return route('login', ['login_msg' => 'You must be logged in to access this page']);
        }
    }
}
