<!DOCTYPE html>
<html lang="pl">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Photolio.pl - Twoje portfolio fotograficzne</title>
</head>
<body>

   @if (Auth::check())
      <a href="/logout">Wyloguj</a> 
   @else
      <a href="{{ URL::route('login') }}">Logowanie</a> 
      <a href="/register">Rejestracja</a> 
   @endif
   <br>

   @yield('content')
   
</body>
</html>