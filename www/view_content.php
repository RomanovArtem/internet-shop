<?php
	include("include/db_connect.php");
    include("functions/functions.php");
    
    $id = clear_strings($_GET["id"]);
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

	<script type="text/javascript" src="/js/jquery.cookie.js"></script> 
    <title>Интернет-Магазин Сноубордов</title>  
</head>

<body>

<div id="block-body">
<?php
	include("include/block-header.php");
?>
<div id="block-content">

<?php
	$result = mysql_query("SELECT * FROM table_products WHERE products_id='$id' AND visible = '1'", $link); 
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
            
            
            echo '
                    <div id = "content-info">
                        <img src ="'.$img_path.'" width ="'.$width.'" height = "'.$height.'" />
                        <div id = "mini-description">
                            <p id = "content-title">'.$row["title"].'</p>
                            <a class = "add-cart" id = "add-cart-view" productID="'.$row["products_id"].'"></a>
                            <p id = "content-price">'.$row["price"].' руб</p>
                            <p id = "content-text"><span id = "auxiliary-word">Описание: </span> <br />'.$row["description"].'</p>
                            <p id = "content-text"><span id = "auxiliary-word">Технологии: </span> <br />'.$row["features"].'</p>
                        </div>
                    </div>            
            ';
            
             echo '
            <p id = "text-title">Отзывы: </p>
           <div class = "review">
            <a class = "write-send-review">Написать отзыв</a>
            <a class = "write-send-review1"><-Назад</a>
                
                
                ';
                
               
                $query_reviews = mysql_query("SELECT * FROM table_reviews, reg_user WHERE table_reviews.products_id = '$id' AND table_reviews.approved = '1' AND reg_user.user_id = table_reviews.user_id  ORDER BY date DESC", $link) ; 

                
                if (mysql_num_rows($query_reviews) > 0)
                {
                    $row_reviews = mysql_fetch_array($query_reviews);
                    do
                    {
                        echo '
                        
                        <div class = "block-reviews">
                            <p class = "author-date"><strong>'.$row_reviews["surname"].' '.$row_reviews["name"].'</strong> '.$row_reviews["date"].'</p>
                            <img src ="/images/plus.png" />
                            <p class = "text-review">'.$row_reviews["good_reviews"].'</p>
                    
                            <img src ="/images/minus.png" />
                            <p class = "text-review">'.$row_reviews["bad_reviews"].'</p>
                    
                            <p class = "text-comment">'.$row_reviews["comment"].'</p>
                
                        </div>';
                    } while ($row_reviews = mysql_fetch_array($query_reviews));
                }
                else
                {
                    echo '<p class = "title-no-info">Отзывов нет</p>';
                }
                
                echo '
            </div>
            
            
            <div id = "send-review">';
            if ($_SESSION['input'] == 'yes_input')
            {
                 echo '
                <p align = "right" id="title-review">Публикация отзыва</p>
                
                <ul>
                    <li><p id = "label-name" align = "right" ><span>Имя:</span> '.$_SESSION['input_surname'].' '.$_SESSION['input_name'].'</p></li>
                    <li><p align = "right"><label id = "label-good"> Достоинства <span>*</span></label><textarea id = "good_review" maxlength="100"></textarea></p></li>
                    <li><p align = "right"><label id = "label-bad"> Недостатки <span>*</span></label><textarea id = "bad_review" maxlength="100"></textarea></p></li>
                    <li><p align = "right"><label id = "label-comment"> Комментарий <span>*</span></label><textarea id = "comment_review" maxlength="100"></textarea></p></li>
                </ul>
                <p align = "right" id = "button-send-review" productID="'.$id.'" >Отправить</p>';
            }
             if ($_SESSION['input'] != 'yes_input')
            {
           echo '
           <p id = "message-delivery-comment">Пожалуйста авторизуйтесь/зарегистрируйтесь</p>
           '; 
            }
           echo ' </div>';
            
            
            
        
        
            
        }while($row = mysql_fetch_array($result));  
        
       
        
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
	include("include/block-footer.php");
?>
</div>

</body>
</html>