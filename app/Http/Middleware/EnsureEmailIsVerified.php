<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        
        if(($request->user('pharmacy') && $request->user('pharmacy')->hasVerifiedEmail())
             || ($request->user('doctor') && $request->user('doctor')->hasVerifiedEmail() ) 
                || $request->user("admin")) {
                    return $next($request);
            }
  
       else {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route($redirectToRoute ?: 'pharmacy.verification.notice');
        }
     
    }
}
