<?php
	session_start();
	if ($_SESSION['auth_admin'] == "yes_auth") 
	{
		define('myshop', true); 

		if (isset($_GET["logout"]))
		{
			unset($_SESSION['auth_admin']); // удаляем сессиию auth_admin
			header("Location: login.php"); // пернаправляем
		}
		$_SESSION['urlpage'] = "<a href= 'index.php'>Главная</a> \ <a href= 'product.php'>Товары</a>  \ <a>Добавление товара</a>"; // в сессию помещаем ссылку для навигационной цепочки

		include("include/db_connect.php"); // подключаемся к бд
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
    
	<title>Панель управления</title>
</head>

<body>
<div class="block-body">
	<?php
		include("include/block-header.php"); 
	?>
	<div class="block-content">
		<div class = "block-parameters">
            <p class="title-page">Добавление товара</p>
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
                    <label>Название товара</label>
                    <input type="text" name="form-title" />
                </li>
                
                <li>
                    <label>Цена</label>
                    <input type="text" name="form-price" />
                </li>
                
                <li>
                    <label>Краткое описание</label>
                    <textarea name="form-seo-description"></textarea>
                </li>
                
                <li>
                    <label>Краткие хар-ки</label>
                    <textarea name="form-seo-features"></textarea>
                </li> 
                
               <!--  <li>
                    <label>Тип товара</label>
                    <select name="form-type" class="type" size="1">
                        <option value="snowboard">Сноуборды</option> 
                        <option value="mounting">Крепления</option>
                        <option value="boot">Ботинки</option>   
                    </select>
                </li>  -->
                
                <li>
                    <label>Бренды</label>
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
            <label class="label-image">Основная картинка</label>
            
            <div class="base-img">
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <input type="file" name="image-upload"/>
            </div>
            
            <h3 class="click-header">Описание товара</h3>
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
            
            <h3 class="click-header">Характеристики товара</h3>
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
            
            <h3 class="titleh3">Настройки товара</h3>
            <ul class="checkbox">
                <li><input type="checkbox" name="visible" id="visible" /><label for="visible">Показать товар</label></li>
                <li><input type="checkbox" name="new" id="new" /><label for="new">Новый товар</label></li>
                <li><input type="checkbox" name="leader" id="leader" /><label for="leader">Популярный товар</label></li>
                <li><input type="checkbox" name="sale" id="sale" /><label for="sale">Товар со скидкой</label></li>
            </ul>
            
            <p align="right"><input type="submit" class="submit-form" name="submit_add" value="Добавить товар"/></p>
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
