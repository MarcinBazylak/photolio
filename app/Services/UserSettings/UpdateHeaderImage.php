<?php
namespace App\Services\UserSettings;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UpdateHeaderImage
{

   public $alert;

   public function __construct($request)
   {
      $request->validate(
         [
            'image' => 'required|image|mimetypes:image/jpeg|max:3072|dimensions:min_width=1600,min_height=900'
         ],
         [],
         [
            'image' => 'Plik'
         ]
      );

      $this->saveImage($request);
   }

   private function saveImage($data)
   {
      $img = Image::make($data->file('image'));
      $img->resize(1920, null, function ($constraint) {
         $constraint->aspectRatio();
      });
      $img->save(public_path('photos/' . Auth::user()->id . '/header/header.jpg'));
      $this->alert = 'Zdjęcie zostało pomyślnie zapisane.';
   }
}

?>