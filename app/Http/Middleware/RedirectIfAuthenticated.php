<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Jika user sudah login sebagai admin
            if (Auth::guard($guard)->check() && Auth::user()->is_admin) {
                return redirect(RouteServiceProvider::ADMIN_HOME);
            }

            // Jika user adalah customer (login Google)
            if (Session::has('is_google_user')) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
