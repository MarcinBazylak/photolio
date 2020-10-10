<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Photos\AddPhotos;
use App\Http\Controllers\Controller;
use App\Photo;
use App\Services\Photos\AddTitles;
use App\Services\Photos\ChangeAlbum;
use App\Services\Photos\DeletePhoto;
use App\Services\Photos\EditTitle;

class PhotoController extends Controller
{

   public function __construct()
   {
      $this->middleware('verified');
   }

   public function index()
   {
      return view('user.photos');
   }

   public function store(Request $request)
   {
      $result = new AddPhotos($request);
      return view('user.addTitles', ['result' => $result, 'status' => $result->alert]);
   }

   public function destroy(Request $request)
   {
      $result = new DeletePhoto($request);
      return redirect()->back()->with('status', $result->alert);
   }

   public function changeAlbum($photoId, Request $request)
   {
      $result = new ChangeAlbum($photoId, $request);
      return redirect()->back()->with('status', $result->alert);
   }

   public function update($photoId, request $request)
   {
      $result = new EditTitle($photoId, $request);
      return redirect()->back()->with('status', $result->alert);
   }

   public function addTitles(Request $request)
   {
      $result = new AddTitles($request);
      return redirect('/panel/photos')->with('status', $result->alert);
   }
}
