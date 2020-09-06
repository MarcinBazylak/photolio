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
   <div class="container">
      <header>


      </header>

      <aside>
         <ul>
            @auth
               <li><a href="/panel">Ustawienia</a></li>
               <li><a href="/panel/albums">Albumy</a></li>
               <li><a href="/panel/photos">Zdjęcia</a></li>
            @endauth
            @if(Auth::user()->is_admin)
               <li><a href="/admin">Admin</a></li>
               <ul>
                  <li><a href="/admin/users">Użytkownicy</a></li>
                  <li><a href="/admin/settings">Ustawienia</a></li>
               </ul>
            @endif
            @guest
               <li><a href="{{ URL::route('login') }}">Zaloguj się</a></li>
               <li><a href="/register">Załóż konto</a></li>
            @endguest
            @auth
                <li><a href="/logout">Wyloguj</a></li>
            @endauth

         </ul>
      </aside>

      <main>
         @if(session('status') !== null || !empty($status))
            <div class="alert">
               {!! Alert::display($status ?? session('status')) !!}
            </div>
         @endif

         @yield('content')
      </main>

      <footer>FOOTER</footer>
   </div>
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
