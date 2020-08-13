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
      return view('user.albums');
   }

   public function store()
   {

      request()->validate(
         [
            'album_name' => 'required|string|max:30|unique:albums,album_name,NULL,id,user_id,' . Auth::user()->id
         ],
         [
            'album_name.unique' => 'Już posiadasz album o nazwie ' . request('album_name')
         ],
         [
            'album_name' => 'Nazwa albumu'
         ]
      );

      $album = new Album();
      $album->album_name = request('album_name');
      $album->user_id = Auth::user()->id;
      $album->save();

      $alert = [1, 'Album ' . request('album_name') . ' został dodany'];
      return redirect('/panel/albums')->with('alert', $alert);
   }

   public function delete($album)
   {
      $album = Album::where('user_id', Auth::user()->id)->findOrFail($album);
      return view('user.deleteAlbum', compact('album'));
   }

   public function destroy($album)
   {

      $album = Album::where('user_id', Auth::user()->id)->findOrFail($album);

      if ($album->photos()->count() === 0) {
         $alert = [1, 'Album ' . $album->album_name . ' został usunięty'];
         $album->delete();
      } else {
         $alert = [0, 'Nie można usunąć albumu ' . $album->album_name . ' ponieważ nie jest on pusty.'];
      }

      return redirect('/panel/albums')->with('alert', $alert);
   }

   public function edit($album)
   {
      $album = Album::where('user_id', Auth::user()->id)->findOrFail($album);
      return view('user.editAlbum', compact('album'));
   }

   public function update($album)
   {
      request()->validate(
         [
            'album_name' => 'required|string|max:30|unique:albums,album_name,NULL,id,user_id,' . Auth::user()->id
         ],
         [
            'album_name.unique' => 'Już posiadasz album o nazwie ' . request('album_name')
         ],
         [
            'album_name' => 'Nazwa albumu'
         ]
      );

      $album = Album::where('user_id', Auth::user()->id)->findOrFail($album);
      $alert = [1, 'Nazwa albumu ' . $album->album_name . ' została zmieniona na ' . request('album_name') . '.'];
      $album->update(['album_name' => request('album_name')]);
      $album->photos()->update(['album_name' => request('album_name')]);

      return redirect('/panel/albums')->with('alert', $alert);
   }
}
