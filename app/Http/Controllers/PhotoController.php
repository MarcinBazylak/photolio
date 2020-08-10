<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Controllers\Controller;
use App\Photo;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{

   public function __construct()
   {
      $this->middleware('verified');
   }

   public function index()
   {
      $albums = Album::where('user_id', Auth::user()->id)->orderBy('album_name', 'asc')->get();
      $photos = Photo::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
      return view('user.photos', compact('albums', 'photos'));
   }
}
