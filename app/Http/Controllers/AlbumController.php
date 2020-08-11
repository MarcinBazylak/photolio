<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
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

      request()->validate(
         [
            'album_name' => 'required|string|max:30|unique:albums,album_name,NULL,id,user_id,' . Auth::user()->id
         ],
         [
            'album_name.unique' => 'Już posiadasz album o takiej nazwie'
         ],
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

   public function destroy($album)
   {

      $album = Album::where('id', $album)->where('user_id', Auth::user()->id)->firstOrFail();

      if($album->photos()->count() === 0) {
         $alert = [1, 'Album ' . $album->album_name . ' został usunięty'];
         $album->delete();      
      } else {
         $alert = [0, 'Nie można usunąć albumu ' . $album->album_name . ' ponieważ nie jest on pusty.'];
      }

      $albums = Album::where('user_id', Auth::user()->id)->orderBy('album_name', 'asc')->get();
      return view('user.albums', compact('alert', 'albums'));

   }
}
