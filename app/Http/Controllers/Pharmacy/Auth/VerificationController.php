<?php

namespace App\Http\Controllers\Pharmacy\Auth;

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
    | pharmacy that recently registered with the application. Emails may also
    | be re-sent if the pharmacy didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect pharmacies after verification.
     *
     * @var string
     */
    protected $redirectTo = '/pharmacy';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pharmacy.auth');
        $this->middleware('signed')->only('pharmacy.verify');
        $this->middleware('throttle:6,1')->only('pharmacy.verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user('pharmacy')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('pharmacy.auth.verify');
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
        if (! hash_equals((string) $request->route('id'), (string) $request->user('pharmacy')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('pharmacy')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('pharmacy')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('pharmacy')->markEmailAsVerified()) {
            event(new Verified($request->user('pharmacy')));
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
        if ($request->user('pharmacy')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user('pharmacy')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}
