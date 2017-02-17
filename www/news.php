<?php
	include("include/db_connect.php");
    include("include/sort_items.php");
    session_start();
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
    <!------!>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script> 
    <title>Новости</title>  
</head>

<body>

<div id="block-body">
<?php
	include("include/block-header.php");
?>
<div id="block-content">


<ul id="block-news-list">
<?php
	$result = mysql_query("SELECT * FROM news ORDER BY date DESC", $link);
    if (mysql_num_rows($result) >0) 
    {
        $row = mysql_fetch_array($result); 
        do
        {
            
            if ($row["image"] != "" && file_exists("./news_images/".$row["image"])) 
            {
                $img_path = "./news_images/".$row["image"];
                $max_width = 80;
                $max_height = 80;
                $width = 140;
                $height = 90;
            } 
            else
            {
                $img_path = "/images/no-image.png";
                $width = 80;
                $height = 80;
            }
            
            echo '
            <li>
            
                <div class="block-images-news-list">
                <img src="'.$img_path.'"/ width = "'.$width.'" height = "'.$height.'"> </div>
            
                
                
                <p class="title-list-news"><a href="" >'.$row["title"].'</a></p>
                
                
                <p class="price-list-news"><strong>'.$row["date"].'</strong></p>
                
                <div class="text-list-news">'.$row["text"].'
                </div>
            
            </li>
            
            
            ';
        }   while($row = mysql_fetch_array($result));     
    }

echo '</ul>';
	
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
	include("include/block-footer.php");
?>
</div>

</body>
</html>