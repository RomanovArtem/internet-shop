<?php
	session_start();
	if ($_SESSION['auth_admin'] == "yes_auth") 
	{
		define('myshop', true); 

		if (isset($_GET["logout"]))
		{
			unset($_SESSION['auth_admin']); // ������� ������� auth_admin
			header("Location: login.php"); // �������������
		}
		$_SESSION['urlpage'] = "<a href= 'index.php'>�������</a> \ <a href= 'add_administrator.php'>��������� ��������������</a>"; // � ������ �������� ������ ��� ������������� �������

		include("include/db_connect.php"); // ������������ � ��
        
        $all_clients = mysql_query("SELECT * FROM reg_user", $link);
        $result_count = mysql_num_rows($all_clients)
?>	
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv ="content-type" content="text/html" />
	<link href ="css/reset.css" rel="stylesheet" type="text/css" />
	<link href ="css/style.css" rel="stylesheet" type="text/css" />
    <link href ="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script> 
    
	<title>������ ���������� - �������</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
	?>
	<div class="block-content">
		<div class = "block-parameters">
			<p class="title-page">���������� ��������������</p>
		</div>
        
        <form method="post" id="form-info">
            <ul class="info-admin">
                <li><label>�����</label><input type="text" name="admin_login" /></li>
                <li><label>������</label><input type="password" name="admin_pass" /></li>
                <li><label>���</label><input type="text" name="admin_fio" /></li>
                <li><label>���������</label><input type="text" name="admin_role" /></li>
                <li><label>E-mail</label><input type="email" name="admin_email" /></li>
                <li><label>�������</label><input type="tel" name="admin_email" /></li>
            </ul>
            
            <h3 class="title-privilege">����������</h3>
            <p class="link-privilege"><a id="select-all">������� ���</a> | <a id="remove-all">����� ���</a></p>
            
            <div class="block-privilege">
                <ul class="privilege">
                    <li><h3>������</h3></li>
                    <li>
                        <input type="checkbox" name="view_orders" id="view_orders" value="1" />
                        <label for="view_orders">�������� �������</label>
                    </li>
                    <li>
                        <input type="checkbox" name="accept_orders" id="accept_orders" value="1" />
                        <label for="accept_orders">��������� �������</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_orders" id="delete_orders" value="1" />
                        <label for="delete_orders">�������� �������</label>
                    </li>
                </ul>
                <ul class="privilege">
                    <li><h3>������</h3></li>
                    <li>
                        <input type="checkbox" name="add_products" id="add_products" value="1" />
                        <label for="add_products">���������� �������</label>
                    </li>
                    <li>
                        <input type="checkbox" name="edit_products" id="edit_products" value="1" />
                        <label for="edit_products">��������� �������</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_products" id="delete_products" value="1" />
                        <label for="delete_products">�������� �������</label>
                    </li>
                </ul>
                <ul class="privilege">
                    <li><h3>������</h3></li>
                    <li>
                        <input type="checkbox" name="accept_reviews" id="accept_reviews" value="1" />
                        <label for="accept_reviews">��������� �������</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_reviews" id="delete_reviews" value="1" />
                        <label for="delete_reviews">�������� �������</label>
                    </li>
                </ul>
            </div>
            
            <div class="block-privilege">
                <ul class="privilege">
                    <li><h3>�������</h3></li>
                    <li>
                        <input type="checkbox" name="view_clients" id="view_clients" value="1" />
                        <label for="view_clients">�������� ��������</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_clients" id="delete_clients" value="1" />
                        <label for="delete_clients">�������� ��������</label>
                    </li>
                </ul>
                <ul class="privilege">
                    <li><h3>�������</h3></li>
                    <li>
                        <input type="checkbox" name="add_news" id="add_news" value="1" />
                        <label for="add_news">���������� ��������</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_news" id="delete_news" value="1" />
                        <label for="delete_news">�������� ��������</label>
                    </li>
                </ul>
                <ul class="privilege">
                    <li><h3>���������</h3></li>
                    <li>
                        <input type="checkbox" name="add_category" id="add_category" value="1" />
                        <label for="add_category">���������� ���������</label>
                    </li>
                    <li>
                        <input type="checkbox" name="delete_category" id="delete_category" value="1" />
                        <label for="delete_category">�������� ���������</label>
                    </li>
                </ul>
            </div>
            
            <div class="block-privilege">
                <ul class="privilege">
                    <li><h3>��������������</h3></li>
                    <li>
                        <input type="checkbox" name="view_admins" id="view_admins" value="1" />
                        <label for="view_admins">�������� ���������������</label>
                    </li>
                </ul>
            </div>
            
            <p align="right"><input type="submit" class="submit-form" name="submit_add" value="��������"/></p>            
        </form>
	</div>
</div>
</body>
</html>
<?php 
	}
	else
	{
		header("Location: login.php");
	}
?>
