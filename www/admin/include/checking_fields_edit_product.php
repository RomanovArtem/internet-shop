<?php
if ($_POST["submit_save"]) 
    {
        $error = array();
        
        if (!$_POST["form-title"])
        {
            $error[] = "Укажите название товара";
        }
        if (!$_POST["form-price"])
        {
            $error[] = "Укажите цену товара";
        }
        if (!$_POST["form-seo-description"])
        {
            $error[] = "Укажите краткое описание товара";
        }
        if (!$_POST["form-seo-features"])
        {
            $error[] = "Укажите краткие характиристики товара";
        }
        if (!$_POST["txt1"])
        {
            $error[] = "Укажите описание товара";
        }
         if (!$_POST["txt2"])
        {
            $error[] = "Укажите характеристики товара";
        }
        
        if (!$_POST["form-brand"])
        {
            $error[] = "Выберите бренд товара";
        }
        else
        {
            $result = mysql_query("SELECT * FROM brands WHERE id='{$_POST["form-brand"]}'",$link);
            $row = mysql_fetch_array($result);
            $selectBrand = $row["brand"];
        }
        
        if ($_POST["visible"])
        {
            $visible = "1";
        } else { $visible = "0"; }
        
        if ($_POST["new"])
        {
            $new = "1";
        } else { $new = "0"; }
        
        if ($_POST["leader"])
        {
            $leader = "1";
        } else { $leader = "0"; }
        
        if ($_POST["sale"])
        {
            $sale = "1";
        } else { $sale = "0"; }
        
        
        if (count($error))
        {
            $_SESSION['message'] = "<p class='form-error'>".implode('<br />',$error)."</p>"; //из массива переводим в строки все ошибки и разделяем тегом br
        }
        else
        {
            $edit_product = "title='{$_POST["form-title"]}',price='{$_POST["form-price"]}',mini_description='{$_POST["form-seo-description"]}',mini_features='{$_POST["form-seo-features"]}',brand_id='{$_POST["form-brand"]}',description='{$_POST["txt1"]}',features='{$_POST["txt2"]}',visible='$visible',new='$new',leader='$leader',sale='$sale'";
           
            $update = mysql_query("UPDATE table_products SET $edit_product WHERE products_id = '$id'",$link); 

           

            
            $_SESSION['message'] = "<p class='form-success'>Товар успешно изменён!</p>";
            //$id = mysql_insert_id();
            
            if (empty($_POST["image-upload"]))  // существет поле или нет
            {
                include("actions/upload-image.php");
                unset($_POST["image-upload"]); // очищаем поле от картинки
            }
        }
        
    }
?>