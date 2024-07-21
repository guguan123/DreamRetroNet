<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$b = $con->query("SELECT * FROM `news` WHERE `id` = '".$id."'")->fetch_assoc();

$title = 'Редактирование Новости '.$b['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `news` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_POST['add'])){
$text = filtr($_POST['text']);
$name = filtr($_POST['name']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '9900') $err = 'Текст либо менее 1 либо более 9900 символов';

if($err){ 
err($err);
}else{
$con->query("UPDATE `news` SET `text` = '".$text."', `name` = '".$name."' WHERE `id` = '".$id."'");
header('Location: news_'.$b['id']);
}
}

echo '<div class="link"><center>
<form action="" method="POST"><input type="text" name="name" value="'.$b['name'].'"><br/><textarea name="text">'.$b['text'].'</textarea><br/><input type="submit" name="add" value="Изменить"></form></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>