<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '消息';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a>';
echo '<h1>'.$use['name'].'</h1>';
echo '<div id="user">';
if(!$user){
echo '<a href="/auth">登录</a></div></div>';
}else{
echo '<a href="/user">'.$user['name'].'</a>';
}
echo '</div></div>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/menu.php';
echo '<div id="nav"><span>位置：</span><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><div id="main">';

aut();

$k_post = $con->query('SELECT * FROM `msg` WHERE `id_user` = "'.$user['id'].'"')->num_rows;

if($k_post == 0) err('没有杂志');
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;
	
	$ms = $con->query("SELECT * FROM `msg` WHERE `id_user` = '".$user['id']."' ORDER BY `id` DESC LIMIT $start, 10");

	  while($w = $ms->fetch_assoc()){
echo '<ul class="list comment line padding bg-white" id="comment"><li class="clearfix"><a href="/user/16835"><img src="https://thirdqq.qlogo.cn/g?b=oidb&amp;k=47NquUyHlm3pCuBDI9gD0g&amp;s=40&amp;t=1582873570" width="46" height="46" alt="头像" /></a><div><p><a href="/user/16835">'.user($w['id_user']).'</a>：'.text($w['text']).'</p>';
echo '<div class="small-font"><a href="/reply/'.$w['id'].'" class="right">回复</a>'.data($comm['time']).'</div></div></li>';

  
  //echo '<div class="link">'.text($w['text']).' ('.data($w['time']).')</div>';
  if($w['read'] == 0){

$con->query("UPDATE `msg` SET `read` = '1' WHERE `id` = '".$w['id']."'");

  }

  }

  if($k_post > '10') {  echo str('?',$k_page,$page.'');  }


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>