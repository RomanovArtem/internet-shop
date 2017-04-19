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
		$_SESSION['urlpage'] = "<a href= 'index.php'>Главная</a> \ <a href= 'reviews.php'>Отзывы</a>"; // в сессию помещаем ссылку для навигационной цепочки

		include("include/db_connect.php"); // подключаемся к бд
        include("include/functions.php");
        include("include/sort-reviews.php");
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
    
	<title>Панель управления - Отзывы</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
        $allCount = mysql_query("SELECT * FROM table_reviews", $link);
        $allCountResult = mysql_num_rows($allCount);
        
        $noAcceptCount = mysql_query("SELECT * FROM table_reviews WHERE approved = '0'", $link);
        $noAcceptCountResult = mysql_num_rows($noAcceptCount);
	?>
	<div class="block-content">
		<div class = "block-parameters">
            <ul class="list">
                <li>Сортировать:</li>
                <li><a class="select-links" href="#"><? echo $sortName; ?></a>
                    <ul class="list-rew-sort">
                        <li><a href="reviews.php?sort=accept">Проверенные</a></li>
                        <li><a href="reviews.php?sort=no-accept">Не проверенные</a></li>
                    </ul>
                </li>
            </ul>                                
		</div>
        <div class="block-info">
        <ul class="review-info-count">
            <li>Всего отзывов: <b><?php echo $allCountResult;?></b></li>
            <li>Не проверенных: <b><?php echo $noAcceptCountResult;?></b></li>
        </ul>
        </div>
         <?php
            if (isset($msgerror)) {
                echo '<p class="form-error" align="center">'.$msgerror.'</p>';
            }
         
                $num = 4;//сколько выводить товаров на страницу
                $page = (int)$_GET['page']; // номер текущей страницы
                
                $count = mysql_query("SELECT COUNT(*) FROM table_reviews $sortCount",$link); // общее кол-во товаров в бд
                
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
            
                if($temp[0] > 0) // есил товары есть
                {
                    $result = mysql_query("SELECT * FROM table_reviews,table_products WHERE table_products.products_id = table_reviews.products_id $sortData LIMIT $start, $num", $link);
                    
                    if(mysql_num_rows($result) > 0)
                    {
                        $row = mysql_fetch_array($result);
                        do
                        {
                            if(strlen($row["image"]) > 0 && file_exists("../upload_images/".$row["image"]))
                            {
                                $img_path = "../upload_images/".$row["image"];
                                $max_width = 130;
                                $max_height = 170;
                                $width = 130;
                                $height = 170;
                            } 
                            else
                            {
                                $img_path = "../../images/no-image.png";
                                $width = 130;
                                $height = 170;
                            }
                            
                            if ($row["approved"] == '0') {
                                $linkAccept = '<a class = "green" href="reviews.php?id='.$row["reviews_id"].'&action=accept" >Принять</a> | ';
                            }
                            else {
                                $linkAccept = '';
                            }
                            
                            $user = $row["user_id"];
                            $resultUser = mysql_query("SELECT * FROM reg_user WHERE user_id = $user", $link);
                            $rowUser = mysql_fetch_array($resultUser);
           
                            echo '
                            <div class="block-reviews">
                                <div class="block-title-img">
                                    <p>'.$row["title"].'</p>
                                    <center>
                                        <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
                                    </center> 
                                </div>
                            <p class="author-date"><b>'.$rowUser["surname"].' '.$rowUser["name"].' '.$rowUser["patronymic"].'</b>, '.$row["date"].'</p>  
                            <div class="plus-minus">
                                <img src="../images/plus.png"/><p>'.$row["good_reviews"].'</p>
                                <img src="../images/minus.png"/><p>'.$row["bad_reviews"].'</p>
                            </div>
                            
                            <p class="reviews-comment" >'.$row["comment"].'</p>
                            <p class="links-actions" align="right" >'.$linkAccept.'<a class="delete" rel="reviews.php?id='.$row["reviews_id"].'&action=delete" >Удалить</a> </p>   
                             </div>   
                            ';
                        } while ($row = mysql_fetch_array($result));
                    } 
                }
                
if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="reviews.php?'.$url.'page='. ($page - 1) .'&sort='.$sort.'" />Назад</a></li>';
 
if ($page != $total) $nextpage = '<li><a class="pstr-next" href="reviews.php?'.$url.'page='. ($page + 1) .'&sort='.$sort.'"/>Вперёд</a></li>';
 
// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = '<li><a href="reviews.php?'.$url.'page='. ($page - 5) .'&sort='.$sort.'">'. ($page - 5) .'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="reviews.php?'.$url.'page='. ($page - 4) .'&sort='.$sort.'">'. ($page - 4) .'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="reviews.php?'.$url.'page='. ($page - 3) .'&sort='.$sort.'">'. ($page - 3) .'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="reviews.php?'.$url.'page='. ($page - 2) .'&sort='.$sort.'">'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="reviews.php?'.$url.'page='. ($page - 1) .'&sort='.$sort.'">'. ($page - 1) .'</a></li>';
 
if($page + 5 <= $total) $page5right = '<li><a href="reviews.php?'.$url.'page='. ($page + 5) .'&sort='.$sort.'">'. ($page + 5) .'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="reviews.php?'.$url.'page='. ($page + 4) .'&sort='.$sort.'">'. ($page + 4) .'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="reviews.php?'.$url.'page='. ($page + 3) .'&sort='.$sort.'">'. ($page + 3) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="reviews.php?'.$url.'page='. ($page + 2) .'&sort='.$sort.'">'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="reviews.php?'.$url.'page='. ($page + 1) .'&sort='.$sort.'">'. ($page + 1) .'</a></li>';
 
if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="reviews.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
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
    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='reviews.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
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
