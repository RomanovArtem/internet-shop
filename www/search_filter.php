<?php
	include("include/db_connect.php");
    include("functions/functions.php");
    
    session_start();
    $category = $_GET["category"];
    $brand = $_GET["brand"];
?>


<!DOCTYPE HTML PUBLIC>
<html>

<head>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type= "image/x-icon">

	<meta http-equiv="content-type" content="text/html; charset=windows-1251" /> 
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="/js/jcarousellite-1.0.1.js"></script> 
    <script type="text/javascript" src="/js/shop-script.js"></script>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script> 
    <title>Поиск по цене</title>  
</head>

<body>

<div id="block-body">
<?php
	include("include/block-header.php");
?>

<div id="block-content">


<?php
if ($_GET["brand"]) # если что то есть
{
     
    $checkBrand = implode(',', $_GET["brand"]);
} 
$startPrice = (int)$_GET["startPrice"];
$endPrice = (int)$_GET["endPrice"];


if(!empty($checkBrand) || !empty($endPrice))
{
    if(!empty($checkBrand))
    {
        $queryBrand = " AND brand_id IN($checkBrand)";
    }
    if(!empty($endPrice))
    {
        $queryPrice  =" AND price BETWEEN $startPrice AND $endPrice";
    }
}

    $result = mysql_query("SELECT * FROM table_products WHERE visible='1'  $queryPrice ORDER BY price ASC", $link); 
    if (mysql_num_rows($result) > 0) 
    {
        $row = mysql_fetch_array($result); 
        echo '
        <div id="block-sorting">
        <p id="nav-breadcrumbs"><a href="index.php">Главная страница</a> \<span>Поиск по цене</span></p><!--потом название поменяй--!>
        <ul id="option-list">
        <li>Вид: </li>
        <li><img id="style-grid" src="images/icon-grid.png"/> </li>
        <li><img id="style-list" src="images/icon-list.png"/> </li>

        
        </ul>
        </div>
        
        <ul id="block-product-grid">
        
        ';
    
        do
        {
            
            if ($row["image"] != "" && file_exists("./upload_images/".$row["image"])) 
            {
                $img_path = "./upload_images/".$row["image"];
                $max_width = 160;
                $max_height = 210;
                $width = 160;
                $height = 210;
            } 
            else
            {
                $img_path = "/images/no-image.png";
                $width = 160;
                $height = 210;
            }
            $query_reviews = mysql_query("SELECT * FROM table_reviews WHERE products_id = '{$row["products_id"]}' AND approved = '1'", $link);
            $count_reviews = mysql_num_rows($query_reviews);
            echo '
            <li>
            
                <div class="block-images-grid">
                <img src="'.$img_path.'"/ width = "'.$width.'" height = "'.$height.'"> </div>
            
                <p class="title-grid"><a href="view_content.php?id='.$row["products_id"].'" >'.$row["title"].'</a></p>
                
                <ul class="views-and-reviews-grid">
                    <li><img src="/images/comment-icon.png"/><p>'.$count_reviews.'</p></li>
                </ul>
                
               <a class="add-basket-grid" productID="'.$row["products_id"].'"></a>
                
                <p class="price-grid"><strong>'.$row["price"].'</strong> руб.</p>
                
                <div class="mini-features">'.$row["mini_features"].'
                </div>
            
            </li>
            
            
            ';
        }   while($row = mysql_fetch_array($result));     
    #}


?>
</ul>



<ul id="block-product-list">
<?php
	$result = mysql_query("SELECT * FROM table_products WHERE visible='1' $queryBrand $queryPrice ORDER BY products_id DESC", $link); 
    if (mysql_num_rows($result) >0) 
    {
        $row = mysql_fetch_array($result); 
        do
        {
            
            if ($row["image"] != "" && file_exists("./upload_images/".$row["image"])) 
             {
                $img_path = "./upload_images/".$row["image"];
                $max_width = 130;
                $max_height = 170;
                $width = 130;
                $height = 170;
            } 
            else
            {
                $img_path = "/images/no-image.png";
                $width = 130;
                $height = 170;
            }
                        
             $query_reviews = mysql_query("SELECT * FROM table_reviews WHERE products_id = '{$row["products_id"]}' AND approved = '1'", $link);
             $count_reviews = mysql_num_rows($query_reviews);
                          
            echo '
            <li>
            
                <div class="block-images-list">
                <img src="'.$img_path.'"/ width = "'.$width.'" height = "'.$height.'"> </div>
            
                <ul class="views-and-reviews-list">                  
                    <li><img src="/images/comment-icon.png"/><p>'.$count_reviews.'</p></li>
                </ul>
                
                <p class="title-list"><a href="view_content.php?id='.$row["products_id"].'" >'.$row["title"].'</a></p>
                
                <a class="add-basket-list" productID="'.$row["products_id"].'"></a>
                
                <p class="price-list"><strong>'.$row["price"].'</strong> руб.</p>
                
                <div class="text-list">'.$row["mini_description"].'
                </div>
            
            </li>
            
            
            ';
        }   while($row = mysql_fetch_array($result));     
    }
    }else{ 
        echo '<h3>Категория не доступна или не создана!</3>';
    }


?>
</ul>






</div>
<div id="block-left">
<?php
	include("include/block-category.php");
    include("include/block-parameter.php");
    include("include/block-news.php");
?>


</div>
<?php
	include("include/block-footer.php");
?>
</div>

</body>
</html>