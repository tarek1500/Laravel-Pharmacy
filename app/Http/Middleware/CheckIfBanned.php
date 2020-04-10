<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->is_baned){
            Auth::guard('doctor')->logout();
            $request->session()->invalidate();
            return redirect()->route('doctor.login')->withMessage("you are banned, please contact the admin.");
        }
           
        return $next($request);
    }
}
