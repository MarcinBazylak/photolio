@php
use App\Photo;
@endphp
@extends('layouts.panel')

@section('content')

@if (Auth::check('verified'))
<h1>Albumy</h1>

<form action="/panel/albums" method="post">
   @csrf
   <h2>Dodaj nowy album</h2>
   <div>
      <label for="album_name">Nazwa albumu</label>
   </div>
   <div>
      <input placeholder="Podaj nazwę albumu" type="text" class="form-control @error('album_name') is-invalid @enderror" name="album_name" id="album_name" autocomplete="off">
      @error('album_name')
      <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
   <div>
      <button type="submit">Dodaj</button>
   </div>   
</form>
<br>




@foreach ($albums as $album)
@php
$count = count(Photo::where('album_id', $album->id)->get());
@endphp
<div>
   <a href="/panel/album/{{ $album->id }}">{{ $album->album_name }} </a> {{ $count }}
   <br>
   <a href="/panel/album/{{ $album->id }}/edit">zmień nazwę</a>
   @if ($count === 0)
   | <a href="/panel/album/{{ $album->id }}/delete">usuń</a>
   @endif
</div>
@endforeach



<br>
{{ Auth::user()->username }}<br>
{{ Auth::user()->name }}<br>
{{ Auth::user()->email }}<br>
@endif

@endsection