<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Album;
use App\Aboutme;
use App\UserSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
         'name' => 'Imię i nazwisko',
         'username' => 'Nazwa użytkownika',
         'email' => 'Adres e-mail',
         'password' => 'Hasło'
      ]);
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\User
    */

   private function addAboutMe($userId, $userName)
   {
      $aboutMe = new Aboutme(['title' => $userName]);
      $user = User::find($userId);
      $user->aboutme()->save($aboutMe);
   }

   private function addFirstAlbum($userId)
   {
      $album = new Album(['album_name' => 'Krajobraz']);
      $user = User::find($userId);
      $user->albums()->save($album);

      $albumId = $album->id;
      $this->addUserSettings($userId, $albumId);
   }

   private function addUserSettings($userId, $defAlbumId)
   {
      $userSettings = new UserSetting(['def_album' => $defAlbumId]);
      $user = User::find($userId);
      $user->settings()->save($userSettings);
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
