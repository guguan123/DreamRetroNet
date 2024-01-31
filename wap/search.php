<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/wap/M/c/header.php';
$title = '搜索';
echo '<div class="header"><a href="/">'.$title2.'</a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/wap/M/c/user.php';
echo '<div class="wrapper"><ul>';
aut();

if(!isset($_GET['keyword'])){
echo '<form action="/search" method="get"><input type="search" name="keyword" value="" /><input type="submit" value="搜索" /></form>';
echo '<h2 class="topic">近期热搜</h2>';
echo '<div class="hotwords">';
//$keys = $con->query("SELECT * FROM `search_log` ORDER BY `id` DESC LIMIT 10");
$keys = $con->query(" SELECT * FROM `search_log` WHERE num > 0 ORDER BY RAND() LIMIT 12");
while($k = $keys->fetch_assoc()){
echo '<a href="/search?keyword='.$k['key'].'">'.$k['key'].'</a> | ';
}
echo '</div></div>';
//echo '
//<span class="title">关键字</span><div class="link"><form action="" method="get">
//</br>
//<input type="text" name="key" value=""><br/>
//<input type="submit" name="submit" value="搜索" />
//</form></div>';	
}else{
	//名字
	$keyword = filtr($_GET['keyword']);
	 $key_num = $con->query(" SELECT * FROM `search_log` WHERE `key` = '$keyword'")->num_rows;
    if($key_num > 0){
        $con->query("UPDATE `search_log` SET `num` = `num`+1 WHERE `key` = '$keyword'");
        
    }else{
        $con->query("INSERT INTO `search_log` (`id`, `key`, `num`, `time`) VALUES (NULL, '{$key}', '1', '')");
        
    }
$k_post = $con->query("SELECT * FROM `game` WHERE `name` LIKE '%$keyword%' OR `cn` LIKE '%$keyword%'")->num_rows;
	
$k_page = k_page($k_post,12);
	
$page = page($k_page);
	
$start = 12*$page-12;
		$ms = $con->query("SELECT * FROM `game` WHERE `name` LIKE '%$keyword%' OR  `cn` LIKE '%$keyword%' order by id DESC LIMIT $start, 12");
if($k_post  < 1) err('抱歉，暂未收录'.$keyword.'……');
echo '<form action="/search" method="get"><input type="search" name="keyword" value="'.$keyword.'" /><input type="submit" value="搜索" /></form>';
//echo '<span class="title">搜索</span>'.$key.'<div class="block">';

echo '<ul>';
while($w = $ms->fetch_assoc()){
echo '<li><a href="/game/'.$w['id'].'"><img src="/M/i/'.$w['icon'].'" width="24" height="24" alt="图标" />';
if($name = $w['cn'] ?: $w['name']){
echo ''.$name.'</a></li>';
}
}
}
echo '</ul>';
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></div>';


//echo '</div>';

if($k_post > '10') {  echo str('?keyword='.$keyword.'&',$k_page,$page.'');  }

include_once $_SERVER["DOCUMENT_ROOT"].'/wap/M/c/foot.php';
?>