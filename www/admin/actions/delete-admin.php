<?php
include("./include/functions.php");

$id = clear_strings($_GET["id"]);
$action = $_GET["action"];
if(isset($action)) {
    switch ($action) {
        case 'delete':
            $delete = mysql_query("DELETE FROM admins WHERE id = '$id'",$link);
            break;
            
        default:
            break;
    }
}
?>