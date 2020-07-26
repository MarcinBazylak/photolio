var s = 0.1;

var y = $(document).scrollTop();
var h = $(window).innerHeight();

$('.gallery-photo').each(function() {
    var t = $(this).offset().top;
    if (y + h + 50 > t) {

      $(this).css('animation-delay', s + 's');
      $(this).addClass('show');
      s += 0.2;

    }
  });

$(document).scroll(function() {

  var y = $(this).scrollTop();  
  var h = $(window).height();

  $('.gallery-photo').each(function() {
    var t = $(this).offset().top;

    if (y + h - 50 > t) {

      if(!$(this).hasClass('show'))

         $(this).addClass('show');
         
      }

  });
});