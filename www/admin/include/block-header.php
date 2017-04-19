<?php
	defined('myshop') or die('Доступ запрещён!');
    
    $resultNoConfirmedOrders = mysql_query("SELECT * FROM orders WHERE order_confirmed='no'", $link);
    $countNoConfirmedOrders = mysql_num_rows($resultNoConfirmedOrders);
    
    if ($countNoConfirmedOrders > 0) {
        $count_str1 = '<p>+'.$countNoConfirmedOrders.'</p>';
    }
    else {
        $count_str1 = '';
    }
    
    $resultNoApprovedReviews = mysql_query("SELECT * FROM table_reviews WHERE approved='0'", $link);
    $countNoApprovedReviews = mysql_num_rows($resultNoApprovedReviews);
    
    if ($countNoApprovedReviews > 0) {
        $count_str2 = '<p>+'.$countNoApprovedReviews.'</p>';
    }
    else {
        $count_str2 = '';
    }
?>
<div class="block-header">
	<div class = "block-header-left">
		<h3>Board Komplekt. Панель управления</h3>
		<p class="navigation"> <?php echo $_SESSION['urlpage'] ?></p>
	</div>
	<div class="block-header-right">
		<p align="right"><a href="administrators.php">Администраторы</a> | <a href="?logout">Выход</a></p>
		<p align="right">Вы - <span><?php echo $_SESSION['admin_role']; ?></span></p>
	</div>
</div>

<div class="left-nav">
	<ul>
		<li><a href="orders.php">Заказы</a><?php echo $count_str1; ?></li>
		<li><a href="products.php">Товары</a></li>
		<li><a href="reviews.php">Отзывы</a><?php echo $count_str2; ?></li>
		<li><a href="category.php">Категории</a></li>
		<li><a href="clients.php">Клиенты</a></li>
		<li><a href="news.php">Новости</a></li>
	</ul>
</div>