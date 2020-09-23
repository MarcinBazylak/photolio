<!DOCTYPE html>
<html lang="pl">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
   <link rel="stylesheet" href="{{ asset('/css/forms.css') }}">
   <link rel="stylesheet" href="{{ asset('/css/main.menu.css') }}">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Photolio.pl - Twoje portfolio fotograficzne</title>
   <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body>
   <div class="container">
      <label class="navigation-toggle" id="toggle" for="input-toggle">
         <span></span>
         <span></span>
         <span></span>
      </label>
      <input type="checkbox" id="input-toggle">
      <nav>
         <ul>
            <li>
               <a href="/" class="menuBtn"><img class="menu-icon" src="{{ asset('/img/home.png') }}" alt="home icon">Strona główna</a>
            </li>
            @auth
               <li>
                  <a href="http://{{ Auth::user()->username }}.{{ Config::get('app.url') }}" class="menuBtn"><img class="menu-icon" src="{{ asset('/img/gallery.png') }}" alt="gallery icon">Twoja Galeria</a>
               </li>
               <li>
                  <a href="/panel" class="menuBtn"><img class="menu-icon" src="{{ asset('/img/settings.png') }}" alt="settings icon">Panel</a>
               </li>
               <li>
                  <a href="/logout" class="menuBtn"><img class="menu-icon" src="{{ asset('/img/logout.png') }}" alt="logout icon">Wyloguj</a>
               </li>
            @endauth
            @guest
               <li>
                  <a href="{{ URL::route('login') }}" class="menuBtn"><img class="menu-icon" src="{{ asset('/img/login.png') }}" alt="login icon">Zaloguj się</a>
               </li>
               <li>
                  <a href="/register" class="menuBtn"><img class="menu-icon" src="{{ asset('/img/register.png') }}" alt="register icon">Załóż konto</a>
               </li>
            @endguest
            <li>
               <a href="/#kontakt" class="menuBtn"><img class="menu-icon" src="{{ asset('/img/contact.png') }}" alt="contact icon">Kontakt</a>
            </li>
         </ul>
      </nav>
      @yield('content')
   </div>
   <script>
      $('.menuBtn').click(function() {
         $('#input-toggle').prop('checked', false);
      });
   </script>
</body>

</html>
