<?php
defined('myshop') or die('Доступ запрещён!');  
$error_img = array();

if($_FILES['image-upload']['error'] > 0) // допущены ли ошибки?
{
 //в зависимости от номера ошибки выводим соответствующее сообщение
 switch ($_FILES['image-upload']['error'])
 {
 case 1: $error_img[] =  'Размер файла превышает допустимое значение UPLOAD_MAX_FILE_SIZE'; break;
 case 2: $error_img[] =  'Размер файла превышает допустимое значение MAX_FILE_SIZE'; break;
 case 3: $error_img[] =  'Не удалось загрузить часть файла'; break;
 case 4: $error_img[] =  'Файл не был загружен'; break;
 case 6: $error_img[] =  'Отсутствует временная папка.'; break;
 case 7: $error_img[] =  'Не удалось записать файл на диск.'; break;
 case 8: $error_img[] =  'PHP-расширение остановило загрузку файла.'; break;
 }

}else
{
//проверяем расширения
if($_FILES['image-upload']['type'] == 'image/jpeg' || $_FILES['image-upload']['type'] == 'image/jpg' || $_FILES['image-upload']['type'] == 'image/png')
{ 

$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['image-upload']['name'])); //определяем рамширение

    //папка для загрузки
$uploaddir = '../news_images/';
//новое сгенерированное имя файла, чтобы не было совпадений
$newfilename = 'news-img-'.$id.rand(1,100).'.'.$imgext;
//путь к файлу (папка.файл)
$uploadfile = $uploaddir.$newfilename;
 
//загружаем файл move_uploaded_file
if (move_uploaded_file($_FILES['image-upload']['tmp_name'], $uploadfile))
{

  $update = mysql_query("UPDATE news SET image='$newfilename' WHERE id = '$last_id'",$link);   

}
else
{
 $error_img[] =  "Ошибка загрузки файла.";    
}
 

    
}else
{
 $error_img[] =  'Допустимые расширения: jpeg, jpg, png';
}
 

}


?>