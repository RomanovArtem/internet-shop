<?php
	session_start();
	if ($_SESSION['auth_admin'] == "yes_auth") 
	{
		define('myshop', true); 

		if (isset($_GET["logout"]))
		{
			unset($_SESSION['auth_admin']); // удаляем сессиию auth_admin
			header("Location: login.php"); // пернаправляем
		}
		$_SESSION['urlpage'] = "<a href= 'index.php'>Главная</a> \ <a href= 'administrators.php'>Администраторы</a>"; // в сессию помещаем ссылку для навигационной цепочки

		include("include/db_connect.php"); // подключаемся к бд
        include("actions/delete-admin.php");
?>	
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv ="content-type" content="text/html" />
	<link href ="css/reset.css" rel="stylesheet" type="text/css" />
	<link href ="css/style.css" rel="stylesheet" type="text/css" />
    <link href ="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
    
	<title>Панель управления - Администраторы</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
	?>
	<div class="block-content">
		<div class = "block-parameters">
            <p class="title-page">Администраторы</p>
			<p align="right" class="add-style"><a href="add_administrator.php">Добавить админа</a></p>
		</div>  
        
        <?php
	       $result = mysql_query("SELECT * FROM admins ORDER BY id DESC", $link);
            if(mysql_num_rows($result) > 0) {
                $row = mysql_fetch_array($result);
                do {           
                    echo '
                        <ul class = "list-admin">
                            <li>
                            <h3>'.$row["fio"].'</h3>
                            <p><strong>Должность:</strong> '.$row["role"].'</p>
                            <p><strong>E-mail:</strong> '.$row["email"].'</p>
                            <p><strong>Телефон:</strong> '.$row["phone"].'</p>
                            <p class="links-actions" align="right"><a class="green" href="edit_administrator.php?id='.$row["id"].'">Изменить</a> | <a rel="administrators.php?id='.$row["id"].'&action=delete" class="delete" > Удалить</a></p> 
                            </li> 
                        </ul>   
                    ';
                } while ($row = mysql_fetch_array($result));
            } 
        ?>
          
	</div>
</div>
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script> 
</body>
</html>
<?php 
	}
	else
	{
		header("Location: login.php");
	}
?>
