<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Aboutme;
use App\Album;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

   use RegistersUsers;

   /**
    * Where to redirect users after registration.
    *
    * @var string
    */
   protected $redirectTo = RouteServiceProvider::HOME;

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('guest');
   }

   public function register(Request $request)
   {
      $this->validator($request->all())->validate();

      event(new Registered($user = $this->create($request->all())));

      // $this->guard()->login($user);

      return $this->registered($request, $user)
         ?: redirect('/' . $user->username);
   }

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data)
   {
      return Validator::make($data, [
         'name' => ['required', 'string', 'max:191'],
         'username' => ['required', 'string', 'max:191', 'unique:users', 'regex:/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/'],
         'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
         'password' => ['required', 'string', 'min:8', 'confirmed'],
         'terms-accepted' => ['required', 'integer']
      ], [], [
         'name' => 'imię i nazwisko',
         'username' => 'nazwa użytkownika',
         'email' => 'adres e-mail',
         'password' => 'hasło'
      ]);
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\User
    */

   private function addAboutMe($user_id, $user_name)
   {
      Aboutme::create([
         'user_id' => $user_id,
         'title' => $user_name,
         'description' => 'O mnie'
      ]);
   }

   private function addFirstAlbum($user_id)
   {
      $album = Album::create([
         'user_id' => $user_id,
         'album_name' => 'Krajobraz'
      ]);

      $album_id = $album->id;

      $this->setDefAlbum($album_id, $user_id);
   }

   private function setDefAlbum($album_id, $user_id)
   {
      $user = User::find($user_id);
      $user->def_album = $album_id;
      $user->save();
   }

   protected function create(array $data)
   {
      $user = User::create([
         'name' => $data['name'],
         'terms_accepted' => 1,
         'username' => $data['username'],
         'email' => $data['email'],
         'password' => Hash::make($data['password']),
      ]);

      $id = $user->id;
      $name = $user->name;

      $this->addAboutMe($id, $name);
      $this->addFirstAlbum($id);

      return $user;
   }
}
