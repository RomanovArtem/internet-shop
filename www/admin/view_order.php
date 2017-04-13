<?php
	session_start();
	if ($_SESSION['auth_admin'] == "yes_auth") 
	{
		define('myshop', true); 

		if (isset($_GET["logout"]))
		{
			unset($_SESSION['auth_admin']); 
			header("Location: login.php"); 
		}
		$_SESSION['urlpage'] = "<a href= 'index.php'>Главная</a> \ <a href= 'orders.php'>Заказы</a> \ <a>Просмотр заказа</a>"; // в сессию помещаем ссылку для навигационной цепочки

		include("include/db_connect.php");
        include("include/functions.php");
        include("actions/delete-order.php");
       $id = clear_strings($_GET["id"]);
?>	
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv ="content-type" content="text/html" />
	<link href ="css/reset.css" rel="stylesheet" type="text/css" />
	<link href ="css/style.css" rel="stylesheet" type="text/css" />
    <link href ="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script> 
    
	<title>Панель управления - Просмотр заказа</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php");         
	?>
	<div class="block-content">
		<div class = "block-parameters">
           <p class="title-page">Просмотр заказа</p>                              
		</div>
        <?php
	       $result = mysql_query("SELECT * FROM orders WHERE order_id='$id'", $link);
           if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_array($result);
            do {
                if ($row["order_confirmed"] == 'yes') {
                    $status = '<b class="green">Обработан</b>';
                }
                else {
                    $status = '<b class="red">Не обработан</b>';
                }
                
                echo '
                    <p class="view-order-link"><a class="green" href="view_order.php?id='.$row["order_id"].'&action=accept">Подтвердить заказ</a> | <a class="delete" rel="view_order.php?id='.$row["order_id"].'&action=delete">Удалить заказ</a></p>
                    <p class="order_datetime">'.$row["order_datetime"].'</p>
                    <p class="order_number">Заказ № '.$row["order_id"].' - '.$status.'</p>
                    
                    <table align="center" cellpadding="10" width="100%">
                    <tr>
                        <th>№</th>
                        <th>Наименование товара</th>
                        <th>Цена</th>
                        <th>Количество</th>
                    </tr>
                ';
                
                $query_product = mysql_query("SELECT * FROM buy_products,table_products WHERE buy_products.buy_id_order='$id' AND table_products.products_id=buy_products.buy_id_product", $link);
                $result_query = mysql_fetch_array($query_product);
                
                $buyer_product = mysql_query("SELECT * FROM orders,reg_user WHERE orders.order_id='$id' AND reg_user.user_id=orders.id_buyer", $link);
                $result_query_buyer = mysql_fetch_array($buyer_product);
                do {
                    $price = $price + ($result_query["price"] * $result_query["buy_count_product"]);
                    $index_count = $index_count + 1;   
                    
                    echo '
                    <tr>
                        <td align="center">'.$index_count.'</td>
                        <td align="center">'.$result_query["title"].'</td>
                        <td align="center">'.$result_query["price"].'</td>
                        <td align="center">'.$result_query["buy_count_product"].'</td>
                    </tr>
                    ';                 
                } while ($result_query = mysql_fetch_array($query_product));
                
                if ($row["order_pay"] == "accepted") {
                    $stat_pay = '<b class="green">Оплачено</b>';
                }
                else {
                    $stat_pay = '<b class="red">Не оплачено</b>';
                }
                
                echo '
                    </table>
                    <ul class = "info-order">
                        <li>Общая цена: <b>'.$price.'</b> руб</li>
                        <li>Способ доставки: <b>'.$row["order_delivery"].'</b></li>
                        <li>Статус оплаты: '.$stat_pay.'</li>
                        <li>Тип оплаты: <b>'.$row["order_type_pay"].'</b></li>
                        <li>Дата оплаты: <b>'.$row["order_datetime"].'</b></li>
                    </ul>
                    
                    <table align="center" cellpadding="10" width="100%">
                    <tr>
                        <th>ФИО</th>
                        <th>Адрес</th>
                        <th>Контакты</th>
                        <th>Примечание</th>
                    </tr>
                    
                    <tr>
                        <td align="center">'.$result_query_buyer["surname"].' '.$result_query_buyer["name"].' '.$result_query_buyer["patronymic"].'</td>
                        <td align="center">'.$result_query_buyer["address"].'</td>
                        <td align="center">'.$result_query_buyer["phone"].'</br>'.$result_query_buyer["email"].'</td>
                        <td align="center">'.$result_query_buyer["order_note"].'</td>
                    </tr>
                    </table>
                ';
            } while ($row = mysql_fetch_array($result));
           }
        ?>
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
