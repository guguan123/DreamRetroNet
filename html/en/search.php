<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '搜索';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
aut();
echo '<body class=""><header><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="返回"></a>';
echo '<h2>'.$title2.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$title.'</span></div>';
echo '<main class="container"><div id="main">';

if(!isset($_GET['keyword'])){
echo '<div class="area"><form action="/search" method="get" class="form"><div><input type="search" name="keyword" placeholder="在这里搜索……" required="required" value="" autocomplete="off" /><input type="submit" value="搜索" /></div></form>';
echo '<h2 class="topic">近期热搜</h2>';
echo '<ul class="hotwords">';
//$keys = $con->query("SELECT * FROM `search_log` ORDER BY `id` DESC LIMIT 10");
$keys = $con->query(" SELECT * FROM `search_log` WHERE num > 0 ORDER BY RAND() LIMIT 12");
while($k = $keys->fetch_assoc()){
echo '<li><a href="/search?keyword='.$k['key'].'">'.$k['key'].'</a></li>';
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
	 $key_num = $con->query(" SELECT * FROM `search_log` WHERE `key` = '$keyword'")->num_rows;
    if($key_num > 0){
        $con->query("UPDATE `search_log` SET `num` = `num`+1 WHERE `key` = '$keyword'");
        
    }else{
        $con->query("INSERT INTO `search_log` (`id`, `key`, `num`, `time`) VALUES (NULL, '{$keyword}', '1', '')");
        
    }
$k_post = $con->query("SELECT * FROM `game` WHERE `name` LIKE '%$keyword%' OR `cn` LIKE '%$keyword%'")->num_rows;
	
$k_page = k_page($k_post,12);
	
$page = page($k_page);
	
$start = 12*$page-12;
		$ms = $con->query("SELECT * FROM `game` WHERE `name` LIKE '%$keyword%' OR  `cn` LIKE '%$keyword%' order by id DESC LIMIT $start, 12");
if($k_post  < 1) err('抱歉，暂未收录'.$keyword.'……');
echo '<div class="area"><form action="/search" method="get" class="form"><div><input type="search" name="keyword" placeholder="在这里搜索……" required="required" value="'.$keyword.'" autocomplete="off" /><input type="submit" value="搜索" /></div></form>';
//echo '<span class="title">搜索</span>'.$keyword.'<div class="block">';

echo '<ul class="games">';
while($w = $ms->fetch_assoc()){
if($name = $w['cn'] ?: $w['name']){
echo '<li><a href="/game/'.$w['id'].'"><img src="/M/i/'.$w['icon'].'" width="46" height="46" alt="'.$name.'图标" /></a><div>';
echo '<h3><a href="/game/'.$w['id'].'">'.$name.'</a></h3><div>';
}
echo '<span>'.$w['platform'].'</span><span>'.$w['id_raz'].'</span><span>'.$w['downs'].'下载</span><span>';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$w['id'].'"')->num_rows;
echo ''.$number.'评论</span></div></div></li>';
}
echo '</ul>';
}
//echo '</ul>';
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></div>';


//echo '</div>';

if($k_post > '10') {  echo str('?keyword='.$keyword.'&',$k_page,$page.'');  }

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>