<?php

namespace App\Services\Photos;

use App\Photo;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddTitles
{

   public $alert;

   public function __construct($request)
   {
      $validator = Validator::make($request->all(), [
         'photo'  => 'required|array|max:12',
         'title'  => 'required|array|max:12'
      ]);

      if ($validator->fails()) {
         return redirect('panel/photos')
            ->withErrors($validator)
            ->withInput();
      }

      $this->save($request);
   }

   private function save($data)
   {
      for ($i = 0; $i < count($data['photo']); $i++) {
         $photo = Photo::where('user_id', Auth::user()->id)->find($data['photo'][$i]);
         if (!$photo) {
            abort(403, 'Brak autoryzacji!');
         }
            $photo->title = htmlspecialchars($data['title'][$i]);
            $photo->save();
      }

      $this->alert = 'Tytuły zostały dodane do zdjęć';
   }
}
