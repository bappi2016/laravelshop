<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard){
            case 'admin':
//                for admin only
                if (Auth::guard($guard)->check()) {
                    return redirect('/admin');
                }
                break;
            default:
                // for frontend user
                if (Auth::guard($guard)->check()) {
                    return redirect('/user/profile');
                }

        }



        return $next($request);
    }
}
