
<div id="block-header">

<div id="header-top-block">
<ul id="header-top-menu">

<li>��� ����� - <span>������</span></li> 
<li><a href="about-us.php">� ���</a></li>
<li><a href="shops.php">��������</a></li>
<li><a href="contacts.php">��������</a></li>

</ul>


<?php
	if($_SESSION['input'] == 'yes_input')
    {
        echo '<a id ="input-user-info" align="right"><img id = "img-user" src="/images/user.png"/> '.$_SESSION['input_surname'].' '.$_SESSION['input_name'].' <img id="img-logout" src="/images/user-out.png"/> </a>';
        
             
    }
    else
    {
        
        echo '<p id="input-registration" align="right"> <a class="input-button">����</a>  
                                          <a href="registration.php">�����������</a> </p> '; 
    }
?>

<div id="user-input">
<div id="corner"></div>

<form method="post" action="../include/entrance.php">

<ul id="input-email-pass">
<h3>����</h3>
<p id="message-input">�������� ����� �/��� ������</p>
<li><center><input type="text" id="input-login" placeholder="����� ��� Email"/></center></li>
<li><center><input type="password" id="input-pass" placeholder="������"/><span id="button-pass-show-hide" class="pass-hide"></span></center></li>   


<p align="right" id="button-input"><a>�����</a></p>

<p align="right" id="loading-input"><img src="/images/loading.gif"/></p>
</ul>


</form>

</div>

</div>

<div id="top-line"></div>


<a href="index.php"><img id="img-logo" src="/images/logo.png" /></a>

<div id="name">
<h1>��������-�������</h1> 
<h2>���������� ��� ���������</h2> </div>

<div id="personal-info">
<p align="right">������ ����������.</p> 
<h3 align="right">8 (800) 555-35-35</h3>

<img src="/images/phone-icon.png" />

<p align="right">����� ������</p>
<p align="right">������ ���: � 9:00 �� 18:00</p>
<p align="right">�������, ����������� - ��������</p>


<img src="/images/time-icon.png" />
</div>


</div>


<div id="top-menu">
<ul>
<li><img src="/images/shop.png"/><a href="index.php">�������</a></li>
<li><img src="/images/new.png"/><a href="">�������</a></li>
<li><img src="/images/bestprice.png"/><a href="">������ ������</a></li>
<li><img src="/images/sale.png"/><a href="">����������</a></li>
</ul>

<div align="right" id="block-basket"><img src="/images/basket.png" /><a href="cart.php?action=basketgoods">��� �������</a></div>
<div id="nav-line"></div>
</div>