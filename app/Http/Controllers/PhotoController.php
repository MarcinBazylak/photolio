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
}
