<?php
include("./include/functions.php");

if ($_POST["cat-submit"]) {
    $error = array();
    
     if (!$_POST["cat-type"]) {
        $error[] = "������� ��� ������!";
     }   
     if (!$_POST["cat-brand"]) {
        $error[] = "������� ����� ������!";
     }   
    
    if (count($error)) {
        $_SESSION['message'] = "<p class='form-error'>".implode('<br />', $error)."</p>";
        $cat_type = clear_strings($_POST["cat-type"]);
        $cat_brand = clear_strings($_POST["cat-brand"]);
    }
    else {
        $cat_type = clear_strings($_POST["cat-type"]);
        $cat_brand = clear_strings($_POST["cat-brand"]);
        
       $query = (mysql_query("INSERT INTO brands(category,brand)
        VALUES(
            '".$cat_type."',
            '".$cat_brand."'
        )",$link));
        
        $_SESSION['message'] = "<p class='form-success'>��������� ���������!</p>";
        unset($error);
        unset($cat_type);
        unset($cat_brand);
        
      //  header('location: http://'.$_SERVER['HTTP_HOST'].'/admin/category.php');
    }
}

?>