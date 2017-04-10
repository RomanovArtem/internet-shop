<?php
	defined('myshop') or die('Доступ запрещён!');
?>
<div class="block-header">
	<div class = "block-header-left">
		<h3>Board Komplekt. Панель управления</h3>
		<p class="navigation"> <?php echo $_SESSION['urlpage'] ?></p>
	</div>
	<div class="block-header-right">
		<p align="right"><a href="administrators.php">Администраторы</a> | <a href="?logout">Выход</a></p>
		<p align="right">Вы - <span>11</span></p>
	</div>
</div>

<div class="left-nav">
	<ul>
		<li><a href="orders.php">Заказы</a></li>
		<li><a href="products.php">Товары</a></li>
		<li><a href="reviews.php">Отзывы</a></li>
		<li><a href="category.php">Категории</a></li>
		<li><a href="clients.php">Клиенты</a></li>
		<li><a href="news.php">Новости</a></li>
	</ul>
</div>