<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$bx = $con->query("SELECT * FROM `theme` WHERE `id` = '".$id."'")->fetch_assoc();
if($bx){
if($name = $bx['name']){
$title = ''.$name.'';
}
}

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

if($name = $bx['name']){
echo '<div class="header">'.$name.'</a>';
}
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div class="wrapper"><div>';



$b = $con->query("SELECT * FROM `theme` WHERE `id` = '".$id."'")->fetch_assoc();
//$x = $con->query("SELECT * FROM `games` WHERE `id` = '".$id."'")->fetch_assoc();
//$g = $con->query("SELECT * FROM `games` WHERE `id` = '".$id."'")->
//fetch_assoc();

$us = $con->query("SELECT * FROM `user` WHERE `id` = '".$x['id_user']."'")->
fetch_assoc();
if($b){
if($b['id'] ->num_rows >0){
 echo '<body id="notice"><h2 class="topic">消息提示</h2><p>你防问的游戏不存在</p>';
echo '</p><p><a href="#back" class="button">返回</a></p>';
  exit;
}
$title = ''.$b['name'].'';

$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/download/'.$x['down'].'');

//echo '<div class="block"><div class="b_flex_down_l"><h1>'.$b['name'].'</h1>'; $msssa = $con->query("SELECT * FROM `class` WHERE `id` = '".$b['id_raz']."'"); while($wss = $msssa->fetch_assoc()){echo '<h2>'.$wss['name'].'</h2>';} echo '</div><div class="b_flex_down_r"><a href="/download/'.$b['id'].'"><button class="down">下载</button></a></div></div>';

//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$b['id']."' ORDER BY `id` ASC LIMIT 10");
//if($ms){
//echo "还没有游戏截图！";
//}else{
//while($w = $ms->fetch_assoc()){
//echo '<div class="carousel-cell"><img class="img_rms" src="/down/images/'.$w['url'].'"></div>';
//}
//}

//echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a><h1>'.$b['name'].'</h1>';
echo '<img src="/M/i/'.$b['id'].'.png" /><a href="/games?system='.$b['platform'].'">'.$b['platform'].'</a> | <a href="/games?category='.$b['id_raz'].'">'.$b['id_raz'].'</a> | <a href="/games?vendor='.$b['author'].'">'.$b['author'].'</a> | <span>'.$b['downs'].'下载</span>';
$number = $con->query('SELECT * FROM `comment_theme` WHERE `id_obmen` = "'.$id.'"')->num_rows;
echo ' | <span>'.$number.'评论</span></div>';

echo '<h2>下载：</h2><ul>';
//$files = $con->query("SELECT * FROM `games` WHERE `id_game` = '".$b['id']."' ORDER BY `id` DESC");

$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/download/'.$w['down'].'');
$list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
echo '<li><a href="/game/download/'.$x['id'].'">'.$x['dpi'].'</a>&nbsp;v' . getJarIniName($ftext, "MIDlet-Version") . '&nbsp;'.$size.'</li>';
}
echo '</ul>';
echo '<h2>';
$number = $con->query('SELECT * FROM `comment_theme` WHERE `id_obmen` = "'.$id.'"')->num_rows;
if ($number){
echo '<a href="/comment/'.$b['id'].'" class="right">查看'.$number.'条</a>';
}
echo '评论：</h2>';
if($user){
echo '<form action="/comments/'.$b['id'].'" method="post"><div><input type="text" name="text" maxlength="255" /><input type="submit" name="add" value="提交" /></div></form>';
}else{
echo '<div><a href="/login">登录</a>后才能评论哦：）</div><ul>';
}
//($number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
//echo '<div class="margin_site_title_file"><span class="title"><a href="/comment/'.$b['id'].'">评论</a>'.$number.'</span></div>';
$comment = $con->query("SELECT * FROM `theme_comment` WHERE `id_obmen` = '".$id."' ORDER BY `id` DESC LIMIT 5");
while($comm = $comment->fetch_assoc()){
echo '<li>'.user($comm['id_user']).''.text($comm['text']).'';
//}else{
//echo '<div class="quote small-font"><a href="/user/17173">'.user($comm['id_user']).'</a>：'.text($comm['text']).'</div>';
//}
echo '<em>'.data($comm['time']).'</em></li>';
//echo '<div class="small-font"><a href="/reply/'.$comm['id'].'" class="right">回复</a>'.data($comm['time']).'</div></div></li>';

//echo '<li class="clearfix"></a><div><p><a href="/info/'.$b['id_user'].'">'.user($comm['id_user']).'</a>：'.text($comm['text']).'</p>';
//}else{
//echo '<div class="quote small-font"><a href="/user/17173">'.user($comm['id_user']).'</a>：'.text($comm['text']).'</div>';
//}

//echo '<div class="margin_site_title_file"><span class="title_file">描述</span></div> '.text($b['text']).' 
//<div class="margin_site_title_file"><span class="title_file">信息</span></div>
//<b>上传者</b>: <a href="/info/'.$b['id_user'].'">'.$us['login'].'</a></br>
//<b>分辨率</b>:'.dpi($b['dpi']).'<br>';
//<b>平台</b>:'.platform($b['platform']).'<br>
//<b>格式</b>:  '.$b['format'].'<br> 
//<b>大小</b>: '.$size.' ';
//if($user['admin_level']>=2){
//echo '<div class="a_p"><a href="/file_del/'.$b['id'].'">删除</a> <a href="/file_edit/'.$b['id'].'">编辑</a> 
//<a href="/add_image/'.$b['id'].'">添加截图</a></div>';
//}
//$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
//echo '<div class="margin_site_title_file"><span class="title"><a href="/comment/'.$b['id'].'">评论</a>'.$number.'</span></div>';
//$comment = $con->query("SELECT * FROM `comment` WHERE `id_obmen` = '".$id."' ORDER BY `id` DESC LIMIT 5");
//while($comm = $comment->fetch_assoc()){
//if($user['id'] != $comm['id_user']) {$ot = '<a href="/reply/'.$comm['id'].'">[回复]</a>';}else{$ot = '';}
//echo '<div class="komm_news">'.user($comm['id_user']).' ('.data($comm['time']).')</br>
//'.text($comm['text']).'</br>'.$ot.'';
if($user['admin_level']>=1) echo '<a href="/comment/'.$comm['id'].'&del&id_k='.$comm['id'].'"> [删除] </a> <a href="/comment_edit/'.$comm['id'].'"> [编辑] </a>';
echo '</ul></div>';
 

}
if($user['id']==$b['id_user'] ?: $user['admin_level']>=3){
echo '<ul class="list icon small line bg-white margin-top"><li><a href="/game/edit/'.$b['id'].'">编辑此应用</a></li></ul>';
echo'</div></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
