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
		$_SESSION['urlpage'] = "<a href= 'index.php'>Главная</a> \ <a href= 'orders.php'>Заказы</a>"; // в сессию помещаем ссылку для навигационной цепочки

		include("include/db_connect.php"); // подключаемся к бд
        include("include/functions.php");
        include("include/sort-orders.php");
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
    
	<title>Панель управления - Заказы</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
        
        $allOrders = mysql_query("SELECT * FROM orders", $link);
        $allOrdersResult = mysql_num_rows($allOrders);
        
        $allConfirmedOrders = mysql_query("SELECT * FROM orders WHERE order_confirmed = 'yes'", $link);
        $allConfirmedOrdersResult = mysql_num_rows($allConfirmedOrders);
        
        $allNoConfirmedOrders = mysql_query("SELECT * FROM orders WHERE order_confirmed = 'no'", $link);
        $allNoConfirmedOrdersResult = mysql_num_rows($allNoConfirmedOrders);
        
	?>
	<div class="block-content">
		<div class = "block-parameters">
            <ul class="list">
                <li>Сортировать:</li>
                <li><a class="select-links" href="#"><? echo $sortName; ?></a>
                    <ul class="list-rew-sort">
                        <li><a href="orders.php?sort=all-orders">От А до Я</a></li>
                        <li><a href="orders.php?sort=confirmed">Обработанные</a></li>
                        <li><a href="orders.php?sort=no-confirmed">Не обработанные</a></li>
                    </ul>
                </li>
            </ul>                                
		</div>
        <div class="block-info">
        <ul class="review-info-count">
            <li>Всего заказов: <b><?php echo $allOrdersResult;?></b></li>
            <li>Обработанных: <b><?php echo $allConfirmedOrdersResult;?></b></li>
            <li>Не обработанных: <b><?php echo $allNoConfirmedOrdersResult;?></b></li>
        </ul>
        </div>
         <?php
                $num = 5;//сколько выводить товаров на страницу
                $page = (int)$_GET['page']; // номер текущей страницы
                
                $count = mysql_query("SELECT COUNT(*) FROM orders $sort",$link);
                
                $temp = mysql_fetch_array($count); // значение запроса
                
                $post = $temp[0]; // общее кол-во товаровecho $post;
                    
                // сколько страниц нужно
                $total = (($post - 1) / $num) + 1;
                $total = intval($total); // округление до целого(в меньшую сторону)
                    
                $page = intval($page); //ибо в поисковую строку к номеру страницы можно написать и цифры
                    
                if(empty($page) or $page <= 0) $page = 1;
                    if ($page > $total) $page = $total;
                
                //узнаем, с какого номера надо выводить товар
                    $start = $page * $num - $num;
            
                if($temp[0] > 0)
                {
                    $result = mysql_query("SELECT * FROM orders $sort LIMIT $start, $num", $link);
                    
                    if(mysql_num_rows($result) > 0)
                    {
                        $row = mysql_fetch_array($result);
                        do
                        {
                            if ($row["order_confirmed"] == 'yes') {
                                $status = '<b class="green">Обработан</b>';
                            }
                            else {
                                $status = '<b class="red">Не обработан</b>';
                            }
           
                            echo '
                            <div class="block-order">
                                <p class="order_datetime">'.$row["order_datetime"].'</p>
                                <p class="order_number">Заказ № '.$row["order_id"].' - '.$status.'</p>
                                <p class="order_link"><a class="green" href="view_order.php?id='.$row["order_id"].'">Подробнее</a></p>
                            </div>   
                            ';
                        } while ($row = mysql_fetch_array($result));
                    } 
                }
                
if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="orders.php?'.$url.'page='. ($page - 1) .'&sort='.$sortCase.'" />Назад</a></li>';
 
if ($page != $total) $nextpage = '<li><a class="pstr-next" href="orders.php?'.$url.'page='. ($page + 1) .'&sort='.$sortCase.'"/>Вперёд</a></li>';
 
// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = '<li><a href="orders.php?'.$url.'page='. ($page - 5) .'&sort='.$sortCase.'">'. ($page - 5) .'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="orders.php?'.$url.'page='. ($page - 4) .'&sort='.$sortCase.'">'. ($page - 4) .'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="orders.php?'.$url.'page='. ($page - 3) .'&sort='.$sortCase.'">'. ($page - 3) .'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="orders.php?'.$url.'page='. ($page - 2) .'&sort='.$sortCase.'">'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="orders.php?'.$url.'page='. ($page - 1) .'&sort='.$sortCase.'">'. ($page - 1) .'</a></li>';
 
if($page + 5 <= $total) $page5right = '<li><a href="orders.php?'.$url.'page='. ($page + 5) .'&sort='.$sortCase.'">'. ($page + 5) .'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="orders.php?'.$url.'page='. ($page + 4) .'&sort='.$sortCase.'">'. ($page + 4) .'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="orders.php?'.$url.'page='. ($page + 3) .'&sort='.$sortCase.'">'. ($page + 3) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="orders.php?'.$url.'page='. ($page + 2) .'&sort='.$sortCase.'">'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="orders.php?'.$url.'page='. ($page + 1) .'&sort='.$sortCase.'">'. ($page + 1) .'</a></li>';
 
if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="orders.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
}else
{
    $strtotal = ""; 
}
            ?>
            <div class="footerfix"></div> <!-- чтобы навигация не обтекалась с товарами -->
            <?php
    if ($total > 1)
{
    echo '
    <center>
    <div class="pstrnav">
    <ul>   
    ';
    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='orders.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
    echo '
    </center>   
    </ul>
    </div>
    ';
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
