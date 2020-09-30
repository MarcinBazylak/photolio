<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserSettings\UpdateAboutMe;
use App\Services\UserSettings\UpdateSettings;
use App\Services\UserSettings\UpdateHeaderImage;

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

   public function updateUserSettings(Request $request)
   {
      $result = new UpdateSettings($request);
      return redirect('/panel')->with('status', $result->alert);
   }

   public function updateAboutMe(Request $request)
   {
      $result = new UpdateAboutMe($request);
      return redirect('/panel/about-me')->with('status', $result->alert);
   }

   public function updateHeaderImage(Request $request)
   {
      $result = new UpdateHeaderImage($request);
      return redirect('/panel/header')->with('status', $result->alert);
   }

}