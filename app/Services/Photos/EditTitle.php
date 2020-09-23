<?php
namespace App\Services\Photos;

use App\Photo;
use Illuminate\Support\Facades\Auth;

class EditTitle
{
   public $alert;

   public function __construct($photoId, $request)
   {
      $success = 'Tytuł został uaktualniony';
      $failure = 'Tytuł nie został uaktualniony';
      $this->alert = ($this->updateTitle($photoId, $request)) ? $success : $failure;
   }

   private function updateTitle($photoId, $data)
   {
      $photo = Photo::where('user_id', Auth::user()->id)->find($photoId);
      if (!$photo) abort(403, 'Brak autoryzacji!');

      return $photo->update(['title' => $data['title']]);
   }
}