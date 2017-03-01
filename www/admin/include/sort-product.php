<?php
include("include/functions.php");

$category = $_GET["category"];
$brand = $_GET["brand"];

if (isset($category))
{
    switch ($category)
    {
        case 'all':
            $selectBrand = '��� ������';
            $url = "category=all&";
            $category = "";
            break;
            
        case 'snowboards':
            $selectBrand = '���������';
            $url = "category=snowboards&";
            $category = "WHERE brand_id IN (Select id FROM brands WHERE category='snowboard')";
            break;
            
        case 'mounting':
            $selectBrand = '���������';
            $url = "category=mounting&";
            $category = "WHERE brand_id IN (Select id FROM brands WHERE category='mounting')";
            break;
            
        case 'boot':
            $selectBrand = '�������';
            $url = "category=boot&";
            $category = "WHERE brand_id IN (Select id FROM brands WHERE category='boot')";
            break;
        
        default: 
        $selectBrand = $brand;
        $url = "category=".clear_strings($category)."&brand=".clear_strings($brand)."&";
        $category = "WHERE brand_id IN (SELECT id FROM brands WHERE category='".clear_strings($category)."' AND brand = '".clear_strings($brand)."')";
        break;        
    }
}
else
{
    $selectBrand = '��� ������'; // ���������� ����� ���������� �� ������
    $url = "";
    $category = "";
    
}
?>