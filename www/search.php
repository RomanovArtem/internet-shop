<?php
	include("include/db_connect.php");
    include("include/sort_items.php");
    include("functions/functions.php");
    session_start();
    
    $search = clear_strings($_GET["query"]);
    $searchNull = 0;
    
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
    <title>Поиск по названию - <?php echo $search; ?> </title>  
</head>

<body>

<div id="block-body">
<?php
	include("include/block-header.php");
?>
<div id="block-content">

<?php
	if((strlen($search) >= 3) && (strlen($search) <= 50))
    {
        
?>



<ul id="block-product-grid">
<?php
    $num = 6; 
    $page = (int)$_GET['page']; 
    
    $count = mysql_query("SELECT COUNT(*) FROM table_products WHERE title LIKE '%$search%' AND visible = '1'", $link);
    $temp = mysql_fetch_array($count);
   
    if ($temp[0] > 0)
    {
        $tempCount = $temp[0];
    
        $total = (($tempCount - 1) / $num) + 1;
        $total = intval($total);
        
        $page = intval($page);
        
        if (empty($page) || $page < 0)
        {
            $page = 1;
        }
        if ($page > $total) 
        {
            $page = $total;
        }
        
        $start = $page * $num - $num;
        
        $quryStartNumber = "LIMIT $start, $num"; 
    }
    
    if ($temp[0] > 0)
    {
    

    echo '
    <div id="block-sorting">
<p id="nav-breadcrumbs"><a href="index.php">Главная страница</a> \<span>Поиск по названию</span></p><!--потом название поменяй--!>
<ul id="option-list">
<li>Вид: </li>
<li><img id="style-grid" src="images/icon-grid.png"/> </li>
<li><img id="style-list" src="images/icon-list.png"/> </li>

<li>Сортировать:</li>
<li><a id="select-sort">'. $sort_name.'</a>
<ul id="sorting-list">
<li><a href="search.php?sort=sort-ascending&query='.$search.'&category='.$category.'&page='.($page-1).'">От дешёвых к дорогим</a></li>
<li><a href="search.php?sort=sort-descending&query='.$search.'&category='.$category.'&page='.($page-1).'">От дорогих к дешёвым</a></li>
<li><a href="search.php?sort=sort-new&query='.$search.'&category='.$category.'&page='.($page-1).'">Новинки</a></li>
<li><a href="search.php?sort=sort-alphabetically-ASC&query='.$search.'&category='.$category.'&page='.($page-1).'">От А до Я</a></li>
<li><a href="search.php?sort=sort-alphabetically-DESC&query='.$search.'&category='.$category.'&page='.($page-1).'">От Я до А</a></li>
</ul>
</li>
</ul>
</div>
    ';

	$result = mysql_query("SELECT * FROM table_products WHERE title LIKE '%$search%' AND visible='1' ORDER BY $sorting $quryStartNumber", $link); 
    if (mysql_num_rows($result) >0) 
    {
        $row = mysql_fetch_array($result); 
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
    }


?>
</ul>



<ul id="block-product-list">
<?php
	$result = mysql_query("SELECT * FROM table_products WHERE title LIKE '%$search%' AND visible='1'ORDER BY $sorting $quryStartNumber", $link); 
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

echo '</ul>';

if ($page != 1) 
{
    $prevPage = '<li><a class = "prevPage" href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page-1).'">&lt</a></li>'; 
}

if ($page != $total) 
{
    $nextPage = '<li><a class = "nextPage"href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page+1).'">&gt</a></li>'; 
}



if ($page-5 > 0) 
{
    $leftPage5 = '<li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page-5).'">'.($page-5).'</a></li>'; 
}
if ($page-4 > 0) 
{
    $leftPage4 = '<li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page-4).'">'.($page-4).'</a></li>'; 
}



if ($page-3 > 0) 
{
    $leftPage3 = '<li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page-3).'">'.($page-3).'</a></li>'; 
}
if ($page-2 > 0) 
{
    $leftPage2 = '<li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page-2).'">'.($page-2).'</a></li>'; 
}
if ($page-1 > 0) 
{
    $leftPage1 = '<li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page-1).'">'.($page-1).'</a></li>'; 
}




if ($page+5 <= $total) 
{
    $rightPage5 = '<li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page+5).'">'.($page+5).'</a></li>'; 
}
if ($page+4 <= $total) 
{
    $rightPage4 = '<li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page+4).'">'.($page+4).'</a></li>'; 
}
if ($page+3 <= $total) 
{
    $rightPage3 = '<li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page+3).'">'.($page+3).'</a></li>'; 
}
if ($page+2 <= $total)
{
    $rifhtPage2 = '<li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page+2).'">'.($page+2).'</a></li>'; 
}
if ($page+1 <= $total) 
{
    $rightPage1 = '<li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.($page+1).'">'.($page+1).'</a></li>'; 
}


if ($page + 5 < $total)
{
    $pageTotal = '<li> <p class ="navPoint">...</p></li><li><a href="search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page='.$total.'">'.$total.'</a></li>';
}
else
{
    $pageTotal = "";
}

if ($total > 1)
{
    echo '
    <div class ="navPages">
    <ul>
    ';
    echo $prevPage.$leftPage5.$leftPage4.$leftPage3.$leftPage2.$leftPage1."<li><a class = 'pageActive' href = 'search.php?query='.$search.'&category='.$category.'&sort='.$sortPage.'&page=".$page."'>".$page."</a></li>".$rightPage1.$rightPage2.$rightPage3.$rightPage4.$rightPage5.$pageTotal.$nextPage;
    echo '
    </ul>
    </div>
    
    ';
}

}if ($temp[0] == 0)
{
    $searchNull = 1;
   
    
}
}else
{
    echo "<p id='search-message'>Значение для поиска должно быть от 3 до 50 символов!</p>";
}

?>

 





</div>
<div id="block-left">
<?php
	include("include/block-category.php");
    include("include/block-parameter.php");
    include("include/block-news.php");
?>


</div>
<?php
	if($searchNull == 1)
{
    echo "<p id='search-message'>Товар не найден!</p>";
}
?>
<?php
	include("include/block-footer.php");
?>
</div>

</body>
</html>