@component('mail::message')
# Witaj!

<b>{{ $name }}</b> wysłał Ci wiadomość z Twojej strony w serwisie Photolio.pl<br><br>
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
