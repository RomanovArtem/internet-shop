<?php
$id = clear_strings($_GET["id"]);
$action = $_GET["action"];
if(isset($action)) {
    switch ($action) {
        case 'accept':
            $update = mysql_query("UPDATE orders SET order_confirmed='yes' WHERE order_id='$id'", $link);
            break;
            
        case 'delete':
            $deleteBuyProducts = mysql_query("DELETE FROM buy_products WHERE buy_id_order = '$id'",$link);
            $deleteOrder = mysql_query("DELETE FROM orders WHERE order_id = '$id'",$link);
            header("Location: orders.php");
            break;
            
        default:
            break;
    }
}
?>