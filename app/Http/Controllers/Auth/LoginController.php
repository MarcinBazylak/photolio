<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

   use AuthenticatesUsers;

   protected function authenticated(Request $request, $user)
   {
      return redirect('/panel');
   }

   protected function validateLogin(Request $request)
   {
      $request->validate([
         $this->username() => 'required|string',
         'password' => 'required|string',
      ], [], [
         'email' => 'Adres e-mail',
         'password' => 'Hasło'
      ]);
   }

   public function __construct()
   {
      $this->middleware('guest')->except('logout');
   }
}
