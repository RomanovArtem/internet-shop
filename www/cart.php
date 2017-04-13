<?php
	include("include/db_connect.php");
    include("functions/functions.php");
    session_start();
    
    $id = clear_strings($_GET["id"]);
    $action = clear_strings($_GET["action"]);
    switch ($action)
    {
        case 'clear':
        $clear = mysql_query("DELETE FROM cart WHERE cart_user_id = '{$_SESSION['input_id']}'", $link);
        break;
        
        case 'delete':
        $clear = mysql_query("DELETE FROM cart WHERE cart_id = '$id' AND cart_user_id = '{$_SESSION['input_id']}' ", $link);
        break;
    }
    
    
     $result = mysql_query("SELECT * FROM cart, table_products WHERE cart.cart_user_id = '{$_SESSION['input_id']}' AND table_products.products_id = cart.cart_id_products", $link);
     if(mysql_num_rows($result) > 0)
       {
        $row = mysql_fetch_array($result);
        do
        {
            $totalPrice = $row["price"] * $row["cart_count"]; 
            $allPrice = $allPrice + $totalPrice;
        } while ($row = mysql_fetch_array($result));
        $totalPriceCart = $allPrice;
        $totalPrice = 0;
        $allPrice = 0;
        
       } 
       
       
       
       if (isset($_POST["submitData"]))
    {
        if ($_SESSION['input'] == 'yes_input')
        {
           
            
            mysql_query(" INSERT INTO `orders`(`id_buyer`, `order_datetime`, `order_delivery`, `order_total_price`, `order_note`, `order_pay`) 
        VALUES ('".$_SESSION['input_id']."', NOW(), '".$_POST["order_delivery"]."', '".$totalPriceCart."', '".$_POST["order_note"]."', 'accepted')", $link);
        
            
            $_SESSION["order_delivery"] = $_POST["order_delivery"];
            $_SESSION["order_note"] = $_POST["order_note"];
        
        
        
        $_SESSION["order_id"] = mysql_insert_id(); 
        
        $result = mysql_query("SELECT * FROM cart WHERE cart_user_id = '{$_SESSION['input_id']}'", $link);
        if (mysql_num_rows($result) > 0)
        {
            $row = mysql_fetch_array($result);
            
            do
            {
                  mysql_query(" INSERT INTO `buy_products`(`buy_id_order`, `buy_id_product`, `buy_count_product`) 
                VALUES ('".$_SESSION["order_id"]."', '".$row["cart_id_products"]."', '".$row["cart_count"]."')", $link);
        
            } while ($row = mysql_fetch_array($result));
             header("Location: cart.php?action=completion");
        }
        

        
      
        }
    }
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
    <title>Корзина заказов</title>  
</head>

<body>

<div id="block-body">
<?php
	include("include/block-header.php");
?>
<div id="block-content">
<?php
	$action = clear_strings($_GET["action"]);
    switch ($action) 
    {
        case 'basketgoods':
        if ($_SESSION['input'] == 'yes_input')
         {
        echo '
        <div id ="block-step">
        
        <div id ="name-step">
            <ul>
                <li><a class="active">Корзина заказов</a></li> <li><span>></span></li>
                <li><a>Оформление заказа</a></li> <li><span>></span></li>
                <li><a>Проверка информации</a></li>
            </ul>
        
        </div>
                <a href="cart.php?action=clear">Очистить корзину</a>
        
                </div>';
         }
        
         if ($_SESSION['input'] != 'yes_input')
        {
           echo '
           <p id = "message-delivery">Пожалуйста авторизуйтесь/зарегистрируйтесь</p>
           '; 
        }
        
        else{
        $result = mysql_query("SELECT * FROM cart, table_products WHERE cart.cart_user_id = '{$_SESSION['input_id']}' AND table_products.products_id = cart.cart_id_products", $link);
        if(mysql_num_rows($result) > 0)
        {
            $row = mysql_fetch_array($result);
            echo '
                <div id = "header-list-cart"> 
                    <div id = "head1">Изображение</div>
                    <div id = "head2">Наименование товара</div>
                    <div id = "head3">Количество</div>
                    <div id = "head4">Стоимость</div>
                </div>
            ';
        
        do
        {
            $totalPrice = $row["price"] * $row["cart_count"]; 
            $allPrice = $allPrice + $totalPrice;
            
             if ($row["image"] != "" && file_exists("./upload_images/".$row["image"])) 
            {
                $img_path = "./upload_images/".$row["image"];
                $max_width = 120;
                $max_height = 150;
                $width = 120;
                $height = 150;
            } 
            else
            {
                $img_path = "/images/no-image.png";
                $width = 120;
                $height = 150;
            }
            
        echo '
        <div class = "block-list-cart">
            <div class = "img-cart">
                <p align="center"><img src = "'.$img_path .'" width = "'.$width.'" height = "'.$height.'"/></p>
            </div>
            
            <div class = "title-cart">
                <p> <a href="view_content.php?id='.$row["products_id"].'" >'.$row["title"].'</a></p>
                
                <p class = "cart-mini-features">'.$row["mini_features"].'</p>
            </div>
        
            <div class = "count-cart">
                <ul class = "input-count">
                
                
                <li>
                    <p align = "center"><input id = "input-id'.$row["cart_id"].'" productCartID="'.$row["cart_id"].'" class = "count-input" maxlength = "3" type="text" value = "'.$row["cart_count"].'" /></p>
                </li>
                
               
                
                </ul>
            </div>
        
            <div id = "tovar'.$row["cart_id"].'" class = "price-product"><h5><span class="span-count">'.$row["cart_count"].'</span> x <span>'.$row["price"].'</span></h5><p price = "'.$row["price"].'" >'.$totalPrice.' руб</p></div>
            <div class = "delete-product"><a href ="cart.php?id='.$row["cart_id"].'&action=delete"><img src = "/images/product-del-hover.png"/></a></div>
            <div id = "bottom-cart-line"></div>
        </div>
        
        
        '; 
            
            
                        
        }
        while ($row = mysql_fetch_array($result));
        
        
        
        echo '
            <h2 class = "total-price" align = "right">Стоимость заказа: <strong>'.$allPrice.'</strong> руб </h2>
            <p align = "right" class = "button-next" ><a href = "cart.php?action=drawinguporder" >Далее</a></p>
        ';
        
        }
        else
        {
            
            echo '<h3 id = "clear-cart" align = "center">Корзина пуста</h3>';
        }
        }
        

        
        break;
        
        case 'drawinguporder':
        echo '
        <div id ="block-step">
        
        <div id ="name-step">
            <ul>
                <li><a href = "cart.php?action=basketgoods">Корзина товров</a></li> <li><span>></span></li>
                <li><a class="active">Оформление заказа</a></li> <li><span>></span></li>
                <li><a>Проверка информации</a></li>
            </ul>
        
        </div>
        
        </div>
        ';
        
       
        
        if ($_SESSION['input'] != 'yes_input')
        {
           echo '
           <p id = "message-delivery">Пожалуйста авторизуйтесь</p>
           '; 
        }
        else
        {
             $chck1 = "checked";
        if ($_SESSION['order_delivery'] == "По почте") $chck1 = "checked";
        if ($_SESSION['order_delivery'] == "Курьером") $chck2 = "checked";
        if ($_SESSION['order_delivery'] == "Самовывоз") $chck3 = "checked";
        
        echo '
        
        <h3 id = "title-delivery">Способы доставки: </h3>
        
        <form method = "post">
            <ul id = "info-delivery">
                <li>
                <input type = "radio" name = "order_delivery" class = "order_delivery" id = "order_delivery1" value = "По почте" '.$chck1.' />
                <label class = "label_delivery" for = "order_delivery1">По почте</label>
                </li>
                
                <li>
                <input type = "radio" name = "order_delivery" class = "order_delivery" id = "order_delivery2" value = "Курьером" '.$chck2.' />  
                <label class = "label_delivery" for = "order_delivery2">Курьером</label>
                </li>
                
                <li>
                <input type = "radio" name = "order_delivery" class = "order_delivery" id = "order_delivery3" value = "Самовывоз" '.$chck3.' /> 
                <label class = "label_delivery" for = "order_delivery3">Самовывоз</label>
                </li>
            </ul>
            '; 
            
            echo '
            <ul id = "info-order">
            <li><label class = "order_note_style" for = "order_note">Примечание</label><textarea name = "order_note" maxlength="70">'.$_SESSION["order_note"].'</textarea><span>Комментарий к заказу. <br /> Удобное время доставки <br /></span></li>
            <ul>
            <p align = "right"><input type = "submit" name = "submitData" id = "drawinguporder-button-next" value = "Далее" /></p>
        </form>
        ';    
            
            
        }
        
        break;
        
        case 'completion':
        echo '
        <div id ="block-step">
        
        <div id ="name-step">
            <ul>
                <li><a href = "cart.php?action=basketgoods">Корзина товаров</a></li> <li><span>></span></li>
                <li><a href = "cart.php?action=drawinguporder">Оформление заказа</a></li> <li><span>></span></li>
                <li><a class="active">Проверка информации</a></li>
            </ul>
        
        </div>
        
        </div>
        <h3 id = "final-info">Конечная информация: </h3>
        ';
        
         if ($_SESSION['input'] != 'yes_input')
        {
           echo '
           <p id = "message-delivery">Пожалуйста авторизуйтесь</p>
           '; 
        }
        else
        {
            echo'
                <ul id = "list-info">
                    <li><strong>ФИО: </strong>'.$_SESSION['input_surname'].' '.$_SESSION['input_name'].' '.$_SESSION['input_patronymic'].'</li>
                    <li><strong>Email: </strong>'.$_SESSION['input_email'].'</li>
                    <li><strong>Телефон: </strong>'.$_SESSION['input_phone'].'</li>
                    <li><strong>Адрес доставки: </strong>'.$_SESSION['input_address'].'</li>
                    <li><strong>Способ доставки: </strong>'.$_SESSION['order_delivery'].'</li>
                    
        
                    <li><strong>Примечание: </strong>'.$_SESSION['order_note'].'</li>                
                </ul>
            ';
            
            echo '
                <h2 id = "totalPriceCart" align = "right">Сумма к оплате: <strong>'.$totalPriceCart.'</strong> руб </h2>
                <p align = "right" id = "button-pay" ><a href = "index.php" >Оплатить</a></p>
                
            ';
        }
        
        break;
        
        default:
        echo '
        <div id ="block-step">
        
        <div id ="name-step">
            <ul>
                <li><a class="active">Корзина товаров</a></li> <li><span>></span></li>
                <li><a>Оформление заказа</a></li> <li><span>></span></li>
                <li><a>Проверка информации</a></li>
            </ul>
        
        </div>
        <a href="cart.php?action=clear">Очистить корзину</a>
        
        </div>
        ';
        
        
        
        
        $result = mysql_query("SELECT * FROM cart, table_products WHERE cart.cart_user_id = '{$_SESSION['input_id']}' AND table_products.products_id = cart.cart_id_products", $link);
        if(mysql_num_rows($result) > 0)
        {
            $row = mysql_fetch_array($result);
            echo '
                <div id = "header-list-cart"> 
                    <div id = "head1">Изображение</div>
                    <div id = "head2">Наименование товара</div>
                    <div id = "head3">Количество</div>
                    <div id = "head4">Стоимость</div>
                </div>
            ';
        
        do
        {
            $totalPrice = $row["price"] * $row["cart_count"]; 
            $allPrice = $allPrice + $totalPrice;
            
             if ($row["image"] != "" && file_exists("./upload_images/".$row["image"])) 
            {
                $img_path = "./upload_images/".$row["image"];
                $max_width = 120;
                $max_height = 150;
                $width = 120;
                $height = 150;
            } 
            else
            {
                $img_path = "/images/no-image.png";
                $width = 120;
                $height = 150;
            }
            
        echo '
        <div class = "block-list-cart">
            <div class = "img-cart">
                <p align="center"><img src = "'.$img_path .'" width = "'.$width.'" height = "'.$height.'"/></p>
            </div>
            
            <div class = "title-cart">
                <p><a href = "">'.$row["title"].'</a></p>
                <p class = "cart-mini-features">'.$row["mini_features"].'</p>
            </div>
        
            <div class = "count-cart">
                <ul class = "input-count">
                
                
                <li>
                    <p align = "center"><input id = "input-id'.$row["cart_id"].'" productCartID="'.$row["cart_id"].'" class = "count-input" maxlength = "3" type="text" value = "'.$row["cart_count"].'" /></p>
                </li>
                
               
                
                </ul>
            </div>
        
            <div id = "tovar'.$row["cart_id"].'" class = "price-product"><h5><span class="span-count">'.$row["cart_count"].'</span> x <span>'.$row["price"].'</span></h5><p price = "'.$row["price"].'" >'.$totalPrice.' руб</p></div>';
            $itogPrice = $totalPrice;
            echo '
            <div class = "delete-product"><a href ="cart.php?id='.$row["cart_id"].'&action=delete"><img src = "/images/product-del-hover.png"/></a></div>
            <div id = "bottom-cart-line"></div>
        </div>
        
        
        ';
            
            
                        
        }
        while ($row = mysql_fetch_array($result));
        
        
        echo '
            <h2 class = "total-price" align = "right">Стоимость заказа: <strong>'.$allPrice.'</strong> руб </h2>
            <p align = "right" class = "button-next" ><a href = "cart.php?action=drawinguporder" >Далее</a></p>
        ';
        
        }
        else
        {
            echo '<h3 id = "clear-cart" align = "center">Корзина пуста</h3>';
        }
        
        
        break;
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