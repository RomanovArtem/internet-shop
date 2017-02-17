   $(document).ready(function(){
        $("#form_reg").validate(
        {
            // ������� ��� ��������
            rules:{
                reg_login:{
                    required:true, //�� ������ �� ����?
                    minlength:5, // ����������� ����� ��������
                    maxlength:15, //������������ ����� ��������
                    remote:{
                        url: "reg/check_login.php",
                              type: 'post'    
                          
                            }
                },
                
                reg_pass:{
                    required:true, //�� ������ �� ����?
                    minlength:7, // ����������� ����� ��������
                    maxlength:15, //������������ ����� ��������
                },
                
                reg_surname:{
                    required:true, //�� ������ �� ����?
                    minlength:3, // ����������� ����� ��������
                    maxlength:20, //������������ ����� ��������
                },
                
                reg_name:{
                    required:true, //�� ������ �� ����?
                    minlength:3, // ����������� ����� ��������
                    maxlength:15, //������������ ����� ��������
                },
                
                reg_patronymic:{
                    required:true, //�� ������ �� ����?
                    minlength:3, // ����������� ����� ��������
                    maxlength:25, //������������ ����� ��������
                },
                
                 reg_email:{
                    required:true, //�� ������ �� ����?
                    email:true, //�������� email �� ������������ �����
                },
                
                 reg_phone:{
                    required:true,//�� ������ �� ����?
                   number:true, //�������� ���?

                },
                
                reg_address:{
                    required:true, //�� ������ �� ����?
                },
                
                //reg_captcha:{
//                    required:true, //�� ������ �� ����?
//                    remote:{
//                        type: "post", //���������� ������� post
//                        url: "/reg/check_captcha.php" // ����� �����������, � ��� �������� � ������ � �� ��� �������� �����, ���� ����� ���������� � �� �����, �� �������� ������������ true
//                    },
//                },
            },
            
            // ��������� ���������, ��� ���������� ��������������� ������
            messages:{
                reg_login:{
                    required: "������� �����!",
                    minlength: "�� 5 �� 15 ��������!",
                    maxlength: "�� 5 �� 15 ��������!",
                    remote: "����� �����!"
                },
                
                reg_pass:{
                    required: "������� ������!",
                    minlength: "�� 7 �� 15 ��������!",
                    maxlength: "�� 7 �� 15 ��������!",
                },
           
                
                reg_surname:{
                    required: "������� ���� �������!",
                    minlength: "�� 3 �� 20 ��������!",
                    maxlength: "�� 3 �� 20 ��������!",
                },
              
                reg_name:{
                    required: "������� ���� ���!",
                    minlength: "�� 3 �� 15 ��������!",
                    maxlength: "�� 3 �� 15 ��������!",
                },
                
                reg_patronymic:{
                    required: "������� ���� ��������!",
                    minlength: "�� 3 �� 25 ��������!",
                    maxlength: "�� 3 �� 25 ��������!",
                },

                
                reg_email:{
                    required: "������� ���� E-mail!",
                    email: "�� ���������� E-mail",
                },
                
                reg_phone:{
                    required: "������� ����� ��������!",
                    number: "�� ���������� ����� ��������!",

                },
                
                reg_address:{
                    required: "���������� ������� ����� ��������!",
                },

                //reg_captcha:{
//                    required: "������� ��� � ��������!",
//                    remote: "�� ������ ��� ��������!",
//                },

            },
            
            //���� �� ��������� ���������, �� ��� ������� ������ �����������
            //����� �����������:
            
             submitHandler: function(form){    ////////////////////////////   submitHandler    /////////////////////////////////////
    $(form).ajaxSubmit({
        success: function(data){
            if(data == true){     
                
                //� ����������� echo 'true', �� �������� �� ����������!
                $("#block-form-registration").fadeOut(300, function(){
                    $("#form_submit").hide();
                    $("#reg_message").addClass("reg_message_good").fadeIn(400).html("�� ������� ����������������!");
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