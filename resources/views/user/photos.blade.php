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
                     <input type="text" name="title[{{ $i }}]" placeholder="Wpisz tytuł" autocomplete="off">
                  </div>
               </div>
            @endfor
            <button type="submit">Zapisz</button>
         </form>
      </div>
   @endif
</div>

<div style="width: 1300px; max-width: 96%; margin: auto">
   @foreach($albums as $album)
      @if($album->photos()->count() > 0)
         <h3>{{ $album->album_name }}</h3>
         <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center">
            @foreach($album->photos()->orderBy('id', 'desc')->get() as $photo)
               @if($photo->album_id === $album->id)
                  <div class="gallery-photo">
                     <a href="/photos/{{ $photo->user_id }}/{{ $photo->id }}.jpg" data-lightbox="{{ $photo->album_name }}" data-title="{{ $photo->title }}">
                        <img src="/photos/{{ $photo->user_id }}/thumbnails/{{ $photo->id }}.jpg" alt="{{ $photo->title }}" class="gallery">
                        <div class="gallery-photo-overlay">
                           <strong>{{ $photo->title }}</strong>
                        </div>
                     </a>
                     <div class="image-buttons">
                        <img id="edit-button" class="photo-icon" onclick="showEditPrompt('{{ $photo->user_id }}','{{ $photo->id }}','{{ $photo->title }}')" src="/img/edit.png" alt="edytuj tytuł zdjęcia">
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
