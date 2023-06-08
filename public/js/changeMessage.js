

  $(function() {
  $(".changeMessage").on('click',  function (ev) {
    
      var button = $(this)
      var td = $(this).parent()
      var route = $(this).data('route')
      var id = $(this).data('id')
      $.ajax({

          url: route,

          type: "POST",

          headers: {

          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

          },


          success: function (data) {
            var returnedData = JSON.parse(data);
            console.log(returnedData['status'])
            if(Number(returnedData['status']) === Number(1)){
              button.removeClass('btn-outline-danger').addClass('btn-outline-success')
              button.children().removeClass('fa-eye-slash').addClass('fa-eye')

            }else{
              button.removeClass('btn-outline-success').addClass('btn-outline-danger')
              button.children().removeClass('fa-eye').addClass('fa-eye-slash')
            }
            var counterParent = $('#messagesCount').parent()
            counterParent.load(location.href + ' #messagesCount')

          },

          error: function (data, msg) {

              alert('Ошибка');
              console.log(data, route)

          }

        });  
                
  });
  })
