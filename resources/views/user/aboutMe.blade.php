@extends('layouts.panel')

@section('content')

@if(Auth::check())
   <h1>Panel ustawień</h1>

   <div id="about-me">
      <h2>Edycja strony O mnie</h2>
      <form action="/panel/aboutme" method="post">
         @method('PUT')
         @csrf
         <div>
            <label for="about_me">Tekst strony o mnie</label>
            <div>
               <textarea id="about_me" class="form-control @error('about_me') is-invalid @enderror" name="about_me" cols="50" rows="8">{{ $user->aboutme->description }}</textarea>
               <span class="feedback">
                  @error('about_me')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </div>
         </div>
         <button type="submit" class="form-control">Zapisz zmiany</button>
      </form>
   </div>
@endif
@endsection
