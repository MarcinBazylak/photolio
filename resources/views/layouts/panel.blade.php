@php
   use App\Services\Alert;
@endphp
<!DOCTYPE html>
<html lang="pl">

<head>
   <link rel="stylesheet" href="{{ asset('/css/lightbox.css') }}">
   <link rel="stylesheet" href="{{ asset('/css/panel.css') }}">
   <link rel="stylesheet" href="{{ asset('/css/panel.menu.css') }}">
   <link rel="stylesheet" href="{{ asset('/css/panel.forms.css') }}">
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
                     <li><a href="/panel/colors" class="{{ (request()->path() == 'panel/colors') ? 'active' : '' }} menuBtn">Kolory</a></li>
                  </ul>
                  <li><a href="/panel/albums" class="{{ (request()->path() == 'panel/albums') ? 'active' : '' }} menuBtn">Albumy</a></li>
                  <li><a href="/panel/photos" class="{{ (request()->path() == 'panel/photos') ? 'active' : '' }} menuBtn">Zdjęcia</a></li>
               @endauth
               @if(Auth::user()->is_admin)
                  <li><a href="/admin/settings" class="menuBtn">Admin</a></li>
                  <ul>
                     <li><a href="/admin/settings" class="menuBtn">Ustawienia</a></li>
                     <li><a href="/admin/users" class="menuBtn">Użytkownicy</a></li>
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

   </script>
   <script>
      $('.menuBtn').click(function () {
         $('#input-toggle').prop('checked', false);
      });

   </script>
   <script>
      function showDelPhotosPrompt() {
         var text =
            '<div class="popup">' +
            "<p>Czy na pewno chcesz usunąć " + $(".checkbox:checked").length + " zdjęć?</p>" +
            '<button onclick="hidePrompt()" type="button" class="form-control-small">ANULUJ</button> <button form="delete-photos" type="submit" class="form-control-small">USUŃ</button>' +
            "</div>";
         $(".screen-overlay").append(text).css("display", "flex").animate({
               opacity: 1,
            },
            "fast"
         );
      }

      function showEditPhotoPrompt(photoId, title) {
         var text =
            '<div class="popup">' +
            '<img src="/photos/{{ Auth::user()->id }}/thumbnails/' +
            photoId +
            '.jpg" class="gallery">' +
            "<p>Podaj nowy tytuł dla tego zdjęcia.</p>" +
            '<form action="/panel/photo/' +
            photoId +
            '/edit" method="POST">' +
            '<input class="form-control" type="text" name="title" autocomplete="off" value="' +
            title +
            '" autofocus>' +
            '@csrf' +
            '<br>' +
            '<button onclick="hidePrompt()" type="button" class="form-control-small">ANULUJ</button> <button type="submit" class="form-control-small">ZAPISZ</button>' +
            "</form" +
            "</div>";
         $(".screen-overlay").append(text).css("display", "flex").animate({
            opacity: 1,
         }, "fast");
      }

      function showMovePhotoPrompt(photoId, albumId) {
         var text =
            '<div class="popup">' +
            '<img src="/photos/{{ Auth::user()->id }}/thumbnails/' + photoId + '.jpg" class="gallery">' +
            "<p>Wybierz nowy album dla tego zdjęcia.</p>" +
            '<form action="/panel/photo/' +
            photoId +
            '/changeAlbum" method="POST">' +
            '@csrf' +
            '<select name="album" class="form-control">' +
            '<option value="" disabled selected>Wybierz Album</option>' +
            '@foreach($albums as $album)' +
            '<option value="{{ $album->id }}">{{ $album->album_name }}</option>' +
            '@endforeach' +
            '</select>' +
            '<br>' +
            '<button onclick="hidePrompt()" type="button" class="form-control-small">ANULUJ</button> <button type="submit" class="form-control-small">ZAPISZ</button>' +
            "</form" +
            "</div>";
         $(".screen-overlay").append(text).css("display", "flex").animate({
            opacity: 1,
         }, "fast");
      }

   </script>
</body>

</html>
