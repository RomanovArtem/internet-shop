<?php
$sort = clear_strings($_GET["sort"]);

switch ($sort) {
        case 'all-orders':
            $sort = "ORDER BY order_id DESC";
            $sortName = "�� � �� �";
            $sortCase = "all-orders";
            break;
            
        case 'confirmed':
            $sort = "WHERE order_confirmed ='yes' ORDER BY order_id DESC";
            $sortName = "������������";
            $sortCase = "confirmed";
            break;
            
        case 'no-confirmed':
            $sort = "WHERE order_confirmed ='no' ORDER BY order_id DESC";
            $sortName = "�� ������������";
            $sortCase = "no-confirmed";
            break;
        
        default: 
        $sort = "ORDER BY order_id DESC";
        $sortName = "�� � �� �";
        $sortCase = "all-orders";
        break;        
    }
?>