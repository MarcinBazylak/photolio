<?php
namespace App\Services;

Class Alert
{
   public static function display($message)
   {
      return '<strong>' . $message . '</strong>';
   }
}
?>