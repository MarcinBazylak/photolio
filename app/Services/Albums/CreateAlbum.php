<?php
namespace App\Services\Albums;

use App\Album;
use Illuminate\Support\Facades\Auth;

class CreateAlbum
{

   public $alert;
   private $successful;
   private $failed;

   public function __construct($request)
   {
      $request->validate(
         [
            'album_name' => 'required|string|max:30|unique:albums,album_name,NULL,id,user_id,' . Auth::user()->id
         ],
         [
            'album_name.unique' => 'Już posiadasz album o nazwie "' . request('album_name') . '"'
         ],
         [
            'album_name' => 'Nazwa albumu'
         ]
      );

      $this->successful = 'Album "' . $request['album_name'] . '" został dodany';
      $this->failed = 'Album "' . $request['album_name'] . '" nie został dodany';

      $this->alert = ($this->save($request)) ? $this->successful : $this->failed;
   }

   private function save($data)
   {
      $album = new Album();
      $album->album_name = $data['album_name'];
      $album->user_id = Auth::user()->id;
      return $album->save();
   }
}