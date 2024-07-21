<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '搜索';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

if(!isset($_GET['key'])){
echo '
<span class="title">关键字</span><div class="link"><form action="" method="get">
</br>
<input type="text" name="key" value=""><br/>
<input type="submit" name="submit" value="搜索" />
</form></div>';	
}else{
	//名字
	$key = filtr($_GET['key']);
$k_post = $con->query("SELECT * FROM `file` WHERE `name` LIKE '%$key%'")->num_rows;
	
$k_page = k_page($k_post,12);
	
$page = page($k_page);
	
$start = 12*$page-12;
		$ms = $con->query("SELECT * FROM `file` WHERE `name` LIKE '%$key%' order by id DESC LIMIT $start, 12");

if($k_post  < 1) err('啥也没搜到啊！');

echo '<span class="title">搜索</span>'.$key.'<div class="block">';

while($w = $ms->fetch_assoc()){

echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></div>';

}

echo '</div>';

if($k_post > '10') {  echo str('?key='.$key.'&',$k_page,$page.'');  }
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>