<?php

namespace App\Http\Controllers;

use App\User;
use App\Aboutme;
use App\UserSetting;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    
   public function __construct()
   {
      $this->middleware('verified');
   }
   
   public function index()
   {
      return view('user.index');
   }

   public function update()
   {
      request()->validate(
         [
            'username' => 'required|max:191|string|regex:/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/|unique:users,username,'.Auth::user()->id,
            'name' => 'required|max:191|string',
            'def_album' => 'required',
            'welcome_note' => 'required',
            'facebook' => 'required|url',
            'youtube' => 'required|url',
            'instagram' => 'required|url',
         ],
         [
            'username.regex' => 'Nazwa użytkownika może składać się jedynie z małych i dużych liter oraz cyfr i musi zaczynać się literą'
         ],
         [
            'username' => 'Nazwa użytkownika',
            'name' => 'Imię i nazwisko',
            'welcome_note' => 'Wiadomość powitalna'
         ]
      );

      $settings = UserSetting::where('user_id', Auth::user()->id)->first();
      $settings->def_album = request('def_album');
      $settings->welcome_note = request('welcome_note');
      $settings->facebook = request('facebook');
      $settings->youtube = request('youtube');
      $settings->instagram = request('instagram');
      $settings->save();

      $user = User::find(Auth::user()->id);
      $user->username = request('username');
      $user->name = request('name');
      $user->save();

      $alert = 'Ustawienia zostały zapisane.';
      return redirect('/panel')->with('status', $alert);
   }

   public function aboutMe()
   {
      request()->validate(
         [
            'about_me' => 'required'
         ],
         [
            'about_me.required' => 'Opis "O mnie" nie może być pusty.'
         ],
         []
      );

      $aboutMe = Aboutme::where('user_id', Auth::user()->id)->first();
      $aboutMe->description = request('about_me');
      $aboutMe->save();

      $alert = 'Treść strony "O mnie" została zapisana.';
      return redirect('/panel')->with('status', $alert);
   }
}