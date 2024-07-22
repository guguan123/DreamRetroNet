<?php
ob_start(); // 开启输出缓冲

require_once("Connect/API/qqConnectAPI.php");
$qc = new QC();
echo $qc->qq_callback();
echo $qc->get_openid();

header("Location: ".'/login/Connect/example/user/get_user_info.php');
ob_end_flush(); // 发送缓冲区内容
exit;
?>

