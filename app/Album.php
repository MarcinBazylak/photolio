<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
   protected $fillable = ['user_id', 'album_name'];
}
