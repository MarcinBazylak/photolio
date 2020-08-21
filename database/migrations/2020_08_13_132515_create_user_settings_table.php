<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSettingsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('user_settings', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->unsigned();
         $table->integer('def_album')->nullable();
         $table->string('accent_color')->default('ADFF2F');
         $table->boolean('empty_albums')->default(1);
         $table->text('welcome_note', 500)->default('
         To jest wiadomość powitalna Twojej strony. 
         Możesz w niej umieścić informacje o sobie lub o swoich zainteresowaniach. 
         Możesz ją edytować w ustawieniach.
         ');
         $table->string('instagram');
         $table->string('youtube');
         $table->string('facebook');
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
      Schema::dropIfExists('user_settings');
   }
}
