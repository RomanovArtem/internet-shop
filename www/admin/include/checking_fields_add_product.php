<?php
if ($_POST["submit_add"]) 
    {
        $error = array();
        
        if (!$_POST["form-title"])
        {
            $error[] = "������� �������� ������";
        }
        if (!$_POST["form-price"])
        {
            $error[] = "������� ���� ������";
        }
        if (!$_POST["form-seo-description"])
        {
            $error[] = "������� ������� �������� ������";
        }
        if (!$_POST["form-seo-features"])
        {
            $error[] = "������� ������� �������������� ������";
        }
        if (!$_POST["txt1"])
        {
            $error[] = "������� �������� ������";
        }
         if (!$_POST["txt2"])
        {
            $error[] = "������� �������������� ������";
        }
        
        if (!$_POST["form-brand"])
        {
            $error[] = "�������� ����� ������";
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
            $_SESSION['message'] = "<p class='form-error'>".implode('<br />',$error)."</p>"; //�� ������� ��������� � ������ ��� ������ � ��������� ����� br
        }
        else
        {
            mysql_query("INSERT INTO table_products(title,price,mini_description,mini_features,brand_id,description,features,visible,new,leader,sale,datetime)
            VALUES(
                '".$_POST["form-title"]."',
                '".$_POST["form-price"]."',
                '".$_POST["form-seo-description"]."',
                '".$_POST["form-seo-features"]."',
                '".$_POST["form-brand"]."',
                '".$_POST["txt1"]."',
                '".$_POST["txt2"]."',
                '".$visible."',
                '".$new."',
                '".$leader."',
                '".$sale."',
                '".date("Y-m-d G:i:s")."'              
            )",$link);
            
            $_SESSION['message'] = "<p class='form-success'>����� ������� ��������!</p>";
            $id = mysql_insert_id();
            
            if (empty($_POST["image-upload"]))  // ��������� ���� ��� ���
            {
                include("actions/upload-image.php");
                unset($_POST["image-upload"]); // ������� ���� �� ��������
            }
        }
        
    }
?>