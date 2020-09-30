<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutme extends Model
{
   protected $fillable = ['title', 'description'];

   public function user()
   {
      return $this->belongsTo('App\User');
   }
}
