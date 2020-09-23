@extends('layouts.panel')

@section('content')

@if(Auth::check())
   <h1>Ustawienia konta</h1>

   <div id="settings">
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
         <label class="checkbox">Pokazuj puste albumy w galerii
            <input id="empty_albums" type="checkbox" name="empty_albums" value="1" {{ ($user->settings->empty_albums) ? 'checked' : '' }}>
            <span class="checkmark"></span>
         </label>
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

         <button type="submit" class="form-control">Zapisz ustawienia</button>
      </form>
   </div>
@endif
@endsection
