<?php

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ


include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$bx = $con->query("SELECT * FROM `games` WHERE `id` = '".$id."'")->fetch_assoc();

if($bx){


$title = ''.$bx['name'].'';

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

if($bx['id_game'] > 0){
//echo '<div class="margin_site_title_one"><span class="title">'.$ws['name'].'</span></div>';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>安装包上传成功。</p><p><a href="/game/'.$bx['id_game'].'" class="button">返回</a></p>';
}else{
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>抱歉！安装包上传成功，文件数据错误，请联系管理员处理。</p></body>';
}
}


	


//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></


//if($user['admin_level']>=2){
//echo '<a href="/add_file/'.$id.'"><button>上传文件</button></a>';
//}