@component('mail::message')
   # Witaj Adminie!

   W serwisie Photolio.pl zarejestrował sie nowy użytkownik.<br><br>

   Adres jego galerii:<br>
   <a href="http://{{ $username }}.{{ config('app.url') }}">http://{{ $username }}.{{ config('app.url') }}</a><br><br>

   Szczegóły konta:<br>
   <a href="http://{{ config('app.url') }}/admin/user/{{ $userId }}">http://{{ config('app.url') }}/admin/user/{{ $userId }}</a><br><br>

   <br>
   Pozdrawiamy<br>
   Zespół {{ config('app.name') }}
@endcomponent