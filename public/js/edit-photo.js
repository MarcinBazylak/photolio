function showEditPrompt(userId, photoId, title) {
   var text =
      '<div style="text-align: center; height: auto; min-width: 30vw; border: 1px solid white; border-radius: 10px; padding: 15px; color: white">' +
      '<img src="/photos/' +
      userId +
      "/thumbnails/" +
      photoId +
      '.jpg" class="gallery">' +
      "<p>Podaj nowy tytuł dla tego zdjęcia.</p>" +
      '<form action="/panel/photo/' +
      photoId +
      '/edit" method="POST">' +
      '<input class="edit-title" type="text" name="title" required autocomplete="off" value="' +
      title +
      '"><br>' +
      '<button onclick="hidePrompt()" type="button">ANULUJ</button> <button type="submit">ZAPISZ</button>' +
      "</form" +
      "</div>";

   $(".screen-overlay").append(text).css("display", "flex").animate(
      {
         opacity: 1,
      },
      "fast"
   );
}
