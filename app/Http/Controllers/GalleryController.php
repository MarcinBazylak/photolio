<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Services\UserService;
use App\UserAboutme;
use App\UserPhoto;
use App\UserCategory;
use App\UserSetting;
use Illuminate\Support\Facades\Route;

class GalleryController extends Controller
{

   private $user;
   private $settings;
   private $photos;
   private $albums;
   private $currentAlbum;

   public function __construct() {
      $username = Route::current()->parameter('username');
      $this->user = User::where('username', $username)->firstOrFail();
      $this->settings = UserSetting::where('uid', $this->user->id)->first();
      $this->albums = UserCategory::where('uid', $this->user->id)->get();
      $this->currentAlbum = UserCategory::where('id', $this->settings->def_cat)->where('uid', $this->user->id)->firstOrFail();
   }

    public function index()
    {
      $this->photos = UserPhoto::where('cat_id', $this->settings->def_cat)->where('active', 1)->get();
      return view('userGallery.gallery', ['settings' => $this->settings, 'photos' => $this->photos, 'albums' => $this->albums, 'currentAlbum' => $this->currentAlbum->id]);
    }

    public function album($username, $album)
    {
      $this->currentAlbum = UserCategory::where('id', $album)->where('uid', $this->user->id)->firstOrFail();
      $this->photos = UserPhoto::where('cat_id', $album)->where('active', 1)->get();
      return view('userGallery.gallery', ['settings' => $this->settings, 'photos' => $this->photos, 'albums' => $this->albums, 'currentAlbum' => $this->currentAlbum->id]);
    }

    public function aboutMe() 
    {
      $aboutMe = UserAboutme::where('uid', $this->user->id)->firstOrFail();
      return view('userGallery.aboutMe', ['settings' => $this->settings, 'albums' => $this->albums, 'currentAlbum' => 0, 'aboutMe' => $aboutMe]);
    }

    public function contact() 
    {
      return view('userGallery.contact', ['settings' => $this->settings, 'photos' => $this->photos, 'albums' => $this->albums, 'currentAlbum' => 0]);
    }

}