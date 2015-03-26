# our custom alert flash message box
$(".alert")
  .not(".alert-important")
  .delay(3000)
  .slideUp(300)

# activate bootstrap modals
$("#myModal")
    .modal();