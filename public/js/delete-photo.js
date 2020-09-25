function highlight(id) {
   if ($("#del-photo" + id).prop("checked")) {
      $("#photo" + id).css("backgroundColor", "red");
   } else {
      $("#photo" + id).css("backgroundColor", "white");
   }
   if ($(".checkbox:checked").length > 0) {
      $("#del-button")
         .prop("disabled", false)
         .text("Usuń " + $(".checkbox:checked").length + " zdjęć");
   } else {
      $("#del-button")
         .prop("disabled", true)
         .text("Usuń");
   }
}