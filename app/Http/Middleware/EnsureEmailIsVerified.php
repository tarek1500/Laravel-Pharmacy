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
        
        if($request->user('pharmacy') && !$request->user('pharmacy')->hasVerifiedEmail())
            return $this->verifyRedirection($request,"pharmacy",$redirectToRoute );
        
        else if ($request->user('doctor') && !$request->user('doctor')->hasVerifiedEmail() )
            return $this->verifyRedirection($request,"doctor",$redirectToRoute);
              
       return $next($request);
     
    }

    function verifyRedirection($request, $guard , $redirectToRoute = null){
        return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route($redirectToRoute ?: "$guard.verification.notice");
    }
}
