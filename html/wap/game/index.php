<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$bx = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();
if($bx){
if($name = $bx['cn'] ?: $bx['name']){
$title = ''.$name.' - 续梦网';
//$description =  $descriptiongame;
//$keywords = $keywordsgame;
}
}

include_once $_SERVER["DOCUMENT_ROOT"].'/wap/M/c/header.php';

include_once $_SERVER["DOCUMENT_ROOT"] . '/wap/M/c/user.php';
//echo '<div id="middle">';

$b = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();
//$g = $con->query("SELECT * FROM `games` WHERE `id` = '".$id."'")->
//fetch_assoc();

$us = $con->query("SELECT * FROM `user` WHERE `id` = '".$x['id_user']."'")->
fetch_assoc();
if($b){
//$title = ''.$b['name'].'';

$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/download/'.$b['down'].'');

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

if($name = $b['cn'] ?: $b['name']){
echo '<br>'.$name.'';
}
//echo '<ul>';
echo '<br>类型:<a href="/games?category='.$b['raz'].'">'.$b['raz'].'</a> 容量:'.$size.'
<br>厂商:<a href="/games?vendor='.$b['author'].'">'.$b['author'].'</a>
<br>系统:<a href="/games?system='.$b['platform'].'">'.$b['platform'].'</a>
 语言:'.$b['zh'].'
<br>
 版本:'.$b['v'].'
 下载:'.$b['downs'].'';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
echo '<br>评论:'.$number.'';
$str=$b['format'];
$str=str_replace('.','',$str);
echo ' 分辨率:'.$b['dpi'].'
<br>单机联机:'.$b['DJ'].'
<br>简介:'.$b['text'].'
<br><img src="/image/download.gif" alt="图片"><a href="/package/'.$b['platform'].'/'.$b['id'].''.$b['format'].'">点击下载安装包</a>';
//echo '</ul>';
//echo '<ul>';

$mu = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$b['id']."' ORDER BY `id` ASC");

while($ms = $mu->fetch_assoc()){
echo '<br/><img src="/jietu/'.$ms['id'].'" width="100" height="100">';
}

echo '<br>评论';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
if ($number){
echo '<br><a href="/comment/'.$b['id'].'" class="right">'.$view.''.$number.'</a>';
}
if($user){
echo '<form action="/comment/'.$b['id'].'" method="post"><input type="text" name="text" maxlength="255" /> <input type="submit" name="add" value="提交" /></form>';
}else{
echo '<br><a href="/login">登录</a>后才能评论哦：）';
}
//($number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
//echo '<div class="margin_site_title_file"><span class="title"><a href="/comment/'.$b['id'].'">评论</a>'.$number.'</span></div>';
$comment = $con->query("SELECT * FROM `comment` WHERE `id_obmen` = '".$id."' ORDER BY `id` DESC LIMIT 5");
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
}
echo '</ul></div>';
 

}else{
	echo '<br>消息提示<br>你防问的游戏不存在';
	echo '<br><a href="#back">返回</a>';
}
if($user['id']==$b['id_user'] ?: $user['admin_level']>=3){
echo '<ul class="list icon small line bg-white margin-top"><li><a href="/app/edit/'.$b['id'].'">编辑</a></li></ul>';
echo'</div></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/wap/M/c/foot.php';
