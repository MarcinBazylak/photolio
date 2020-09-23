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
            'albumName' => 'required|string|max:30|unique:albums,album_name,NULL,id,user_id,' . Auth::user()->id
         ],
         [
            'albumName.unique' => 'Już posiadasz album o nazwie "' . $request['albumName'] . '"',
            'albumName.required' => 'Pole "nazwa albumu" nie może być puste'
         ],
         [
            'albumName' => 'Nazwa albumu'
         ]
      );

      $album = Album::where('user_id', Auth::user()->id)->findOrFail($albumId);

      $this->successful = 'Nazwa albumu "' . $album->album_name . '" została zmieniona na "' . $request['albumName'] . '"';
      $this->failed = 'Nazwa albumu "' . $album->album_name . '" nie została zmieniona';
      
      $this->alert = ($this->save($album, $request)) ? $this->successful : $this->failed;
   }

   private function save($album, $data)
   {
      $album->photos()->update(['album_name' => $data['albumName']]);
      $album->album_name = $data['albumName'];
      return $album->save();
   }
}