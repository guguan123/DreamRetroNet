<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc();
$f = $con->query("SELECT * FROM `file` WHERE `id_user` = '".$use['id']."'")->fetch_assoc();

$title = ''.$use['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$use['name'].'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$use['name'].'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';


$arr_pol = array('1' => '♂', '2' => '♀');
$arr_adm = array('0' => '用户', '1' => '版主', '2' => '管理员', '3' => '<font color="red">创始人</font>');



if($use){
//echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a><h1>'.$use['name'].'</h1><div id="user">'
$file = $con->query("SELECT * FROM `file` WHERE `id_user` = '".$id."' ORDER BY `id` DESC LIMIT 10");
if($use['id']==$f['id_user']){
echo '<h2 class="topic top-white"><a href="/user/file/'.$use['id'].'" class="right">更多</a>'.$use['name'].'上传的应用</h2>';
echo '<ul class="list icon line games bg-white c">';
while($u = $file->fetch_assoc()){
echo '<li><a href="/file/'.$u['id'].'" class="clearfix"><img src="/icon/'.$u['id'].'" width="46" height="46" alt="图标" />';
if($name = $u['zhcn'] ?: $u['name']){
echo '<strong>'.$name.'</strong>';
}
echo '<span class="small-font">'.platform($u['platform']).'&nbsp;'.$u['downs'].'下载&nbsp;';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$u['id'].'"')->num_rows;
echo ''.$number.'评论&nbsp;';
$msssa = $con->query("SELECT * FROM `class` WHERE `id` = '".$u['id_raz']."'"); 
while($wss = $msssa->fetch_assoc()){
echo ''.$wss['name'].'</span></a></li>';
}
}
}
//$uw = $con->query("SELECT * FROM `file` WHERE `id_user` = "'.$id.'" ORDER BY `id` DESC");
$uw = $con->query("SELECT * FROM `file` WHERE `id_user` = '".$id."' ORDER BY `id` DESC");
$uc = $con->query("SELECT * FROM `comment` WHERE `id_user` = '".$id."' ORDER BY `id` DESC");
$uv = $con->query("SELECT * FROM `files` WHERE `id_user` = '".$id."' ORDER BY `id` DESC");
echo '</div><div id="aside"><h2 class="topic">'.$use['name'].'</h2>';
echo '<ul class="list padding line bg-white c"><li>注册日期：'.data($use['data_reg']).'</li>';
echo '<li>上传应用：'.$uw->num_rows.'个</li>';
echo '<li>下载应用：'.$use['downs'].'个</li>';
echo '<li>应用列表：'.$uv->num_rows.'个</li>';
echo '<li>发布评论：'.$uc->num_rows.'条</li>';
echo '<li>封号大礼包：'.fh($use['fh']).'</li>';
echo '</ul></div></div>';
echo '<div class="link"><b>用户名</b> : '.$use['login'].'</div>';
echo '<div class="link"><b>昵称</b> : '.$use['name'].'</div>';
echo '<div class="link"><b>ID</b> : '.$use['id'].'</div>';
echo '<div class="link"><b>性别</b> : '.$arr_pol{$use['pol']}.'</div>';
echo '<div class="link"><b>注册时间</b> : '.data($use['data_reg']).'</div>';
echo '<div class="link"><b>用户等级</b> : '.$arr_adm{$use['admin_level']}.'</div>';
echo '<div class="link"><b>最近登录</b> : '.data($use['up_time']).'</div>';
}else{
err('Ошибка');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>