<?php
$id = clear_strings($_GET["id"]);
$action = $_GET["action"];
if(isset($action)) {
    switch ($action) {
        case 'accept':
            if ($_SESSION['accept_orders'] == '1') {
                $update = mysql_query("UPDATE orders SET order_confirmed='yes' WHERE order_id='$id'", $link);
            }
            else {
                $msgerror = '” вас нет прав на подтверждение заказов!';
            }
            break;
            
        case 'delete':
            if ($_SESSION['delete_orders'] == '1') {
                $deleteBuyProducts = mysql_query("DELETE FROM buy_products WHERE buy_id_order = '$id'",$link);
                $deleteOrder = mysql_query("DELETE FROM orders WHERE order_id = '$id'",$link);
                header("Location: orders.php");
            } 
            else  {
                $msgerror = '” вас нет прав на удаление заказов!';
            }
            break;
            
        default:
            break;
    }
}
?>