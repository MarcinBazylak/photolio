<?php

namespace App\Services\Albums;

use App\Album;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DeleteAlbum
{

   public $alert;
   private $successful;
   private $failed;
   private $reason;

   public function __construct($albumId)
   {
      $album = Album::where('user_id', Auth::user()->id)->find($albumId);
      if (!$album) abort(403, 'Brak autoryzacji!');

      $this->successful = 'Album "' . $album->album_name . '" został usunięty';
      $this->failed = 'Nie można usunąć albumu "' . $album->album_name . '", ponieważ ';
      $this->alert = ($this->delete($album)) ? $this->successful : $this->failed . $this->reason;
   }

   private function delete($album)
   {
      if ($album->user->settings->def_album === $album->id) {
         $this->reason = 'jest to domyślny album';
         return false;
      } else {
         foreach ($album->photos()->get() as $photo) {
            $this->deleteFile($photo->id);
         }
         $album->photos()->delete();
         return $album->delete();
      }
   }

   private function deleteFile($photoId)
   {
      $photoFile = public_path('photos/' . Auth::user()->id . '/' . $photoId . '.jpg');
      $thumbFile = public_path('photos/' . Auth::user()->id . '/thumbnails/' . $photoId  . '.jpg');
      File::delete([$photoFile, $thumbFile]);
   }
}
