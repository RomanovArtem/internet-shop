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
		$_SESSION['urlpage'] = "<a href= 'index.php'>Главная</a> \ <a href= 'administrators.php'>Адмнистраторы</a> \ <a>Изменение администратора</a>"; // в сессию помещаем ссылку для навигационной цепочки

		include("include/db_connect.php"); // подключаемся к бд
        include("include/functions.php");
        include("include/checking_fields_edit_administrator.php");	
?>	
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv ="content-type" content="text/html" />
	<link href ="css/reset.css" rel="stylesheet" type="text/css" />
	<link href ="css/style.css" rel="stylesheet" type="text/css" />
    <link href ="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
    
	<title>Панель управления - Изменение администратора</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
	?>
	<div class="block-content">
		<div class = "block-parameters">
			<p class="title-page">Изменение администратора</p>
		</div>
        <?php
	       if (isset($_SESSION['message'])) {
	           echo $_SESSION['message'];
               unset($_SESSION['message']);
	       }
           
           $id = clear_strings($_GET["id"]);
           $result = mysql_query("SELECT * FROM admins WHERE id = '$id'", $link);
           if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_array($result);
            do {
                if ($row["view_orders"] == "1") {$view_orders = "checked";} 
                if ($row["accept_orders"] == "1") {$accept_orders = "checked";}
                if ($row["delete_orders"] == "1") {$delete_orders = "checked";}
                if ($row["add_products"] == "1") {$add_products = "checked";}
                if ($row["edit_products"] == "1") {$edit_products = "checked";}
                if ($row["delete_products"] == "1") {$delete_products = "checked";}
                if ($row["accept_reviews"] == "1") {$accept_reviews = "checked";}
                if ($row["delete_reviews"] == "1") {$delete_reviews = "checked";}
                if ($row["view_clients"] == "1") {$view_clients = "checked";}
                if ($row["delete_clients"] == "1") {$delete_clients = "checked";}
                if ($row["add_news"] == "1") {$add_news = "checked";}
                if ($row["delete_news"] == "1") {$delete_news = "checked";}
                if ($row["add_category"] == "1") {$add_category = "checked";}
                if ($row["delete_category"] == "1") {$delete_category = "checked";}
                if ($row["view_admins"] == "1") {$view_admins = "checked";}
                
                echo '
            <form method="post" id="form-info">
            <ul class="info-admin">
                <li><label>Логин</label><input type="text" name="admin_login" value = "'.$row["login"].'" /></li>
                <li><label>Пароль</label><input type="password" name="admin_pass" /></li>
                <li><label>ФИО</label><input type="text" name="admin_fio" value = "'.$row["fio"].'" /></li>
                <li><label>Должность</label><input type="text" name="admin_role" value = "'.$row["role"].'" /></li>
                <li><label>E-mail</label><input type="email" name="admin_email" value = "'.$row["email"].'" /></li>
                <li><label>Телефон</label><input type="tel" id="tel-admin" name="admin_tel" placeholder="8(123) 456-67890" value = "'.$row["phone"].'" /></li>
            </ul>
            
            <h3 class="title-privilege">Привилегии</h3>
            <p class="link-privilege"><a id="select-all">Выбрать все</a> | <a id="remove-all">Снять все</a></p>
            
            <div class="block-privilege">
                <ul class="privilege">
                    <li><h3>Заказы</h3></li>
                    <li>
                        <input type="checkbox" name="view_orders" id="view_orders" value="1" '.$view_orders.'/>
                        <label for="view_orders">Просмотр заказов</label>
                    </li>
                    <li>
                        <input type="checkbox" name="accept_orders" id="accept_orders" value="1" '.$accept_orders.' />
                        <label for="accept_orders">Обработка заказов</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_orders" id="delete_orders" value="1" '.$delete_orders.' />
                        <label for="delete_orders">Удаление заказов</label>
                    </li>
                </ul>
                <ul class="privilege">
                    <li><h3>Товары</h3></li>
                    <li>
                        <input type="checkbox" name="add_products" id="add_products" value="1" '.$add_products.' />
                        <label for="add_products">Добавление товаров</label>
                    </li>
                    <li>
                        <input type="checkbox" name="edit_products" id="edit_products" value="1" '.$edit_products.' />
                        <label for="edit_products">Изменение товаров</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_products" id="delete_products" value="1" '.$delete_products.' />
                        <label for="delete_products">Удаление товаров</label>
                    </li>
                </ul>
                <ul class="privilege">
                    <li><h3>Отзывы</h3></li>
                    <li>
                        <input type="checkbox" name="accept_reviews" id="accept_reviews" value="1" '.$accept_reviews.'/>
                        <label for="accept_reviews">Модерация отзывов</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_reviews" id="delete_reviews" value="1" '.$delete_reviews.'/>
                        <label for="delete_reviews">Удаление отзывов</label>
                    </li>
                </ul>
            </div>
            
            <div class="block-privilege">
                <ul class="privilege">
                    <li><h3>Клиенты</h3></li>
                    <li>
                        <input type="checkbox" name="view_clients" id="view_clients" value="1" '.$view_clients.'/>
                        <label for="view_clients">Просмотр клиентов</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_clients" id="delete_clients" value="1" '.$delete_clients.' />
                        <label for="delete_clients">Удаление клиентов</label>
                    </li>
                </ul>
                <ul class="privilege">
                    <li><h3>Новости</h3></li>
                    <li>
                        <input type="checkbox" name="add_news" id="add_news" value="1" '.$add_news.'/>
                        <label for="add_news">Добавление новостей</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_news" id="delete_news" value="1" '.$delete_news.'/>
                        <label for="delete_news">Удаление новостей</label>
                    </li>
                </ul>
                <ul class="privilege">
                    <li><h3>Категории</h3></li>
                    <li>
                        <input type="checkbox" name="add_category" id="add_category" value="1" '.$add_category.'/>
                        <label for="add_category">Добавление категорий</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_category" id="delete_category" value="1" '.$delete_category.' />
                        <label for="delete_category">Удаление категорий</label>
                    </li>
                </ul>
            </div>
            
            <div class="block-privilege">
                <ul class="privilege">
                    <li><h3>Администраторы</h3></li>
                    <li>
                        <input type="checkbox" name="view_admins" id="view_admins" value="1" '.$view_admins.' />
                        <label for="view_admins">Просмотр администраторов</label>
                    </li>
                </ul>
            </div>
            
            <p align="right"><input type="submit" class="submit-form" name="submit_save" value="Сохранить"/></p>            
        </form>
                ';
                
            } while ($row = mysql_fetch_array($result));
           }
        ?>
        
	</div>
</div>

    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script> 
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script> 
</body>
</html>
<?php 
	}
	else
	{
		header("Location: login.php");
	}
?>
