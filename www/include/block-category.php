<div id="block-category">
<div class="header-title">��������� �������</div>  

<ul>
<li><a><img src="/images/icon-search.png" id="board-image"/>���������</a>
<ul id="category-section">
<li><a href="view_brand.php?category=snowboard"><strong>��� ������</strong></a></li>


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

<li><a><img src="/images/icon-search.png" id="mounting-image"/>���������</a>
<ul id="category-section">
<li><a href="view_brand.php?category=mounting"><strong>��� ������</strong></a></li>
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
<li><a><img src="/images/icon-search.png" id="boots-image"/>�������</a>
<ul id="category-section">
<li><a href="view_brand.php?category=boot"><strong>��� ������</strong></a></li>
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