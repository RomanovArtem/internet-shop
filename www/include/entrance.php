<?php
	session_start();  
?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include("../include/db_connect.php");
    include("../functions/functions.php");

    $login = ($_POST["login"]);   
    $pass = ($_POST["pass"]);  
    
    

    
    
    $pass = md5($pass);  
    $pass = strrev($pass);  
    $pass = "9nm2rv8q".$pass."2yo6z";  
    
    
    $result = mysql_query("SELECT * FROM reg_user WHERE (login = '$login' || email = '$login') && password = '$pass'", $link);
    if (mysql_num_rows($result) > 0)
    {
        $row = mysql_fetch_array($result);
         
        $_SESSION['input'] = 'yes_input'; 
        $_SESSION['input_id'] = $row["user_id"];
        $_SESSION['input_pass'] = $row["password"];  
        $_SESSION['input_login'] = $row["login"]; 
        $_SESSION['input_surname'] = $row["surname"];
        $_SESSION['input_name'] = $row["name"]; 
        $_SESSION['input_patronymic'] = $row["patronymic"];
        $_SESSION['input_address'] = $row["address"]; 
        $_SESSION['input_phone'] = $row["phone"];
        $_SESSION['input_email'] = $row["email"];
        echo true;
    }
    else
    {
        echo false;
    }
}
?>  