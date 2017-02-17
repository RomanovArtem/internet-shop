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
		$_SESSION['urlpage'] = "<a href= 'index.php'>Главная</a>"; // в сессию помещаем ссылку для навигационной цепочки

		include("include/db_connect.php"); // подключаемся к бд
?>	
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv ="content-type" content="text/html" />
	<link href ="css/reset.css" rel="stylesheet" type="text/css" />
	<link href ="css/style.css" rel="stylesheet" type="text/css" />
	<title>Панель управления</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
	?>
	<div class="block-content">
		<div class = "block-parameters">
			<p class="title-page">Общая статистика</p>
		</div>
	</div>
</div>

</body>
</html>
<?php 
	}
	else
	{
		header("Location: login.php");
	}
?>
