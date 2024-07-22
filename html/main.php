<?php
//echo '</head>';   

//include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';

//echo '<h1>'.$title.'</h1>';

include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
//echo '<div id="nav" class="container"><a href="/">续梦网</a><span>首页</span></div>';
echo '<div id="where"><a href="/">续梦网</a>首页</div><div id="middle"><div id="main">';
echo '<form action="/search" method="get"><input type="search" name="keyword" required="" placeholder="搜索游戏……"><input type="submit" value="搜索"></form>';
//echo '<h2>'.$title2.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
//include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img src="/icon/'.$w['id'].'" width="23" height="23" alt="图标" /> <div class="example_text">'.$w['name'].'<span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
//截图列表
//$ne = $con->query("select * from `file WHERE `ivent` = 1 order by rand() desc");
//$ne = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 ORDER BY `id` DESC");
//echo '<h2 class="topic bg-white">推荐</h2>';

//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$mn['id']."' ORDER BY `id` ASC LIMIT 10")->
//fetch_assoc();


echo '<div class="box"><h2 class="topic">推荐</h2>';
echo '<ul class="res">';
//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$mn['id']."' ORDER BY `id` ASC LIMIT 10")->
//fetch_assoc();
$mn = $con->query("SELECT * FROM `game` WHERE `img` = 'cover' ORDER BY RAND() limit 12");

while($ms = $mn->fetch_assoc()){
$usd = $con->query("SELECT * FROM `user` WHERE `id` = '".$ms['id_user']."' ORDER BY `id` DESC")->fetch_assoc();
//$ne = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$ms['id']."' ORDER BY RAND() limit 1")->fetch_assoc();
$ne = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$ms['id']."' ORDER BY `id` ASC limit 1")->fetch_assoc();
if ($ne['url']){
//
if($name = $ms['cn'] ?: $ms['name']){
echo '<li><a href="/game/'.$ms['id'].'"><img src="/jietu/'.$ne['id'].'" alt="截图" width="240" height="320">';
echo '<h3>'.$name.'</h3></a><footer><img src="'.avatar($usd['id']).'" width="25" height="25" alt="头像"><name>'.$usd['name'].'&nbsp;&nbsp;<i class="iconfont icon-liulanliang">&nbsp;0</i></name></footer></li>';
}
}
}
echo '</ul></div>';

echo '<div class="box"><h2 class="topic margin-top bg-white">新收录</h2>';
echo '<ul class="res">';
//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$mn['id']."' ORDER BY `id` ASC LIMIT 10")->
//fetch_assoc();
$mns = $con->query("SELECT * FROM `game` ORDER BY `id` DESC LIMIT 12");
while($mss = $mns->fetch_assoc()){
$nes = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$mss['id']."' ORDER BY `id` ASC limit 1")->fetch_assoc();
//if ($nes['url']){
//
if($name = $mss['cn'] ?: $mss['name']){
echo '<li><a href="/game/'.$mss['id'].'"><img src="/jietu/'.$nes['id'].'" alt="截图" width="320" height="240">';
echo '<h3>'.$name.'</h3></a></li>';
}
}
echo '</ul></div></div>';
//
echo '<div id="aside"><div class="box"><h2 class="topic"><a href="/v">优质小伙伴</a></h2><ul class="res">';
$ub = $con->query("SELECT * FROM `user` WHERE `vv` = '开'  ORDER BY RAND() limit 4");
while($us = $ub->fetch_assoc()){
echo '<li><a href="/games?users_id='.$us['id'].'" ><span1 class="user-img"><img class="Avatar" src="'.avatar($us['id']).'" width="46" height="46" alt="头像">';
if ($us['v'] == "黄色"){
echo '<i class="m-icon m-icon-us m-icon-yellowv"></i></span1>';
//<img  class="Avatar v" src="/style/image/V.png" width="14" height="14" alt="头像" />
}
if ($us['v'] == "蓝色"){
echo '<i class="m-icon m-icon-us m-icon-bluev"></i></span1>';
//<img  class="Avatar v" src="/style/image/V.png" width="14" height="14" alt="头像" />
}
echo '</a></li>';
}
echo '</ul></div>';

$comment = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 10");
echo '<div class="box"><h2 class="topic">评论</h2><ul class="comments">';
while($com = $comment->fetch_assoc()){
$uss = $con->query("SELECT * FROM `user` WHERE `id` = '".$com['id_user']."' ORDER BY `id` DESC")->fetch_assoc();
echo '<li><a href="/user/'.$uss['id'].'" ><span1 class="user-img">';
if ($uss['v'] == "黄色"){
echo '<i class="m-icon m-icon-uss m-icon-yellowv"></i></span1>';
//<img  class="Avatar v" src="/style/image/V.png" width="14" height="14" alt="头像" />
}
if ($uss['v'] == "蓝色"){
echo '<i class="m-icon m-icon-uss m-icon-bluev"></i></span1>';
//<img  class="Avatar v" src="/style/image/V.png" width="14" height="14" alt="头像" />
}
echo '<header>'.$uss['name'].'</a></header><div>'.$com['text'].'</div><footer>'.data($com['time']).'<a href="/game/'.$com['id_obmen'].'">对应游戏</a></footer></li>';
}
echo '</ul></div>';


echo '</div></div>';


//}
//截图列表结束
//$comment = $con->query("SELECT * FROM `comment` WHERE `id_obmen` ='{$file['id']}' ORDER BY `id` DESC LIMIT 5");
//while($comm = $comment->fetch_assoc()){
//评论
//$com = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 10");


//$ms = $con->query("SELECT * FROM `user` ORDER BY `id` DESC LIMIT $start, 10");
//while($w = $ms->fetch_assoc()){


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

echo '</div></div></div>';
?>