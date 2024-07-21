<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Language" content="zh-CN">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/config/base.php';
$cmd = abs(intval($_GET['cmd'])); # ФИЛЬТР ГЕТ
$link = $con->query("SELECT * FROM `jump` WHERE `url` = '".$cmd."'")->fetch_assoc();
if ($link['url']){
echo '<meta http-equiv="refresh" content="0;url='.$link['url'].'">
<title></title>
</head>
<body>正在跳转中<br>
<a href="'.$link['url'].'">如等待时间过长可点击这里跳转</a>

</body></html>';
}else{
echo '<meta http-equiv="refresh" content="0;url=http://uc.jvgme.cn">
<title></title>
</head>
<body>正在跳转中<br>
<a href="http://uc.jvgme.cn">如等待时间过长可点击这里跳转</a>

</body></html>';
}