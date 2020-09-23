<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Mail\VerificationCompleted;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/verificationSuccessful';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Auth::routes(['verify' => true]);
        $this->middleware('auth')->except('verify');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

   public function verify(Request $request)
   {

      $user = User::find($request->route('id'));
      Auth::login($user);
      
      if (!hash_equals((string) $request->route('id'), (string) $request->user()->getKey())) {
         throw new AuthorizationException;
      }

      if (!hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {
         throw new AuthorizationException;
      }

      if ($request->user()->hasVerifiedEmail()) {
         return $request->wantsJson()
            ? new Response('', 204)
            : redirect($this->redirectPath());
      }

      if ($request->user()->markEmailAsVerified()) {
         event(new Verified($request->user()));
      }

      if ($response = $this->verified($request)) {
         return $response;
      }

      $mailable = new VerificationCompleted($request->user()->name, $request->user()->email, $request->user()->username);
      $mailable->replyTo('noreply@photolio.pl');
      $mailable->subject('Adres email został pomyślnie zweryfikowany');
      Mail::to($request->user()->email)->send($mailable);

      return $request->wantsJson()
         ? new Response('', 204)
         : redirect($this->redirectPath())->with('verified', true);
   }

}
