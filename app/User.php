<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PasswordReset;
use App\Notifications\VerifyEmail;

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
