@php
    use App\Photo;
@endphp
@extends('layouts.panel')

@section('content')

@if (Auth::check('verified'))
    Albumy
    <br>
    @foreach ($albums as $album)
   @php
      $count = count(Photo::where('album_id', $album->id)->get());
   @endphp
        <div>
           <a href="/panel/albums/{{ $album->id }}">{{ $album->album_name }} </a> {{ $count }}
           <br>
           <a href="/panel/albums/edit/{{ $album->id }}">zmień nazwę</a>
           @if ($count === 0)
           | <a href="/panel/albums/delete/{{ $album->id }}">usuń</a>
           @endif
         </div>
    @endforeach


    
    <br>
    {{ Auth::user()->username }}<br>
    {{ Auth::user()->name }}<br>
    {{ Auth::user()->email }}<br>
@endif

@endsection