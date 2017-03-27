$(document).ready(function() {
    $('.delete').click(function() {
        var rel = $(this).attr("rel");
        
        $.confirm({
            'title' : '����������� ��������!',
            'message'   : '����� ����� �����. ����������?',
            'buttons'   : {
                '��'    : {
                    'class' : 'blue',
                    'action' : function(){
                        location.href = rel; // ������������� ������������ �� ������
                    }
                },
                '���'   : {
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
        $(this).next().slideToggle(400); // ���������� ������ �� ������� ������ , � next-�� ��������� ��������� ������ (�����)
    });
    
    
    $('.delete-cat').click(function() {
        var selectId = $('#select-type option:selected').val(); //����� id ������, ������� ������
        
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
                            alert("�������� ����������! \n��������� ������ ��������� � ������ ���������.");
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