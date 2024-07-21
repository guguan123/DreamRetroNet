<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Ответить на комментарий';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ




$b = $con->query("SELECT * FROM `komm_news` WHERE `id` = '".$id."'")->fetch_assoc();
$b_nick = $con->query("SELECT * FROM `user` WHERE `id` = '".$b['id_author']."'")->fetch_assoc();
if($b){

	if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '2400') $err = 'Текст либо менее 1 либо более 2400 символов';

if($err){ 
err($err);
}else{
$con->query("INSERT INTO `komm_news` (`text`, `id_news`, `id_author`) VALUES ('[b]".$b_nick['login']."[/b], ".$text."','".$b['id_news']."', '".$user['id']."')");	
$con->query("INSERT INTO `journal` SET `text` = '".$user['login']." прокомментировал вашу запись [url=".$SITE."/komm_news_".$b['id_news']."]в новости[/url]',`time` = '".time()."', `id_user` = '".$b_nick['id']."'");
header('Location: /komm_news_'.$b['id_news']);
}
	}

echo '<div class="cit">'.user($b['id_author']).'</br>
'.text($b['text']).'
</div>';
echo '<div class="link"></br><center>Ваш ответ : </br></br>
<form action="" method="POST"><textarea name="text"></textarea><br/><input type="submit" name="add" value="Отправить"></form></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>