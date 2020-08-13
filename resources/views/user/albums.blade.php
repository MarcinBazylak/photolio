@php
   use App\Photo;
@endphp
@extends('layouts.panel')

@section('content')

@if(Auth::check('verified'))
   <h1>Albumy</h1>

   <form action="/panel/albums" method="post">
      @csrf
      <h2>Dodaj nowy album</h2>
      <div>
         <label for="album_name">Nazwa albumu</label>
      </div>
      <div>
         <input placeholder="Podaj nazwę albumu" type="text" class="form-control @error('album_name') is-invalid @enderror" name="album_name" id="album_name" required autocomplete="off">
         <span style="display: block; height: 20px" class="invalid-feedback" role="alert">
            @error('album_name')
               <strong>{{ $message }}</strong>
            @enderror
         </span>
      </div>
      <div>
         <button type="submit">Dodaj</button>
      </div>
   </form>
   <br>

   @foreach($albums as $album)
      <div>
         <a href="/panel/album/{{ $album->id }}">{{ $album->album_name }} </a> {{ $album->photos()->count() }}
         <br>
         <a href="/panel/album/{{ $album->id }}/edit">zmień nazwę</a>
         @if($album->photos()->count() === 0)
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
