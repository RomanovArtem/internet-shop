<?php
 
    $sorting = $_GET["sort"];
 
    switch($sorting)
    {
        case 'sort-ascending';
        $sorting = 'price ASC';
        $sort_name = '�� ������� � �������';
        $sortPage = 'sort-ascending';
        break;
        
        case 'sort-descending';
        $sorting = 'price DESC';
        $sort_name = '�� ������� � �������';
        $sortPage = 'sort-descending';
        break;
        
        case 'sort-popular';
        $sorting = 'views DESC';
        $sort_name = '����������';
        $sortPage = 'sort-popular';
        break;
        
        case 'sort-new';
        $sorting = 'datetime DESC';
        $sort_name = '�������';
        $sortPage = 'sort-new';
        break;
        
        case 'sort-alphabetically-ASC';
        $sorting = 'title ASC';
        $sort_name = '�� � �� �';
        $sortPage = 'sort-alphabetically-ASC';
        break;
        
        case 'sort-alphabetically-DESC';
        $sorting = 'title DESC';
        $sort_name = '�� � �� �';
        $sortPage = 'sort-alphabetically-DESC';
        break;
        
        default:
        $sorting = 'products_id ASC';
        $sort_name = '��� ����������';
        $sortPage = 'products_id ASC';
        break;
    }
?>