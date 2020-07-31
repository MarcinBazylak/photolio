<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Aboutme;
use App\Photo;
use App\Album;
use Mail;
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
      $this->albums = Album::where('user_id', $this->user->id)->orderBy('album_name', 'asc')->get();
      $this->currentAlbum = Album::where('id', $this->user->def_album)->where('user_id', $this->user->id)->first();
   }

    public function index()
    {
      $this->photos = Photo::where('album_id', $this->user->def_album)->get();
      return view('userGallery.gallery', ['user' => $this->user, 'photos' => $this->photos, 'albums' => $this->albums, 'currentAlbum' => $this->currentAlbum->id]);
    }

    public function album($username, $album)
    {
      $this->currentAlbum = Album::where('id', $album)->where('user_id', $this->user->id)->firstOrFail();
      $this->photos = Photo::where('album_id', $album)->get();
      return view('userGallery.gallery', ['user' => $this->user, 'photos' => $this->photos, 'albums' => $this->albums, 'currentAlbum' => $this->currentAlbum->id]);
    }

    public function aboutMe() 
    {
      $aboutMe = Aboutme::where('user_id', $this->user->id)->first();
      return view('userGallery.aboutMe', ['user' => $this->user, 'albums' => $this->albums, 'aboutMe' => $aboutMe]);
    }

    public function contact() 
    {
      return view('userGallery.contact', ['user' => $this->user, 'albums' => $this->albums]);
    }

}