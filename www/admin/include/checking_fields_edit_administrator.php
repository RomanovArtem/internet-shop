<?php
if ($_POST["submit_save"]) 
    {
        $error = array();
        $id = clear_strings($_GET["id"]);
        
        if (!$_POST["admin_login"]) {
             $error[] = "Укажите логин!";
        }
        
        if ($_POST["admin_pass"])
        {
            $pass = md5(clear_strings($_POST["admin_pass"]));
            $pass = strrev($pass);
            $pass = "password='".strtolower("dqw3443kl".$pass."sdad213123")."',";
        }
        if (!$_POST["admin_fio"])
        {
            $error[] = "Укажите ФИО!";
        }
        if (!$_POST["admin_role"])
        {
            $error[] = "Укажите должность!";
        }
        if (!$_POST["admin_email"])
        {
            $error[] = "Укажите E-mail!";
        }
        if (!$_POST["admin_tel"])
        {
            $error[] = "Укажите номер телефона!";
        }
        
        if (count($error))
        {
            $_SESSION['message'] = "<p class='form-error'>".implode('<br />',$error)."</p>"; //из массива переводим в строки все ошибки и разделяем тегом br
        }
        else
        {
            $update = mysql_query("UPDATE admins SET login='{$_POST["admin_login"]}',$pass fio='{$_POST["admin_fio"]}',role='{$_POST["admin_role"]}',email='{$_POST["admin_email"]}',phone='{$_POST["admin_tel"]}',view_orders='{$_POST["view_orders"]}',accept_orders='{$_POST["accept_orders"]}',delete_orders='{$_POST["delete_orders"]}',add_products='{$_POST["add_products"]}',edit_products='{$_POST["edit_products"]}',delete_products='{$_POST["delete_products"]}',accept_reviews='{$_POST["accept_reviews"]}',delete_reviews='{$_POST["delete_reviews"]}',view_clients='{$_POST["view_clients"]}',delete_clients='{$_POST["delete_clients"]}',add_news='{$_POST["add_news"]}',delete_news='{$_POST["delete_news"]}',add_category='{$_POST["add_category"]}',delete_category='{$_POST["delete_category"]}',view_admins='{$_POST["view_admins"]}' WHERE id = '$id'",$link); 
            $_SESSION['message'] = "<p class='form-success'>Администратор успешно изменен!</p>";           
        }        
    }
?>