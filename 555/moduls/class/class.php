<?php

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$bx = $con->query("SELECT * FROM `class` WHERE `id` = '".$id."'")->fetch_assoc();
if($bx){

$title = ''.$bx['name'].'';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

$msssa = $con->query("SELECT * FROM `class` WHERE `id` = '".$id."'");
while($ws = $msssa->fetch_assoc()){

echo '<div class="margin_site_title_one"><span class="title">'.$ws['name'].'</span></div>';

}

$k_post = $con->query('SELECT * FROM `file` WHERE `id_raz` = "'.$id.'" AND `ivent` = 1')->num_rows;
	
$k_page = k_page($k_post,12);
	
$page = page($k_page);
	
$start = 12*$page-12;
		$ms = $con->query("SELECT * FROM `file` WHERE `id_raz` = '".$id."' AND `ivent` = 1 ORDER BY `id` DESC LIMIT $start, 12");

if($k_post  < 1) err('这里啥也没有！');

echo '<div class="block">';

while($w = $ms->fetch_assoc()){

echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></div>';
}


echo '</div>';

if($k_post > '10') {  echo str('?',$k_page,$page.'');  }

if($user['admin_level']>=2){
echo '<a href="/add_file/'.$id.'"><button>上传文件</button></a>';
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>