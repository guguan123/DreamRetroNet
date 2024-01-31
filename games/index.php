<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$pagesize = abs(intval($_GET['pagesize']));
$top = abs(intval($_GET['top'])); # 
include "../M/c/function.php";
if(isset($_GET["local"])){
  $_SESSION["language"] = $_GET["local"];
}else{
  $_SESSION["language"] = getDefalutlanguage();
}
$language_name = getLanguageName($_SESSION["language"]);
if (!$language_name){
echo '<link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>我们没有找到语言包</p></body>';
exit();
}else{
include "../M/e/".$language_name.".inc";
}

  $language_array = array_language();
  foreach($language_array as $key => $value){
    if($_SESSION["language"] == $value){
      $selected = "selected = 'selected' ";
    }else{
      $selected = "";
    }
    }

  if($_GET["local"] == $value){
      //$selected = "selected = 'selected' ";
    }
$new = $con->query("SELECT * FROM `game` WHERE `downs` > 0 ORDER BY `downs` DESC LIMIT 10");
$order = abs(intval($_GET['order'])); #
$n = $con->query("SELECT * FROM `game` ORDER BY `id` DESC LIMIT 10");
if ($order==10){
$str="";
foreach($n as $row){
    $rowArr = json_encode(array("id" => "".$row['id']."","name" => "".$row['name']."","chinese" => "".$row['cn']."","system" => "".$row['platform']."","category" => "".$row['id_raz']."","vendor" => "".$row['author']."","local" => "".$local1."",
    "download_num" => "".$row['downs']."","comment_num" => "0"));
    $str=$str.$rowArr."###";
}
$jsonArr=rtrim($str,"###");
echo "{\"games\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}
if ($top==10){
$str="";
foreach($new as $row){
    $rowArr = json_encode(array("id" => "".$row['id']."","name" => "".$row['name']."","chinese" => "".$row['cn']."","system" => "".$row['platform']."","category" => "".$row['id_raz']."","vendor" => "".$row['author']."","local" => "".$local1."",
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
	$lang = filtr($_GET['lang']);
	$online = filtr($_GET['online']);
$page = 1;
if(isset($_GET['page']))
$page = $_GET['page'];
//$users = $con->query("SELECT * FROM `user` WHERE `id` = '".$user_id."'")->fetch_assoc();
if($k_post1 = $users_id ?: $system ?: $category ?: $vendor ?: $resolution ?: $lang ?: $online){
//$k_post3 = $con->query("SELECT * FROM `games` WHERE `dpi` LIKE '".$resolution."'")->num_rows;
$k_post1 = $con->query("SELECT * FROM `game` WHERE `id_user` LIKE '".$users_id."' OR `dpi` LIKE '".$resolution."' OR `platform` LIKE '".$system."' OR `raz` LIKE '".$category."' OR `author` LIKE '".$vendor."' OR `zh` LIKE '".$lang."' OR `DJ` LIKE '".$online."'")->num_rows;
}else{
$k_post2 = $con->query("SELECT * FROM `game`")->num_rows;
}
if($k_post = $k_post1 ?: $k_post2){
$total = $k_post;//记录数
}
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
//$ms = $con->query("SELECT * FROM `game` WHERE `id_user` LIKE '%$users_id%' OR `platform` LIKE '%$system%' OR `id_raz` LIKE '%$category%' OR `author` LIKE '%$vendor%' order by downs DESC LIMIT $start,$pagesiz");
if($mss = $users_id ?: $system ?: $category ?: $vendor ?: $resolution ?: $lang ?: $online){
	//$mssss = $con->query("SELECT * FROM `games` WHERE `dpi` LIKE '".$resolution."' order by id DESC LIMIT $start,$pagesiz");
		$mss = $con->query("SELECT * FROM `game` WHERE `id_user` LIKE '".$users_id."' OR `platform` LIKE '".$system."' OR `raz` LIKE '".$category."' OR `author` LIKE '".$vendor."' OR `zh` LIKE '".$lang."' OR `DJ` LIKE '".$online."' OR `dpi` LIKE '".$resolution."' order by downs DESC LIMIT $start,$pagesiz");
		//`id` LIKE '".$mssss['id_game']."' OR 
	}else{
	$msss = $con->query("SELECT * FROM `game` order by downs DESC LIMIT $start,$pagesiz");
	}
		$mi = $con->query("SELECT * FROM `game` WHERE `platform` LIKE '%$system%' and `raz` LIKE '%$category%' and `author` LIKE '%$vendor%' ORDER BY RAND() LIMIT $start,$pagesize");
		//$ms = $con->query("SELECT * FROM `file` WHERE `author` = '".$author."' ORDER BY `id` DESC LIMIT 10");
if ($pagesize==10){
$str="";
foreach($mi as $row){
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$row['id'].'"')->num_rows;
     $rowArr = json_encode(array("id" => "".$row['id']."","name" => "".$row['name']."","chinese" => "".$row['cn']."","system" => "".$row['platform']."","category" => "".$row['id_raz']."","vendor" => "".$row['author']."","local" => "".$local1."",
    "download_num" => "".$row['downs']."","comment_num" => "".$number.""));
    $str=$str.$rowArr."###";
}
$jsonArr=rtrim($str,"###");
echo "{\"games\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
echo $header;
?>

<meta itemprop="name" content="<?php $title2 ?>" />

<?php
 echo '<title>'.$title2.'</title>';
echo '</head>'; 
$title = ''.$title2.'';
echo '<div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="'.$exit.'"></a>
';
echo '<h1>'.$title2.'</h1><a href="/"><img src="/favicon.ico" width="32" height="32" alt="'.$title2.'logo" /><h1>'.$title2.'</h1>';

//echo '<h2>'.$title2.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
//if($k_post  < 1) err('没有同厂游戏！');
echo '<div id="nav" class="container"><a href="/">'.$zhuye.'</a><span>'.$list.'</span></div>';
echo '<main class="container"><div id="main"><div class="tabs"><a href="/games" class="current">'.$download_top.'</a><a href="/games/order=id">'.$upload_new.'</a></div>';
//echo '<span class="title">同厂游戏</span>'.$key.'<div class="block">';
echo '<ul class="box res">';
if($ms = $mss ?: $msss ?: $mssss){
while($w = $ms->fetch_assoc()){
$mu = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$w['id']."' ORDER BY `id` ASC limit 1")->fetch_assoc();
if($mu > 0){
$image = $mu['url'];
}else{
$image = '0.png';
}
if($name = $w['cn'] ?: $w['name']){
echo '<li><a href="/game/'.$w['id'].''.$local1.'" class="clearfix"><img src="/M/s/'.$image.'" /></a>';
echo '<h3>'.$name.'</h3></li>';
}
}
}
echo '</ul>';
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></div>';
echo '</ul>';
echo '</div>';
while($count < 1){
echo '<div class="pager"><span>'.$pagerss.''.$page.''.$pagerss0.'/'.$pagerss1.''.$totalPage.''.$pagerss2.'</span>';
$count++;
}
if($page>2){//不在第一页
echo '<a href="/games'.$local1.'">'.$zhuye.'</a>';
}
if($page>1){//不在第一页
echo '<a href="/games?page='.($page-1).''.$local2.'">'.$pagers1.' </a>';
}
if($page < $totalPage){//不在最后一页
echo '<a href="/games?page='.($page+1).''.$local2.'">'.$pagers2.' </a>';
}
if($page < $totalPage-1){//不在最后一页
echo '<a href="/games?page='.$totalPage.''.$local2.'">'.$pagers_total.'</a>';
}
echo '</div></div>';
//if($k_post > '20') {  echo str('?page='.$page.'&system='.$system.'&resolution='.$resolution.'&category='.$category.'&vendor='.$vendor.'&',$k_page,$page.'');  }
echo '<div id="aside"><a href="/games/ngage2'.$local1.'" title="N-Gage2"><img src="/M/o/ngage.png" alt="ngage logo" /></a><div class="twobuttons margin-top"><a href="/games/upload'.$local1.'" class="button green">'.$upload_jar.'</a><a href="/games/uploadGame'.$local1.'" class="button green">'.$upload_game.'</a></div><h2 class="topic margin-top">'.$filter.'</h2><form action="/games" method="get" class="form"><div><label>'.$system_s.'：</label><select name="system"><option value="">'.$who.'</option><option value="J2ME" >J2ME</option><option value="S60V1" >S60V1</option><option value="S60V2" >S60V2</option><option value="S60V3" >S60V3</option><option value="S60V5" >S60V5</option><option value="Symbian3" >Symbian3</option><option value="N-Gage2" >N-Gage2</option><option value="MRP" >MRP</option></select></div><div><label>'.$res.'：</label><select name="resolution"><option value="">'.$who.'</option><option value="128×128" >128×128</option><option value="128×160" >128×160</option><option value="132×176" >132×176</option><option value="175×220" >175×220</option><option value="176×208" >176×208</option><option value="176×220" >176×220</option><option value="176×240" >176×240</option><option value="208×208" >208×208</option><option value="208×320" >208×320</option><option value="240×240" >240×240</option><option value="240×320" >240×320</option><option value="240×400" >240×400</option><option value="240×432" >240×432</option><option value="320×240" >320×240</option><option value="320×480" >320×480</option><option value="480×640" >480×640</option><option value="480×700" >480×700</option><option value="480×720" >480×720</option><option value="480×800" >480×800</option><option value="640×360" >640×360</option><option value="flex" >flex</option></select></div><div><label>'.$cate.'：</label><select name="category"><option value="">'.$who.'</option><option value="ACT" >'.$act.'</option><option value="ARPG" >'.$arpg.'</option><option value="AVG" >'.$avg.'</option><option value="ETC" >'.$etc.'</option><option value="FPS" >'.$fps.'</option><option value="FTG" >'.$ftg.'</option><option value="MUG" >'.$mug.'</option><option value="RAC" >'.$rac.'</option><option value="RPG" >'.$rpg.'</option><option value="RTS" >'.$rts.'</option><option value="SLG" >'.$slg.'</option><option value="SPG" >'.$spg.'</option><option value="STG" >'.$stg.'</option><option value="APP" >'.$app.'</option></select></div><div><input type="submit" value="'.$screen_s.'" /></div></form></div></main>';
//}

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';

?>