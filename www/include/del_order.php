<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start(); 
    
    include("../include/db_connect.php");
    include("../functions/functions.php");
    
    
    mysql_query("DELETE FROM `cart` WHERE cart_user_id = '{$_SESSION['input_id']}'", $link);
    
    
    
        
 echo true; 
    
}

?>