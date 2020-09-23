<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

   public function settings()
   {
      return view('admin.settings');
   }

   public function users()
   {
      return view('admin.users');
   }

}
