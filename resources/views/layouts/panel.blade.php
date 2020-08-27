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

   <div style="height:20px">
      {!! Alert::display($status ?? session('status') ?? '') !!}
   </div>

   @yield('content')

   <script>
      lightbox.option({
         'albumLabel': ''
      });
   </script>
   <script src="{{ asset('/js/menu.js') }}"></script>
   <script src="{{ asset('/js/loading.js') }}"></script>
   <script src="{{ asset('/js/delete-photo.js') }}"></script>
   <script>
      function showEditPrompt(userId, photoId, title) {
         var text =
            '<div style="text-align: center; height: auto; min-width: 30vw; border: 1px solid white; border-radius: 10px; padding: 15px; color: white">' +
            '<img src="/photos/' +
            userId +
            " /thumbnails/" + 
            photoId + 
            '.jpg" class="gallery">' + 
            "<p>Podaj nowy tytuł dla tego zdjęcia.</p>" + 
            '<form action="/panel/photo/' + 
            photoId + 
            '/edit" method="POST">' + 
            '<input class="edit-title" type="text" name="title" required autocomplete="off" value="' + 
            title + 
            '">' +
            '@csrf' +
            '<br>' + 
            '<button onclick="hidePrompt()" type="button">ANULUJ</button> <button type="submit">ZAPISZ</button>' + 
            "</form" + 
            "</div>";
         $(".screen-overlay").append(text).css("display", "flex").animate({
            opacity: 1,
         }, "fast");
      }
   </script>
</body>

</html>
