<?php
include "M/c/function.php";
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
include "M/e/".$language_name.".inc";
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
   echo $header;
   
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
aut();
if($user['admin_level']=="禁言"){
echo '<link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>请登录之后再操作</p></body>';
exit();
}
 if(!isset($_GET['keyword'])){
$title = ''.$search_name.'';
echo '<meta itemprop="name" content="'.$title.'" />'; 
echo '<title>'.$title.'</title>';
echo '</head>'; 
echo '<div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="'.$exit.'"></a>
';
echo '<h1>'.$title2.'</h1><a href="/"><img src="/favicon.ico" width="32" height="32" alt="'.$title2.'logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';

echo '<div id="nav" class="container"><a href="/">'.$zhuye.'</a><span>'.$title.'</span></div>';
echo '<main class="container"><div id="main">';

echo '<div class="area"><form action="/search'.$local2.'" method="get" class="form"><div><input type="search" name="keyword" placeholder="'.$keywords.'" required="required" value="" autocomplete="off" /><input type="submit" value="'.$sousuo.'" /></div></form>';
echo '<h2 class="topic">'.$search_top.'</h2>';
echo '<ul class="hotwords">';
//$keys = $con->query("SELECT * FROM `search_log` ORDER BY `id` DESC LIMIT 10");
$keys = $con->query(" SELECT * FROM `search_log` WHERE num > 0 ORDER BY RAND() LIMIT 12");
while($k = $keys->fetch_assoc()){
echo '<li><a href="/search?keyword='.$k['key'].''.$local2.'">'.$k['key'].'</a></li>';
}
echo '</ul></div></main>';
//echo '
//<span class="title">关键字</span><div class="link"><form action="" method="get">
//</br>
//<input type="text" name="key" value=""><br/>
//<input type="submit" name="submit" value="搜索" />
//</form></div>';	
}else{
	//名字
	$keyword = filtr($_GET['keyword']);
	$title = ''.$_GET['keyword'].''.$search_name.'';
echo '<meta itemprop="name" content="'.$title.'" />'; 
	echo '<title>'.$title.'</title>';
echo '</head>'; 
echo '<body class=""><header><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="'.$exit.'"></a>';
echo '<h2>'.$title2.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">'.$zhuye.'</a><span>'.$title.'</span></div>';
echo '<main class="container"><div id="main">';
	 $key_num = $con->query(" SELECT * FROM `search_log` WHERE `key` = '$keyword'")->num_rows;
    if($key_num > 0){
        $con->query("UPDATE `search_log` SET `num` = `num`+1 WHERE `key` = '$keyword'");
        
    }else{
        $con->query("INSERT INTO `search_log` (`id`, `key`, `num`, `time`) VALUES (NULL, '{$keyword}', '1', '')");
        
    }
    $page = 1;
if(isset($_GET['page']))
$page = $_GET['page'];
$k_post = $con->query("SELECT * FROM `game` WHERE `name` LIKE '%$keyword%' OR `cn` LIKE '%$keyword%'")->num_rows;
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
		$ms = $con->query("SELECT * FROM `game` WHERE `name` LIKE '%$keyword%' OR  `cn` LIKE '%$keyword%' order by id DESC LIMIT $start,$pagesiz");
if($k_post  < 1) err('抱歉，暂未收录'.$keyword.'……');
echo '<div class="area"><form action="/search'.$local2.'" method="get" class="form"><div><input type="search" name="keyword" placeholder="'.$search.'" required="required" value="'.$keyword.'" autocomplete="off" /><input type="submit" value="'.$sousuo.'" /></div></form>';
//echo '<span class="title">搜索</span>'.$keyword.'<div class="block">';

echo '<ul class="games">';
while($w = $ms->fetch_assoc()){
if($name = $w['cn'] ?: $w['name']){
echo '<li><a href="/game/'.$w['id'].'"><img src="/M/i/'.$w['icon'].'" width="46" height="46" alt="'.$name.''.$icons.'" /></a><div>';
echo '<h3><a href="/game/'.$w['id'].''.$local1.'">'.$name.'</a></h3><div>';
}
echo '<span>'.$w['platform'].'</span><span>'.$w['id_raz'].'</span><span>'.$w['downs'].''.$download_num.'</span><span>';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$w['id'].'"')->num_rows;
echo ''.$number.''.$number_num.'</span></div></div></li>';
}
echo '</ul>';
while($count < 1){
echo '<div class="pager"><span>'.$pagerss.''.$page.''.$pagerss0.'/'.$pagerss1.''.$totalPage.''.$pagerss2.'</span>';
$count++;
}
if($page>2){//不在第一页
echo '<a href="/search'.$local1.'">'.$zhuye.'</a>';
}
if($page>1){//不在第一页
echo '<a href="/search?page='.($page-1).''.$local2.'">'.$pagers1.' </a>';
}
if($page < $totalPage){//不在最后一页
echo '<a href="/search?page='.($page+1).''.$local2.'">'.$pagers1.' </a>';
}
if($page < $totalPage-1){//不在最后一页
echo '<a href="/search?page='.$totalPage.''.$local2.'">'.$pagers_total.'</a>';
}
echo '</div></div>';
}

//echo '</ul>';
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></div>';

echo '</main>';
//echo '</div>';

//if($k_post > '10') {  echo str('?keyword='.$keyword.'&',$k_page,$page.'');  }

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>