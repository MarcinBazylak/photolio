@extends('layouts.panel')

@section('content')

<h1>Zdjęcia</h1>

<div class="upper-box">
   @if(empty($result))
      <h2>Dodaj nowe zdjęcia</h2>
      <form action="/panel/photos" enctype="multipart/form-data" method="POST">
         @csrf
         <div>
            <p>Wybierz zdjęcia z dysku</p>
            <span style="display: block; font-size: 0.7em">Maksymalnie 12 zdjęć. Każde zdjęcie nie większe niż 2 MB</span>
            <div>
               <input class="inputfile @error('images') is-invalid @enderror" type="file" name="images[]" id="images" data-multiple-caption="Wybrano {count} zdjęć" multiple required accept="image/jpeg">
               <label id="fileLabel" for="images">Kliknij aby wybrać zdjęcia</label>
               <span class="feedback">
                  @if($errors->has('images.*'))
                     <strong>{{ $errors->first('images.*') }}</strong>
                  @endif
               </span>
            </div>
         </div>
         <div>
            <label for="album">Wybierz album dla zdjęć</label>
            <div>
               <select id="album" class="form-control @error('album') is-invalid @enderror" required name="album">
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
         <button type="submit" class="form-control" id="inputFileSubmit">Dalej</button>
      </form>
   @else
      <h2>Dodaj tytuły do nowych zdjęć</h2>
      <form class="form" action="/panel/photos" method="post">
         <div style="width: 100%; display:flex; flex-wrap: wrap; align-items: center; justify-content: center">
            @method('PUT')
            @csrf
            @for($i = 0; $i < count($result->uploaded); $i++)
               <div style="display: inline-block; border: 1px solid #bbb; border-radius:6px; margin: 5px; background: #e0e0e0; padding: 5px; box-shadow: 3px 3px 3px rgba(0,0,0,0.3)">
                  <div style="display: flex; flex-direction: column; align-content: center;align-items: center">
                     <img src="/photos/{{ Auth::user()->id }}/thumbnails/{{ $result->uploaded[$i] }}.jpg" style="max-width: 200px">
                  </div>
                  <div style="display: block; margin-top: 10px;">
                     <input type="hidden" name="photo[{{ $i }}]" value="{{ $result->uploaded[$i] }}">
                     <input class="form-control-small" style="margin-bottom: 0 !important; width: 100% !important;" type="text" name="title[{{ $i }}]" placeholder="Wpisz tytuł" autocomplete="off">
                  </div>
               </div>
            @endfor
         </div>
         <div style="display: block; margin: 10px 5px; width: fit-content">
            <a href="/panel/photos"><button type="button" class="form-control">Pomiń</button></a> <button type="submit" class="form-control">Zapisz</button>
         </div>
      </form>
   @endif
</div>

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
   @foreach($albums as $album)
      @if($album->photos()->count() > 0)
         <h3>{{ $album->album_name }}</h3>
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
      @endif
   @endforeach
</div>
<div class="screen-overlay"></div>
@endsection
