$('#toggle').click(function() {

   toggleMenu();

});

function toggleMenu() {
   
   if($('#input-toggle').prop('checked')) {

      $("#li1").removeClass('navopen').addClass('navclose');
      setTimeout(function(){
         $("#li2").removeClass('navopen').addClass('navclose');
      },100);
      setTimeout(function(){
         $("#li3").removeClass('navopen').addClass('navclose');
      },200);

   } else {

      $("#li1").removeClass('navclose').addClass('navopen');
      setTimeout(function(){
         $("#li2").removeClass('navclose').addClass('navopen');
      },100);
      setTimeout(function(){
         $("#li3").removeClass('navclose').addClass('navopen');    
      },200);

   }

}