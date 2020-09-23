@component('mail::message')
   # Witaj {{ $name }}!

   Veryfikacja Twojego adresu email przebiegła pomyślnie.<br><br>

   Adres Twojej strony:<br>
   <a href="http://{{ $username }}.{{ config('app.url') }}">http://{{ $username }}.{{ config('app.url') }}</a><br><br>

   Adres panelu administracyjnego:<br>
   <a href="http://{{ config('app.url') }}/panel">http://{{ config('app.url') }}/panel</a><br><br>

   Twój login: {{ $email }}<br>
   Twoje hasło: ********
   
   <br>
   Pozdrawiamy<br>
   Zespół {{ config('app.name') }}
@endcomponent