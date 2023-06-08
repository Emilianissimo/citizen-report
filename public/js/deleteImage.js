$(function() {
  $(".deleteImage").on('click', function () {
    console.log("changed");
      var route = $(this).data('route')

      $.ajax({

          url: route,

          type: "GET",

          headers: {

          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

          },


          success: function (data) {
            console.log('ok')
          },

          error: function (data, msg) {

              alert('Ошибка');
              console.log(data['responseText'])

          }

        });  
              
  });
  })