<?php
include("./include/functions.php");

$id = clear_strings($_GET["id"]);
$action = $_GET["action"];
if(isset($action)) {
    switch ($action) {
        case 'delete':
        if ($_SESSION['delete_news'] == '1') {
            $delete = mysql_query("DELETE FROM news WHERE id = '$id'",$link);
        }
        else {
            $msgerror = 'У вас нет прав на удаление новостей!';
        }
            break;
            
        default:
            break;
    }
}
?>