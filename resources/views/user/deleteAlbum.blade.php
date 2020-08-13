@extends('layouts.panel')

@section('content')

<h2>Usuwanie albumu {{ $album->album_name ?? '' }}</h2>

<form action="/panel/album/{{ $album->id }}/delete" method="post">
   @csrf
   <div>
      <p>Czy na pewno chcesz usunąć album {{ $album->album_name ?? '' }} ?</p>
   </div>
   <div>
      <a href="/panel/albums"><button type="button">Nie</button></a> <button type="submit">Tak</button>
   </div>
</form>
<br>

@endsection
