<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '管理员';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();
$num = $con->query('SELECT * FROM `file` WHERE `ivent` = 0')->num_rows;
if($user['admin_level']>=1){
if($user['admin_level']>=2) echo "<div class='link'><a href='/review'>审核列表($num)</a></div>";
if($user['admin_level']>=2) echo "<div class='link'><a href='/add_razdel_f'>创建论坛部分</a></div>";
if($user['admin_level']>=2) echo "<div class='link'><a href='/add_podrazdel_f'>创建论坛小节</a></div>";
if($user['admin_level']>=2) echo "<div class='link'><a href='/admin_settings'>网站设定</a></div>";
if($user['admin_level']>=2) echo "<div class='link'><a href='/add_msg'>创建杂志的邮件列表</a></div>";
if($user['admin_level']>=2) echo "<div class='link'><a href='/add_room'>创建聊天室</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/add_news'>创建新闻</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/add_class'>创建交换器部分</a></div>";

}else{

err('Ошибка доступа');

}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>