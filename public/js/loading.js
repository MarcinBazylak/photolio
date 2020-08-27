setTimeout(() => {
   var s = 0.1;

   var y = $(document).scrollTop();
   var h = $(window).innerHeight();

   $(".gallery-photo").each(function () {
      var t = Math.floor($(this).offset().top);
      if (t < h + y) {
         $(this).css("animation-delay", s + "s");
         $(this).addClass("show");
         s += 0.1;
         console.log("inner height = " + h);
         console.log("scroll top = " + y);
         console.log("offset = " + t);
      }
   });

   $(document).scroll(function () {
      var y = $(this).scrollTop();
      var h = $(window).height();

      var delay = 0.1;

      $(".gallery-photo").each(function () {
         var t = $(this).offset().top;

         if (y + h + 160 > t) {
            if (!$(this).hasClass("show")) {
               $(this).css("animation-delay", delay + "s");
               $(this).addClass("show");
               delay += 0.1;
            }
         }
      });
   });
}, 1000);
