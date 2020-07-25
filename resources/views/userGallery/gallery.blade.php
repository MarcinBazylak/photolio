@extends('layouts.gallery')

@section('content')

<div class="gallery-container">
   @foreach ($photos as $photo)

   <div class="gallery-photo">
      <a href="/{{ $settings->uname }}/photo/{{ $photo->id }}">
         <img src="/photos/{{ $settings->uid }}/{{ $photo->id }}/{{ $photo->id }}.jpg" class="gallery">
         <div class="gallery-photo-overlay">
            <strong>{{ $photo->title }}</strong>{{ $photo->cat_name }}
         </div>
      </a>
   </div>

   @endforeach
</div>

@endsection