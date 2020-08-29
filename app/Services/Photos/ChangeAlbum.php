<?php
namespace App\Services\Photos;

use App\Album;
use App\Photo;
use Illuminate\Support\Facades\Auth;

class ChangeAlbum
{
   public $alert;

   public function __construct($photoId, $request)
   {
      $album_name = $this->changeAlbum($photoId, $request);
      $this->alert = 'Zdjęcie zostało przeniesione do albumu "' . $album_name . '"';
   }

   private function changeAlbum($photoId, $request)
   {
      $album = Album::where('user_id', Auth::user()->id)->find($request['album']);
      if (!$album) abort(403, 'Brak autoryzacji.');

      $photo = Photo::where('user_id', Auth::user()->id)->find($photoId);
      if (!$photo) abort(403, 'Brak autoryzacji.');
      
      $photo->update(['album_id' => $album->id, 'album_name' => $album->album_name]);
      return $album->album_name;
   }
}