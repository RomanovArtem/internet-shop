<?php

$id = clear_strings($_GET["id"]);
$sort = clear_strings($_GET["sort"]);

switch ($sort) {
        case 'accept':
            $sortCount = "WHERE approved ='1'";
            $sortData = "AND table_reviews.approved='1'";
            $sortName = "�����������";
            break;
            
        case 'no-accept':
            $sortCount = "WHERE approved ='0'";
            $sortData = "AND table_reviews.approved='0'";
            $sortName = "�� �����������";
            break;
        
        default: 
        $sortCount = "";
        $sortData = "";
        $sortName = "��� ����������";
        break;        
    }
    
    // ��������� ��� �������� ������
    $action = $_GET["action"];
    if (isset($action)) {
        switch ($action) {
            case 'accept':
                if ($_SESSION['accept_reviews'] == '1') {
                    $update = mysql_query("UPDATE table_reviews SET approved = '1' WHERE reviews_id = '$id'", $link);
                }
                else {
                    $msgerror = '� ��� ��� ���� �� ��������� �������!';
                }
                break;
            
            case 'delete':
                if ($_SESSION['delete_reviews'] == '1') {
                    $delete = mysql_query("DELETE FROM table_reviews WHERE reviews_id = '$id'", $link);
                }
                else {
                    $msgerror = '� ��� ��� ���� �� �������� �������!';
                }
                break;
        }       
    }
    
?>