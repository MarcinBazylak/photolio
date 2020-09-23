<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

   public function settings()
   {
      return view('admin.settings');
   }

   public function users()
   {
      $users = User::get();
      return view('admin.users', ['users' => $users]);
   }

}
