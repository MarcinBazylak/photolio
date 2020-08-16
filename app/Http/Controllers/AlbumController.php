<?php

namespace App\Http\Controllers;

use App\User;
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
            'album_name.unique' => 'Już posiadasz album o nazwie "' . request('album_name') . '"'
         ],
         [
            'album_name' => 'Nazwa albumu'
         ]
      );

      $album = new Album();
      $album->album_name = request('album_name');
      $album->user_id = Auth::user()->id;
      $album->save();

      $alert = 'Album "' . request('album_name') . '" został dodany';
      return redirect('/panel/albums')->with('status', $alert);
   }

   public function delete($album)
   {
      $album = Album::where('user_id', Auth::user()->id)->findOrFail($album);
      return view('user.deleteAlbum', compact('album'));
   }

   public function destroy($album)
   {

      $album = Album::where('user_id', Auth::user()->id)->findOrFail($album);
      $user = User::find(Auth::user()->id);

      if ($album->photos()->count() === 0 && $user->settings->def_album != $album->id) {
         $alert = 'Album "' . $album->album_name . '" został usunięty';
         $album->delete();
      } else {
         $alert = 'Nie można usunąć albumu "' . $album->album_name . '".';
      }

      return redirect('/panel/albums')->with('status', $alert);
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
            'album_name.unique' => 'Już posiadasz album o nazwie "' . request('album_name') . '".'
         ],
         [
            'album_name' => 'Nazwa albumu'
         ]
      );

      $album = Album::where('user_id', Auth::user()->id)->findOrFail($album);
      $alert = 'Nazwa albumu "' . $album->album_name . '" została zmieniona na "' . request('album_name') . '".';
      $album->update(['album_name' => request('album_name')]);
      $album->photos()->update(['album_name' => request('album_name')]);

      return redirect('/panel/albums')->with('status', $alert);
   }
}
