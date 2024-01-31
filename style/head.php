<?php
# Включаем сессии
ob_start();
#session_start();

if(!is_file($_SERVER["DOCUMENT_ROOT"].'/system/base.php')) {
header('Location: /install/');
}

//echo '
//<head><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
//<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
//<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=UTF-8" />
//<meta name="viewport" content="width=device-width; initial-scale=1.">
//<link rel="stylesheet" href="/style/style.css" type="text/css"/>
//<link rel="stylesheet" href="/style/reset.css" type="text/css"/>
//<link rel="stylesheet" href="/style/iconfont.css" type="text/css"/>

echo '
<?xml version="1.0"?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN">
<head><meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
<meta name="KeyWords" content="诺基亚,索尼爱立信,java游戏,怀旧游戏,功能机游戏,塞班游戏">
<meta name="description" content="续梦网，怀旧手机游戏爱好者的网上乐园。这里有诺基亚、索尼爱立信等塞班机或功能机平台上的怀旧游戏或应用。">
<link href="/style/reset.css" type="text/css" rel="stylesheet" media="screen" />
<link href="/style/style.css" type="text/css" rel="stylesheet" media="screen" />
<link href="/style/iconfont.css" type="text/css" rel="stylesheet" media="screen" />
<link href="/style/xzw1.css" type="text/css" rel="stylesheet" media="screen" />';



include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';





// ВРЕМЯ ГЕНЕРАЦИИ СКРИПТАЫ

$start_time = microtime();



$start_array = explode(" ",$start_time);


$start_time = $start_array[1] + $start_array[0]; 
//echo '<ion-view subpage-bar="true"></ion-view>';




if(!$title) $title = '续梦网：续写怀旧游戏新篇章，重温旧梦';
if(!$title2) $title2 = '续梦网';
echo '<title>'.$title.'</title>';
echo '</head><body>
';
//if(!$user){
//echo '<a href="/auth">登录</a>|<a href="/reg">注册</a>';
//}else{
//echo '<a href="/user">用户中心</a>';
//}
//echo '</div></div></div>';

//echo '<div id="">';
//echo '<body class="">';

//echo '<div class="menu_rms">';
