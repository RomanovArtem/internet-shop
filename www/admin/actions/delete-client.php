<?php
include("./include/functions.php");

$id = clear_strings($_GET["id"]);
$action = $_GET["action"];
if(isset($action)) {
    switch ($action) {
        case 'delete':
            $countOrder = mysql_query("SELECT COUNT(*) FROM orders WHERE id_buyer = '$id'",$link);
            $count = mysql_fetch_array($countOrder);
            //$deleteReviews = mysql_query("DELETE FROM reviews WHERE user_id = '$id'",$link);
            //$deleteClient = mysql_query("DELETE FROM reg_user WHERE user_id = '$id'",$link);
            echo("count" + $count[0]);
            if($count[0] > 0) { ?>
                <script type="text/javascript">
                    alert("Удаление невозможно!\nДанный пользователь имеет заказы.");
                </script>
            <?php }
            else {
                $deleteCart = mysql_query("DELETE FROM cart WHERE cart_user_id = '$id'",$link);
                $deleteReviews = mysql_query("DELETE FROM table_reviews WHERE user_id = '$id'",$link);
                $deleteClient = mysql_query("DELETE FROM reg_user WHERE user_id = '$id'",$link);
                ?>
                <script type="text/javascript">
                    alert("Пользователь, его корзина и отзывы удалены!");
                </script>
            <?php }
            break;
        default:
            break;
    }
}
?>
