<?php

namespace App;

use App\Notifications\VerifyEmail;
use App\Notifications\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    
   use Notifiable;
   protected $fillable = ['name', 'username', 'email', 'password'];

   public function sendPasswordResetNotification($token)
   {
       $this->notify(new PasswordReset($token));
   }

   public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

}
