<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\fromGallery;
use App\Mail\fromMainPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
   private $user;

   public function sendToUser(Request $request)
   {

      $validator = Validator::make(
         $request->all(),
         [
            'name'  => 'required',
            'email'  => 'required|email',
            'enquiry' => 'required'
         ],
         [],
         [
            'name'  => 'Imię',
            'email'  => 'Adres email',
            'enquiry' => 'Wiadomość'
         ]
      );

      if ($validator->fails()) {
         return redirect()
         ->back()
         ->withErrors($validator)
            ->withInput();
      }

      $username = Route::current()->parameter('username');
      $this->user = User::where('username', $username)->firstOrFail();

      $mailable = new fromGallery(request('name'), request('enquiry'));
      $mailable->replyTo(request('email'), request('name'));
      $mailable->subject(request('name') . ' wysłał Ci wiadomość z Photolio.pl');

      Mail::to($this->user->email)->send($mailable);

      $alert = '<div class="green">Twoja wiadomość została wysłana. Dziękuję.</div>';
      return redirect()->back()->with('message', $alert);;
   }

   public function sendToAdmin(Request $request)
   {

      $validator = Validator::make(
         $request->all(),
         [
            'contact-name'  => 'required',
            'contact-email'  => 'required|email',
            'enquiry' => 'required'
         ],
         [],
         [
            'contact-name'  => 'Imię',
            'contact-email'  => 'Adres email',
            'enquiry' => 'Wiadomość'
         ]
      );

      if ($validator->fails()) {
         return redirect('/#kontakt')
            ->withErrors($validator)
            ->withInput();
      }

      $mailable = new fromMainPage(request('contact-name'), request('contact-email'), request('enquiry'));
      $mailable->replyTo(request('contact-email'), request('contact-name'));
      $mailable->subject('Nowa wiadomość od ' . request('contact-name') . ' z serwisu Photolio.pl');

      Mail::to('kontakt@photolio.pl')->send($mailable);

      $alert = '<div class="green">Twoja wiadomość została wysłana. Dziękujemy.</div>';
      return redirect('/#kontakt')->with('message', $alert);;
   }
}
