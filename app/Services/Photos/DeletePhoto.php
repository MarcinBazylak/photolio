<?php

namespace App\Services\Photos;

use App\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DeletePhoto
{
   public $alert;

   public function __construct($request)
   {
      $this->deleteFiles($request);
   }

   private function deleteDbEntry($photoId)
   {
         $photo = Photo::where('user_id', Auth::user()->id)->find($photoId);
         if (!$photo) abort(403, 'Brak autoryzacji!');
         $photo->delete();
   }

   private function deleteFiles($data)
   {
      for ($i = 0; $i < count($data['del-photo']); $i++) {
         $photoFile = public_path('photos/' . Auth::user()->id . '/' . $data['del-photo'][$i] . '.jpg');
         $thumbFile = public_path('photos/' . Auth::user()->id . '/thumbnails/' . $data['del-photo'][$i]  . '.jpg');
         File::delete([$photoFile, $thumbFile]);
         $this->deleteDbEntry($data['del-photo'][$i]);
      }
      $this->alert = 'Usunięto zdjęcia (' . $i . ')';
   }
}
