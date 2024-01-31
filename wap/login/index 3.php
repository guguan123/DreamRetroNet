<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc();
$f = $con->query("SELECT * FROM `game` WHERE `id_user` = '".$use['id']."'")->fetch_assoc();
if($name = $use['name'] ?: $use['login']){
$title = ''.$name.'';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/wap/M/c/header.php';

echo '<div class="header"><a href="/">';
echo ''.$title.'</a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/wap/M/c/user.php';
echo '<div class="wrapper">';


$arr_pol = array('1' => '♂', '2' => '♀');
$arr_adm = array('0' => '用户', '1' => '版主', '2' => '管理员', '3' => '<font color="red">创始人</font>');

if($use['up_time']+300 > time()){
$on_off = '在线'; 
}else{
$on_off = '离线'; 
}


if($use){
//echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a><h1>'.$use['name'].'</h1><div id="user">'
$file = $con->query("SELECT * FROM `game` WHERE `id_user` = '".$id."' ORDER BY `id` DESC LIMIT 10");
if($use['id']==$f['id_user']){
if($name = $use['name'] ?: $use['login']){
echo '<h2 class="topic top-white"><a href="/games/1?users_id='.$use['id'].'" class="right">更多</a>'.$name.'上传的应用</h2>';
}
echo '<ul class="list icon line line2 games bg-white c">';
while($u = $file->fetch_assoc()){
echo '<li><a href="/game/'.$u['id'].'" class="clearfix"><img src="/M/i/'.$u['id'].'" width="46" height="46" alt="图标" />';
if($name = $u['cn'] ?: $u['name']){
echo '<strong>'.$name.'</strong>';
}
echo '<span class="small-font">'.$u['platform'].'&nbsp;'.$u['downs'].'下载&nbsp;';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$u['id'].'"')->num_rows;
echo ''.$number.'评论&nbsp;'.$u['id_raz'].'</span></a></li>';
}
}
$dow = $con->query("SELECT * FROM `game` ORDER BY `id` DESC");
if($name = $use['name'] ?: $use['login']){
echo '<h2 class="topic top-white">'.$name.'最近在玩</h2>';
}
echo '<ul class="list icon line line2 games bg-white c">';
while($do = $dow->fetch_assoc()){
$down = $con->query("SELECT * FROM `game_download` WHERE `game_id` = '".$do['id']."' AND `user_id` = '".$id."' ORDER BY `id` DESC LIMIT 10");
while($download = $down->fetch_assoc()){
echo '<li><a href="/game/'.$download['game_id'].'" class="clearfix"><img src="/M/i/'.$download['game_id'].'" width="46" height="46" alt="图标" />';
if($name = $do['cn'] ?: $do['name']){
echo '<strong>'.$name.'</strong>';
}
echo '<span class="small-font">'.$do['platform'].'&nbsp;'.$do['downs'].'下载&nbsp;';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$do['id'].'"')->num_rows;
echo ''.$number.'评论&nbsp;'.$do['id_raz'].'</span></a></li>';
}
}
//$uw = $con->query("SELECT * FROM `file` WHERE `id_user` = "'.$id.'" ORDER BY `id` DESC");
$uw = $con->query("SELECT * FROM `game` WHERE `id_user` = '".$id."' ORDER BY `id` DESC");
$uc = $con->query("SELECT * FROM `comment` WHERE `id_user` = '".$id."' ORDER BY `id` DESC");
$uv = $con->query("SELECT * FROM `games` WHERE `id_user` = '".$id."' ORDER BY `id` DESC");
if($name = $use['name'] ?: $use['login']){
echo '</div><div id="aside"><h2 class="topic top-white">'.$name.'</h2>';
}
echo '<ul class="list padding line bg-white c">
<li>UID：'.$use['id'].'</li>';
echo '<li>在线状态：'.$on_off.'</li>';
echo '<li>注册日期：'.data($use['data_reg']).'</li>';
echo '<li>上传游戏：'.$uw->num_rows.'个</li>';
echo '<li>下载游戏：'.$use['downs'].'个</li>';
echo '<li>游戏列表：'.$uv->num_rows.'个</li>';
echo '<li>发布评论：'.$uc->num_rows.'条</li>';
echo '<li>封号大礼包：'.fh($use['fh']).'</li>';
echo '</ul>';
if($user['id']==$use['id']){
echo '<h2 class="topic top-white">功能</h2>';
echo '<ul class="list padding line bg-white c"><li><a href="/games/upload" >上传游戏</li>';
echo '<li><a href="/user/edit" >修改资料</li>';
echo '<li><a href="/user/edit/pic" >修改头像</li>';
echo '<li><a href="/user/edit/password" >修改密码</li>';
echo '<li><a href="/user/logout" >注销登录</li>';
}
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
include_once $_SERVER["DOCUMENT_ROOT"].'/wap/M/c/foot.php';
?>