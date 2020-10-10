@extends('layouts.panel')

@section('content')

<h1>Zdjęcia</h1>

<div class="upper-box">
      <h2>Dodaj nowe zdjęcia</h2>
      <form action="/panel/photos" enctype="multipart/form-data" method="POST">
         @csrf
         <div>
            <p>Wybierz zdjęcia z dysku</p>
            <span style="display: block; font-size: 0.7em">Maksymalnie 6 zdjęć. Każde zdjęcie nie większe niż 2 MB</span>
            <div>
               <input class="inputfile @error('images') is-invalid @enderror" type="file" name="images[]" id="images" data-multiple-caption="Wybrano {count} zdjęć" multiple required accept="image/jpeg">
               <label id="fileLabel" for="images">Kliknij aby wybrać zdjęcia</label>
               <span class="feedback">
                  @if($errors->has('images.*'))
                     <strong>{{ $errors->first('images.*') }}</strong>
                  @endif
               </span>
            </div>
         </div>
         <div>
            <label for="album">Wybierz album dla zdjęć</label>
            <div>
               <select id="album" class="form-control @error('album') is-invalid @enderror" required name="album">
                  <option disabled selected>Wybierz album</option>
                  @foreach($albums as $album)
                     <option value="{{ $album->id }}">{{ $album->album_name }}</option>
                  @endforeach
               </select>
               <span class="feedback">
                  @error('album')
                     <strong>{{ $message }}</strong>
                  @enderror
               </span>
            </div>
         </div>
         <div>W następnym kroku będziesz miał możliwość dodać tytuł do każdego zdjęcia</div>
         <button type="submit" class="form-control" id="inputFileSubmit">Dalej</button><img class="progressIcon" src="{{ asset('/img/progress.png') }}" alt="pogress">
      </form>

      		<div class="progress">
      		   <div class="bar"></div>
      		   <div class="percent">0%</div>
      		</div>
      		
            <div id="status"></div>
            <script src="/js/upload.js"></script>
            		<script>
            		   (function () {
            		      
            		      "use strict";

            		      var bar = $('.bar');
            		      var percent = $('.percent');
                        var status = $('#status');
                        var input = $('#inputFileSubmit');
                        var progressIcon = $('.progressIcon');

            		      $('form').ajaxForm({
            		         beforeSend: function () {
            		            status.empty();
            		            var percentVal = '0%';
            		            bar.width(percentVal);
                              percent.html(percentVal);
                              input.prop("disabled", true);
                              progressIcon.addClass('rotating');
            		         },
            		         uploadProgress: function (event, position, total, percentComplete) {
            		            var percentVal = percentComplete + '%';
            		            bar.width(percentVal);
            		            percent.html(percentVal);
            		         },
            		         success: function (data, statusText, xhr) {
            		            var percentVal = '100%';
            		            bar.width(percentVal);
            		            percent.html(percentVal);
                              status.html(xhr.responseText);
                              progressIcon.removeClass('rotating');
            		         },
            		         error: function (xhr, statusText, err) {
                              status.html(err || statusText);
                              progressIcon.removeClass('rotating');
            		         }
            		      });

            		   })();
            		</script>
</div>

<div class="upper-box">
   <h2>Usuwanie zdjęć</h2>
   <p>
      Aby usunąć zdjęcia, kliknij ikone kosza na zdjęciach, które chcesz usunąć, nastepnie kliknij przycisk usuń.
   </p>
   <form action="/panel/photos/delete" method="post" id="delete-photos">
      @csrf
   </form>
   <button id="del-button" disabled type="button" onclick="showDelPhotosPrompt()" class="form-control">Usuń</button>
</div>

<div style="max-width: 100%; margin: auto">
   @foreach($albums as $album)
      @if($album->photos()->count() > 0)
         <h3>{{ $album->album_name }}</h3>
         <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center">
            @foreach($album->photos()->orderBy('id', 'desc')->get() as $photo)
               @if($photo->album_id === $album->id)
                  <div class="gallery-photo">
                     <a href="/photos/{{ $photo->user_id }}/{{ $photo->id }}.jpg" data-lightbox="{{ $photo->album_name }}" data-title="{{ $photo->title }}">
                        <img id="photo{{ $photo->id }}" src="/photos/{{ $photo->user_id }}/thumbnails/{{ $photo->id }}.jpg" alt="{{ $photo->title }}" class="gallery">
                        <div class="gallery-photo-overlay">
                           {{ $photo->title }} <br> {{ 'Album: ' . $photo->album_name }}
                        </div>
                     </a>
                     <div class="image-buttons">
                        <img id="edit-button" class="photo-icon" onclick="showEditPhotoPrompt('{{ $photo->id }}','{{ $photo->title }}')" src="/img/edit.png" alt="edytuj tytuł zdjęcia">
                        <img id="move-button" class="photo-icon" onclick="showMovePhotoPrompt('{{ $photo->id }}','{{ $photo->album_id }}')" src="/img/move.png" alt="przenieś do albumu">
                        <label for="del-photo{{ $photo->id }}">
                           <img id="delete-button" class="photo-icon" src="/img/delete.png" alt="usuń zdjęcie">
                        </label>
                        <input style="display: none" class="checkbox" onchange="highlight({{ $photo->id }})" type="checkbox" form="delete-photos" name="del-photo[]" id="del-photo{{ $photo->id }}" value="{{ $photo->id }}">
                     </div>
                  </div>
               @endif
            @endforeach
         </div>
      @endif
   @endforeach
</div>
<div class="screen-overlay"></div>
<script>


   function showEditPhotoPrompt(photoId, title) {
      var text =
         '<div class="popup">' +
         '<img src="/photos/{{ Auth::user()->id }}/thumbnails/' +
         photoId +
         '.jpg" class="gallery">' +
         "<p>Podaj nowy tytuł dla tego zdjęcia.</p>" +
         '<form action="/panel/photo/' +
         photoId +
         '/edit" method="POST">' +
         '<input class="form-control" type="text" name="title" autocomplete="off" value="' +
         title +
         '" autofocus>' +
         '@csrf' +
         '<br>' +
         '<button onclick="hidePrompt()" type="button" class="form-control-small">ANULUJ</button> <button type="submit" class="form-control-small">ZAPISZ</button>' +
         "</form" +
         "</div>";
      $(".screen-overlay").append(text).css("display", "flex").animate({
         opacity: 1,
      }, "fast");
   }

   function showMovePhotoPrompt(photoId, albumId) {
      var text =
         '<div class="popup">' +
         '<img src="/photos/{{ Auth::user()->id }}/thumbnails/' + photoId + '.jpg" class="gallery">' +
         "<p>Wybierz nowy album dla tego zdjęcia.</p>" +
         '<form action="/panel/photo/' +
         photoId +
         '/changeAlbum" method="POST">' +
         '@csrf' +
         '<select id="selectAlbum" name="album" class="form-control" onchange="toggleSaveBtn()">' +
         '<option value="noselect" disabled selected>Wybierz Album</option>' +
         '@foreach($albums as $album)' +
         '<option value="{{ $album->id }}">{{ $album->album_name }}</option>' +
         '@endforeach' +
         '</select>' +
         '<br>' +
         '<button onclick="hidePrompt()" type="button" class="form-control-small">ANULUJ</button> <button type="submit" id="saveBtn" disabled class="form-control-small">ZAPISZ</button>' +
         "</form" + "</div>";
      $(".screen-overlay").append(text).css("display", "flex").animate({
         opacity: 1,
      }, "fast");
   }

   function toggleSaveBtn() {
      if ($('#seletAlbum').children('option:selected').val() == 'noselect') {
         $('#saveBtn').prop('disabled', true);
      } else {
         $('#saveBtn').prop('disabled', false);
      }
   }

</script>
@endsection
