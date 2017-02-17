$(document).ready(function() {
  $('#newsticker').jCarouselLite({
  btnPrev: "#news-prev",
  btnNext: "#news-next",
        auto: 5000,   
        hoverPause: true,
        speed: 500,
        vertical: true,
        visible: 3
 });
 
 
$("#style-grid").click(function(){ 
  $("#block-product-grid").show();  
  $("#block-product-list").hide();
  $("#style-grid").attr("src","/images/icon-grid-active.png");
  $("#style-list").attr("src","/images/icon-list.png");

  $.cookie('select_style','grid')
}); 
 
$("#style-list").click(function(){
  $("#block-product-grid").hide();  
  $("#block-product-list").show();
  $("#style-list").attr("src","/images/icon-list-active.png");
  $("#style-grid").attr("src","/images/icon-grid.png");

  $.cookie('select_style','list')
});

 if($.cookie('select_style') == 'grid')
 {
    $("#block-product-grid").show();  
    $("#block-product-list").hide();
    
    $("#style-grid").attr("src","/images/icon-grid-active.png");
    $("#style-list").attr("src","/images/icon-list.png");
 }
 else
 {
    $("#block-product-grid").hide();  
    $("#block-product-list").show();
    $("#style-list").attr("src","/images/icon-list-active.png");
    $("#style-grid").attr("src","/images/icon-grid.png");
 }
 
 
 
 
$("#select-sort").click(function(){
    $("#sorting-list").slideToggle(200)
});

$('#block-category > ul > li > a').click(function(){
    if($(this).attr('class') != 'active'){
        $('#block-category > ul > li > ul').slideUp(400);
        $(this).next().slideToggle(400); 
        $('#block-category > ul > li > a').removeClass('active');
        $(this).addClass('active');}
        else{
            $('#block-category > ul > li > a').removeClass('active');
            $('#block-category > ul > li > ul').slideUp(400);
        }
}) ;
 
 $(".input-button").toggle(
    function(){
 
        $(".input-button").attr("id", "active-button");
        $("#user-input").fadeIn(300);
    },

    function(){
        
        $(".input-button").attr("id", "");
        $("#user-input").fadeOut(300);
    }
 );
 
 
 
 $('#button-pass-show-hide').click(function(){
 var statuspass = $('#button-pass-show-hide').attr("class");
  
    if (statuspass == "pass-show")
    {
       $('#button-pass-show-hide').attr("class","pass-hide");
       
                            var $input = $("#input-pass");
                            var change = "password";
                            var rep = $("<input placeholder='Пароль' type='" + change + "' />")
                                .attr("id", $input.attr("id"))
                                .attr("name", $input.attr("name"))
                                .attr('class', $input.attr('class'))
                                .val($input.val())
                                .insertBefore($input);
                            $input.remove();
                            $input = rep;
        
    }else
    {
        $('#button-pass-show-hide').attr("class","pass-show");
        
                            var $input = $("#input-pass");
                            var change = "text";
                            var rep = $("<input placeholder='Пароль' type='" + change + "' />")
                                .attr("id", $input.attr("id"))
                                .attr("name", $input.attr("name"))
                                .attr('class', $input.attr('class'))
                                .val($input.val())
                                .insertBefore($input);
                            $input.remove();
                            $input = rep;              
    }
  }); 
 
 
 $("#button-input").click(function() {
    
    var input_login = $("#input-login").val();            
    var input_pass= $("#input-pass").val();
    
    if (input_login == "" || input_login.length > 30)
    {
        $("#input-login").css("borderColor", "#FDB6B6");
        send_login = 'no';
    }
    else
    {
        $("#input-login").css("borderColor", "#DBDBDB");
        send_login = 'yes';
    }
    
    if (input_pass == "" || input_pass.length > 15)
    {
        $("#input-pass").css("borderColor", "#FDB6B6");
        send_pass = 'no';
    }
    else
    {
        $("#input-pass").css("borderColor", "#DBDBDB");
        send_pass = 'yes';
    }
    
    
    if(send_login == 'yes' && send_pass == 'yes')
    {
        $("#button-input").hide();
        $("#loading-input").show();
        
        $.ajax({
            type: "POST", 
            url: "../include/entrance.php",  
            data: "login="+input_login+"&pass="+input_pass, 
            success: function(data){   
                
            if(data == 1){                   
                    location.reload();
                }
                else
                {
                    $("#message-input").slideDown(400);                    
                    $("#button-input").show();
                    $("#loading-input").hide()                    
                }
                
            }
        
        })
        
    }
    
 });
 
 
 
 $('#img-logout').click(function(){
    $.ajax({
        type: "POST",
        url: "../include/log-out.php",
        dataType: "html",
        success: function(data){
            
            if(data == 'logout')
            {
                location.reload();
            }
        }
    });
 });
 
 

 
 $('.add-basket-grid,.add-basket-list,.add-cart').click(function(){
  
  var productID = $(this).attr("productID");
  
  $.ajax({
  type: "POST", 
  url: "../include/addtoCart.php", 
  data: "MyID="+productID, 
  dataType: "html",
  success: function(data){ 
  
  if (data == 1)
  {
    alert('Товар добавлен в корзину!');
  }
  else
  {
    alert('Чтобы добавить товары в корзину, зарегистрируйтесь/авторизуйтесь!');
  }
  }
  });
    
    
 });
 
 
 
 $('.count-input').keypress(function(e){
    
    if(e.keyCode==13) 
    {
        var productCartID = $(this).attr("productCartID");
        var inCount = $("#input-id"+productCartID).val();
        
          $.ajax({
            type: "POST",
            url: "../include/count-input.php",
            data: "id="+productCartID+"&count="+inCount, 
            dataType: "html",
            success: function(data){ 
            
            $("#input-id"+productCartID).val(data); 
            
            var priceProduct = $("#tovar"+productCartID+" > p").attr("price"); 
            resultTotal = Number(priceProduct)* Number(data); 
            
            $("#tovar"+productCartID+" > p").html(resultTotal + " руб");

            $("#tovar"+productCartID+" > h5 > .span-count").html(data);

            TotalPrice();
           
            }
        });
    }
    
      
    
                    
 });
 
 
     function TotalPrice(){
        
         $.ajax({
            type: "POST", 
            url: "../include/total-price.php", 
            dataType: "html",
            success: function(data) 
            {
                $(".total-price > strong").html(data);
            }
            });
     }
 
 
 
 $(".write-send-review").click(function()
 {  
    $("#send-review").show();  ь
    $(".write-send-review1").show();
    $(".write-send-review").hide();
    $(".block-reviews").hide();
 });
 
 $(".write-send-review1").click(function(){ 
 $("#send-review").hide();  
 $(".write-send-review1").hide();
 $(".write-send-review").show();
 $(".block-reviews").show();


}); 
 
 

 $("#button-send-review").click(function()
 {
    
    var good = $("#good_review").val();
    var bad = $("#bad_review").val();
    var comment = $("#comment_review").val();
    var productID = $("#button-send-review").attr("productID");
    
    if (good != "")
    {
        good_review = '1';
        $("#good_review").css("borderColor", "#DBDBDB")
    }
    else
    {
        good_review = '0';
        $("#good_review").css("borderColor", "#FDB6B6")
    }
    
    if (bad != "")
    {
        bad_review = '1';
        $("#bad_review").css("borderColor", "#DBDBDB")
    }
    else
    {
        bad_review = '0';
        $("#bad_review").css("borderColor", "#FDB6B6")
    }
    
    

    
    if (good_review == '1' && bad_review == '1')
    {
        
        alert('Комментарий добавлен!');
        $("#send-review").hide(); 
        $(".write-send-review1").hide();
        $(".write-send-review").show();
        $(".block-reviews").show();
        
        
        $.ajax({
            type: "POST",
            url: "/include/add_review.php",
            data: "id="+productID+"&good="+good+"&bad="+bad+"&comment="+comment,
            dataType: "html",
            success: function()
            {
                //
            }
        });
    }
    
 });
 
 
 $("#button-pay").click(function()
 {
     $.ajax({
            type: "POST",
            url: "/include/del_order.php",
            success: function()
            {
                alert('Заказ успешно оформлен!');
            }
        });
    });
 
 
 
 
 
 
 
});