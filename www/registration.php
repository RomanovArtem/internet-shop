<?php
	include("include/db_connect.php");
    include("functions/functions.php");
    session_start();    
?>
<!DOCTYPE HTML PUBLIC>
<html>

<head>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type= "image/x-icon">

	<meta http-equiv="content-type" content="text/html; charset=windows-1251" /> 
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
        
    <script type="text/javascript" src="/js/jquery-1.5.2.min.js"></script> 
    <script type="text/javascript" src="/js/jcarousellite-1.0.1.js"></script> 
    <script type="text/javascript" src="/js/shop-script.js"></script>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script> 
    <script type="text/javascript" src="/js/jquery.form.js"></script> 
    <script type="text/javascript" src="/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/js/input-check.js"></script>
    
    <title>Регистрация</title>  
</head>

<body>

<div id="block-body">
<?php
	include("include/block-header.php");
?>

<div id="block-content">

<h2 class="h2-title">Регистрация</h2>
<form method="post" id="form_reg" action="/reg/handler_reg.php">
<p id="reg_message"></p>
<div id="block-form-registration">
<ul id="form-registration">

<li>
<label>Логин</label>
<span class="star">*</span>
<input type="text" name="reg_login" id="reg_login"/>
</li>

<li>
<label>Пароль</label>
<span class="star">*</span>
<input type="text" name="reg_pass" id="reg_pass"/>

</li>

<li>
<label>Фамилия</label>
<span class="star">*</span>
<input type="text" placeholder="Иванов" name="reg_surname" id="reg_surname"/>
</li>

<li>
<label>Имя</label>
<span class="star">*</span>
<input type="text" placeholder="Иван" name="reg_name" id="reg_name"/>
</li>

<li>
<label>Отчество</label>
<span class="star">*</span>
<input type="text" placeholder="Иванович" name="reg_patronymic" id="reg_patronymic"/>
</li>

<li>
<label>Email</label>
<span class="star">*</span>
<input type="text" placeholder="Ivanov@mail.ru" name="reg_email" id="reg_email"/>
</li>

<li>
<label>Мобильный телефон</label>
<span class="star">*</span>
<input type="text" placeholder="89601234567" name="reg_phone" id="reg_phone"/>
</li>

<li>
<label>Адрес доставки</label>
<span class="star">*</span>
<input type="text" placeholder="г.Калуга, ул. Никитина, д.19" name="reg_address" id="reg_address"/>
</li>



</ul>
</div>

<p align="right"><input type="submit" name="form_submit" id="form_submit" value="Регистрация"/></p>

</form>



</div>
<div id="block-left">
<?php
	include("include/block-category.php");
    include("include/block-parameter.php");
    include("include/block-news.php");
?>


</div>
<?php
	include("include/block-footer.php");
?>
</div>

</body>
</html>