function showEditAlbumPrompt(albumId, albumName) {
   var text =
      '<div class="popup">' +
      '<p>Podaj nową nazwę dla albumu "' +
      albumName +
      '".</p>' +
      '<form action="/panel/album/' +
      albumId +
      '/edit" method="POST">' +
      '<input class="form-control" type="text" name="albumName" autocomplete="off" value="' +
      albumName +
      '" autofocus>' +
      "@csrf" +
      "<br>" +
      '<button onclick="hidePrompt()" type="button" class="form-control-small">ANULUJ</button> <button type="submit" class="form-control-small">ZAPISZ</button>' +
      "</form" +
      "</div>";
   
   $(".screen-overlay").append(text).css("display", "flex").animate(
      {
         opacity: 1,
      },
      "fast"
   );
}
