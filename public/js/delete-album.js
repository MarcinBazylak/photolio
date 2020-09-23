function showDelAlbumPrompt(albumId, albumName) {
   var text = '<div class="popup">';
   text +=
      '<p>Czy na pewno chcesz usunąć album "<b>' + albumName + '</b>"?</p>';
   text +=
      '<button onclick="hidePrompt()" type="button" class="form-control-small">NIE</button> <a href="/panel/album/' +
      albumId +
      '/delete"><button type="button" class="form-control-small">TAK</button></a>';
   text += "</div>";

   $(".screen-overlay").append(text).css("display", "flex").animate(
      {
         opacity: 1,
      },
      "fast"
   );
}

function hidePrompt() {
   $(".screen-overlay").animate(
      {
         opacity: 0,
      },
      200
   );
   setTimeout(() => {
      $(".screen-overlay").empty().css("display", "none");
   }, 1000);
}
