<?php
namespace App\Services\Albums;

use App\Album;
use Illuminate\Support\Facades\Auth;

class UpdateAlbum
{

   public $alert;
   private $successful;
   private $failed;

   public function __construct($albumId, $request)
   {
      $request->validate(
         [
            'album_name' => 'required|string|max:30|unique:albums,album_name,NULL,id,user_id,' . Auth::user()->id
         ],
         [
            'album_name.unique' => 'Już posiadasz album o nazwie "' . $request['album_name'] . '".'
         ],
         [
            'album_name' => 'Nazwa albumu'
         ]
      );

      $album = Album::where('user_id', Auth::user()->id)->findOrFail($albumId);

      $this->successful = 'Nazwa albumu "' . $album->album_name . '" została zmieniona na "' . $request['album_name'] . '".';
      $this->failed = 'Nazwa albumu "' . $album->album_name . '" nie została zmieniona.';
      
      $this->alert = ($this->save($album, $request)) ? $this->successful : $this->failed;
   }

   private function save($album, $data)
   {
      $album->photos()->update(['album_name' => $data['album_name']]);
      $album->album_name = $data['album_name'];
      return $album->save();
   }
}