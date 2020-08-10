<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Support\Facades\Auth;

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

   public function store()
   {

      request()->validate([
         'album_name' => 'required|string|max:30|unique:albums,album_name,NULL,id,user_id,'.Auth::user()->id
      ],
         [],
         [
            'album_name' => 'Nazwa albumu'
         ]
      );

      $album = new Album();
      $album->album_name = request('album_name');
      $album->user_id = Auth::user()->id;
      $album->save();

      $albums = Album::where('user_id', Auth::user()->id)->orderBy('album_name', 'asc')->get();
      $alert = [1, 'Album ' . request('album_name') . ' został dodany'];
      return view('user.albums', compact('alert', 'albums'));
   }
}
