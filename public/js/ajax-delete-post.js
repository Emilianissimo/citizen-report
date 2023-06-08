$(function() {
  $(".delete-comment").on('click', function () {
    console.log("changed");
    if (window.confirm("Вы уверены?")){
      var route = $(this).data('route')
      var tr = $(this).parent().parent().parent()

      $.ajax({

          url: route,

          type: "DELETE",

          headers: {

          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

          },


          success: function (data) {
            tr.hide('slow', function(){ tr.remove(); });
          },

          error: function (data, msg) {

              alert('Ошибка');
              console.log(data['responseText'], route)

          }

        });  
      }          
  });
  })

$('.edit-comment').on('click', function(){
  var comment = $(this).parent().parent().parent().find('.comment')
  var commentText = comment.html()
  var route = $(this).data('route')
  $(this).hide()
  comment.html(
    '<textarea class="form-control" id="commentTextEditable">'+commentText.trim()+'</textarea><hr><button data-route="' +
    route +
    '" class="btn btn-success commentTextEditableButton" type="button"><i class="fa fa-check"></i></button> <button type="button" data-old="'+ commentText.trim() +'" class="btn btn-danger dropCommentEdit"><i class="fa fa-remove"><i></button>'
    )
})

$('.comment').on('click', 'button.dropCommentEdit', function(){
  var comment = $(this).parent()
  var edit = $(this).parent().parent().parent().parent().find('.edit-comment')
  var commentText = $(this).data('old')
  comment.html(commentText)
  edit.show()
})

$('.comment').on('click', 'button.commentTextEditableButton', function(){
  var comment = $(this).parent()
  var commentText = $('#commentTextEditable').val()
  var edit = $(this).parent().parent().parent().parent().find('.edit-comment')
  var route = $(this).data('route')
  $.ajax({

          url: route,

          type: "PUT",

          data: {commentText:commentText},

          headers: {

          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),

          },


          success: function (data) {
            comment.html(commentText)
            edit.show()
          },

          error: function (data, msg) {

              alert('Ошибка');
              console.log(data['responseText'], route)

          }

        });
})