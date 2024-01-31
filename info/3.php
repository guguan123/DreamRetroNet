<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '捐助网站';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';


echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$title.'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav"><a href="/">首页</a><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';

echo '<div class="info bg-white">
<h1>捐助网站</h1>
<div class="content"><p>为使网站健康、稳定、持续的为小伙伴们提供服务。仅凭我们一己之力难免有些捉襟见肘，因此希望有能力的好心人能够慷慨解囊。网站提供一种在线捐助方式。</p><p>
<img src="../M/o/weixin.png" alt="wechat" /></p><p>
<img src="../M/o/alipay.png" alt="alipay" /></p>
<p>
<img src="../M/o/qq.png" alt="qq" /></p>
</div></div></div>';
include_once $_SERVER["DOCUMENT_ROOT"].'/info/top.php';

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';

?>