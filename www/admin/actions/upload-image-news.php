<?php
defined('myshop') or die('������ ��������!');  
$error_img = array();

if($_FILES['image-upload']['error'] > 0) // �������� �� ������?
{
 //� ����������� �� ������ ������ ������� ��������������� ���������
 switch ($_FILES['image-upload']['error'])
 {
 case 1: $error_img[] =  '������ ����� ��������� ���������� �������� UPLOAD_MAX_FILE_SIZE'; break;
 case 2: $error_img[] =  '������ ����� ��������� ���������� �������� MAX_FILE_SIZE'; break;
 case 3: $error_img[] =  '�� ������� ��������� ����� �����'; break;
 case 4: $error_img[] =  '���� �� ��� ��������'; break;
 case 6: $error_img[] =  '����������� ��������� �����.'; break;
 case 7: $error_img[] =  '�� ������� �������� ���� �� ����.'; break;
 case 8: $error_img[] =  'PHP-���������� ���������� �������� �����.'; break;
 }

}else
{
//��������� ����������
if($_FILES['image-upload']['type'] == 'image/jpeg' || $_FILES['image-upload']['type'] == 'image/jpg' || $_FILES['image-upload']['type'] == 'image/png')
{ 

$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['image-upload']['name'])); //���������� ����������

    //����� ��� ��������
$uploaddir = '../news_images/';
//����� ��������������� ��� �����, ����� �� ���� ����������
$newfilename = 'news-img-'.$id.rand(1,100).'.'.$imgext;
//���� � ����� (�����.����)
$uploadfile = $uploaddir.$newfilename;
 
//��������� ���� move_uploaded_file
if (move_uploaded_file($_FILES['image-upload']['tmp_name'], $uploadfile))
{

  $update = mysql_query("UPDATE news SET image='$newfilename' WHERE id = '$last_id'",$link);   

}
else
{
 $error_img[] =  "������ �������� �����.";    
}
 

    
}else
{
 $error_img[] =  '���������� ����������: jpeg, jpg, png';
}
 

}


?>