<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Mail\fromGallery;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class EmailController extends Controller
{
   private $user;

   public function sendToUser()
   {
      $username = Route::current()->parameter('username');
      $this->user = User::where('username', $username)->firstOrFail();

      $mailable = new fromGallery(request('name'), request('enquiry'));
      $mailable->replyTo(request('email'), request('name'));
      $mailable->subject(request('name') . ' wysłał Ci wiadomość z Photolio.pl');
      
      Mail::to($this->user->email)->send($mailable);

      $alert = '<div class="green">Twoja wiadomość została wysłana. Dziękuję.</div>';
      return redirect()->back()->with('message', $alert);;
   }
}