@php
   use App\Services\Alert;
@endphp
<!DOCTYPE html>
<html lang="pl">

<head>
   <link rel="stylesheet" href="{{ asset('/css/lightbox.css') }}">
   <link rel="stylesheet" href="{{ asset('/css/panel.css') }}">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Photolio :: Twoje portfolio fotograficzne</title>
   <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   <script src="{{ asset('/js/lightbox.js') }}"></script>
</head>

<body>

   @auth
      <a href="/logout">Wyloguj</a> |
      <a href="/panel">Ustawienia</a> |
      <a href="/panel/albums">Albumy</a> |
      <a href="/panel/photos">Zdjęcia</a>
   @endauth
   @if(Auth::user()->is_admin)
      | <a href="/admin">Admin</a>
      | <a href="/admin/users">Użytkownicy</a>
   @endif
   @guest
      <a href="{{ URL::route('login') }}">Zaloguj się</a> |
      <a href="/register">Załóż konto</a>
   @endguest
   <br>

   @if(session('status') !== null || !isset($status))
      <div class="alert">
         {!! Alert::display($status ?? session('status')) !!}
      </div>
   @endif


   @yield('content')

   <script>
      lightbox.option({
         'albumLabel': ''
      });

   </script>
   <script src="{{ asset('/js/menu.js') }}"></script>
   <script src="{{ asset('/js/loading.js') }}"></script>
   <script src="{{ asset('/js/delete-photo.js') }}"></script>
</body>

</html>
