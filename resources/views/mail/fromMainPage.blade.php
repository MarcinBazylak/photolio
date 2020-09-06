@component('mail::message')
   # Witaj!

   nowa wiadomość z Photolio.pl od <b>{{ $name }}</b><br><br>
   Oto jej treść:<br>
   <div style="width: 100%; border-top: 1px solid #bbb; border-bottom: 1px solid #bbb;">
      <br>
      {{ $message }}
      <br><br>
   </div>
   <br>
   Pozdrawiamy<br>
   Zespół {{ config('app.name') }}
@endcomponent
