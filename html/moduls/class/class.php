<?php

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ


include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$bx = $con->query("SELECT * FROM `class` WHERE `id` = '".$id."'")->fetch_assoc();

if($bx){


$title = ''.$bx['name'].'';


}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

echo '<div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a>
<a href="/">
<img src="/favicon.ico" width="32" height="32" alt="续梦网logo" />';
echo '<h1>'.$title2.'</h1><p>续写怀旧游戏新篇章，重温旧梦</p></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$bx['name'].'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';


$msssa = $con->query("SELECT * FROM `class` WHERE `id` = '".$id."'");

while($ws = $msssa->fetch_assoc()){


//echo '<div class="margin_site_title_one"><span class="title">'.$ws['name'].'</span></div>';

}

$k_post = $con->query('SELECT * FROM `file` WHERE `id_raz` = "'.$id.'" AND `ivent` = 1')->num_rows;
	
$k_page = k_page($k_post,20);
	
$page = page($k_page);
	
$start = 20*$page-20;
		$ms = $con->query("SELECT * FROM `file` WHERE `id_raz` = '".$id."' AND `ivent` = 1 ORDER BY `id` DESC LIMIT $start, 20");

if($k_post  < 1) err('这里啥也没有！');

echo '<div class="block">';


echo '<ul class="list icon line games bg-white">';
while($w = $ms->fetch_assoc()){
echo '<li><a href="/file/'.$w['id'].'" class="clearfix"><img src="/icon/'.$w['id'].'" width="46" height="46" alt="图标" />';
if($name = $w['zhcn'] ?: $w['name']){
echo '<strong>'.$name.'</strong>';
}
echo '<span class="small-font">'.platform($w['platform']).'&nbsp;'.$w['downs'].'下载&nbsp;';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
echo ''.$number.'评论&nbsp;'.$bx['name'].'&nbsp</span></a></li>';
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></div>';
}
echo '</ul>';


echo '</div>';

if($k_post > '20') {  echo str('?',$k_page,$page.'');  }

//if($user['admin_level']>=2){
//echo '<a href="/add_file/'.$id.'"><button>上传文件</button></a>';
//}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>