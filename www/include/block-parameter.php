<div id="block-parameter">

<div class="header-title">Поиск по параметрам</div>
<p class="title-filter">Название</p>
<div id="block-search"> 
<form method="GET" action="search.php?query="> 

 
<input type="text" id="input-search" name="query" placeholder="Что ищем?" value="<?php echo $search; ?>"/> 
<center><input type="submit" id="button-search" value="Поиск"/></center> 

</form>   

</div>



<p class="title-filter">Стоимость</p>

<form method="GET" action="search_filter.php">

<div id="block-input-price">

<ul>
<li><p>от</p></li>
<li><input type="text" id="start-price" name="startPrice" placeholder="1000" value="<?php echo $startPrice; ?>" /></li> 
<li><p>до</p></li>
<li><input type="text" id="end-price" name="endPrice" placeholder="50000" value="<?php echo $endPrice; ?>" /></li>
<li><p>руб</p></li>
</ul>


</div>




<center><input type="submit" name="submit" id="button-param-search" value="Найти"/></center>

</form>

</div>