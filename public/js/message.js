var messageField = document.getElementById("message");
   function showAlert(data) {

      setTimeout(function(){

         if(data != '') {
            messageField.innerHTML = data;
         }
         }, 500);

         setTimeout(function(){
            messageField.className = "fade-in";
         }, 1000);

         setTimeout(function(){
            messageField.className = "";
         }, 3000);

      }