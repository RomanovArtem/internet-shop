$(document).ready(function() {
    $('.delete').click(function() {
        var rel = $(this).attr("rel");
        
        $.confirm({
            'title' : 'Подтвердите удаление!',
            'message'   : 'Товар будет удалён. Продолжить?',
            'buttons'   : {
                'Да'    : {
                    'class' : 'blue',
                    'action' : function(){
                        location.href = rel; // перенаправить пользователя на ссылку
                    }
                },
                'Нет'   : {
                    'class' : 'gray',
                    'action': function(){ }
                }
            }
        });
    });
    
    $('.select-links').click(function() {
        $(".list-brands, .list-rew-sort").slideToggle(200);
    });
    
    $('.click-header').click(function(){
        $(this).next().slideToggle(400); // определяем объект на который нажади , и next-ом открываем следующий объект (класс)
    });
    
    
    $('.delete-cat').click(function() {
        var selectId = $('#select-type option:selected').val(); //взять id бренда, котлрый выбран
        
        if (!selectId) {
            var elem = document.getElementById("select-type");

            $("#select-type").css("border", "3px solid #F5A4A4");
            //this.style.borderColor = "#F5A4A4";
            
        } 
        else {
            $.ajax({
                type: "POST",
                url: "./actions/delete-category.php",
                data: "id="+selectId,
                dataType: "html",
                cache: false,
                success: function(data) {
                    switch(data){
                        case "delete":
                            $("#select-type").css("border", "3px solid #D1E7BC");
                            $("#select-type option:selected").remove();
                            $(".form-success").css("display", "none");
                            $(".form-error").css("display", "none");
                            break;
                            
                        case "no-delete":
                            $(".form-success").css("display", "none");
                            $(".form-error").css("display", "none");
                            alert("Удаление невозможно! \nНекоторые товары относятся к данной категории.");
                            break;
            
                        default:
                            break;
                    }
                   
                }
            });
        }
    });
    
    $('.block-clients').click(function() {
        $(this).find('ul').slideToggle(300);
    });
    
    
});