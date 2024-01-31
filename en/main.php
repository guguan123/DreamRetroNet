<?php
echo '<meta name="applicable-device" content="pc,mobile" /><meta itemprop="name" content="ContinuedMontenet：Treasure the soon-to-be-lost feature machine JAVA game software" />
<meta name="KeyWords" content="Nokia, Sony Ericsson, nostalgic games, feature machine games, Symbian games, java games, java games Android emulator, code farmer Li Bai, Symbian games, java app store">
<meta name="description" content="Code Farmer Li BaiContinuedMontenet Here you can download all the Saipan JAVA games recommended in Li Bai s videos and live broadcasts, as well as an easy-to-use Android Saipan JAVA game simulator。">';
echo '<body class=""><header><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="返回"></a>';
echo '<h2>'.$title2.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/en/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">Home</a><span>Home</span></div>';
echo '<main class="container"><div id="main">';


//echo '<div class="chk_red">
//<span class="title_chk_red">热门</span><div class="block">';


//while($w = $hot->fetch_assoc()){

//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img src="/icon/'.$w['id'].'" width="23" height="23" alt="图标" /> <div class="example_text">'.$w['name'].'<span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
//截图列表
//$ne = $con->query("select * from `file WHERE `ivent` = 1 order by rand() desc");
$ne = $con->query("SELECT * FROM `image` ORDER BY RAND() LIMIT 12");
//$ne = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 ORDER BY `id` DESC");
//echo '<h2 class="topic bg-white">推荐</h2>';
echo '<div class="covers240">';
while($ms = $ne->fetch_assoc()){
//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$mn['id']."' ORDER BY `id` ASC LIMIT 10")->
//fetch_assoc();
$mn = $con->query("SELECT * FROM `game` WHERE `id` = '".$ms['id_game']."' ORDER BY RAND()")->fetch_assoc();
if ($ms['id_game']){
//
if($name = $mn['cn'] ?: $mn['name']){
echo '<a href="/game/'.$ms['id_game'].'"><img src="/M/s/'.$ms['url'].'" width="150" height="199" alt="'.$name.'截图" />';
echo '<span>'.$name.'</span></a>';
}
}
}
echo '</div>';
//}
//截图列表结束
//$comment = $con->query("SELECT * FROM `comment` WHERE `id_obmen` ='{$file['id']}' ORDER BY `id` DESC LIMIT 5");
//while($comm = $comment->fetch_assoc()){
//评论
//$com = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 10");
//玩家观点
echo '<h2 class="topic margin-top">view</h2><ul data-url="/comments?pagesize=10" data-tpl="commentlist"></ul></div>';


//$ms = $con->query("SELECT * FROM `user` ORDER BY `id` DESC LIMIT $start, 10");
//while($w = $ms->fetch_assoc()){
$users = $con->query("SELECT * FROM `user` ORDER BY `id` DESC");
//用户列表
echo '<div id="aside">
<h2 class="topic">
<a href="/register" class="right">I want to join</a>'.$users->num_rows.'-bit friends</h2>
<div data-url="/users?pagesize=30" data-tpl="facewall"></div>';
//列表
echo '<h2 class="topic margin-top"><a href="/games/upload" class="right">I want to upload </a><a href="/games/order=id">a new recording</a></h2><ul data-url="/games/order=id?pagesize=10" data-tpl="gamesimple"></ul>';

echo '<h2 class="topic margin-top"><a href="/games?order=id">TOP10</a></h2><ul data-url="/games?order=id&amp;top=10" data-tpl="gamesimple"></ul></div></main>';


//echo '
//<span class="title_chk_red">最新</span><div class="block">';
//while($w = $new->fetch_assoc()){

//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
//}
//echo'</div>';
//$up = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 ORDER BY `id` DESC LIMIT 12");
//echo '
//<span class="title_chk_red">推荐</span><div class="block">';
//while($w = $up->fetch_assoc()){
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$w['id'].'"> <div class="example_text"><h6>'.$w['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
//}

//echo '</div></main>';
?>