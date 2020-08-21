<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutmesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('aboutmes', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->unsigned();
         $table->string('title');
         $table->text('description')->default('
            To jest opis strony O mnie. 
            Możesz go w każej chwili edytować w ustawieniach swojego konta.
             ');
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('aboutmes');
   }
}
