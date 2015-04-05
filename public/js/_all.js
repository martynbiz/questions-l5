(function() {
  $(".alert").not(".alert-important").delay(3000).slideUp(300);

  $("#myModal").modal();

}).call(this);

(function() {
  $.fn.confirmSubmit = function(message) {
    if (confirm(message)) {
      return $(this).submit();
    }
  };

}).call(this);
