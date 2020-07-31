<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Album;
use Mail;
use Illuminate\Support\Facades\Route;

class EmailController extends Controller
{
   private $user;
   private $settings;
   private $albums;

   public function sendToUser() {

      $username = Route::current()->parameter('username');
      $this->user = User::where('username', $username)->firstOrFail();
      $this->albums = Album::where('user_id', $this->user->id)->get();

      $data = array('text'=>request('enquiry'), 'name'=>request('name'));
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to($this->user->email, $this->user->name)
         ->subject(request('name') . ' wysyła Ci wiadomość z Twojej strony w Photolio.pl')
         ->replyTo(request('email'), request('name'));
         $message->from('admin@photolio.pl','Photolio');
      });

      $alert = '<div class="green">Twoja wiadomość została wysłana. Dziękuję.</div>';
      return view('userGallery.contact', ['user' => $this->user, 'albums' => $this->albums, 'message' => $alert]);

    }
}
