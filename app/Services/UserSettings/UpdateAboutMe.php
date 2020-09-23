<?php
namespace App\Services\UserSettings;

use App\Aboutme;
use Illuminate\Support\Facades\Auth;


class UpdateAboutMe
{

   public $alert;
   private $successful;
   private $failed;

   public function __construct($request)
   {
      $request->validate(
         [
            'about_me' => 'required'
         ],
         [
            'about_me.required' => 'Opis "O mnie" nie może być pusty'
         ],
         []
      );
      
      $this->successful = 'Treść strony "O mnie" została zapisana';
      $this->failed = 'Treść strony "O mnie" nie została zapisana';

      $this->alert = ($this->update($request)) ? $this->successful : $this->failed;
   }

   private function update($data)
   {
      $aboutMe = Aboutme::where('user_id', Auth::user()->id)->first();
      $aboutMe->description = $data['about_me'];
      return $aboutMe->save();
   }
}

?>