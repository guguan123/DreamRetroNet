<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '消息提示';
include_once $_SERVER["DOCUMENT_ROOT"].'/wap/M/c/header.php';
aut();

setcookie('qq','', time()-86400*365, '/', 'javaky.com'); 
setcookie('pass','', time()-86400*365, '/', 'javaky.com');
setcookie('baidu_id','', time()-86400*365, '/', 'javaky.com'); 
header('Location: /');
//include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>