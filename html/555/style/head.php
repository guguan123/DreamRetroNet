<?php
# Включаем сессии
ob_start();
#session_start();

if(!is_file($_SERVER["DOCUMENT_ROOT"].'/system/base.php')) {
header('Location: /install/');
}

echo '
<head><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.">
<link rel="stylesheet" href="/style/style.css" type="text/css"/>

</head>
';



include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';





// ВРЕМЯ ГЕНЕРАЦИИ СКРИПТАЫ

$start_time = microtime();



$start_array = explode(" ",$start_time);


$start_time = $start_array[1] + $start_array[0]; 



if(!$title) $title = '青回网：我的青春又回来了！';
echo '<title>'.$title.'</title>';
echo '<div class="head"><div id="body"><a href="/">青回网</a><div class="user"><a href="/class">分类</a></li>|<a href="/search">搜索</a></li>|<a href="/upload">上传</a></li>|';
if(!$user){
echo '<a href="/auth">登录</a>|<a href="/reg">注册</a>';
}else{
echo '<a href="/user">用户中心</a>';
}
echo '</div></div></div>';


echo '<div id="body"><div class="black"></div>';

echo '<div class="right_menu_site"><div class="menu_rms">';
