<?php
if ($_POST["submit_news"]) {   
    if ($_POST["news_title"] == "" || $_POST["news_text"] == "") {
        $message = "<p class = 'form-error'>��������� ��� ����!</p>";
    }
    else {
        
       mysql_query("INSERT INTO news(title,text,date)
        VALUES(
            '".$_POST["news_title"]."',
            '".$_POST["news_text"]."',
            NOW()
        )",$link);
        
            $last_id = mysql_insert_id();
            include("actions/upload-image-news.php");
            unset($_POST["image-upload"]); // ������� ���� �� ��������
        
        $message = "<p class='form-success'>������� ���������!</p>";
    }
}
?>

