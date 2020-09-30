<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
   protected $fillable = ['def_album', 'welcome_note'];

   public function user()
   {
     return $this->belongsTo('App\User');
   }
}
