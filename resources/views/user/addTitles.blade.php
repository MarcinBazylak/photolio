      <h2>Dodaj tytuły do nowych zdjęć</h2>
      <form class="form" action="/panel/photos" method="post">
         <div style="width: 100%; display:flex; flex-wrap: wrap; align-items: center; justify-content: center">
            @method('PUT')
            @csrf
            @for($i = 0; $i < count($result->uploaded); $i++)
               <div style="display: inline-block; border: 1px solid #bbb; border-radius:6px; margin: 5px; background: #e0e0e0; padding: 5px; box-shadow: 3px 3px 3px rgba(0,0,0,0.3)">
                  <div style="display: flex; flex-direction: column; align-content: center;align-items: center">
                     <img src="/photos/{{ Auth::user()->id }}/thumbnails/{{ $result->uploaded[$i] }}.jpg" style="max-width: 200px">
                  </div>
                  <div style="display: block; margin-top: 10px;">
                     <input type="hidden" name="photo[{{ $i }}]" value="{{ $result->uploaded[$i] }}">
                     <input class="form-control-small" style="margin-bottom: 0 !important; width: 100% !important;" type="text" name="title[{{ $i }}]" placeholder="Wpisz tytuł" autocomplete="off">
                  </div>
               </div>
            @endfor
         </div>
         <div style="display: block; margin: 10px 5px; width: fit-content">
            <a href="/panel/photos"><button type="button" class="form-control">Pomiń</button></a> <button type="submit" class="form-control">Zapisz</button>
         </div>
      </form>
