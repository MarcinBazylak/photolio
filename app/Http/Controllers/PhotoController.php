<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

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

   public function store()
   {
      return redirect('/panel/photos');
   }

   public function delete()
   {
      return redirect('/panel/photos');
   }

   public function destroy()
   {
      return redirect('/panel/photos');
   }

   public function edit()
   {
      return redirect('/panel/photos');
   }

   public function update()
   {
      return redirect('/panel/photos');
   }
}