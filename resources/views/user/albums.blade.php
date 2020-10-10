@extends('layouts.panel')

@section('content')

@if(Auth::check('verified'))
   <h1>Albumy</h1>

   @error('albumName')
      <div class="alert">
         {{ $message }}
      </div>
   @enderror

   <div class="upper-box">
      <form action="/panel/albums" method="post">
         @csrf
         <h2>Dodaj nowy album</h2>
         <div>
            <label for="album_name">Nazwa albumu</label>
         </div>
         <div>
            <input placeholder="Podaj nazwę albumu" type="text" class="form-control @error('album_name') is-invalid @enderror" name="album_name" id="album_name" required autofocus autocomplete="off">
            <span class="feedback">
               @error('album_name')
                  <strong>{{ $message }}</strong>
               @enderror
            </span>
         </div>
         <div>
            <button type="submit" class="form-control">Dodaj</button>
         </div>
      </form>
   </div>

   @foreach($albums as $album)
      <div class="albums-list-row">
         <div>
            <a href="/panel/album/{{ $album->id }}">{{ $album->album_name }}</a>
            @if($album->id === $user->settings->def_album)
               (domyślny)
            @endif
         </div>
         {{ $album->photos()->count() }} zdjęć
         <br>
         <button type="button" onclick="showEditAlbumPrompt({{ $album->id }}, '{{ $album->album_name }}')" class="form-control-small">zmień nazwę</button>
         <button type="button" {!! ($user->settings->def_album !== $album->id) ? 'onclick="showDelAlbumPrompt(' . $album->id . ', \'' . $album->album_name . '\')"' : 'disabled' !!} class="form-control-small">usuń</button>
      </div>
   @endforeach
   <div class="screen-overlay"></div>
@endif
<script>
   function showEditAlbumPrompt(albumId, albumName) {
      var text =
         '<div class="popup">' +
         '<p>Podaj nową nazwę dla albumu "' +
         albumName +
         '".</p>' +
         '<form action="/panel/album/' +
         albumId +
         '/edit" method="POST">' +
         '@method("put")' +
         '<input class="form-control" type="text" name="albumName" autocomplete="off" value="' +
         albumName +
         '" autofocus>' +
         '@csrf' +
         "<br>" +
         '<button onclick="hidePrompt()" type="button" class="form-control-small">ANULUJ</button> <button type="submit" class="form-control-small">ZAPISZ</button>' +
         "</form></div>";
      $(".screen-overlay").append(text).css("display", "flex").animate({
         opacity: 1,
      }, "fast");
   }

</script>
@endsection
