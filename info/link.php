<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '友情链接';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';


echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="'.$exit.'"></a>';

echo '<h1>'.$title.'</h1><a href="/"><img src="/favicon.ico" width="32" height="32" alt="'.$title2.'logo" /><h1>'.$title2.'</h1>';

include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';

echo '<div id="nav" class="container"><a href="/">首页</a>';
echo '<span>'.$title.'</span></div>';
echo '<main class="container"><div id="main">';
echo '<ul class="list icon line games bg-white">';
echo '<li><a href="/" class="clearfix"><img src="/" width="46" height="46" alt="图标" />';
echo '<strong>小众网</strong></li>';
