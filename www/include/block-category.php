<div id="block-category">
<div class="header-title">Категории товаров</div>  

<ul>
<li><a><img src="/images/icon-search.png" id="board-image"/>Сноуборды</a>
<ul id="category-section">
<li><a href="view_brand.php?category=snowboard"><strong>Все модели</strong></a></li>


<?php
	$result = mysql_query("SELECT * FROM brands WHERE category='snowboard'", $link); 
    if (mysql_num_rows($result) >0) 
    {
        $row = mysql_fetch_array($result); 
        do
        {
            echo'
            <li><a href="view_brand.php?brand='.strtolower($row["brand"]).'&category='.$row["category"].'">'.$row["brand"].'</a></li>
            ';
        }   while($row = mysql_fetch_array($result));     
    }
?>
</ul>


</li>

<li><a><img src="/images/icon-search.png" id="mounting-image"/>Крепления</a>
<ul id="category-section">
<li><a href="view_brand.php?category=mounting"><strong>Все модели</strong></a></li>
<?php
	$result = mysql_query("SELECT * FROM brands WHERE category='mounting'", $link); 
    if (mysql_num_rows($result) >0) 
    {
        $row = mysql_fetch_array($result); #
        do
        {
            echo'
            <li><a href="view_brand.php?brand='.strtolower($row["brand"]).'&category='.$row["category"].'">'.$row["brand"].'</a></li>
            ';
        }   while($row = mysql_fetch_array($result));     
    }
?>
</ul>


</li>
<li><a><img src="/images/icon-search.png" id="boots-image"/>Ботинки</a>
<ul id="category-section">
<li><a href="view_brand.php?category=boot"><strong>Все модели</strong></a></li>
<?php
	$result = mysql_query("SELECT * FROM brands WHERE category='boot'", $link); 
    if (mysql_num_rows($result) >0) 
    {
        $row = mysql_fetch_array($result); 
        do
        {
            echo'
            <li><a href="view_brand.php?brand='.strtolower($row["brand"]).'&category='.$row["category"].'">'.$row["brand"].'</a></li>
            ';
        }   while($row = mysql_fetch_array($result));     
    }
?>
</ul>


</li>



</ul>





</div>