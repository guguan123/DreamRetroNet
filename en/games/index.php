<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$pagesize = abs(intval($_GET['pagesize']));
$user_id = abs(intval($_GET['user_id']));
$top = abs(intval($_GET['top'])); # 
$new = $con->query("SELECT * FROM `game` WHERE `downs` > 0 ORDER BY `downs` DESC LIMIT 10");
if ($top==10){
$str="";
foreach($new as $row){
    $rowArr = json_encode(array("id" => "".$row['id']."","name" => "".$row['name']."","chinese" => "".$row['cn']."","system" => "".$row['platform']."","category" => "".$row['id_raz']."","vendor" => "".$row['author']."",
    "download_num" => "".$row['downs']."","comment_num" => "0"));
    $str=$str.$rowArr."###";
}
$jsonArr=rtrim($str,"###");
echo "{\"games\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
	//名字
	$system = filtr($_GET['system']);
	$resolution = filtr($_GET['resolution']);
	$category = filtr($_GET['category']);
	$vendor = filtr($_GET['vendor']);
	$users_id = filtr($_GET['users_id']);
$page = 1;
if(isset($_GET['page']))
$page = $_GET['page'];
//$users = $con->query("SELECT * FROM `user` WHERE `id` = '".$user_id."'")->fetch_assoc();
$k_post = $con->query("SELECT * FROM `game` WHERE `id_user` LIKE '%$users_id%' and `platform` LIKE '%$system%' and `id_raz` LIKE '%$category%' and `author` LIKE '%$vendor%'")->num_rows;
$total = $k_post;//记录数
$count = 0;
//$pagesize = $pagesi;
$pagesiz = 20;
$totalPage = ceil($total/$pagesiz);//总页数
$pages = ceil($conut/$pagesiz);//共多少页
$prepage=$page-1;
if($prepage<=0)
$prepage=1;
$nextpage = $page+1;
if($nextpage >= $pages){
$nextpage = $pages;
$start = ($page-1) * $pagesiz;
}
		$ms = $con->query("SELECT * FROM `game` WHERE `id_user` LIKE '%$users_id%' and `platform` LIKE '%$system%' and `id_raz` LIKE '%$category%' and `author` LIKE '%$vendor%' order by downs DESC LIMIT $start,$pagesiz");
		$mi = $con->query("SELECT * FROM `game` WHERE `platform` LIKE '%$system%' and `id_raz` LIKE '%$category%' and `author` LIKE '%$vendor%' ORDER BY RAND() LIMIT $start,$pagesize");
		//$ms = $con->query("SELECT * FROM `file` WHERE `author` = '".$author."' ORDER BY `id` DESC LIMIT 10");
if ($pagesize==10){
$str="";
foreach($mi as $row){
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$row['id'].'"')->num_rows;
     $rowArr = json_encode(array("id" => "".$row['id']."","name" => "".$row['name']."","chinese" => "".$row['cn']."","system" => "".$row['platform']."","category" => "".$row['id_raz']."","vendor" => "".$row['author']."",
    "download_num" => "".$row['downs']."","comment_num" => "".$number.""));
    $str=$str.$rowArr."###";
}
$jsonArr=rtrim($str,"###");
echo "{\"games\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}
include_once $_SERVER["DOCUMENT_ROOT"].'/en/M/c/header.php';
$title = ''.$title2.'';
echo '<body class=""><header><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="返回"></a>';
echo '<h2>'.$title2.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/en/M/c/user.php';
if($k_post  < 1) err('no app from the same factory！');
//导航
echo '<div id="nav" class="container"><a href="/">Home</a><span>'.$key.'</span></div>';
//最多最新上传
echo '<main class="container"><div id="main"><div class="tabs"><a href="/games" class="current">most downloads</a><a href="/games/order=id">Latest upload</a></div>';
//echo '<span class="title">同厂游戏</span>'.$key.'<div class="block">';
//游戏列表
echo '<ul class="games">';
while($w = $ms->fetch_assoc()){
if($name = $w['cn'] ?: $w['name']){
echo '<li><a href="/game/'.$w['id'].'"><img src="/M/i/'.$w['icon'].'" width="46" height="46" alt="'.$name.'图标" /></a><div>';
echo '<h3><a href="/game/'.$w['id'].'">'.$name.'</a></h3><div>';
}
echo '<span>'.$w['platform'].'</span><span>'.$w['id_raz'].'</span><span>'.$w['downs'].' downloads</span><span>';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
echo ''.$number.' comments</span></div></div></li>';
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></div>';
}
echo '</ul>';
//翻页统计
while($count < 1){
echo '<div class="pager"><span>Page '.$page.'/Total '.$totalPage.' Pages</span>';
$count++;
}
//上一页/下一页/尾页
if($page>2){//不在第一页
echo '<a href="/games">Home</a>';
}
if($page>1){//不在第一页
echo '<a href="/games?page='.($page-1).'">previous page </a>';
}
if($page < $totalPage){//不在最后一页
echo '<a href="/games?page='.($page+1).'">next page </a>';
}
if($page < $totalPage-1){//不在最后一页
echo '<a href="/games?page='.$totalPage.'">last page</a>';
}
echo '</div></div>';
//if($k_post > '20') {  echo str('?page='.$page.'&system='.$system.'&resolution='.$resolution.'&category='.$category.'&vendor='.$vendor.'&',$k_page,$page.'');  }
//筛选条件
echo '<div id="aside"><a href="/games/ngage2" title="N-Gage2"><img src="/M/o/ngage.png" alt="ngage logo" /></a><div class="twobuttons margin-top"><a href="/games/upload" class="button green">Upload JAR</a><a href="/games/uploadGame" class="button green">Upload SIS or N-Gage</a></div><h2 class="topic margin-top">filter</h2><form action="/games" method="get" class="form"><div><label>system：</label><select name="system"><option value="">all</option><option value="J2ME" >J2ME</option><option value="S60V1" >S60V1</option><option value="S60V2" >S60V2</option><option value="S60V3" >S60V3</option><option value="S60V5" >S60V5</option><option value="Symbian3" >Symbian3</option><option value="N-Gage2" >N-Gage2</option></select></div><div><label>MoResolution：</label><select name="resolution"><option value="">all</option><option value="128×128" >128×128</option><option value="128×160" >128×160</option><option value="132×176" >132×176</option><option value="175×220" >175×220</option><option value="176×208" >176×208</option><option value="176×220" >176×220</option><option value="176×240" >176×240</option><option value="208×208" >208×208</option><option value="208×320" >208×320</option><option value="240×240" >240×240</option><option value="240×320" >240×320</option><option value="240×400" >240×400</option><option value="240×432" >240×432</option><option value="320×240" >320×240</option><option value="320×480" >320×480</option><option value="480×640" >480×640</option><option value="480×700" >480×700</option><option value="480×720" >480×720</option><option value="480×800" >480×800</option><option value="640×360" >640×360</option><option value="flex" >flex</option></select></div><div><label>type：</label><select name="category"><option value="">all</option><option value="ACT" >action game</option><option value="ARPG" >Action RPG</option><option value="AVG" >adventure game</option><option value="ETC" >other games</option><option value="FPS" >first person shooter</option><option value="FTG" >fighting game</option><option value="MUG" >music game</option><option value="RAC" >racing game</option><option value="RPG" >cosplay</option><option value="RTS" >Real-Time Strategy</option><option value="SLG" >strategy simulation</option><option value="SPG" >sports game</option><option value="STG" >shooting game</option><option value="APP" >application software</option></select></div><div><input type="submit" value="filter" /></div></form></div></main>';
//}

include_once $_SERVER["DOCUMENT_ROOT"].'/en/M/c/foot.php';

?>