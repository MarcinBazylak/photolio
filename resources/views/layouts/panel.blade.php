@php
   use App\Services\Alert;
@endphp
<!DOCTYPE html>
<html lang="pl">

<head>
   <link rel="stylesheet" href="{{ asset('/css/lightbox.css') }}?{{ time() }}">
   <link rel="stylesheet" href="{{ asset('/css/panel.css') }}?{{ time() }}">
   <link rel="stylesheet" href="{{ asset('/css/panel.menu.css') }}?{{ time() }}">
   <link rel="stylesheet" href="{{ asset('/css/panel.forms.css') }}?{{ time() }}">
   <link rel="shortcut icon" href="{{ asset('/img/icon.ico') }}" type="image/x-icon">
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
         <img class="logo" src="{{ asset('/img/logo.png') }}" alt="Logo">
      </header>
      <label class="navigation-toggle" id="toggle" for="input-toggle">
         <span></span>
         <span></span>
         <span></span>
      </label>
      <input type="checkbox" id="input-toggle">
      <aside>
         <nav>
            <ul>
               <li><a href="/" menuBtn">Photolio.pl</a></li>
               <li><a href="http://{{ Auth::user()->username }}.{{ Config::get('app.url') }}" target="_blank" class="menuBtn">Twoja Galeria</a></li>
               @auth
                  <li>
                     <a href="/panel" class="menuBtn">Ustawienia</a>
                  </li>
                  <ul>
                     <li><a href="/panel" class="{{ (request()->path() == 'panel') ? 'active' : '' }} menuBtn">Konto</a></li>
                     <li><a href="/panel/about-me" class="{{ (request()->path() == 'panel/about-me') ? 'active' : '' }} menuBtn">O mnie</a></li>
                     <li><a href="/panel/header" class="{{ (request()->path() == 'panel/header') ? 'active' : '' }} menuBtn">Zdjęcie nagłówka</a></li>
                     {{-- <li><a href="/panel/colors" class="{{ (request()->path() == 'panel/colors') ? 'active' : '' }} menuBtn">Kolory</a></li> --}}
                  </ul>
                  <li><a href="/panel/albums" class="{{ (request()->path() == 'panel/albums') ? 'active' : '' }} menuBtn">Albumy</a></li>
                  <li><a href="/panel/photos" class="{{ (request()->path() == 'panel/photos') ? 'active' : '' }} menuBtn">Zdjęcia</a></li>
               @endauth
               @if(Auth::user()->is_admin)
                  <li><a href="/admin/settings" class="menuBtn">Admin</a></li>
                  <ul>
                     <li><a href="/admin/settings" class="{{ (request()->path() == 'admin/settings') ? 'active' : '' }} menuBtn">Ustawienia</a></li>
                     <li><a href="/admin/users" class="{{ (request()->path() == 'admin/users') ? 'active' : '' }} menuBtn">Użytkownicy</a></li>
                  </ul>
               @endif
               @guest
                  <li><a href="{{ URL::route('login') }}" class="menuBtn">Zaloguj się</a></li>
                  <li><a href="/register" class="menuBtn">Załóż konto</a></li>
               @endguest
               @auth
                  <li><a href="/logout" class="menuBtn">Wyloguj</a></li>
               @endauth
            </ul>
         </nav>
      </aside>

      <main>
         @if(session('status') !== null || !empty($status))
            <div class="alert">
               {!! Alert::display($status ?? session('status')) !!}
            </div>
         @endif

         @yield('content')
      </main>

      <footer>Copyright 2020 Photolio.pl</footer>
   </div>
   <script src="{{ asset('/js/menu.js') }}"></script>
   <script src="{{ asset('/js/input.js') }}"></script>
   <script src="{{ asset('/js/loading.js') }}"></script>
   <script src="{{ asset('/js/delete-photo.js') }}"></script>
   <script src="{{ asset('/js/delete-album.js') }}"></script>
   <script>
      lightbox.option({
         'albumLabel': ''
      });

      $('.menuBtn').click(function () {
         $('#input-toggle').prop('checked', false);
      });

      function hidePrompt() {
         $(".screen-overlay").animate({
               opacity: 0,
            },
            200
         );
         setTimeout(() => {
            $(".screen-overlay").empty().css("display", "none");
         }, 1000);
      }

      function uncheck() {
         $('.gallery').css("backgroundColor", "white");
         $('.checkbox').prop("checked", false);
         $("#del-button")
            .prop("disabled", true)
            .text("Usuń");
      }

         function showDelPhotosPrompt() {
         var text =
         '<div class="popup">' +
            "<p>Czy na pewno chcesz usunąć " + $(".checkbox:checked").length + " zdjęć?</p>" +
            '<button onclick="hidePrompt();uncheck()" type="button" class="form-control-small">ANULUJ</button> <button form="delete-photos" type="submit" class="form-control-small">USUŃ</button>' +
            "</div>";
         $(".screen-overlay").append(text).css("display", "flex").animate({
         opacity: 1,
         },
         "fast"
         );
         }

   </script>

</body>

</html>
