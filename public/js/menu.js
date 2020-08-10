$('#toggle, .menu-item, .menu-item-admin').click(function() {

   toggleMenu();

});

function toggleMenu() {
   
   if($('#input-toggle').prop('checked')) {

      let t = 0.0;

      $('.menu-item').each(function() {

         $(this).css('transition-delay', t + 's');
         $(this).addClass('menu-item-hidden').removeClass('menu-item-show');
         
         t += 0.05;

       });

   } else {

      let t = 0.0;

      $('.menu-item').each(function() {
         
         $(this).css('transition-delay', t + 's');
         $(this).addClass('menu-item-show').removeClass('menu-item-hidden');
         
         t += 0.05;
       });


      // $("#li1").removeClass('navclose').addClass('navopen');
      // setTimeout(function(){
      //    $("#li2").removeClass('navclose').addClass('navopen');
      // },100);
      // setTimeout(function(){
      //    $("#li3").removeClass('navclose').addClass('navopen');    
      // },200);

   }

}