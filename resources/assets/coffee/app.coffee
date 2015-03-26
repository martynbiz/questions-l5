# # test loading json
# $ ->
#   $.ajax
#     url: "/"
#     dataType: "json"
#     error: (jqXHR, textStatus, errorThrown) ->
#       alert "Error loading"
#     success: (data, textStatus, jqXHR) ->
#       alert "JSON loaded!"