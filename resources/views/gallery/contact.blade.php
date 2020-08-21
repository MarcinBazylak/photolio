@extends('layouts.gallery')

@section('content')
<div class="wrapper">

   <div style="text-align: center">
      {!! session('message') ?? '' !!}
   </div>

   <h2>Napisz do mnie</h2>
   <form enctype="multipart/form-data" action="http://{{ $user->username }}.{{ Config::get('app.url') }}/kontakt" method="post" id="contactForm"">
@csrf
      <p style=" text-align: justify">
      Jeśli masz ochotę dowiedzieć się czegoś więcej na temat moich zdjęć, chcesz użyć któregoś z nich lub chcesz porozmawiać ze mną o fotografii, nie wahaj się do mnie napisać. Możesz zostawić mi wiadomość korzystając z poniższego formularza, a ja postaram się do Ciebie jak najszybciej odpisać.
      </p>

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
