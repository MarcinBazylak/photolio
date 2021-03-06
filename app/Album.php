<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
   protected $fillable = ['user_id', 'album_name'];

   public function photos()
    {
    	return $this->hasMany('App\Photo');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
