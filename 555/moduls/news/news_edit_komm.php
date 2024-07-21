<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Новость';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=1){
$b = $con->query("SELECT * FROM `komm_news` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '2400') $err = 'Текст либо менее 1 либо более 2400 символов';

if($err){ 
err($err);
}else{
$con->query("UPDATE `komm_news` SET `text` = '".$text."' WHERE `id` = '".$id."'");
header('Location: komm_news_'.$b['id_news']);
}
}

echo '<div class="link"><center>
<form action="" method="POST"><textarea name="text">'.$b['text'].'</textarea><br/><input type="submit" name="add" value="Изменить"></form></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>