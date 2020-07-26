<!DOCTYPE html>
<html lang="pl">

<head>
   <link rel="stylesheet" href="/css/gallery.style.css">
   <link rel="stylesheet" href="/css/gallery.menu.css">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>{{ $settings->title }} :: Photolio</title>
   <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body>
   <header>

      <label class="navigation-toggle" id="toggle" for="input-toggle">
         <span></span>
         <span></span>
         <span></span>
      </label>
      <input type="checkbox" id="input-toggle">
      <nav id="nav">
         <ul>
            <li id="li1">
               <a href="/{{ $settings->uname }}" id="aboutMeLink">Galeria</a>
            </li>
            <li id="li2">
               <a href="/{{ $settings->uname }}/o-mnie" id="portfolioLink">O mnie</a>
            </li>
            <li id="li3">
               <a href="/{{ $settings->uname }}/kontakt" id="contactLink">Kontakt</a>
            </li>
         </ul>
      </nav>

      <div class="my-title">
         <h1>{{ $settings->title }}</h1>
      </div>
      <div class="my-description">
         <p>
            {!! nl2br(e($settings->welcome_note)) !!} <a href="/{{ $settings->uname }}/kontakt">kontakt</a>
         </p>
      </div>

      <div class="albums">
         @foreach ($albums as $album)
         @if ($album->id == $currentAlbum)
         <a class="on" href="/{{ $settings->uname }}/album-{{ $album->id }}">{{ $album->category_name }}</a>
         @else
         <a href="/{{ $settings->uname }}/album-{{ $album->id }}">{{ $album->category_name }}</a>
         @endif
         @endforeach
      </div>

   </header>

   @yield('content')

   <footer>Layout and design: Photolio.pl. All photos by: {{ $settings->title }}. All rights reserved</footer>

   <script src="/js/menu.js"></script>
   <script src="/js/loading.js"></script>
</body>

</html>