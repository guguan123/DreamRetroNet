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
<!DOCTYPE html><html lang="zh-CN">
<head><meta charset="utf-8" /><meta name="viewport" content="width=device-width" /><meta name="renderer" content="webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/head.php';
echo '<link href="/M/c/reset.css" rel="stylesheet" /><link href="/M/c/en.jvzh.cn.css" rel="stylesheet" /><link href="/M/c/desktop.css" rel="stylesheet" media="screen and (min-width:641px)" /><link href="/M/c/phone.css" rel="stylesheet" media="screen and (max-width:640px)" /><link rel="stylesheet" href="//at.alicdn.com/t/font_3181697_ujupqh2hd4.css"><link href="/M/c/en.css" rel="stylesheet" />';



include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';





// ВРЕМЯ ГЕНЕРАЦИИ СКРИПТАЫ

$start_time = microtime();



$start_array = explode(" ",$start_time);


$start_time = $start_array[1] + $start_array[0]; 
//echo '<ion-view subpage-bar="true"></ion-view>';




if(!$title) $title = 'ContinuedMontenet：Treasure the soon-to-be-lost feature machine JAVA game software';
if(!$title2) $title2 = 'ContinuedMontenet';
echo '<title>'.$title.'</title>';
echo '</head><body>
';
uphold();
//if(!$user){
//echo '<a href="/auth">登录</a>|<a href="/reg">注册</a>';
//}else{
//echo '<a href="/user">用户中心</a>';
//}
//echo '</div></div></div>';

//echo '<div id="">';
//echo '<body class="">';

//echo '<div class="menu_rms">';
?>
<style>
.icon {
  width:4.3rem;
  height: 4.3rem;
  /*padding: -1rem;*/
  vertical-align: -0.15em;
  fill: currentColor;
  overflow: hidden;
}
</style>
