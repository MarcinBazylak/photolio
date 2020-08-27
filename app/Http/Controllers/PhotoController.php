<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Photos\AddPhotos;
use App\Http\Controllers\Controller;
use App\Photo;
use App\Services\Photos\AddTitles;
use App\Services\Photos\DeletePhoto;

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
      return view('user.photos', ['result' => $result, 'status' => $result->alert]);
   }

   public function destroy($photoId)
   {
      $result = new DeletePhoto($photoId);
      return redirect('/panel/photos')->with('status', $result->alert);
   }

   public function edit()
   {
      return redirect('/panel/photos');
   }

   public function update()
   {
      return redirect('/panel/photos');
   }

   public function addTitles(Request $request)
   {
      $result = new AddTitles($request);
      return redirect('/panel/photos')->with('status', $result->alert);
   }
}
