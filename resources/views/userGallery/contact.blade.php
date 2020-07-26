@extends('layouts.gallery')

@section('content')
<div class="wrapper">

   <h2>Napisz do mnie</h2>
      <form enctype="multipart/form-data" action="send.php" method="post" id="contactForm"">
         @csrf   
         <p style=" text-align: justify">
         {{ $settings->contact_pre_pl }}
         </p>
         <div id="message"></div>
         <div class="form">
            <div>
               <input placeholder="Twoje imię" id="name" type="text" name="name" class="contact" maxlength="80" autocomplete="off" required><input placeholder="Twój adres email" id="email" type="email" name="email" class="contact" maxlength="80" autocomplete="off" required>
            </div>
            <div>
               <textarea placeholder="Twoja wiadomość" class="contact" id="txtInput" name="enquiry" oninput="this.style.height = '' ;this.style.height = this.scrollHeight + 'px'" required></textarea>
               <input type="checkbox" name="tick" id="tick" value="123" style="display: none;">
            </div>
            <div>
               <button type="submit" class="contact" name="button">Wyślij</button>
            </div>
         </div>
      </form>

</div>
@endsection