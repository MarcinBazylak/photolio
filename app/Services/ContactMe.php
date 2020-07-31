<?php
namespace App\Services;

use Mail;
use \App\UserSetting;

class ContactMe
{

   public static function sendEmail(string $user_id, string $from, string $name, string $message) : string
   {

      $user = UserSetting::where('uid', $user_id)->firstOrFail();
      // $email = $user->email;

      return '<span style="color: green;"> ' . $user_id . $from . $name . $message . ' Wiadmość została wysłana. Dziękuję.</span>';
   }

}

?>