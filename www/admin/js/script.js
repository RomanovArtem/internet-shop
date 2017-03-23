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
    
});