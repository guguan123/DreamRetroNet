<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$b = $con->query("SELECT * FROM `news` WHERE `id` = '".$id."'")->fetch_assoc();
$coun_komm = $con->query('SELECT * FROM `komm_news` WHERE `id_news` = "'.$b['id'].'"')->num_rows;

$title = 'Комментарии к новости : '.$b['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();


if($b){
if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '2400') $err = 'Текст либо менее 1 либо более 2400 символов';

if($err){ 
err($err);
}else{
$con->query("INSERT INTO `komm_news` (`text`, `id_news`, `id_author`) VALUES ('".$text."', '".$id."', '".$user['id']."')");	
header('Location: ?');
}
}

if(isset($_GET['del'])){
	if($user['admin_level']>=1){
	$id_k = abs(intval($_GET['id_k']));
$k = $con->query('SELECT * FROM `komm_news` WHERE `id` = "'.$id_k.'"')->fetch_assoc();
if($k){
$con->query("DELETE FROM `komm_news` WHERE `id` = '".$id_k."'");
header('Location: ?');
}
}

}

echo '<div class="other"><form action="" method="POST"><center><textarea name="text"></textarea><br/><input type="submit" name="add" value="Отправить"></form></center></div>';
if($coun_komm<1){err('Комментариев еще нет');}

$k_post = $con->query('SELECT * FROM `komm_news` WHERE `id_news` = "'.$id.'"')->num_rows;
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;
		$ms = $con->query("SELECT * FROM `komm_news` WHERE `id_news` = '".$id."' ORDER BY `id` DESC LIMIT $start, 10");

  while($w = $ms->fetch_assoc()){
  	if($user['id'] != $w['id_author']) {$ot = '<a href="/komm_news_otv'.$w['id'].'">[Ответить]</a>';}else{$ot = '';}
echo '<div class="komm_news">'.user($w['id_author']).'</br>
'.text($w['text']).'</br>'.$ot.'';
if($user['admin_level']>=1) echo '<a href="?del&id_k='.$w['id'].'"> [Удалить] </a> <a href="komm_news_edit'.$w['id'].'"> [Изменить] </a>';
echo '</div>';
  }

  if($k_post > '10') {  echo str('?',$k_page,$page.'');  }

}else{

	err('Ошибка');
}


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>