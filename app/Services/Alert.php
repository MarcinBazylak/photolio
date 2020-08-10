<?php
namespace App\Services;

Class Alert
{
   public static function display($message)
   {
      return ($message[0] == 0) ? '<span style="color: orangered; font-weight: 800;">' . $message[1] . '</span>' :'<span style="color: green; font-weight: 800;">' . $message[1] . '</span>';
   }
}
?>