<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '回复评论';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ




$b = $con->query("SELECT * FROM `comment` WHERE `id` = '".$id."'")->fetch_assoc();
$b_nick = $con->query("SELECT * FROM `user` WHERE `id` = '".$b['id_user']."'")->fetch_assoc();
if($b){

	if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '6400') $err = '评论应大于1小于6400';

if($err){ 
err($err);
}else{
$con->query("INSERT INTO `comment` (`text`, `id_obmen`, `id_user`, `time`) VALUES ('[b]".$b_nick['login']."[/b], ".$text."','".$b['id_obmen']."', '".$user['id']."', '".time()."')");	
$con->query("INSERT INTO `msg` SET `text` = '".$user['login']." 回复了你的评论在 [url=".$SITE."/comment/".$b['id_obmen']."]这里[/url]',`time` = '".time()."', `id_user` = '".$b_nick['id']."'");
header('Location: /comment/'.$b['id_obmen']);
}
	}

echo '<div class="cit">'.user($b['id_user']).'</br>
'.text($b['text']).'
</div>';
echo '<div class="link"></br><center>内容 : </br></br>
<form action="" method="POST"><textarea name="text"></textarea><br/><input type="submit" name="add" value="回复"></form></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>