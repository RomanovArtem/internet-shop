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
		$_SESSION['urlpage'] = "<a href= 'index.php'>�������</a> \ <a href= 'clients.php'>�������</a>"; // � ������ �������� ������ ��� ������������� �������

		include("include/db_connect.php"); // ������������ � ��
        include("actions/delete-client.php");
        
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
			<p class="count-client">����� ��������: <b><?php echo $result_count;?></b></p>
		</div>
        
         <?php
         if (isset($msgerror)) {
                echo '<p class="form-error" align="center">'.$msgerror.'</p>';
         }
            if ($_SESSION['view_clients'] == '1') {
                $num = 6;//������� �������� ������� �� ��������
                $page = (int)$_GET['page']; // ����� ������� ��������
                
                $count = mysql_query("SELECT COUNT(*) FROM reg_user",$link); // ����� ���-�� ������� � ��
                
                $temp = mysql_fetch_array($count); // �������� �������
                
                $post = $temp[0]; // ����� ���-�� �������echo $post;
                    
                // ������� ������� �����
                $total = (($post - 1) / $num) + 1;
                $total = intval($total); // ���������� �� ������(� ������� �������)
                    
                $page = intval($page); //��� � ��������� ������ � ������ �������� ����� �������� � �����
                    
                if(empty($page) or $page <= 0) $page = 1;
                    if ($page > $total) $page = $total;
                
                //������, � ������ ������ ���� �������� �����
                    $start = $page * $num - $num;
            
                if($temp[0] > 0) // ���� ������ ����
                {
                    $result = mysql_query("SELECT * FROM reg_user ORDER BY user_id DESC LIMIT $start, $num", $link);
                    
                    if(mysql_num_rows($result) > 0)
                    {
                        $row = mysql_fetch_array($result);
                        do
                        {           
                            echo '
                            <div class="block-clients">

                            <p class="client-login"><b>'.$row["login"].'</b></p>  
                            <p class="client-fio">'.$row["surname"].' '.$row["name"].' '.$row["patronymic"].'</p>  
                            <p class="delete-client-links"><a class="delete" rel=clients.php?id='.$row["user_id"].'&action=delete>�������</a></p>
                            <ul>
                                <li><strong>E-Mail:</strong> '.$row["email"].'</li>
                                <li><strong>�����:</strong> '.$row["address"].'</li>
                                <li><strong>�������:</strong> '.$row["phone"].'</li>
                                <li><strong>IP:</strong> '.$row["ip"].'</li>
                                <li><strong>���� �����������:</strong> '.$row["datetime"].'</li>
                            </ul>
                            
                            </div>   
                            ';
                        } while ($row = mysql_fetch_array($result));
                    } 
                }
                
if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="clients.php?'.$url.'page='. ($page - 1) .'&sort='.$sort.'" />�����</a></li>';
 
if ($page != $total) $nextpage = '<li><a class="pstr-next" href="clients.php?'.$url.'page='. ($page + 1) .'&sort='.$sort.'"/>�����</a></li>';
 
// ������� ��� ��������� ������� � ����� �����, ���� ��� ����
if($page - 5 > 0) $page5left = '<li><a href="clients.php?'.$url.'page='. ($page - 5) .'&sort='.$sort.'">'. ($page - 5) .'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="clients.php?'.$url.'page='. ($page - 4) .'&sort='.$sort.'">'. ($page - 4) .'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="clients.php?'.$url.'page='. ($page - 3) .'&sort='.$sort.'">'. ($page - 3) .'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="clients.php?'.$url.'page='. ($page - 2) .'&sort='.$sort.'">'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="clients.php?'.$url.'page='. ($page - 1) .'&sort='.$sort.'">'. ($page - 1) .'</a></li>';
 
if($page + 5 <= $total) $page5right = '<li><a href="clients.php?'.$url.'page='. ($page + 5) .'&sort='.$sort.'">'. ($page + 5) .'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="clients.php?'.$url.'page='. ($page + 4) .'&sort='.$sort.'">'. ($page + 4) .'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="clients.php?'.$url.'page='. ($page + 3) .'&sort='.$sort.'">'. ($page + 3) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="clients.php?'.$url.'page='. ($page + 2) .'&sort='.$sort.'">'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="clients.php?'.$url.'page='. ($page + 1) .'&sort='.$sort.'">'. ($page + 1) .'</a></li>';
 
if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="clients.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
}else
{
    $strtotal = ""; 
}
            ?>
            <div class="footerfix"></div> <!-- ����� ��������� �� ���������� � �������� -->
            <?php
    if ($total > 1)
{
    echo '
    <center>
    <div class="pstrnav">
    <ul>   
    ';
    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='clients.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
    echo '
    </center>   
    </ul>
    </div>
    ';
} 
} 
else {
    echo '<p class = "form-error" align="center">� ��� ��� ���� �� �������� ������ ��������!</p>';
}
?>
        
        
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
