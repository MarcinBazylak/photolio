<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Album;
use App\Aboutme;
use App\UserSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\EmailController;
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
         ?: redirect('http://' . $user->username . '.' . config('app.url'));
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
         'username' => ['required', 'string', 'max:191', 'unique:users', 'regex:/^[a-z][a-z0-9]*(?:_[a-z0-9]+)*$/'],
         'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
         'password' => ['required', 'string', 'min:8', 'confirmed'],
         'terms-accepted' => ['required', 'integer']
      ], [
         'username.regex' => 'Nazwa użytkownika może zawierać tylko małe litery oraz cyfry i nie może zaczynać się cyfrą.',
         'username.unique' => 'Ta nazwa użytkownika jest zajęta.'
      ], [
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

   private function createUserFolders($user_id)
   {
      File::makeDirectory(base_path() . '/public/photos/' . $user_id);
      File::makeDirectory(base_path() . '/public/photos/' . $user_id . '/thumbnails');
      File::makeDirectory(base_path() . '/public/photos/' . $user_id . '/header');
      Image::make(base_path() . '/public/img/top.jpg')->save(base_path() . '/public/photos/' . $user_id . '/header/header.jpg');
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
      $username = $user->username;

      $this->addAboutMe($id, $name);
      $this->addFirstAlbum($id);
      $this->createUserFolders($id);

      EmailController::newUserRegistered($id, $username);

      return $user;
   }
}
