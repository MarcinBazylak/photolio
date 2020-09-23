<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   /**
    * Create a new controller instance.
    *
    * @return void
    */

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {
      return view('welcome');
   }

   public function checkUsername(Request $request)
   {

      $request->validate(
         [
            'username' => ['required', 'string', 'max:191', 'unique:users', 'regex:/^[a-z][a-z0-9]*(?:_[a-z0-9]+)*$/']
         ],
         [
            'username.regex' => 'Nazwa użytkownika może zawierać tylko małe litery oraz cyfry i nie może zaczynać się cyfrą.',
            'username.unique' => 'Ta nazwa użytkownika jest zajęta.'
         ],
         [
            'username' => 'Nazwa użytkownika'
         ]
      );

      return view('auth.register', ['username' => request('username')]);
   }
}
