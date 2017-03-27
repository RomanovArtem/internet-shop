<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    define('myshop', true);
    include("../include/db_connect.php");
    
    $delete = mysql_query("DELETE FROM brands WHERE id = '{$_POST["id"]}'",$link); 
      if (!$delete) {
        echo 'no-delete';
      }
      else {
        echo 'delete';       
      }
}
?>
