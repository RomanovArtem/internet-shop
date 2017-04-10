<?php
	session_start();
    define('myshop', true); // ключ доступа к файлам
    include("include/db_connect.php");
    include("include/functions.php");
    
    if ($_POST["submit-enter"])
    {
        $login = clear_strings($_POST["input-login"]);
        $password = clear_strings($_POST["input-pass"]);
        
        if ($login && $password)
        {
            $password = md5($password);
            $password = strrev($password);
            $password = strtolower("dqw3443kl".$password."sdad213123");
            
            $result = mysql_query("SELECT * FROM admins WHERE login = '$login' AND password = '$password'", $link);
        
            if (mysql_num_rows($result) >0 ) // если админ такой есть , то
            {
                $row = mysql_fetch_array($result);
                $_SESSION['auth_admin'] = 'yes_auth'; //с помощью сессии определяем авторизован админ или нет, если да, то перенаправляем на админ панель
                //укзываем куда перенаправить
                header("Location: index.php");
            }
            else
            {
                $msgerror = "Неверный Логин и(или) Пароль! ";
            }
        }
        else
        {
            $msgerror = "Запоните все поля!";
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style-login.css" rel="stylesheet" type="text/css" />
    
	<title>Панель Управления - Вход</title>
</head> 
<body>
<div class="block-pass-login">
<?php
	if ($msgerror)
    {
        echo '<p class = "msgerror">'.$msgerror.'</p>';
    }
?>
<form method="post">
<ul class="pass-login">
<li><label>Логин:</label><input type="text" name="input-login" /></li>
<li><label>Пароль:</label><input type="password" name="input-pass" /></li>
</ul>
<p align="right"><input type="submit" name="submit-enter" class="submit-enter" value="Вход" /></p>
</form>

</div>


</body>
</html>