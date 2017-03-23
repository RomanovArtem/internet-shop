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
		$_SESSION['urlpage'] = "<a href= 'index.php'>�������</a> \ <a href= 'reviews.php'>������</a>"; // � ������ �������� ������ ��� ������������� �������

		include("include/db_connect.php"); // ������������ � ��
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
    
	<title>������ ���������� - ������</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
        $allCount = mysql_query("SELECT * FROM table_reviews", $link);
        $allCountResult = mysql_num_rows($allCount);
        
        $noAcceptCount = mysql_query("SELECT * FROM table_reviews WHERE approved = '0'", $link);
        $noAcceptCountResult = mysql_num_rows($noAcceptCount);
	?>
	<div class="block-content">
		<div class = "block-parameters">
            <ul class="list">
                <li>�����������:</li>
                <li><a class="select-brand" href="#"><? echo $selectBrand; ?></a>
                    <ul class="list-rew-sort">
                        <li><a href="reviews.php?sort=accept">�����������</a></li>
                        <li><a href="reviews.php?sort=no-accept">�� �����������</a></li>
                    </ul>
                </li>
            </ul>                                
		</div>
        <div class="block-info">
        <ul class="review-info-count">
            <li>����� �������: <strong><?php echo $allCountResult;?></strong></li>
            <li>�� �����������: <strong><?php echo $noAcceptCountResult;?></strong></li>
        </ul>
        </div>
        
     
        
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
