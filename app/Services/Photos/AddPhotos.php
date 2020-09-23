<?php

namespace App\Services\Photos;

use App\Album;
use App\Photo;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AddPhotos
{

   public $alert;
   public $uploaded = [];

   public function __construct($request)
   {
      $request->validate(
         [
            'album' => 'required',
            'images'  => 'array|max:12|required',
            'images.*' => 'image|mimes:jpg,jpeg|max:2048'
         ],
         [
            'images.required' => 'Musisz wybrać zdjęcia z dysku',
            'images.max' => 'Możesz przesłać jednorazowo maksymalnie 12 zdjęć',
            'album.required' => 'Musisz wybrać album dla zdjęć',
            'images.*.max' => 'Zdjęcia nie moga być wieksze niż 2MB'
         ],
         [
            'images' => 'Zdjęcia',
            'album' => 'Album'
         ]
      );

      $this->saveImages($request);
   }

   private function saveImages($data)
   {

      $images = $data->file('images');

      if ($data->hasFile('images')) :
         $i = 0;

         foreach ($images as $image) :

            $lastId = $this->createDbEntry($data['album']);

            $img = Image::make($image);
            $photo = $img->resize(1920, null, function ($constraint) {
               $constraint->aspectRatio();
            });
            $photo->save(public_path('photos/' . Auth::user()->id . '/' . $lastId . '.jpg'));

            $thumbnail = $img->resize(400, null, function ($constraint) {
               $constraint->aspectRatio();
            });
            $thumbnail->save(public_path('photos/' . Auth::user()->id . '/thumbnails/' . $lastId . '.jpg'));

            $i++;
            $this->uploaded[] = $lastId;
         endforeach;
         $this->alert = 'Dodano zdjęcia (' . $i . ')';
      endif;
      return $this->uploaded;
   }

   private function createDbEntry($albumId)
   {
      $album = Album::where('user_id', Auth::user()->id)->find($albumId);
      if ($album) {
         $photo = new Photo();
         $photo['user_id'] = Auth::user()->id;
         $photo['album_id'] = $albumId;
         $photo['album_name'] = $album->album_name;
         $photo->save();
         return $photo->id;
      } else {
         abort(403, 'Brak autoryzacji!');
      }
   }
}
