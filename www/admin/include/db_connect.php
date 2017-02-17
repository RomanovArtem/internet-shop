<?php
$db_host    ='localhost';
$db_user    ='admin';
$db_password    ='23357836';
$db_database    ='db_shop';

$link = mysql_connect($db_host, $db_user, $db_password);

mysql_select_db($db_database, $link) or die("Нет соедиения с БД".mysql_error());
mysql_query("SET names cp1251"); 

?>