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
		$_SESSION['urlpage'] = "<a href= 'index.php'>�������</a> \ <a href= 'news.php'>�������</a>"; // � ������ �������� ������ ��� ������������� �������

		include("include/db_connect.php"); // ������������ � ��
        include("actions/delete-news.php");
        include("actions/add-news.php");        
        
        $all_news = mysql_query("SELECT * FROM news", $link);
        $result_count = mysql_num_rows($all_news)
?>	
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv ="content-type" content="text/html" />
	<link href ="css/reset.css" rel="stylesheet" type="text/css" />
	<link href ="css/style.css" rel="stylesheet" type="text/css" />
    <link href ="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
    <link href="fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script> 
    <script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>    
<script type="text/javascript">
    $(document).ready(function(){
    $(".news").fancybox();  
});
</script>
 
    
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
            <p align="right" class="add-news"><a class="news" href="#news" >�������� �������</a></p>
		</div>
        <?php 
            if ($message != "") echo $message;
            
        ?>
        
         <?php
                $num = 6;//������� �������� ������� �� ��������
                $page = (int)$_GET['page']; // ����� ������� ��������
                
                $count = mysql_query("SELECT COUNT(*) FROM news",$link); // ����� ���-�� ������� � ��
                
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
                    $result = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT $start, $num", $link);
                    
                    if(mysql_num_rows($result) > 0)
                    {
                        $row = mysql_fetch_array($result);
                        do
                        {    
                            if(strlen($row["image"]) > 0 && file_exists("../news_images/".$row["image"]))
                            {
                                $img_path = "../news_images/".$row["image"];
                                $max_width = 160;
                                $max_height = 120;
                                $width = 160;
                                $height = 120;
                            } 
                            else
                            {
                                $img_path = "../../images/no-image.png";
                                $width = 160;
                                $height = 120;
                            }
                            
                            echo '
                            <div class="block-news">
                                <h3>'.$row["title"].'</h3>
                                <span>'.$row["date"].'</span>
                                <p>'.$row["text"].'</p>          
                                <img src = "'.$img_path.'" width = "'.$width.'" height = "'.$height.'" />                      
                                <p class="links-actions" align="right"><a class="delete" rel=news.php?id='.$row["id"].'&action=delete>�������</a></p> 
                            </div>
                            ';
                        } while ($row = mysql_fetch_array($result));
                    } 
                }
                
if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="news.php?'.$url.'page='. ($page - 1) .'&sort='.$sort.'" />�����</a></li>';
 
if ($page != $total) $nextpage = '<li><a class="pstr-next" href="news.php?'.$url.'page='. ($page + 1) .'&sort='.$sort.'"/>�����</a></li>';
 
// ������� ��� ��������� ������� � ����� �����, ���� ��� ����
if($page - 5 > 0) $page5left = '<li><a href="news.php?'.$url.'page='. ($page - 5) .'&sort='.$sort.'">'. ($page - 5) .'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="news.php?'.$url.'page='. ($page - 4) .'&sort='.$sort.'">'. ($page - 4) .'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="news.php?'.$url.'page='. ($page - 3) .'&sort='.$sort.'">'. ($page - 3) .'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="news.php?'.$url.'page='. ($page - 2) .'&sort='.$sort.'">'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="news.php?'.$url.'page='. ($page - 1) .'&sort='.$sort.'">'. ($page - 1) .'</a></li>';
 
if($page + 5 <= $total) $page5right = '<li><a href="news.php?'.$url.'page='. ($page + 5) .'&sort='.$sort.'">'. ($page + 5) .'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="news.php?'.$url.'page='. ($page + 4) .'&sort='.$sort.'">'. ($page + 4) .'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="news.php?'.$url.'page='. ($page + 3) .'&sort='.$sort.'">'. ($page + 3) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="news.php?'.$url.'page='. ($page + 2) .'&sort='.$sort.'">'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="news.php?'.$url.'page='. ($page + 1) .'&sort='.$sort.'">'. ($page + 1) .'</a></li>';
 
if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="news.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
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
    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='news.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
    echo '
    </center>   
    </ul>
    </div>
    ';
} 
?>
     <div id="news">
        <form method="post" enctype="multipart/form-data">
            <div class="block-input">
                <label>��������� <input type="text" name="news_title" id="news_title" /></label>
                <label>�������� <textarea name="news_text"></textarea></label>
                <label>�������� ��������</label>
                <div class="base-img-news">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                    <input type="file" name="image-upload"/>
                </div>  
            </div>
            <p align="right">
                <input type="submit" name="submit_news" class="submit_news" value="��������" />
            </p>
        </form>
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
