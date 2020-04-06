<?php

namespace App\Http\Controllers\Doctor\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | doctor that recently registered with the application. Emails may also
    | be re-sent if the doctor didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect doctors after verification.
     *
     * @var string
     */
    protected $redirectTo = '/doctor';

   

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user('doctor')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('doctor.auth.verify');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user('doctor')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('doctor')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('doctor')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('doctor')->markEmailAsVerified()) {
            event(new Verified($request->user('doctor')));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user('doctor')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user('doctor')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}
