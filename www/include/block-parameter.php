<div id="block-parameter">

<div class="header-title">����� �� ����������</div>
<p class="title-filter">��������</p>
<div id="block-search"> 
<form method="GET" action="search.php?query="> 

 
<input type="text" id="input-search" name="query" placeholder="��� ����?" value="<?php echo $search; ?>"/> 
<center><input type="submit" id="button-search" value="�����"/></center> 

</form>   

</div>



<p class="title-filter">���������</p>

<form method="GET" action="search_filter.php">

<div id="block-input-price">

<ul>
<li><p>��</p></li>
<li><input type="text" id="start-price" name="startPrice" placeholder="1000" value="<?php echo $startPrice; ?>" /></li> 
<li><p>��</p></li>
<li><input type="text" id="end-price" name="endPrice" placeholder="50000" value="<?php echo $endPrice; ?>" /></li>
<li><p>���</p></li>
</ul>


</div>




<center><input type="submit" name="submit" id="button-param-search" value="�����"/></center>

</form>

</div>