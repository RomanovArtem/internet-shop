<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start(); 
    
    include("../include/db_connect.php");
    include("../functions/functions.php");

   $id = clear_strings($_POST["MyID"]);

    if ($_SESSION['input_id'] != 0)
    {

    $result = mysql_query("SELECT * FROM cart WHERE cart_user_id = '{$_SESSION['input_id']}' AND cart_id_products = '$id'", $link);
    
    if(mysql_num_rows($result) > 0)
    {
        $row = mysql_fetch_array($result);
        $newCount = $row["cart_count"] + 1;
        $update = mysql_query("UPDATE cart SET cart_count='$newCount' WHERE cart_user_id = '{$_SESSION['input_id']}' AND cart_id_products='$id'", $link);
    }
    else 
    {
        
        $result = mysql_query("SELECT * FROM table_products WHERE products_id = '$id'", $link);
        $row = mysql_fetch_array($result);
        
        mysql_query(" INSERT INTO `cart`(`cart_id_products`, `cart_count`, `cart_datetime`, `cart_user_id`) 
        VALUES ('".$row['products_id']."', '1', NOW(),'".$_SESSION['input_id']."')", $link);
        
    }
    echo true;
    }
    
    else 
    {
        echo false;
    }
}
?>