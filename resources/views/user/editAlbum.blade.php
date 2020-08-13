@extends('layouts.panel')

@section('content')

<form action="/panel/album/{{ $album->id }}/edit" method="post">
   @method('PUT')
   @csrf
   <h2>Edycja albumu {{ $album->album_name ?? '' }}</h2>
   <div>
      <label for="album_name">Podaj nową nazwę dla albumu {{ $album->album_name ?? '' }}</label>
   </div>
   <div>
      <input placeholder="{{ $album->album_name ??'' }}" type="text" class="form-control @error('album_name') is-invalid @enderror" name="album_name" id="album_name" required autocomplete="off">
      <span style="display: block; height: 20px" class="invalid-feedback" role="alert">
         @error('album_name')
            <strong>{{ $message }}</strong>
         @enderror
      </span>
   </div>
   <div>
      <button type="submit">Zapisz</button> <a href="/panel/albums"><button type="button">Anuluj</button></a>
   </div>
</form>
<br>

@endsection
