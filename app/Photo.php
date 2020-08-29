<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

   protected $fillable = ['album_id', 'album_name', 'title'];

   public function user()
   {
     return $this->belongsTo('App\User');
   }

   public function album()
   {
     return $this->belongsTo('App\Album');
   }
}
