<?php
namespace App\Services\Albums;

use App\Album;
use Illuminate\Support\Facades\Auth;

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
      if ($album->photos()->count() != 0) {
         $this->reason = 'nie jest on pusty';
         return false;
      } elseif($album->user->settings->def_album === $album->id) {
         $this->reason = 'jest to domyślny album';
         return false;
      } else {
         return $album->delete();
      }
   }
}