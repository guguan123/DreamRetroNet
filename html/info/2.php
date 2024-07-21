
<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '联系我们';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
echo '<title>'.$title.'</title>';
echo '</head>'; 

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="'.$exit.'"></a>';

echo '<h1>'.$title.'</h1><a href="/"><img src="/favicon.ico" width="32" height="32" alt="'.$title2.'logo" /><h1>'.$title2.'</h1>';

include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';

echo '<div id="nav" class="container"><a href="/">首页</a>';
echo '<span>'.$title.'</span></div>';
echo '<main class="container"><div id="main">';

echo '<div class="article"><h1>'.$title.'</h1><div class="content"><p>Email：3475272270@qq.com</p>
<p><a href="https://wpa.qq.com/msgrd?v=3&uin=3475272270&site=qq&menu=yes">联系QQ：3475272270</a></p>
<p><a target="_blank" href="https://qm.qq.com/cgi-bin/qm/qr?k=jsbueNJbM-eR_qNaIouq9pNRgzr9BBWs&jump_from=webapi&authKey=YBadFpnnZ/z43lS2Xc4T8KqjpmtYM7tMh4ygNG4tNR8i9mTVEZYmyJR4RE6lSCF2"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="续梦网粉丝养老院" title="续梦网粉丝养老院"></a></p>
</div></div></div>';
include_once $_SERVER["DOCUMENT_ROOT"].'/info/top.php';

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';

?>