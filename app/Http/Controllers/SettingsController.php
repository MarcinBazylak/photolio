<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    
   public function __construct()
   {
      $this->middleware('verified');
   }
   
   public function index()
   {
      return view('user.index');
   }
}