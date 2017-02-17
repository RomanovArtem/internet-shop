<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();
    unset($_SESSION['input']);

    session_destroy();
    echo 'logout';
}

?>