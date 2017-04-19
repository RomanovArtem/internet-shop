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
		$_SESSION['urlpage'] = "<a href= 'index.php'>�������</a>  \ <a href= 'category.php'>���������</a>"; // � ������ �������� ������ ��� ������������� �������

		include("include/db_connect.php"); // ������������ � ��
        include("actions/add-category.php");
?>	
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv ="content-type" content="text/html" />
	<link href ="css/reset.css" rel="stylesheet" type="text/css" />
	<link href ="css/style.css" rel="stylesheet" type="text/css" />
    
	<title>������ ���������� - ���������</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
	?>
	<div class="block-content">
		<div class = "block-parameters">
			<p class="title-page">���������</p>
		</div>
        <?php
	       if(isset($_SESSION['message'])) {
	           echo $_SESSION['message'];
               unset($_SESSION['message']);
	       }
        ?>
        
        <form method="post">
            <ul class="cat-product">
                <li>
                    <label>���������</label>
                    <div>
                        <a class="delete-cat">�������</a>
                    </div>
                    <select name="select-type" id="select-type" size="10">
                        <?php
	                   $result = mysql_query("SELECT * FROM brands ORDER BY category DESC", $link);
                       
                       if (mysql_num_rows($result) > 0) {
                        $row = mysql_fetch_array($result);
                        do {
                            echo '
                                 <option value = "'.$row["id"].'">'.$row["category"].': '.$row["brand"].'</option>';
                            } while ($row = mysql_fetch_array($result));
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <label>��� ������</label>
                    <input type="text" name="cat-type" />
                </li>
                <li>
                    <label>�����</label>
                    <input type="text" name="cat-brand" />
                </li>
            </ul>
            <p align="right"><input type="submit" class="submit-form" name="cat-submit" value="�������� ���������"/></p>
        </form>
	</div>
</div>

</body>
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script>
</html>
<?php 
	}
	else
	{
		header("Location: login.php");
	}
?>
