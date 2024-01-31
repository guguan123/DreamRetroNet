<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$b = $con->query("SELECT * FROM `news` WHERE `id` = '".$id."'")->fetch_assoc(); 

$title = 'Новость : '.$b['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();

$coun_komm = $con->query('SELECT * FROM `komm_news` WHERE `id_news` = "'.$b['id'].'"')->num_rows;
if($b){

echo '<div class="news"><b>Название</b> : '.$b['name'].'<br>
'.text($b['text']).'<br>
<b>Автор :</b> '.user($b['author']).'</div>';
if($user['admin_level']>=2){
echo '<div class="link_news"><center><a href="/news_edit'.$b['id'].'">[Изменить]</a> <a href="/news_del'.$b['id'].'">[Удалить]</a></center></div>';
}
echo '<div class="link_news"><a href="/komm_news_'.$b['id'].'"><img src="/style/image/komm.png"> Комментарии ('.$coun_komm.')</a></div>';

}else{

	err('Ошибка');
}


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>