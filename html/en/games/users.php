<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = ''.$user['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
echo strtr($str,"//","/");
echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$user['name'].'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$user['name'].'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';

$users_id = abs(intval($_GET['users_id'])); # ФИЛЬТР ГЕТ

$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$users_id."'")->fetch_assoc();

	//名字
	$key = filtr($_GET['key']);
$k_post = $con->query("SELECT * FROM `game` WHERE `id_user`={$use['id']}")->num_rows;
	
$k_page = k_page($k_post,20);
	
$page = page($k_page);
	
$start = 20*$page-20;
		$ms = $con->query("SELECT * FROM `game` WHERE `id_user` = '{$use['id']}' order by id DESC LIMIT $start, 20");

if($k_post  < 1) err('没有游戏！');

//echo '<span class="title">我上传的游戏</span>'.$key.'<div class="block">';
echo '<ul class="list icon line games bg-white">';
while($w = $ms->fetch_assoc()){

echo '<li><a href="/game/'.$w['id'].'" class="clearfix">
<img src="/M/i/'.$w['id'].'" width="46" height="46" alt="图标" />';
if($name = $w['cn'] ?: $w['name']){
echo '<strong>'.$name.'</strong>';
}
echo '<span class="small-font">'.$w['platform'].'&nbsp;'.$w['downs'].'下载&nbsp;';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$w['id'].'"')->num_rows;
echo ''.$number.'评论&nbsp;';
echo ''.$w['id_raz'].'</span></a></li>';
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></div>';
}

echo '</div>';

if($k_post > '20') {  echo str('?users_id='.$users_id.'&',$k_page,$page.'');  }


include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>