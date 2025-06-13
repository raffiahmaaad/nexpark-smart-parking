<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Jika user mengakses route booking parkir, redirect ke Google login
            if ($request->is('parking/form') || $request->is('parking/book')) {
                return route('google.login');
            }
            return route('login');
        }
    }
}
