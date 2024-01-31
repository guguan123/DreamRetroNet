<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '编辑评论';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=1){
$b = $con->query("SELECT * FROM `comment` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '6400') $err = 'Текст либо менее 1 либо более 6400 символов';

if($err){ 
err($err);
}else{
$con->query("UPDATE `comment` SET `text` = '".$text."' WHERE `id` = '".$id."'");
header('Location: /comment/'.$b['id_obmen']);
}
}

echo '<div class="link"><center>
<form action="" method="POST">
<textarea name="text">'.$b['text'].'</textarea><br/>
<input type="submit" name="add" value="更改"></form></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>