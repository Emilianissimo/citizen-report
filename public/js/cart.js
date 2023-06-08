$(function() {

    $('.addToCart').on('click',function(){

    var button = $(this);

    var count = button.attr("data-count");

    var product_id = button.attr("data-id");

    var business_id = button.attr("data-business")

    var lang = button.attr('data-lang')

    var route = button.attr('data-route')



    $.ajax({

        url: route,

        type: "POST",

        data: {count:count, product_id: product_id, business_id: business_id},

        headers: {

        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },


        success: function (data) {
            button.removeClass('btn-outline-danger').addClass('btn-secondary')
            if(lang=='ru'){
                button.html("Добавлено <i class='fa fa-shopping-cart'></i>")
            }else if(lang=='uz'){
                button.html("Qo'shildi <i class='fa fa-shopping-cart'></i>")
            }else{
                button.html("Added to Cart <i class='fa fa-shopping-cart'></i>")
            }
            $('#cart-parent-pc').load(location.href + ' #cart-pc')
            $('#cart-parent-phone').load(location.href + ' #cart-phone')

        },

        error: function (data, msg) {

            alert('Ошибка');
            console.log(data)

        }

      });

    });

})

$(function() {

    $(".quant_all").on('input', function(){

    var input = $(this) 

    var count = input.val();

    var id = input.attr('data-id');

    var route = input.attr('data-route')
    
    var empty = input.attr('data-empty')

    $.ajax({

        url: route,

        type: "POST",

        data: {count:count, id: id, },

        headers: {

        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },


        success: function (data) {
          if (input.val() == 0) {
            if(data['status'] == 0){
                input.parent().parent().parent().parent().parent().parent().hide('slow', function(){ input.parent().parent().parent().parent().parent().parent().remove(); });
            }else{
               input.parent().parent().hide('slow', function(){ input.parent().parent().remove(); });
            }
            if(data['cart'] == 0){
                $('#content').html('<h4 style="padding: 20px;">' + empty + '</h4>')
            }
            // $('#cartItems').load(location.href + ' .cartItem')
            
            $('#cart-parent-pc').load(location.href + ' #cart-pc')
            $('#cart-parent-phone').load(location.href + ' #cart-phone')
            
            
          }
            

        },

        error: function (data, msg) {

            alert('Ошибка');
            console.log(data)

        }

      });            
});

})

//Update count
$(document).ready(function() {
  update();
    $(".quant").change(function() {
      //this: context of the input that was changed
      console.log('calling /Cart/AddTocart; id:',$(this).attr('data-id'),' quantity: ', $(this).val());
      // $.get(
      //   '/Cart/AddTocart', {
      //     id: $(this).attr('data-id'),
      //     returnUrl: '',
      //     quantity: $(this).val()
      //   });
      update();
    });

    function update() {
      var sum = 0;
      var quantity;
      $('.item-data').each(function() {

        quantity = $(this).find('.quant').val();
        var price = parseInt($(this).find('.price').attr('data-price'));//var price = parseFloat($(this).find('.price').attr('data-price').replace(',', '.'));
        var amount = (quantity * price);

        sum += amount;
        $(this).find('.amount').text(amount);
      });
      $('#total').html(sum);
    }
});
$(function() {
  $(".count_cart").on('input', function () {
    // console.log("changed");
    var input = $(this) 

    var count = input.val();

    var id = input.attr('data-id');

    var route = input.attr('data-route')
    
    var empty = input.attr('data-empty')

    $.ajax({

        url: route,

        type: "POST",

        data: {count:count, id: id, },

        headers: {

        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },


        success: function (data) {
          if (input.val() == 0) {
            // $('#cartItems').load(location.href + ' .cartItem')
            input.parent().parent().parent().parent().hide('slow', function(){ input.parent().parent().parent().parent().remove(); });
            if(data['status'] == 0){
                $('#main-content').html('<h4 style="padding: 20px;">' + empty + '</h4>')
            }
            $('#cart-parent-pc').load(location.href + ' #cart-pc')
            $('#cart-parent-phone').load(location.href + ' #cart-phone')
          }
            

        },

        error: function (data, msg) {

            alert('Ошибка');
            console.log(data)

        }

      });            
});
})