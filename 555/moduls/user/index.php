<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '用户中心';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();
$coun_jor = $con->query('SELECT * FROM `msg` WHERE `id_user` = "'.$user['id'].'" and `read` = "0"')->num_rows;
echo '<div class="razdel"><center>用户名, <b>'.$user['login'].'</b> </center></div>';
echo '<div class="link"><a href="/uploads"><img src="/style/image/index/up.png"> 我上传的</a></div>';
if($coun_jor < 1){
echo '<div class="link"><a href="/msg"><img src="/style/image/index/msg.png"> 我的消息</a></div>';
}else{

echo '<div class="link"><a href="/msg"><img src="/style/image/index/msg.png"> 我的消息 (<font color="red">'.$coun_jor.' 个</font>)</a></div>';

}
echo '<div class="link"><a href="/log_auth"><img src="/style/image/index/log_auth.png"> 登录历史</a></div>';
echo '<div class="link"><a href="/exit"><img src="/style/image/index/exit.png"> 退出登录</a></div>';
if($user['admin_level']>=1){
echo '<div class="link"><a href="/admin"><img src="/style/image/index/adm_panel.png"> 管理员面板</a></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>