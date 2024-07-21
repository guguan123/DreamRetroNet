<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/wap/system/base.php';

include_once $_SERVER["DOCUMENT_ROOT"].'/wap/M/c/header.php';
$title = ''.$title2.'';
echo '<div class="header"><a href="/">'.$title2.'</a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/wap/M/c/user.php';
echo '<div class="wrapper"><ul>';
	//名字
	$key = filtr($_GET['system']);
$k_post = $con->query("SELECT * FROM `game` WHERE `platform` LIKE '%$key%'")->num_rows;
	
$k_page = k_page($k_post,20);
	
$page = page($k_page);
	
$start = 20*$page-20;
		$ms = $con->query("SELECT * FROM `game` WHERE `platform` LIKE '%$key%' order by id DESC LIMIT $start, 20");
		//$ms = $con->query("SELECT * FROM `file` WHERE `author` = '".$author."' ORDER BY `id` DESC LIMIT 10");

if($k_post  < 1) err('没有同厂游戏！');
//echo '<span class="title">同厂游戏</span>'.$key.'<div class="block">';
while($w = $ms->fetch_assoc()){
echo '<li><a href="/game/'.$w['id'].'"><img src="/M/i/'.$w['icon'].'" width="24" height="24" alt="图标" />';
if($name = $w['cn'] ?: $w['name']){
echo ''.$name.'</a>';
}
echo '</li>';
}
echo '</ul>';

if($k_post > '20') {  echo str('?system='.$system.'&',$k_page,$page.'');  }
//}

include_once $_SERVER["DOCUMENT_ROOT"].'/wap/M/c/foot.php';
?>