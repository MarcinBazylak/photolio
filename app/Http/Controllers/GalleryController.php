<?php

namespace App\Http\Controllers;

use App\User;
use App\Aboutme;
use App\Album;
use App\Photo;
use Illuminate\Support\Facades\Route;

class GalleryController extends Controller
{

   private $user;
   private $currentAlbum;

   public function __construct()
   {
      $this->user = User::where('username', Route::current()->parameter('username'))->firstOrFail();
      $this->currentAlbum = Album::where('user_id', $this->user->id)->find($this->user->settings->def_album);
   }

   public function index()
   {
      $currentAlbum = $this->currentAlbum;
      $photos = Photo::where('album_id', $this->user->settings->def_album)->get();
      return view('gallery.index', compact('photos', 'currentAlbum'));
   }

   public function album($username, $album)
   {
      $currentAlbum = Album::where('user_id', $this->user->id)->findOrFail($album);
      $photos = Photo::where('album_id', $album)->get();
      return view('gallery.index', compact('photos', 'currentAlbum'));
   }

   public function aboutMe()
   {
      $aboutMe = Aboutme::where('user_id', $this->user->id)->first();
      return view('gallery.aboutMe', compact('aboutMe'));
   }

   public function contact()
   {
      return view('gallery.contact');
   }
}
