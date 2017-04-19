<?php
if ($_POST["submit_add"]) 
    {
        if ($_SESSION['admin_login'] == 'admin') {
        $error = array();
        
        
        if ($_POST["admin_login"]) {
            $login = clear_strings($_POST["admin_login"]);
            $query = mysql_query("SELECT login FROM admins WHERE login = '$login'", $link);
            
            if (mysql_num_rows($query) > 0) {
                $error[] = "Логин занят!";
            }
        }
        else {
             $error[] = "Укажите логин!";
        }
        
        if (!$_POST["admin_pass"])
        {
            $error[] = "Укажите пароль!";
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
            $pass = md5(clear_strings($_POST["admin_pass"]));
            $pass = strrev($pass);
            $pass = strtolower("dqw3443kl".$pass."sdad213123");
            
            mysql_query("INSERT INTO admins(login,password,fio,role,email,phone,view_orders,accept_orders,delete_orders,add_products,
                        edit_products,delete_products,accept_reviews,delete_reviews,view_clients,delete_clients,add_news,delete_news,
                        add_category,delete_category,view_admins)
            VALUES(
                '".clear_strings($_POST["admin_login"])."',
                '".$pass."',
                '".clear_strings($_POST["admin_fio"])."',
                '".clear_strings($_POST["admin_role"])."',
                '".clear_strings($_POST["admin_email"])."',
                '".clear_strings($_POST["admin_tel"])."',
                '".$_POST["view_orders"]."',
                '".$_POST["accept_orders"]."',
                '".$_POST["delete_orders"]."',
                '".$_POST["add_products"]."',
                '".$_POST["edit_products"]."',
                '".$_POST["delete_products"]."',
                '".$_POST["accept_reviews"]."',
                '".$_POST["delete_reviews"]."',
                '".$_POST["view_clients"]."',
                '".$_POST["delete_clients"]."',
                '".$_POST["add_news"]."',
                '".$_POST["delete_news"]."',
                '".$_POST["add_category"]."',
                '".$_POST["delete_category"]."',
                '".$_POST["view_admins"]."'            
            )",$link);
            
            $_SESSION['message'] = "<p class='form-success'>Администратор успешно добавлен!</p>";           
        }        
    }
    else {
        $msgerror = 'У вас нет прав на добавление администраторов!';
    }
    }
?>