<?php
if ($_POST["submit_news"]) { 
    if ($_SESSION['add_news'] == '1') {
    if ($_POST["news_title"] == "" || $_POST["news_text"] == "") {
        $message = "<p class = 'form-error'>��������� ��� ����!</p>";
    }
    else {
        
       mysql_query("INSERT INTO news(admin_id,title,text,date)
        VALUES(
            '".$_SESSION['id']."',
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
    else {
        $msgerror = '� ��� ��� ���� �� ���������� ��������!';
    }
}
?>

