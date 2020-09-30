@extends('layouts.gallery')

@section('content')

<div class="gallery-container in" id="gallery-container">
   @if(count($photos) > 0)
      @foreach($photos as $photo)
         <div class="gallery-photo">
            <a href="/photos/{{ $user->id }}/{{ $photo->id }}.jpg" data-lightbox="{{ $photo->album_name }}" data-title="{{ $photo->title }}">
               <img src="/photos/{{ $user->id }}/thumbnails/{{ $photo->id }}.jpg" class="gallery" alt="{{ $photo->title }}" loading="lazy">
               <div class="gallery-photo-overlay">
                  {{ $photo->title ?? 'Album: ' . $photo->album_name }}
               </div>
            </a>
         </div>
      @endforeach
      @else
      <h2 style="margin-top: 100px">Ten album nie zawiera zdjęć</h3>
   @endif
</div>

@endsection
