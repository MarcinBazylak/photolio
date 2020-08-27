function showDelPrompt(userId, photoId) {
   var text =
      '<div style="text-align: center; height: auto; min-width: 30vw; border: 1px solid white; border-radius: 10px; padding: 15px; color: white">';
   text +=
      '<img src="/photos/' +
      userId +
      "/thumbnails/" +
      photoId +
      '.jpg" class="gallery">';
   text += "<p>Czy na pewno chcesz usunąć to zdjęcie?</p>";
   text +=
      '<button onclick="hidePrompt()" type="button">NIE</button> <a href="/panel/photo/' +
      photoId +
      '/delete"><button type="button">TAK</button></a>';
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
