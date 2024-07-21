<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Создание раздела обменника';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if($user['admin_level']>=3){ 

if(isset($_POST['add'])){
$name = filtr($_POST['name']);		

if(mb_strlen($name) < '1' or mb_strlen($name) > '200') $err = 'Название либо менее 1 либо более 200 символов';
if($err){ 
err($err);
}else{
$con->query("INSERT INTO `obmen_raz` (`name`) VALUES ('".$name."')");

header('Location: /obmen');

}
}


	echo '<div class="link"><center>
<form action="" method="POST">Название :</br><input type="text" name="name" value=""><br/><input type="submit" name="add" value="Создать"></form></div>';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>