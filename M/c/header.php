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
<!DOCTYPE html><html lang="zh-CN"><head><meta name="baidu_union_verify" content="817303602b8b959ac9f307e2b2cba853"><meta charset="utf-8" /><meta name="viewport" content="width=device-width" /><meta name="renderer" content="webkit" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><meta name="applicable-device" content="pc,mobile" />';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/head.php';
//echo '<link rel="manifest" href="/M/o/manifest.mf" /><link href="/M/c/reset.css" rel="stylesheet" /><link href="//at.alicdn.com/t/font_1755943_toyzzhojd.css" rel="stylesheet" /><link href="/M/c/jvzh.cn.css" rel="stylesheet" /><link href="/M/c/desktop.css" rel="stylesheet" media="screen and (min-width:641px)" /><link href="/M/c/phone.css" rel="stylesheet" media="screen and (max-width:640px)" /></head>';
echo '<link rel="manifest" href="/M/o/manifest.mf" /><link href="/M/c/desktop.css" rel="stylesheet" media="screen and (min-width:641px)"><link href="/M/c/phone.css" rel="stylesheet" media="screen and (max-width:640px)"><link href="/M/c/reset.css" type="text/css" rel="stylesheet" media="screen" /><link href="/style/iconfont.css" type="text/css" rel="stylesheet" media="screen" />';



include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';





// ВРЕМЯ ГЕНЕРАЦИИ СКРИПТАЫ

$start_time = microtime();



$start_array = explode(" ",$start_time);


$start_time = $start_array[1] + $start_array[0]; 
//echo '<ion-view subpage-bar="true"></ion-view>';


//if(!$title) $title = '续梦网';
//if(!$title2) $title2 = 'ContinuedMontenet';

uphold();
//if(!$user){
//echo '<a href="/auth">登录</a>|<a href="/reg">注册</a>';
//}else{
//echo '<a href="/user">用户中心</a>';
//}
//echo '</div></div></div>';

//echo '<div id="">';
//echo '<body>';

echo '';
?>


