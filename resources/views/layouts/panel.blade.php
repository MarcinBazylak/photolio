@php
   use App\Services\Alert;
@endphp
<!DOCTYPE html>
<html lang="pl">

<head>
   <link rel="stylesheet" href="/css/lightbox.css">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Photolio :: Twoje portfolio fotograficzne</title>
   <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   <script src="/js/lightbox.js"></script>
</head>

<body>

   @if(Auth::check())
      <a href="/logout">Wyloguj</a> |
      <a href="/panel">Ustawienia</a> |
      <a href="/panel/albums">Albumy</a> |
      <a href="/panel/photos">Zdjęcia</a>
   @else
      <a href="{{ URL::route('login') }}">Zaloguj się</a> |
      <a href="/register">Załóż konto</a>
   @endif
   <br>

   <div>
      @if(session('alert'))
         {!! Alert::display(session('alert')) !!}
      @endif
   </div>

   @yield('content')

   <script src="/js/menu.js"></script>
   <script src="/js/loading.js"></script>
   <script>
      lightbox.option({
         'albumLabel': ''
      });

   </script>
</body>

</html>
