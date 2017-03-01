<?php
include("include/functions.php");

$category = $_GET["category"];
$brand = $_GET["brand"];

if (isset($category))
{
    switch ($category)
    {
        case 'all':
            $selectBrand = 'Все товары';
            $url = "category=all&";
            $category = "";
            break;
            
        case 'snowboards':
            $selectBrand = 'Сноуборды';
            $url = "category=snowboards&";
            $category = "WHERE brand_id IN (Select id FROM brands WHERE category='snowboard')";
            break;
            
        case 'mounting':
            $selectBrand = 'Крепления';
            $url = "category=mounting&";
            $category = "WHERE brand_id IN (Select id FROM brands WHERE category='mounting')";
            break;
            
        case 'boot':
            $selectBrand = 'Ботинки';
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
    $selectBrand = 'Все товары'; // переменная будет выводиться на экране
    $url = "";
    $category = "";
    
}
?>