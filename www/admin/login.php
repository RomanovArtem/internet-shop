<?php
	session_start();
    define('myshop', true); // ���� ������� � ������
    include("include/db_connect.php");
    include("include/functions.php");
    
    if ($_POST["submit-enter"])
    {
        $login = clear_strings($_POST["input-login"]);
        $password = clear_strings($_POST["input-pass"]);
        
        if ($login && $password)
        {
            $password = md5($password);
            $password = strrev($password);
            $password = strtolower("dqw3443kl".$password."sdad213123");
            
            $result = mysql_query("SELECT * FROM admins WHERE login = '$login' AND password = '$password'", $link);
        
            if (mysql_num_rows($result) >0 ) // ���� ����� ����� ���� , ��
            {
                $row = mysql_fetch_array($result);
                $_SESSION['auth_admin'] = 'yes_auth'; //� ������� ������ ���������� ����������� ����� ��� ���, ���� ��, �� �������������� �� ����� ������
                //�������� ���� �������������
                $_SESSION['admin_login'] = $row["login"];
                $_SESSION['id'] = $row["id"];
        // ���������
        $_SESSION['admin_role'] = $row["role"];
        // ����������
        // ������
        $_SESSION['view_orders'] = $row["view_orders"];
        $_SESSION['delete_orders'] = $row["delete_orders"];
        $_SESSION['accept_orders'] = $row["accept_orders"];
        // ������  
        $_SESSION['delete_products'] = $row["delete_products"];
        $_SESSION['add_products'] = $row["add_products"];
        $_SESSION['edit_products'] = $row["edit_products"];
        // ������
        $_SESSION['accept_reviews'] = $row["accept_reviews"];
        $_SESSION['delete_reviews'] = $row["delete_reviews"];    
        // �������
        $_SESSION['view_clients'] = $row["view_clients"];
        $_SESSION['delete_clients'] = $row["delete_clients"]; 
        // �������
        $_SESSION['add_news'] = $row["add_news"]; 
        $_SESSION['delete_news'] = $row["delete_news"];
        // ���������
        $_SESSION['add_category'] = $row["add_category"]; 
        $_SESSION['delete_category'] = $row["delete_category"];  
        // ��������������
        $_SESSION['view_admins'] = $row["view_admins"];
                
                header("Location: index.php");
            }
            else
            {
                $msgerror = "�������� ����� �(���) ������! ";
            }
        }
        else
        {
            $msgerror = "�������� ��� ����!";
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style-login.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    
	<title>������ ���������� - ����</title>
</head> 
<body>
<div class="block-pass-login">
<?php
	if ($msgerror)
    {
        echo '<p class = "msgerror">'.$msgerror.'</p>';
    }
?>

<div class="panel panel-info my-panel">
          <div class="panel-heading text-center">������ ����������</div>
          <div class="panel-body">
          <form method="post">
            <ul class="pass-login">
            <li><label>�����:</label><input type="text" class="form-control" name="input-login" /></li>
            <li><label>������:</label><input type="password" name="input-pass" /></li>
            </ul>
            <p align="right"><input type="submit" name="submit-enter" class="submit-enter btn btn-info text-center center-block" value="��������������" /></p>
          </form>
          </div>
        </div>



</div>


</body>
</html>