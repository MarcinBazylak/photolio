@extends('layouts.panel')

@section('content')

<h1>Zdjęcia</h1>

<div style="background: #eee; padding: 10px; border: 1px solid #ccc; border-radius: 8px">
   <h2>Dodaj nowe zdjęcia</h2>

   <form action="/panel/photos" enctype="multipart/form-data" method="POST">
      @csrf
      <div>
         <label for="images">Wybierz zdjęcia z dysku</label>
         <span style="display: block; font-size: 0.7em">Maksymalnie 5 sztuk. Każde zdjęcie nie większe niż 2 MB</span>
         <div>
            <input type="file" name="images" id="images" multiple accept="image/jpeg">
            <span class="feedback">
               @error('images')
                  <strong>{{ $message }}</strong>
               @enderror
            </span>
         </div>
      </div>
      <button type="submit">Zapisz</button>
   </form>
</div>



@foreach($albums as $album)
   @if($album->photos()->count() > 0)
      <div>
         <h3>{{ $album->album_name }}</h3>
         @foreach($album->photos()->orderBy('id', 'desc')->get() as $photo)
            @if($photo->album_id === $album->id)
               <a href="/photos/{{ $photo->user_id }}/{{ $photo->id }}.jpg" data-lightbox="{{ $photo->album_name }}" data-title="{{ $photo->title }}">
                  <img src="/photos/{{ $photo->user_id }}/thumbnails/{{ $photo->id }}.jpg" class="gallery" alt="{{ $photo->title }}">
               </a>
            @endif
         @endforeach
      </div>
   @endif
@endforeach

@endsection
