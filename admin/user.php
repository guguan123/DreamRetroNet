<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$title = '审核应用';

include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$title.'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';


aut();



if($user['admin_level']>=3){ 
$k_post = $con->query('SELECT * FROM `user` WHERE `id` = "'.$id.'"')->num_rows;
	
$k_page = k_page($k_post,12);
	
$page = page($k_page);
	
$start = 12*$page-12;
		$ms = $con->query("SELECT * FROM `user` WHERE `id` DESC LIMIT $start, 12");

if($k_post  < 1) err('没有待审核的应用. ');


while($w = $ms->fetch_assoc()){
//$list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
   // $ftext = readZipText("../down/files/".$w["down"]."" . $file, "META-INF/MANIFEST.MF"); 
echo '<ul class="list comment line padding bg-white" id="comment"><li class="clearfix"><a href="/info/16835"><img src="/icon/'.$w['id'].'" width="46" height="46" alt="头像" /></a><div><p><a href="/file_edit/'.$w['id'].'">'.$w['name'].'</a></p>';
//echo '<div class="small-font"><a class="right">';
//if($w['ivent']==1) echo '审核通过'; else echo '不通过';
echo '</div></div></li>';
//echo '<a href="/file_edit/'.$w['id'].'"> '.$w['name'].' </a>审核: ';
//if($w['ivent']==1) echo '审核通过'; else echo '不通过';
//echo '</a></div></div></li>';
//echo '<br>';
}


if($k_post > '10') {  echo str('?',$k_page,$page.'');  }

if($user['admin_level']>=2){
echo '<a href="/add_file/'.$id.'"><button>上传文件</button></a>';
}
}else{
	echo '权限不够';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>