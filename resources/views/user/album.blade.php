@extends('layouts.panel')
@section('content')
<h1>{{ $album->album_name }}</h1>
@if($album->photos()->count() > 0)
   <div class="upper-box">
      <h2>Usuwanie zdjęć</h2>
      <p>
         Aby usunąć zdjęcia, kliknij ikone kosza na zdjęciach, które chcesz usunąć, nastepnie kliknij przycisk usuń.
      </p>
      <form action="/panel/photos/delete" method="post" id="delete-photos">
         @csrf
      </form>
      <button id="del-button" disabled type="button" onclick="showDelPhotosPrompt()" class="form-control">Usuń</button>
   </div>
   <div style="max-width: 100%; margin: auto">
      <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center">
         @foreach($album->photos()->orderBy('id', 'desc')->get() as $photo)
            @if($photo->album_id === $album->id)
               <div class="gallery-photo">
                  <a href="/photos/{{ $photo->user_id }}/{{ $photo->id }}.jpg" data-lightbox="{{ $photo->album_name }}" data-title="{{ $photo->title }}">
                     <img id="photo{{ $photo->id }}" src="/photos/{{ $photo->user_id }}/thumbnails/{{ $photo->id }}.jpg" alt="{{ $photo->title }}" class="gallery">
                     <div class="gallery-photo-overlay">
                        {{ $photo->title }} <br> {{ 'Album: ' . $photo->album_name }}
                     </div>
                  </a>
                  <div class="image-buttons">
                     <img id="edit-button" class="photo-icon" onclick="showEditPhotoPrompt('{{ $photo->id }}','{{ $photo->title }}')" src="/img/edit.png" alt="edytuj tytuł zdjęcia">
                     <img id="move-button" class="photo-icon" onclick="showMovePhotoPrompt('{{ $photo->id }}','{{ $photo->album_id }}')" src="/img/move.png" alt="przenieś do albumu">
                     <label for="del-photo{{ $photo->id }}">
                        <img id="delete-button" class="photo-icon" src="/img/delete.png" alt="usuń zdjęcie">
                     </label>
                     <input style="display: none" class="checkbox" onchange="highlight({{ $photo->id }})" type="checkbox" form="delete-photos" name="del-photo[]" id="del-photo{{ $photo->id }}" value="{{ $photo->id }}">
                  </div>
               </div>
            @endif
         @endforeach
      </div>
   </div>
@else
   <h3>Ten album nie zawiera zdjęć</h3>
@endif
<div class="screen-overlay"></div>
@endsection
