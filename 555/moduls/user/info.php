<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc();

$title = '用户 '.$use['login'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

$arr_pol = array('1' => '男', '2' => '女');
$arr_adm = array('0' => '用户', '1' => '版主', '2' => '管理员', '3' => '<font color="red">创作者</font>');
aut();



if($use){
echo '<div class="link"><b>用户名</b> : '.$use['login'].'</div>';
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