<?php
 
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start(); 
        
    include("../include/db_connect.php");
    include("../functions/functions.php");

   $id = clear_strings($_POST["id"]);  
    $result = mysql_query("SELECT * FROM cart WHERE cart_user_id = '{$_SESSION['input_id']}' AND cart_id= '$id'", $link);
    
    if(mysql_num_rows($result) > 0)
    {
               
        $row = mysql_fetch_array($result);
        $newCount = (int)$_POST['count'];  
        if ($newCount > 0)
        {
            
            $update = mysql_query("UPDATE cart SET cart_count='$newCount' WHERE cart_id = '$id' AND cart_user_id = '{$_SESSION['input_id']}'", $link);
            echo $newCount;        
        }   
        else
        {
            echo $row["cart_count"]; 
        }     
                        
    }
 }
?>