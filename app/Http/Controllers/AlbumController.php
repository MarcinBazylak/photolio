<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AlbumController extends Controller
{
   public function __construct()
   {
      $this->middleware('verified');
   }

   public function index()
   {
      $albums = Album::where('user_id', Auth::user()->id)->orderBy('album_name', 'asc')->get();
      return view('user.albums', compact('albums'));
   }
}
