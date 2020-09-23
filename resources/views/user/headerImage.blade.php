@extends('layouts.panel')

@section('content')

@if(Auth::check())
   <h1>Panel ustawień</h1>

   <div id="header">
      <h2>Edycja zdjęcia nagłówka</h2>
      <img src="/photos/{{ Auth::user()->id }}/header/header.jpg?{{ time() }}" style="max-width: 320px" alt="Header image">
      <form action="/panel/header" method="post" enctype="multipart/form-data">
         @csrf
         <div>
            <span style="display: block; font-size: 0.7em">Zdjęcie w formacie .jpg rozmiar min 1600px x 900px max. 3 MB</span>
            <div>
               <input class="inputfile" type="file" name="image" id="image" data-multiple-caption="Wybrano {count} zdjęć" required accept="image/jpeg">
               <label id="fileLabel" for="image">Kliknij aby wybrać zdjęcie</label>
               <span class="feedback">
                  @error('image')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </div>
         </div>
         <button type="submit" class="form-control">Zapisz</button>
      </form>
   </div>
@endif
@endsection
