<?php
namespace App\Services\UserSettings;

use App\User;
use App\UserSetting;
use Illuminate\Support\Facades\Auth;

class UpdateSettings
{

   public $alert;
   private $successful;
   private $failed;

   public function __construct($request)
   {
      
      $request->validate(
         [
            'username' => 'required|max:191|string|regex:/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/|unique:users,username,' . Auth::user()->id,
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

      $this->successful = 'Ustawienia zostały zapisane!';
      $this->failed = 'Ustawienia nie zostały zapisane!';

      $this->alert = ($this->updateUserSettings($request) && $this->updateUserDetails(($request))) ? $this->successful : $this->failed;

   }

   private function updateUserSettings($data)
   {
      $user = User::find(Auth::user()->id);
      $user->username = $data['username'];
      $user->name = $data['name'];
      return $user->save();
   }

   private function updateUserDetails($data)
   {
      $settings = UserSetting::where('user_id', Auth::user()->id)->first();
      $settings->def_album = $data['def_album'];
      $settings->empty_albums = $data['empty_albums'];
      $settings->welcome_note = $data['welcome_note'];
      $settings->facebook = $data['facebook'];
      $settings->youtube = $data['youtube'];
      $settings->instagram = $data['instagram'];
      return $settings->save();
   }
}

?>