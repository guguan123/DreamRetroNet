<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Создание раздела форума';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if($user['admin_level']>=2){ 

if(isset($_POST['add'])){

$name = filtr($_POST['name']);		

if(mb_strlen($name) < '1' or mb_strlen($name) > '100') $err = 'Текст либо менее 1 либо более 100 символов';
if($err){ 
err($err);
}else{
$con->query("INSERT INTO `forum_razdel` (`name`) VALUES ('".$name."')");

ok('Успешно');

}
}


	echo '<div class="link"><center>
<form action="" method="POST">Название :</br><input type="text" name="name" value=""></br><input type="submit" name="add" value="Создать"></form></div>';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>