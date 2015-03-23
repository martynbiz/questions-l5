# our custom alert flash message box
$(".alert")
  .not(".alert-important")
  .delay(3000)
  .slideUp(300)

# activate bootstrap modals
$("#myModal")
    .modal();

# # test loading json
# $ ->
#   $.ajax
#     url: "/"
#     dataType: "json"
#     error: (jqXHR, textStatus, errorThrown) ->
#       alert "Error loading"
#     success: (data, textStatus, jqXHR) ->
#       alert "JSON loaded!"