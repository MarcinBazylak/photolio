<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use App\Services\Albums\CreateAlbum;
use App\Services\Albums\DeleteAlbum;
use App\Services\Albums\UpdateAlbum;
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

   public function show($albumId)
   {
      $album = Album::where('user_id', Auth::user()->id)->find($albumId);
      $photos = Photo::where('album_id', $albumId)->where('user_id', Auth::user()->id)->get();
      if ($album) {
         return view('user.album', compact('photos', 'album'));
      } else {
         abort(403, 'Brak autoryzacji!');
      }
   }

   public function store(Request $request)
   {
      $result = new CreateAlbum($request);
      return redirect('/panel/albums')->with('status', $result->alert);
   }

   public function destroy($albumId)
   {
      $result = new DeleteAlbum($albumId);
      return redirect('/panel/albums')->with('status', $result->alert);
   }

   public function update($albumId, Request $request)
   {
      $result = new UpdateAlbum($albumId, $request);
      return redirect('/panel/albums')->with('status', $result->alert);
   }
}
