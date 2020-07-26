$(function() {

   $('#contactForm').on('submit', function(e) {

      var tick;

      e.preventDefault();
      if ($('#tick').is(":checked")) {
         tick = $('#tick').val()
      }

      $.ajax({
         type: 'post',
         url: '../send.php',
         data: {
            name: $('#name').val(),
            email: $('#email').val(),
            text: $('#txtInput').val(),
            tick: tick
         },
         success: function(data) {
            document.getElementById('contactForm').reset();
            showAlert(data);
         }
      });

   });

});