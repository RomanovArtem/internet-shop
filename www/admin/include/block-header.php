<?php
	defined('myshop') or die('������ ��������!');
?>
<div class="block-header">
	<div class = "block-header-left">
		<h3>Board Komplekt. ������ ����������</h3>
		<p class="navigation"> <?php echo $_SESSION['urlpage'] ?></p>
	</div>
	<div class="block-header-right">
		<p align="right"><a href="administrators.php">��������������</a> | <a href="?logout">�����</a></p>
		<p align="right">�� - <span>11</span></p>
	</div>
</div>

<div class="left-nav">
	<ul>
		<li><a href="orders.php">������</a></li>
		<li><a href="products.php">������</a></li>
		<li><a href="reviews.php">������</a></li>
		<li><a href="category.php">���������</a></li>
		<li><a href="clients.php">�������</a></li>
		<li><a href="news.php">�������</a></li>
	</ul>
</div>