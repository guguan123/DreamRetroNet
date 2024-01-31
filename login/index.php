<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '登录';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
//百度登录
session_start();
require_once 'baidu/config.php';
$getcode_url = "http://openapi.baidu.com/oauth/2.0/authorize?response_type=code&amp;client_id=$api_key&amp;redirect_uri=$redirect_url&amp;state=baidu&amp;display=";
//
echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="'.$exit.'"></a>';
echo '<h1>'.$title.'</h1><a href="/"><img src="/favicon.ico" width="32" height="32" alt="'.$title2.'logo" /><h1>'.$title2.'</h1>';

include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';

echo '<div id="nav" class="container"><a href="/">首页</a>';
echo '<span>'.$title.'</span></div>';
echo '<main class="container"><div id="main"><div class="area"><ul id="login">';echo '<li><a href="###" data-href="'.$getcode_url.'" class="iconfont icon-baidu">baidu登录</a></li>
<li><a href="###" data-href="https://graph.qq.com/oauth2.0/authorize?response_type=code&amp;client_id=101951815&amp;redirect_uri=https%3A%2F%2Fjvzh.cn%2Flogin%2Fqq&amp;state=qq&amp;display=" class="iconfont icon-qq">QQ登录</a></li>';
echo '</ul><div><input type="checkbox" name="agreen" value="true" />&nbsp;同意&nbsp;<a href="/info/1" target="_blank">免责声明</a></div></div></main>';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>