<?php
namespace App\Services\Photos;

use App\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DeletePhoto
{
   public $alert;

   public function __construct($photoId)
   {
      $this->alert = $this->deleteDbEntry($photoId) ? 'Zdjęcie ' . $photoId . ' zostało pomyslnie usunięte.' : 'Zdjęcie nie zostało usunięte!';
   }

   private function deleteDbEntry($photoId)
   {
      $photo = Photo::where('user_id', Auth::user()->id)->find($photoId);
      if (!$photo) abort(403, 'Brak autoryzacji.');

      return ($photo->delete()) ? $this->deleteFile($photoId) : false;
   }
   
   private function deleteFile($photoId)
   {
      $photoFile = public_path('photos/' . Auth::user()->id . '/' . $photoId . '.jpg');
      $thumbFile = public_path('photos/' . Auth::user()->id . '/thumbnails/' . $photoId . '.jpg');
      return File::delete([$photoFile, $thumbFile]);
   }
}