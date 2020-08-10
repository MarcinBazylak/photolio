@extends('layouts.panel')

@section('content')

@if (Auth::check())
Zdjęcia
<br>

@foreach ($albums as $album)
<div>
   {{ $album->album_name }}<br>
   @foreach ($photos as $photo)
   @if ($photo->album_id === $album->id)
   <a href="/photos/{{ Auth::user()->id }}/{{ $photo->id }}.jpg" data-lightbox="{{ $photo->album_name }}" data-title="{{ $photo->title }}">
      <img src="/photos/{{ Auth::user()->id }}/thumbnails/{{ $photo->id }}.jpg" class="gallery" alt="{{ $photo->title }}">
   </a>
   @endif
   @endforeach
</div>
@endforeach

<br>
{{ Auth::user()->username }}<br>
{{ Auth::user()->name }}<br>
{{ Auth::user()->email }}<br>
@endif

@endsection