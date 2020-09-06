<!DOCTYPE html>
<html lang="pl">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="/css/main.css">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Photolio.pl - Twoje portfolio fotograficzne</title>
</head>

<body>
   <div class="container">
      <div class="top-bar">
         <a href="/">Strona główna</a>
         @auth
            <a href="http://{{ Auth::user()->username }}.{{ Config::get('app.url') }}">Twoja Strona</a>
            <a href="/panel">Panel</a>
            <a href="/logout">Wyloguj</a>
         @endauth
         @guest
            <a href="{{ URL::route('login') }}">Zaloguj się</a>
            <a href="/register">Załóż konto</a>
         @endguest
      </div>
      @yield('content')
   </div>
</body>

</html>
