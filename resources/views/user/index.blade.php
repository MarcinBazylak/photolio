@extends('layouts.panel')

@section('content')

@if(Auth::check())
   <h1>Panel ustawień</h1>

   <h2>Edycja ustawień konta</h2>

   <form action="/panel/settings" method="POST">
      @method('PUT')
      @csrf

      <div>
         <label for="username">Nazwa użytkownika</label>
         <div>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}">
            <span class="feedback">
               @error('username')
                  <strong>{{ $message }}</strong>
               @enderror
            </span>
         </div>
      </div>

      <div>
         <label for="name">Imię i nzawisko</label>
         <div>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
            <span class="feedback">
               @error('name')
                  <strong>{{ $message }}</strong>
               @enderror
            </span>
         </div>
      </div>

      <div>
         <label for="def_album">Domyślny album</label>
         <div>
            <select id="def_album" class="form-control @error('def_album') is-invalid @enderror" name="def_album">
               @foreach($albums as $album)
                  <option value="{{ $album->id }}" {{ ($album->id === $user->settings->def_album) ? 'selected' : '' }}>{{ $album->album_name }}</option>
               @endforeach
            </select>
            <span class="feedback">
               @error('def_album')
                  <strong>{{ $message }}</strong>
               @enderror
            </span>
         </div>
      </div>

      <div>
         <div>
            <input id="empty_albums" type="checkbox" class="form-control @error('empty_albums') is-invalid @enderror" name="empty_albums" value="1" {{ ($user->settings->empty_albums) ? 'checked' : '' }}> Pokazuj puste albumy w galerii
         </div>
      </div>

      <div>
         <label for="welcome_note">Wiadomość powitalna</label>
         <div>
            <textarea id="welcome_note" class="form-control @error('welcome_note') is-invalid @enderror" name="welcome_note" cols="50" rows="8">{{ $user->settings->welcome_note }}</textarea>
            <span class="feedback">
               @error('welcome_note')
                  <strong>{{ $message }}</strong>
               @enderror
            </span>
         </div>
      </div>

      <div>
         <label for="facebook">Link do profilu na facebooku</label>
         <div>
            <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $user->settings->facebook }}">
            <span class="feedback">
               @error('facebook')
                  <strong>{{ $message }}</strong>
               @enderror
            </span>
         </div>
      </div>

      <div>
         <label for="youtube">Link do kanału na youtube</label>
         <div>
            <input id="youtube" type="text" class="form-control @error('youtube') is-invalid @enderror" name="youtube" value="{{ $user->settings->youtube }}">
            <span class="feedback">
               @error('youtube')
                  <strong>{{ $message }}</strong>
               @enderror
            </span>
         </div>
      </div>

      <div>
         <label for="instagram">Link do profilu na instagramie</label>
         <div>
            <input id="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" value="{{ $user->settings->instagram }}">
            <span class="feedback">
               @error('instagram')
                  <strong>{{ $message }}</strong>
               @enderror
            </span>
         </div>
      </div>

      <button type="submit">Zapisz ustawienia</button>
   </form>

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

      <button type="submit">Zapisz zmiany</button>
   </form>

   <br>
   {{ Auth::user()->username }}<br>
   {{ Auth::user()->name }}<br>
   {{ Auth::user()->email }}<br>

@endif

@endsection
