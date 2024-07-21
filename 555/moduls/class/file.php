<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$bx = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();
if($bx){

$title = ''.$bx['name'].' ';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';


$b = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();
$us = $con->query("SELECT * FROM `user` WHERE `id` = '".$b['id_user']."'")->fetch_assoc();
if($b){
if($b['ivent']==0){
  echo '该应用审核不通过！';
  include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
  exit;
}
$title = ''.$b['name'].'';

$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/down/files/'.$b['down'].'');

echo '<div class="block"><div class="b_flex_down_l"><h1>'.$b['name'].'</h1>'; $msssa = $con->query("SELECT * FROM `class` WHERE `id` = '".$b['id_raz']."'"); while($wss = $msssa->fetch_assoc()){echo '<h2>'.$wss['name'].'</h2>';} echo '</div><div class="b_flex_down_r"><a href="/download/'.$b['id'].'"><button class="down">下载</button></a></div></div>';

$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$b['id']."' ORDER BY `id` ASC LIMIT 10");
if($ms){
echo "还没有游戏截图！";
}else{
while($w = $ms->fetch_assoc()){
echo '<div class="carousel-cell"><img class="img_rms" src="/down/images/'.$w['url'].'"></div>';
}
}


echo '<div class="margin_site_title_file"><span class="title_file">描述</span></div> '.text($b['text']).' 
<div class="margin_site_title_file"><span class="title_file">信息</span></div> 
<b>上传者</b>: <a href="/info/'.$b['id_user'].'">'.$us['login'].'</a></br>
<b>分辨率</b>:'.dpi($b['dpi']).'<br>
<b>平台</b>:'.platform($b['platform']).'<br>
<b>格式</b>:  '.$b['format'].'<br> 
<b>大小</b>: '.$size.' ';
if($user['admin_level']>=2){
echo '<div class="a_p"><a href="/file_del/'.$b['id'].'">删除</a> <a href="/file_edit/'.$b['id'].'">编辑</a> 
<a href="/add_image/'.$b['id'].'">添加截图</a></div>';
}
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
echo '<div class="margin_site_title_file"><span class="title"><a href="/comment/'.$b['id'].'">评论</a>'.$number.'</span></div>';
$comment = $con->query("SELECT * FROM `comment` WHERE `id_obmen` = '".$id."' ORDER BY `id` DESC LIMIT 5");
while($comm = $comment->fetch_assoc()){
if($user['id'] != $comm['id_user']) {$ot = '<a href="/reply/'.$comm['id'].'">[回复]</a>';}else{$ot = '';}
echo '<div class="komm_news">'.user($comm['id_user']).' ('.data($comm['time']).')</br>
'.text($comm['text']).'</br>'.$ot.'';
if($user['admin_level']>=1) echo '<a href="/comment/'.$comm['id'].'&del&id_k='.$comm['id'].'"> [删除] </a> <a href="comment_edit/'.$comm['id'].'"> [编辑] </a>';
echo '</div>';
  }

echo '<div class="margin_site_title_file"><span class="title">类似的游戏</span></div><div class="block">';

$mds = $con->query("SELECT * FROM `file` WHERE id>= (SELECT floor(RAND() * (SELECT MAX(id) FROM file))) AND `id_raz` = '".$b['id_raz']."' AND `ivent` = 1 ORDER BY `id` DESC LIMIT 9");



while($aaw = $mds->fetch_assoc()){

echo '<div class="link_game"><a href="/file/'.$aaw['id'].'"> <div class="example3">
<img class="img_rms" src="/icon/'.$aaw['id'].'"> <div class="example_text"><h6>'.$aaw['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$aaw['downs'].' 次.</span></div></div></a></div>';
}
echo '</div>';
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
