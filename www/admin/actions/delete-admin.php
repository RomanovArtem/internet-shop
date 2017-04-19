<?php
include("./include/functions.php");

$id = clear_strings($_GET["id"]);
$action = $_GET["action"];
if(isset($action)) {
    switch ($action) {
        case 'delete':
        if ($_SESSION['admin_login'] == 'admin') {
            $delete = mysql_query("DELETE FROM admins WHERE id = '$id'",$link);
            }
            else {
                $msgerror = 'У вас нет прав на удаление администраторов!';
            }
            break;
            
        default:
            break;
    }
}
?>