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
		$_SESSION['urlpage'] = "<a href= 'index.php'>�������</a>"; // � ������ �������� ������ ��� ������������� �������

		include("include/db_connect.php"); // ������������ � ��
?>	
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv ="content-type" content="text/html" />
	<link href ="css/reset.css" rel="stylesheet" type="text/css" />
	<link href ="css/style.css" rel="stylesheet" type="text/css" />
	<title>������ ����������</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
        
        $countOrders = mysql_query("SELECT * FROM orders", $link);
        $resultCountOrders = mysql_num_rows($countOrders);
        
        $countProducts = mysql_query("SELECT * FROM table_products", $link);
        $resultCountProducts = mysql_num_rows($countProducts);
        
        $countReviews = mysql_query("SELECT * FROM table_reviews", $link);
        $resultCountReviews = mysql_num_rows($countReviews);
        
        $countClients = mysql_query("SELECT * FROM reg_user", $link);
        $resultCountClients = mysql_num_rows($countClients);
	?>
	<div class="block-content">
		<div class = "block-parameters">
			<p class="title-page">����� ����������</p>
		</div>
        <ul class="general-stat">
            <li><p>�������: <b><?php echo $resultCountOrders?></b></p></li>
            <li><p>�������: <b><?php echo $resultCountProducts?></b></p></li>
            <li><p>�������: <b><?php echo $resultCountReviews?></b></p></li>
            <li><p>��������: <b><?php echo $resultCountClients?></b></p></li>
        </ul>
        
        <h3 class="title-stat">���������� ������</h3>
        
        <table align="center" cellpadding="10" width="100%">
            <tr>
                <th>�</th>
                <th>����</th>
                <th>�����</th>
                <th>����</th>
                <th>������</th>
            </tr>
            <?php
                $result = mysql_query("SELECT * FROM orders,buy_products WHERE orders.order_pay='accepted' AND orders.order_id=buy_products.buy_id_order", $link);
                if (mysql_num_rows($result) > 0) {
                    $row = mysql_fetch_array($result);
                do {
                    $index_count = $index_count + 1; 
                      $resultInfoProduct = mysql_query("SELECT * FROM table_products WHERE products_id='{$row["buy_id_product"]}'", $link);
                      if (mysql_num_rows($resultInfoProduct)) {
                        $rowInfoProduct = mysql_fetch_array($resultInfoProduct);
                      }
                      $stat_pay = "��������";
                    echo '
                    <tr>
                        <td align="center">'.$index_count.'</td>
                        <td align="center">'.$row["order_datetime"].'</td>
                        <td align="center">'.$rowInfoProduct["title"].'</td>
                        <td align="center">'.$rowInfoProduct["price"].'</td>
                        <td align="center">'.$stat_pay.'</td>
                    </tr>
                    ';                 
                } while ($row = mysql_fetch_array($result));
                }
                ?>
            
        </table>
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
