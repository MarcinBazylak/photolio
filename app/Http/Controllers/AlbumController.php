<?php

namespace App\Http\Controllers;

use App\Album;
use App\Services\Albums\CreateAlbum;
use App\Services\Albums\DeleteAlbum;
use App\Services\Albums\UpdateAlbum;
use Illuminate\Http\Request;
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

   public function store(Request $request)
   {
      $result = new CreateAlbum($request);
      return redirect('/panel/albums')->with('status', $result->alert);
   }

   public function delete($albumId)
   {
      $album = Album::where('user_id', Auth::user()->id)->findOrFail($albumId);
      return view('user.deleteAlbum', compact('album'));
   }

   public function destroy($albumId)
   {
      $result = new DeleteAlbum($albumId);
      return redirect('/panel/albums')->with('status', $result->alert);
   }

   public function edit($albumId)
   {
      $album = Album::where('user_id', Auth::user()->id)->findOrFail($albumId);
      return view('user.editAlbum', compact('album'));
   }

   public function update($albumId, Request $request)
   {
      $result = new UpdateAlbum($albumId, $request);
      return redirect('/panel/albums')->with('status', $result->alert);
   }
}
