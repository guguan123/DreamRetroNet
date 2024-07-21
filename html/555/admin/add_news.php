<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Создание новости';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if($user['admin_level']>=3){ 

if(isset($_POST['add'])){
$text = filtr($_POST['text']);
$name = filtr($_POST['name']);		

if(mb_strlen($text) < '1' or mb_strlen($text) > '9900') $err = 'Текст либо менее 1 либо более 9900 символов';
if(mb_strlen($name) < '1' or mb_strlen($name) > '100') $err = 'Текст либо менее 1 либо более 100 символов';
if($err){ 
err($err);
}else{
$con->query("INSERT INTO `news` (`name`, `text`, `author`, `time`, `time_new`) VALUES ('".$name."', '".$text."', '".$user['id']."', '".time()."', '".time()."')");

header('Location: /news');

}
}


	echo '<div class="link"><center>
<form action="" method="POST">Название :</br><input type="text" name="name" value=""></br>Текст :</br><textarea name="text"></textarea><br/><input type="submit" name="add" value="Создать"></form></div>';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>