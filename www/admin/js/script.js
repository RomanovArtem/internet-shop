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
    
    $('.select-brand').click(function() {
        $(".list-brands").slideToggle(200);
    });
});