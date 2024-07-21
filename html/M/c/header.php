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


include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';





// ВРЕМЯ ГЕНЕРАЦИИ СКРИПТАЫ

$start_time = microtime();



$start_array = explode(" ",$start_time);


$start_time = $start_array[1] + $start_array[0]; 
//echo '<ion-view subpage-bar="true"></ion-view>';


if(!$title) $title = '续梦网';
if(!$title1) $title1 = '-续梦网';
if(!$title2) $title2 = '续梦网 - 创新诺基亚时代';

uphold();
//if(!$user){
//echo '<a href="/auth">登录</a>|<a href="/reg">注册</a>';
//}else{
//echo '<a href="/user">用户中心</a>';
//}
//echo '</div></div></div>';

//echo '<div id="">';
//echo '<body>';

echo '
<!DOCTYPE html><html lang="zh-CN"><title>'.$title2.'</title><head><script charset="UTF-8" id="LA_COLLECT" src="//sdk.51.la/js-sdk-pro.min.js"></script>
<script>LA.init({id:"K3pGGiqjftaNJR8a",ck:"K3pGGiqjftaNJR8a"})</script>

    <meta name="baidu-site-verification" content="codeva-e7yvvUQbgz" />

<meta name="baidu_union_verify" content="64be92aa9453d32824667f5eeac1af2e">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width" />
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="applicable-device" content="pc,mobile" />
<meta itemprop="name" content="'.$title.'" />';
//include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/head.php';
//echo '<link rel="manifest" href="/M/o/manifest.mf" /><link href="/M/c/reset.css" rel="stylesheet" /><link href="//at.alicdn.com/t/font_1755943_toyzzhojd.css" rel="stylesheet" /><link href="/M/c/jvzh.cn.css" rel="stylesheet" /><link href="/M/c/desktop.css" rel="stylesheet" media="screen and (min-width:641px)" /><link href="/M/c/phone.css" rel="stylesheet" media="screen and (max-width:640px)" /></head>';
echo '<link rel="manifest" href="/M/o/manifest.mf" /><link href="/static/desktop.css" rel="stylesheet" media="screen and (min-width:641px)">
<link href="/static/phone.css" rel="stylesheet" media="screen and (max-width:640px)">
<link href="/static/reset.css" type="text/css" rel="stylesheet" media="screen" />
<link href="//at.alicdn.com/t/c/font_3171365_fq80qoaevpt.css" type="text/css" rel="stylesheet" media="screen" /></head>';
echo '<body><header><div><a href="/">'.$title.'</a></div><nav><a href="/">首页</a><a href="/games?order=download_num">游戏</a><a href="/games?system=symbian&amp;resolution=240%C3%97320&amp;order=cover">Symbian游戏</a><a href="/games?system=java&amp;resolution=240%C3%97320&amp;order=cover">JAVA游戏</a><a href="/games?system=mrp&amp;resolution=240%C3%97320&amp;order=cover">MRP游戏</a><a href="/search">搜索</a><a href="/games/upload">上传</a></nav><div>';
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ?"https://": "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//获取当前访问目录的域名
//  echo $url;
$urls = array($url);
$api = 'http://data.zz.baidu.com/urls?site=https://rmct.cn&token=RqOwXy45cVU0WdBm';
$ch = curl_init();
$options =  array(
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("n", $urls),
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
echo "<script>console.log('当前百度推送$result;')</script>";

?>


