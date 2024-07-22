<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '免责声明';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';


echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$title.'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav"><a href="/">首页</a><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';

echo '<div class="info bg-white">
<h1>免责声明</h1>
<div class="content"><p>
用户在访问本网站即视为已经阅读并同意本声明内容，续梦网上的所有游戏软件均来自互联网公开内容，仅供个人学习和研究使用，不得用于任何商业用途。如有侵犯您的商标权、著作权或其他合法权利，请联系我们并提供相关证明材料，本站将在第一时间对此进行核实并替换。</p><p>
访问续梦网的用户已经充分理解，除非另有说明，续梦网所提供下载的程序代码的版权归码农掌叔程序代码的合法拥有者所有，请用户在下载使用前必须详细阅读并遵守软件作者的“使用许可协议”。</p><p>
续梦网保证站内提供的所有可下载资源(软件等等)都是按照“原样”提供，并未对其做过任何改动。但续梦网不保证本站提供的下载资源的准确性、安全性和完整性。同时，续梦网也不承担用户因使用这些下载资源对自己和他人造成任何形式的损失或伤害。</p><p>
</div></div></div>';
include_once $_SERVER["DOCUMENT_ROOT"].'/info/top.php';

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';

?>