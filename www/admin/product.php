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
		$_SESSION['urlpage'] = "<a href= 'index.php'>Главная</a> \ <a href= 'product.php'>Товары</a>"; // в сессию помещаем ссылку для навигационной цепочки

		include("include/db_connect.php"); // подключаемся к бд
        
        include("include/sort-product.php");  // сортировку товаров, выводит товары данного бренда
        
        // удаление товара
        
        $action = $_GET["action"];
        if (isset($action)) // если сущетсвует, т.е. не пуста
        {
            $id = (int)$_GET["id"];
            switch ($action)
            {
                case 'delete':
                    $delete = mysql_query("DELETE FROM table_products WHERE products_id = '$id'", $link);
                    break;
            }
        }
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
    
	<title>Панель управления - Товары</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
        
        //запрос о кол-ве товаров в БД
        $count_products = mysql_query("SELECT * FROM table_products $category", $link);
        $count_products = mysql_num_rows($count_products); 
	?>
	<div class="block-content">
		<div class = "block-parameters">
            <?php
		      include("include/products_list.php"); 
            ?>
		</div>
        <div class="block-info">
        <p class="count-style">Всего товаров: <strong><?php echo $count_products;?></strong></p>
        <p class="add-product"><a href="add_product.php">Добавить товар</a></p>
        </div>
        
        <!--сначала создаю список, т.к. товары выводятся списком -->
        <ul class = "block-product">
            <?php
                $num = 9;//сколько выводить товаров на страницу
                $page = (int)$_GET['page']; // номер текущей страницы
                
                $count = mysql_query("SELECT COUNT(*) FROM table_products $category",$link); // общее кол-во товаров в бд
                
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
                    $result = mysql_query("SELECT * FROM table_products $category ORDER BY products_id DESC LIMIT $start, $num", $link);
                    
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
                            
                            echo '
                            <li class = "product-li">
                                <p class = "product-p">'.$row["title"].'</p>
                                <center>
                                    <img src = "'.$img_path.'" width = "'.$width.'" height = "'.$height.'" />
                                </center>
                                <p align="center" class="link-action">
                                    <a class="green" href="edit_product.php?id='.$row["products_id"].'">Изменить</a> | <a rel="product.php?'.$url.'id='.$row["products_id"].'&action=delete" class="delete" > Удалить</a>
                                </p>
                            </li>                            
                            ';
                        } while ($row = mysql_fetch_array($result));
                        echo'
                        </ul>
                        ';
                    } 
                }
                
if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="product.php?'.$url.'page='. ($page - 1) .'" />Назад</a></li>';
 
if ($page != $total) $nextpage = '<li><a class="pstr-next" href="product.php?'.$url.'page='. ($page + 1) .'"/>Вперёд</a></li>';
 
// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = '<li><a href="product.php?'.$url.'page='. ($page - 5) .'">'. ($page - 5) .'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="product.php?'.$url.'page='. ($page - 4) .'">'. ($page - 4) .'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="product.php?'.$url.'page='. ($page - 3) .'">'. ($page - 3) .'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="product.php?'.$url.'page='. ($page - 2) .'">'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="product.php?'.$url.'page='. ($page - 1) .'">'. ($page - 1) .'</a></li>';
 
if($page + 5 <= $total) $page5right = '<li><a href="product.php?'.$url.'page='. ($page + 5) .'">'. ($page + 5) .'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="product.php?'.$url.'page='. ($page + 4) .'">'. ($page + 4) .'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="product.php?'.$url.'page='. ($page + 3) .'">'. ($page + 3) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="product.php?'.$url.'page='. ($page + 2) .'">'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="product.php?'.$url.'page='. ($page + 1) .'">'. ($page + 1) .'</a></li>';
 
if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="product.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
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
    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='product.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
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
