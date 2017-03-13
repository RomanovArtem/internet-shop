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
		$_SESSION['urlpage'] = "<a href= 'index.php'>Главная</a> \ <a href= 'product.php'>Товары</a>  \ <a>Изменение товара</a>"; // в сессию помещаем ссылку для навигационной цепочки

		include("include/db_connect.php"); // подключаемся к бд
        include("include/functions.php");
        
        $id = clear_strings($_GET["id"]);
        
        include("include/checking_fields.php");	
  
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
            <p class="title-page">Изменение товара</p>
		</div>
        
        <?php 
            $result = mysql_query("SELECT * FROM table_products WHERE products_id='$id'", $link);
            if (mysql_num_rows($result) > 0)
            {
                $row = mysql_fetch_array($result);
                do
                {
                    echo '
                        <form enctype="multipart/form-data" method="post">
            <ul class="edit-product">
                <li>
                    <label>Название товара</label>
                    <input type="text" name="form-title" value="'.$row["title"].'" />
                </li>
                
                <li>
                    <label>Цена</label>
                    <input type="text" name="form-price" value="'.$row["price"].'" />
                </li>
                
                <li>
                    <label>Краткое описание</label>
                    <textarea name="form-seo-description">"'.$row["mini_description"].'"</textarea>
                </li>
                
                <li>
                    <label>Краткие хар-ки</label>
                    <textarea name="form-seo-features">"'.$row["mini_features"].'"</textarea>
                </li> 
                
                <li>
                    <label>Бренды</label>
                    <select name="form-brand" size="10">
                    ';
                
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
                           
                           echo'
                                 </select>
                </li>
            </ul>
            ';
            
            if (strlen($row["image"]) > 0 && file_exists("../upload_images/".$row["image"]))
            {
                $img_path = "../upload_images/".$row["image"];
                $max_width = 110;
                $max_height = 160;
                $width = 110;
                $height = 160;
            
            echo '
            <label class="label-image">Основная картинка</label>
            
            <div class="baseimg">
                <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
                <a href="editor_product.php?id='.$row["products_id"].'&img='.$row["image"].'&action=delete"></a>
            </div> 
            ';
            }
            else 
            {
              echo '   <label class="label-image">Основная картинка</label>
            
                <div class="base-img">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                    <input type="file" name="image-upload"/>
                </div> ';
            } 
                            
            echo '                                    
            
            <h3 class="click-header">Описание товара</h3>
            <div class="div-editor1">
                <textarea id="editor1" name="txt1" cols="100" rows="20">"'.$row["description"].'"</textarea>
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
                <textarea id="editor2" name="txt2" cols="100" rows="20">"'.$row["features"].'"</textarea>
                    <script>
                        var ckeditor1 = CKEDITOR.replace( "editor2" );
                        AjexFileManager.init({
                            returnTo: "ckeditor",
                            editor: ckeditor2
                        });
                    </script>
            </div>
            ';
            
            if ($row["visible"] == 1) $checked1 = "checked";
            if ($row["new"] == 1) $checked2 = "checked";
            if ($row["leader"] == 1) $checked3 = "checked";
            if ($row["sale"] == 1) $checked4 = "checked";
            
            echo '
            <h3 class="titleh3">Настройки товара</h3>
            <ul class="checkbox">
                <li><input type="checkbox" name="visible" id="visible" '.$checked1.' /><label for="visible">Показать товар</label></li>
                <li><input type="checkbox" name="new" id="new" '.$checked2.' /><label for="new">Новый товар</label></li>
                <li><input type="checkbox" name="leader" id="leader" '.$checked3.' /><label for="leader">Популярный товар</label></li>
                <li><input type="checkbox" name="sale" id="sale" '.$checked4.' /><label for="sale">Товар со скидкой</label></li>
            </ul>
            
            <p align="right"><input type="submit" class="submit-form" name="submit_save" value="Сохранить"/></p>
        </form>
                           ';
                           } while($row = mysql_fetch_array($result));
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
