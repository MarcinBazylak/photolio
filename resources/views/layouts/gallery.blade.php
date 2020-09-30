<!DOCTYPE html>
<html lang="pl">

<head>
   <link rel="stylesheet" href="{{ asset('/css/gallery.style.css') }}">
   <link rel="stylesheet" href="{{ asset('/css/gallery.menu.css') }}">
   <link rel="stylesheet" href="{{ asset('/css/lightbox.css') }}">
   <link rel="shortcut icon" href="{{ asset('/img/icon.ico') }}" type="image/x-icon">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>{{ $user->name }} :: Photolio</title>
   <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   <script src="{{ asset('/js/lightbox.js') }}"></script>
   <style>
      header {
         background-image: url("/../photos/{{ $user->id }}/header/header.jpg");
      }
   </style>
</head>

<body>
   <div class="container">
      <header>
         <div class="social-icons-container">
            @if(!empty($user->settings->facebook))
               <a href="{{ $user->settings->facebook }}" target="_blank">
                  <img class="social-icon" src="/img/facebook.png" alt="facebook icon">
               </a>
            @endif
            @if(!empty($user->settings->instagram))
               <a href="{{ $user->settings->instagram }}" target="_blank">
                  <img class="social-icon" src="/img/instagram.png" alt="instagram icon">
               </a>
            @endif
            @if(!empty($user->settings->youtube))
            <a href="{{ $user->settings->youtube }}" target="_blank">
               <img class="social-icon" src="/img/youtube.png" alt="youtube icon">
            </a>
         @endif
         </div>
         <label class="navigation-toggle" id="toggle" for="input-toggle">
            <span></span>
            <span></span>
            <span></span>
         </label>
         <input type="checkbox" id="input-toggle">
         <nav id="nav">
            <ul>
               <li class="menu-item">
                  <a href="/" id="aboutMeLink">Galeria</a>
               </li>
               <li class="menu-item">
                  <a href="/o-mnie" id="portfolioLink">O mnie</a>
               </li>
               <li class="menu-item">
                  <a href="/kontakt" id="contactLink">Kontakt</a>
               </li>
               @if(Auth::check('verified') && Auth::user()->id === $user->id)
                  <li class="menu-item">
                     <a href="http://{{ Config::get('app.url') }}/panel" class="admin" id="contactLink">Panel</a>
                  </li>
                  <li class="menu-item">
                     <a href="http://{{ Config::get('app.url') }}/logout" class="admin" id="contactLink">Wyloguj</a>
                  </li>
               @endif
            </ul>
         </nav>
         <div class="my-title">
            <h1>{{ $user->name }}</h1>
         </div>
         <div class="my-description">
            <p>
               {!! nl2br(e($user->settings->welcome_note)) !!}... <a href="/o-mnie">więcej</a>
            </p>
         </div>
         <div class="albums">
            @foreach($albums as $album)
               @php
                  $currAlbum = $currentAlbum->id ?? '';
               @endphp
                     <a {!! (request()->path() == 'o-mnie' || request()->path() == 'kontakt') ? 'href="album-' . $album->id . '"' : 'onclick="switchAlbum(' . $album->id . ')"' !!} style="cursor: pointer" id="album-btn-{{ $album->id }}" class="album-btn {{ ($album->id == $currAlbum) ? 'on' : '' }}" onclick="switchAlbum({{ $album->id }})">{{ $album->album_name }}</a>
            @endforeach
         </div>
      </header>
      @yield('content')
   </div>
   <footer>Layout and design: Photolio.pl. All photos by: {{ $user->name }}. All rights reserved</footer>
   <script src="{{ asset('/js/menu.js') }}"></script>
   <script src="{{ asset('/js/loading.js') }}"></script>
   <script src="{{ asset('/js/switchAlbum.js') }}"></script>
   <script>
      lightbox.option({
         'albumLabel': ''
      });
   </script>
</body>

</html>
