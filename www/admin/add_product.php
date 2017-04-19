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
		$_SESSION['urlpage'] = "<a href= 'index.php'>�������</a> \ <a href= 'product.php'>������</a>  \ <a>���������� ������</a>"; // � ������ �������� ������ ��� ������������� �������

		include("include/db_connect.php"); // ������������ � ��
        include("include/functions.php");
        include("include/checking_fields_add_product.php");	
  
?>	
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv ="content-type" content="text/html" />
	<link href ="css/reset.css" rel="stylesheet" type="text/css" />
	<link href ="css/style.css" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
    
	<title>������ ����������</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
	?>
	<div class="block-content">
		<div class = "block-parameters">
            <p class="title-page">���������� ������</p>
		</div>
        
         <?php
         if (isset($msgerror)) {
                echo '<p class="form-error" align="center">'.$msgerror.'</p>';
         }
         
	       if (isset($_SESSION['message'])) {
	           echo $_SESSION['message'];
               unset($_SESSION['message']);
	       }
        ?>
        
        <form enctype="multipart/form-data" method="post">
            <ul class="edit-product">
                <li>
                    <label>�������� ������</label>
                    <input type="text" name="form-title" />
                </li>
                
                <li>
                    <label>����</label>
                    <input type="text" name="form-price" />
                </li>
                
                <li>
                    <label>������� ��������</label>
                    <textarea name="form-seo-description"></textarea>
                </li>
                
                <li>
                    <label>������� ���-��</label>
                    <textarea name="form-seo-features"></textarea>
                </li> 
                
               <!--  <li>
                    <label>��� ������</label>
                    <select name="form-type" class="type" size="1">
                        <option value="snowboard">���������</option> 
                        <option value="mounting">���������</option>
                        <option value="boot">�������</option>   
                    </select>
                </li>  -->
                
                <li>
                    <label>������</label>
                    <select name="form-brand" size="10">
                        <?php
	                       $brand = mysql_query("SELECT * FROM brands", $link);
                           if(mysql_num_rows($brand) > 0)
                           {
                                $result_brand = mysql_fetch_array($brand);
                                do
                                {
                                    echo '
                                        <option value = "'.$result_brand["id"].'">'.$result_brand["category"].': '.$result_brand["brand"].'</option>
                                    ';
                                } while ($result_brand = mysql_fetch_array($brand));
                           }
                        ?>
                    </select>
                </li>
            </ul>
            <label class="label-image">�������� ��������</label>
            
            <div class="base-img">
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <input type="file" name="image-upload"/>
            </div>
            
            <h3 class="click-header">�������� ������</h3>
            <div class="div-editor1">
                <textarea id="editor1" name="txt1" cols="100" rows="20"></textarea>
                    <script type="text/javascript">
                        var ckeditor1 = CKEDITOR.replace( "editor1" );
                        AjexFileManager.init({
                            returnTo: "ckeditor",
                            editor: ckeditor1
                        });
                    </script>
            </div>
            
            <h3 class="click-header">�������������� ������</h3>
            <div class="div-editor2">
                <textarea id="editor2" name="txt2" cols="100" rows="20"></textarea>
                    <script>
                        var ckeditor1 = CKEDITOR.replace( "editor2" );
                        AjexFileManager.init({
                            returnTo: "ckeditor",
                            editor: ckeditor2
                        });
                    </script>
            </div>
            
            <h3 class="titleh3">��������� ������</h3>
            <ul class="checkbox">
                <li><input type="checkbox" name="visible" id="visible" /><label for="visible">�������� �����</label></li>
                <li><input type="checkbox" name="new" id="new" /><label for="new">����� �����</label></li>
                <li><input type="checkbox" name="leader" id="leader" /><label for="leader">���������� �����</label></li>
                <li><input type="checkbox" name="sale" id="sale" /><label for="sale">����� �� �������</label></li>
            </ul>
            
            <p align="right"><input type="submit" class="submit-form" name="submit_add" value="�������� �����"/></p>
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
