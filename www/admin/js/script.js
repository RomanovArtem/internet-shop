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
    
});