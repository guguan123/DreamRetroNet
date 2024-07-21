<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'MD5';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/header.php';

echo '<a href="https://jvzh.cn/">Java应用商店</a> |&nbsp;
<a href="/admin/account?site_id=174022">设置</a>
&nbsp;<a href="/notification">消息<sup>0</sup></a>
<br>
<br>';
echo '<h1>'.$title.'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';

aut();
if(!isset($_GET['keyword'])){
echo '<div class="area"><form action="/admin/MD5.php" method="get" class="form"><div><input type="search" name="keyword" placeholder="." required="required" value="" autocomplete="off" /><input type="submit" value="加密" /></div></form>';
}else{
$b = md5($_GET['keyword']);
echo '加密结果';
echo $b;
}