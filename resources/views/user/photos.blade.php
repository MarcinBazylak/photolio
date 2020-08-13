@extends('layouts.panel')

@section('content')

<h1>Zdjęcia</h1>

@foreach($albums as $album)

   @if($album->photos()->count() > 0)

      <div>
         <h2>{{ $album->album_name }}</h2>
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
