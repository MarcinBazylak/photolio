@extends('layouts.panel')

@section('content')

<h1>Zdjęcia</h1>

@if($errors->any())
   <div class="alert alert-danger">
      <ul>
         @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
@endif

<div style="background: #eee; padding: 10px; border: 1px solid #ccc; border-radius: 8px">

   @if(empty($result))
      <h2>Dodaj nowe zdjęcia</h2>
      <form action="/panel/photos" enctype="multipart/form-data" method="POST">
         @csrf
         <div>
            <label for="images">Wybierz zdjęcia z dysku</label>
            <span style="display: block; font-size: 0.7em">Maksymalnie 12 zdjęć. Każde zdjęcie nie większe niż 2 MB</span>
            <div>
               <input type="file" name="images[]" id="images" multiple accept="image/jpeg">
               <span class="feedback">
                  @error('images')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </div>
         </div>
         <div>
            <label for="album">Wybierz album dla zdjęć</label>
            <div>
               <select id="album" class="form-control @error('album') is-invalid @enderror" name="album">
                  <option disabled selected>Wybierz album</option>
                  @foreach($albums as $album)
                     <option value="{{ $album->id }}">{{ $album->album_name }}</option>
                  @endforeach
               </select>
               <span class="feedback">
                  @error('album')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </div>
         </div>
         <div>W następnym kroku będziesz miał możliwość dodać tytuł do każdego zdjęcia</div>
         <button type="submit">Dalej</button>
      </form>
   @else
      <h2>Dodaj tytuły do nowych zdjęć</h2>
      <div style="display:flex; flex-wrap: wrap">
         <form action="/panel/photos" method="post">
            @method('PUT')
            @csrf
            @for($i = 0; $i < count($result->uploaded); $i++)
               <div style="display: inline-block">
                  <div style="display: block">
                     <img src="/photos/{{ Auth::user()->id }}/thumbnails/{{ $result->uploaded[$i] }}.jpg" style="width: 200px">
                  </div>
                  <div style="display: block">
                     <input type="hidden" name="photo[{{ $i }}]" value="{{ $result->uploaded[$i] }}">
                     <input type="text" name="title[{{ $i }}]" placeholder="Wpisz tytuł zdjęcia" autocomplete="off">
                  </div>
               </div>
            @endfor
            <button type="submit">Zapisz</button> <a href="/panel/photos"><button type="button">Pomiń</button></a>
         </form>
      </div>
   @endif
</div>

<div style="width: 1300px; max-width: 96%; margin: auto">
   @foreach($albums as $album)
      @if($album->photos()->count() > 0)
         <h3>{{ $album->album_name }}</h3>
         <div style="display: flex; flex-wrap: wrap; align-items: center">
            @foreach($album->photos()->orderBy('id', 'desc')->get() as $photo)
               @if($photo->album_id === $album->id)
                  <div class="gallery-photo">
                     <a href="/photos/{{ $photo->user_id }}/{{ $photo->id }}.jpg" data-lightbox="{{ $photo->album_name }}" data-title="{{ $photo->title }}">
                        <img src="/photos/{{ $photo->user_id }}/thumbnails/{{ $photo->id }}.jpg" alt="{{ $photo->title }}" class="gallery">
                        <div class="gallery-photo-overlay">
                           {{ $photo->title }} <br> {{ 'Album: ' . $photo->album_name }}
                        </div>
                     </a>
                     <div class="image-buttons">
                        <img id="edit-button" class="photo-icon" onclick="showEditPrompt('{{ $photo->id }}','{{ $photo->title }}')" src="/img/edit.png" alt="edytuj tytuł zdjęcia">
                        <img id="move-button" class="photo-icon" onclick="showMovePrompt('{{ $photo->id }}','{{ $photo->album_id }}')" src="/img/move.png" alt="przenieś do albumu">
                        <img id="delete-button" class="photo-icon" onclick="showDelPrompt('{{ $photo->user_id }}','{{ $photo->id }}')" src="/img/delete.png" alt="usuń zdjęcie">
                     </div>
                  </div>
               @endif
            @endforeach
         </div>
      @endif
   @endforeach
</div>
<div class="screen-overlay"></div>

@endsection
   <script>
      function showEditPrompt(photoId, title) {
         var text =
            '<div style="text-align: center; height: auto; min-width: 30vw; border: 1px solid white; border-radius: 10px; padding: 15px; color: white">' +
            '<img src="/photos/{{ Auth::user()->id }}/thumbnails/' +
            photoId +
            '.jpg" class="gallery">' +
            "<p>Podaj nowy tytuł dla tego zdjęcia.</p>" +
            '<form action="/panel/photo/' +
            photoId +
            '/edit" method="POST">' +
            '<input class="edit-title" type="text" name="title" autocomplete="off" value="' +
            title +
            '" autofocus>' +
            '@csrf' +
            '<br>' +
            '<button onclick="hidePrompt()" type="button">ANULUJ</button> <button type="submit">ZAPISZ</button>' +
            "</form" +
            "</div>";
         $(".screen-overlay").append(text).css("display", "flex").animate({
            opacity: 1,
         }, "fast");
      }

      function showMovePrompt(photoId, albumId) {
         var text =
            '<div style="text-align: center; height: auto; min-width: 30vw; border: 1px solid white; border-radius: 10px; padding: 15px; color: white">' +
            '<img src="/photos/{{ Auth::user()->id }}/thumbnails/' + photoId + '.jpg" class="gallery">' +
            "<p>Wybierz nowy album dla tego zdjęcia.</p>" +
            '<form action="/panel/photo/' +
            photoId +
            '/changeAlbum" method="POST">' +
            '@csrf' +
            '<select name="album" style="width: 300px; margin: 10px; background: none; color: #888; padding: 10px; border: 1px solid white; border-radius: 8px">' +
            '<option value="" disabled selected>Wybierz Album</option>' +
            '@foreach($albums as $album)' +
            '<option value="{{ $album->id }}">{{ $album->album_name }}</option>' +
            '@endforeach' +
            '</select>' +
            '<br>' +
            '<button onclick="hidePrompt()" type="button">ANULUJ</button> <button type="submit">ZAPISZ</button>' +
            "</form" +
            "</div>";
         $(".screen-overlay").append(text).css("display", "flex").animate({
            opacity: 1,
         }, "fast");
      }
   </script>