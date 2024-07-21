<wml>
<head>
<meta http-equiv="Cache-Control" content="max-age=0"/>
<meta http-equiv="Cache-control" content="no-cache"/>
</head>
<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/config/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$link = $con->query("SELECT * FROM `link` WHERE `id` = '".$id."'")->fetch_assoc();
echo '<meta http-equiv="refresh" content="0;url='.$link['url'].'">
</head>
<card id="redirect" title="跳转" onenterforward="'.$link['url'].'">
<p>
正在进入...<br/>
等不及了,<a href="'.$link['url'].'">点击进入</a>
</p>
</card>
</wml></pre></body></html>';