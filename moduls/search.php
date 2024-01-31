<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '搜索';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
//aut();
echo '<div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>
<a href="/">
<img src="/favicon.ico" width="32" height="32" alt="续梦网logo">';
echo '<h1>'.$title2.'</h1><p>续写怀旧游戏新篇章，重温旧梦</p></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';

if(!isset($_GET['key'])){
echo '<form action="" method="get" class="form bg-white"><div><input type="text" name="key" placeholder="在这里搜索……" required="required" value="" /></div><div><input type="submit" value="搜索" /></div></form></div>';
echo '<div id="aside"><h2 class="topic">热搜词</h2>';
echo '<ul class="list icon line">';
//$keys = $con->query("SELECT * FROM `search_log` ORDER BY `id` DESC LIMIT 10");
$keys = $con->query(" SELECT * FROM `search_log` WHERE num > 2 ORDER BY `num` DESC LIMIT 10");
while($k = $keys->fetch_assoc()){
echo '<li><a href="/search?key='.$k['key'].'">'.$k['key'].'</a></li>';
}
echo '</ul></div></div>';
//echo '
//<span class="title">关键字</span><div class="link"><form action="" method="get">
//</br>
//<input type="text" name="key" value=""><br/>
//<input type="submit" name="submit" value="搜索" />
//</form></div>';	
}else{
	//名字
	$key = filtr($_GET['key']);
	 $key_num = $con->query(" SELECT * FROM `search_log` WHERE `key` = '$key'")->num_rows;
    if($key_num > 0){
        $con->query("UPDATE `search_log` SET `num` = `num`+1 WHERE `key` = '$key'");
        
    }else{
        $con->query("INSERT INTO `search_log` (`id`, `key`, `num`, `time`) VALUES (NULL, '{$key}', '1', '')");
        
    }
$k_post = $con->query("SELECT * FROM `file` WHERE `name` LIKE '%$key%' OR `zhcn` LIKE '%$key%'")->num_rows;
	
$k_page = k_page($k_post,12);
	
$page = page($k_page);
	
$start = 12*$page-12;
		$ms = $con->query("SELECT * FROM `file` WHERE `name` LIKE '%$key%' OR  `zhcn` LIKE '%$key%' order by id DESC LIMIT $start, 12");
if($k_post  < 1) err('抱歉，暂未收录'.$key.'……');

echo '<span class="title">搜索</span>'.$key.'<div class="block">';

echo '<ul class="list icon line games bg-white">';
while($w = $ms->fetch_assoc()){
echo '<li><a href="/file/'.$w['id'].'" class="clearfix"><img src="/icon/'.$w['id'].'" width="46" height="46" alt="图标" />';
if($name = $w['zhcn'] ?: $w['name']){
echo '<strong>'.$name.'</strong>';
}
echo '<span class="small-font">'.platform($w['platform']).'&nbsp;'.$w['downs'].'下载&nbsp;';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$w['id'].'"')->num_rows;
echo ''.$number.'评论&nbsp;';
$msssa = $con->query("SELECT * FROM `class` WHERE `id` = '".$w['id_raz']."'"); 
while($wss = $msssa->fetch_assoc()){
echo ''.$wss['name'].'&nbsp;</span></a></li>';
}
}
echo '</ul></div></div>';
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 已下载: '.$w['downs'].' 次.</span></div></div></a></div>';


//echo '</div>';

if($k_post > '10') {  echo str('?key='.$key.'&',$k_page,$page.'');  }
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>