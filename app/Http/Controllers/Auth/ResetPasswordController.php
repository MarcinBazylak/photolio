<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
   //  'token' => 'required',
   //  'email' => 'required|email',
   //  'password' => 'required|confirmed|min:8',

    protected function validationErrorMessages()
    {
        return [
         'token.required' => 'Nieprawidłowy token',
         'email.required' => 'Pole Adres email jest obowiązkowe',
         'email.email' => 'Adres email musi posiadać prawidłowy format',
         'password.required' => 'Pole Hasło jest obowiązkowe',
         'password.confirmed' => 'Hasła muszą być jednakowe',
         'password.min' => 'Hasło musi składać się conajmniej z ośmiu znaków'
        ];
    }

    protected $redirectTo = '/panel';
}
