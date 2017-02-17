<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start(); 
 
    
    include("../include/db_connect.php");
    include("../functions/functions.php");

   $id = clear_strings($_POST["id"]);  
   
   
            
 
    $result = mysql_query("SELECT * FROM cart, table_products WHERE cart.cart_user_id = '{$_SESSION['input_id']}' AND table_products.products_id = cart.cart_id_products", $link);
        
    
    if(mysql_num_rows($result) > 0)
       {
        $row = mysql_fetch_array($result);
        do
        {
            $totalPrice = $row["price"] * $row["cart_count"]; 
            $allPrice = $allPrice + $totalPrice;
        } while ($row = mysql_fetch_array($result));
        echo $allPrice;
        
       } 
 }
?>