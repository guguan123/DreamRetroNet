<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '友情链接';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
echo '<title>'.$title.'</title>';
echo '</head>'; 
echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="返回"></a>';

echo '<h1>'.$title.'</h1><a href="/"><img src="/favicon.ico" width="32" height="32" alt="'.$title2.'logo" /><h1>'.$title2.'</h1>';

include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';

echo '<div id="nav" class="container"><a href="/">首页</a>';
echo '<span>'.$title.'</span></div>';
echo '<main class="container"><div id="main">';
echo '<h2 class="topic bg-white"><a href="//wj.qq.com/s2/11590977/ffff/" class="right">加入友链</a>'.$title.'</h2>';
$w = $con->query("SELECT * FROM `link` ORDER BY `id` DESC");
echo '<ul class="list icon line games bg-white">';
while($b = $w->fetch_assoc()){
echo '<li><a href="'.$b['link'].'" class="clearfix">';
if ($b['src']){
echo '<img src="'.$b['src'].'" width="46" height="46" alt="图标" />';
}
echo '<strong>'.$b['name'].'</strong></li>';
}
echo '</div></div>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/foot.php';
