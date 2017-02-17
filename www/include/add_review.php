<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start(); 
    
    include("../include/db_connect.php");
    include("../functions/functions.php");
    
    $id = clear_strings($_POST['id']);
    $id_user = $_SESSION['input_id'];
    $good = iconv("UTF-8", "cp1251", clear_strings($_POST['good']));
    $bad = iconv("UTF-8", "cp1251", clear_strings($_POST['bad']));
    $comment = iconv("UTF-8", "cp1251", clear_strings($_POST['comment']));
    
    
    
    mysql_query(" INSERT INTO `table_reviews`(`products_id`, `user_id`, `good_reviews`, `bad_reviews`, `comment`, `date`) 
        VALUES ('".$id."', '".$id_user."', '".$good."', '".$bad."', '".$comment."', NOW())", $link);
        
  echo 'true';  
    
}

?>