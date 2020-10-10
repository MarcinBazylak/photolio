function switchAlbum(albumId) {
   $.ajax({
      type: "GET",
      url: "/php/getAlbum.php?albumId=" + albumId,
      success: function (data) {
         $(window).scrollTop(0);

         $(".album-btn").each(function() {
            $(this).removeClass("on");
         });
         $("#album-btn-" + albumId).addClass("on");
         $("#gallery-container")
            .removeClass("in")
            .addClass("out");

         setTimeout(() => {
            $("#gallery-container")
               .html(data)
               .removeClass("out")
               .addClass("in");
         }, 300);

         setTimeout(() => {
            var s = 0.1;

            var y = $(document).scrollTop();
            var h = $(window).innerHeight();

            $(".gallery-photo").each(function() {
               var t = Math.floor($(this).offset().top);
               if (t < h + y+ 60) {
                  $(this).css("animation-delay", s + "s");
                  $(this).addClass("show");
                  s += 0.1;
               }
            });
         }, 300);
      }
   });
   window.history.pushState("", "Photolio.pl", "/album-" + albumId);
}
