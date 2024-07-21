
<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '联系我们';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';


echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$title.'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav"><a href="/">首页</a><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';

echo '<div class="info bg-white">
<h1>联系我们</h1>
<div class="content">
<p>电子邮件：3475272270@qq.com</p>
<p>QQ群：710970632</p>
</div></div></div>';
include_once $_SERVER["DOCUMENT_ROOT"].'/info/top.php';

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';

?>