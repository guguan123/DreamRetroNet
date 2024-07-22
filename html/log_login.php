<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '登录历史';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

aut();

$k_post = $con->query('SELECT * FROM `log_auth` WHERE `id_user` = "'.$user['id'].'"')->num_rows;

if($k_post == 0) err('没有登录历史');
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;
	
	$ms = $con->query("SELECT * FROM `log_auth` WHERE `id_user` = '".$user['id']."' ORDER BY `id` DESC LIMIT $start, 10");

	  while($w = $ms->fetch_assoc()){
echo '<ul class="list comment line padding bg-white" id="comment"><li class="clearfix"><div><p>'.$t.'</a>登录IP : '.$w['ip'].'</p>';
echo '<div class="small-font">'.data($w['time']).'</div></div></li>';

  
if($w['type'] == 0){$t = '<font color="red">失败</font>';}else{$t = '<font color="green">成功</font>';}

  //echo '<div class="link">'.$t.' 登录IP : '.$w['ip'].' ('.data($w['time']).')</div>';

  }

  if($k_post > '10') {  echo str('?',$k_page,$page.'');  }


include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>