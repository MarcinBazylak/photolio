@extends('layouts.panel')

@section('content')

@if(Auth::check())
   <h1>Panel ustawień</h1>

   <div id="settings">
      <h2>Kolory Twojej galerii</h2>
      <p>
         Tutaj możesz edytować niektóre z kolorów wyświetlanych w Twojej galerii
      </p>
   </div>

@endif
@endsection
