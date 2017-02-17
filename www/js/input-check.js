   $(document).ready(function(){
        $("#form_reg").validate(
        {
            // правила для проверки
            rules:{
                reg_login:{
                    required:true, //не пустое ли поле?
                    minlength:5, // минимальная длина значения
                    maxlength:15, //максимальная длина значения
                    remote:{
                        url: "reg/check_login.php",
                              type: 'post'    
                          
                            }
                },
                
                reg_pass:{
                    required:true, //не пустое ли поле?
                    minlength:7, // минимальная длина значения
                    maxlength:15, //максимальная длинв значения
                },
                
                reg_surname:{
                    required:true, //не пустое ли поле?
                    minlength:3, // минимальная длина значения
                    maxlength:20, //максимальная длинв значения
                },
                
                reg_name:{
                    required:true, //не пустое ли поле?
                    minlength:3, // минимальная длина значения
                    maxlength:15, //максимальная длинв значения
                },
                
                reg_patronymic:{
                    required:true, //не пустое ли поле?
                    minlength:3, // минимальная длина значения
                    maxlength:25, //максимальная длинв значения
                },
                
                 reg_email:{
                    required:true, //не пустое ли поле?
                    email:true, //проверка email на правильность ввода
                },
                
                 reg_phone:{
                    required:true,//не пустое ли поле?
                   number:true, //числовой тип?

                },
                
                reg_address:{
                    required:true, //не пустое ли поле?
                },
                
                //reg_captcha:{
//                    required:true, //не пустое ли поле?
//                    remote:{
//                        type: "post", //отправляет методом post
//                        url: "/reg/check_captcha.php" // этому обработчику, в нем проверка и запрос к бд для проверки капчи, если логин существует и не занят, то проверке возвращается true
//                    },
//                },
            },
            
            // выводимые сообщения, при нарушеении соответствующих правил
            messages:{
                reg_login:{
                    required: "Укажите Логин!",
                    minlength: "От 5 до 15 символов!",
                    maxlength: "От 5 до 15 символов!",
                    remote: "Логин занят!"
                },
                
                reg_pass:{
                    required: "Укажите Пароль!",
                    minlength: "От 7 до 15 символов!",
                    maxlength: "От 7 до 15 символов!",
                },
           
                
                reg_surname:{
                    required: "Укажите вашу Фамилию!",
                    minlength: "От 3 до 20 символов!",
                    maxlength: "От 3 до 20 символов!",
                },
              
                reg_name:{
                    required: "Укажите ваше Имя!",
                    minlength: "От 3 до 15 символов!",
                    maxlength: "От 3 до 15 символов!",
                },
                
                reg_patronymic:{
                    required: "Укажите ваше Отчество!",
                    minlength: "От 3 до 25 символов!",
                    maxlength: "От 3 до 25 символов!",
                },

                
                reg_email:{
                    required: "Укажите свой E-mail!",
                    email: "Не корректный E-mail",
                },
                
                reg_phone:{
                    required: "Укажите номер телефона!",
                    number: "Не корректный номер телефона!",

                },
                
                reg_address:{
                    required: "Необходимо указать адрес доставки!",
                },

                //reg_captcha:{
//                    required: "Введите код с картинки!",
//                    remote: "Не верный код проверки!",
//                },

            },
            
            //если всё правильно заполнено, то при нажатии кнопки регистрация
            //будет происходить:
            
             submitHandler: function(form){    ////////////////////////////   submitHandler    /////////////////////////////////////
    $(form).ajaxSubmit({
        success: function(data){
            if(data == true){     
                
                //в обработчике echo 'true', но возврата не происходит!
                $("#block-form-registration").fadeOut(300, function(){
                    $("#form_submit").hide();
                    $("#reg_message").addClass("reg_message_good").fadeIn(400).html("Вы успешно зарегистрированы!");
                })
            }
            else {
                $("#reg_message").addClass("reg_message_error").fadeIn(400).html(data);
            }
        }
    });
}
}
);
});