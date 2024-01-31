<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$title = ''.$user['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a>';
echo '<h1>'.$user['name'].'</h1>';
echo '<div id="user">';
if(!$user){
echo '<a href="/auth">登录</a></div></div>';
}else{
echo '<a href="/user">'.$user['name'].'</a>';
}
echo '</div></div>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/menu.php';
echo '<div id="nav"><span>位置：</span><span>'.$user['name'].'</span></div>';
echo '<div id="wrapper" class="clearfix"><div id="main">';

aut();
//$uw = $con->query("SELECT * FROM `file` ORDER BY `id_user` = {$user['id']} DESC");
$uw = $con->query("SELECT * FROM `file` WHERE `id_user` ={$user['id']} ORDER BY `id` DESC");
$uc = $con->query("SELECT * FROM `comment` WHERE `id_user` ={$user['id']} ORDER BY `id` DESC");
$uk = $con->query("SELECT * FROM `files` WHERE `id_user` ={$user['id']} ORDER BY `id` DESC");
echo '<h2 class="topic">申请认证</h2>';
if (!$user['v']>=1){
echo '<ul class="list padding line bg-white"><li>用户名：'.$user['login'].'</li><li>昵称：'.$user['name'].'</li><li>应用：'.$uw->num_rows.'/5个</li><li><a href="/user/VS.php">申请认证</li></ul>';
}else{
echo '<ul class="list padding line bg-white"><li><img src="/style/image/V.png" width="40" height="40" alt="头像" />'.$user['v_name'].''.v($user['v']).'</li><li>已完成认证</li></ul>';
}

echo '<h2 class="topic margin-top">管理菜单</h2><ul class="list padding line bg-white"><li><img src="/style/image/V.png" width="40" height="40" alt="头像" /><p>黄色标记</a></li><li>用户名：'.$user['login'].'</li><li><a href="/info/2">重置登录码请联系管理员</a></li><li><a href="/user/setPhone">设置我的功能机</a></li><li><a href="https://jinshuju.net/f/tPrerh">上传游戏</a></li>';
if($user['admin_level']>=1){
echo '<li><a href="/admin">管理员面板</a></li>';
}
echo '</ul></div></div>';
//upload

//echo '<div class="razdel"><center>用户名, <b>'.$user['login'].'</b> </center></div>';
//echo '<div class="link"><a href="/uploads"><img src="/style/image/index/up.png"> 我上传的</a></div>';
//if($coun_jor < 1){
//echo '<div class="link"><a href="/msg"><img src="/style/image/index/msg.png"> 我的消息</a></div>';
//}else{

//echo '<div class="link"><a href="/msg"><img src="/style/image/index/msg.png"> 我的消息 (<font color="red">'.$coun_jor.'123 个</font>)</a></div>';

//}
//echo '<div class="link"><a href="/log_auth"><img src="/style/image/index/log_auth.png"> 登录历史</a></div>';
//echo '<div class="link"><a href="/exit"><img src="/style/image/index/exit.png"> 退出登录</a></div>';
//if($user['admin_level']>=1){
//echo '<div class="link"><a href="/admin"><img src="/style/image/index/adm_panel.png"> 管理员面板</a></div>';
//}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>