<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Все новости';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();


$k_post = $con->query('SELECT * FROM `news`')->num_rows;

if($k_post == 0) err('Новостей еще нет');
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;
	
	$ms = $con->query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT $start, 10");
	

  while($w = $ms->fetch_assoc()){
  
$a = $w['text'];
$lenght = 250;
$be = mb_substr($a, 0, $lenght);
if (mb_strlen($a) > $lenght) {
    $be .= '...';
}



echo '<div class="news"><b>Название</b> : '.$w['name'].'<br>
'.bb_code(nl2br($be)).'<br>

<b>Автор :</b> '.user($w['author']).'</br><a href="/news_'.$w['id'].'">Подробнее...</a></div>';
  
  }

if($k_post > '10') {  echo str('?',$k_page,$page.'');  }


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>