<?php
$hot = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 AND `downs` > 2 ORDER BY `downs` DESC LIMIT 10");
echo '<div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>
<a href="/">
<img src="/favicon.ico" width="32" height="32" alt="续梦网logo" />';
echo '<h1>'.$title2.'</h1><p>续写怀旧游戏新篇章，重温旧梦</p></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav"><a href="/">首页</a><span>首页</span></div>';
echo '<div class="clearfix"><main class="container"><div id="main">';


//echo '<div class="chk_red">
//<span class="title_chk_red">热门</span><div class="block">';


//while($w = $hot->fetch_assoc()){

//echo '<div class="link_game"><a href="/file/'.$w['id'].'"> <div class="example3">
//<img src="/icon/'.$w['id'].'" width="23" height="23" alt="图标" /> <div class="example_text">'.$w['name'].'<span><i class="fas fa-file-download ic"></i> 下载: '.$w['downs'].' 次.</span></div></div></a></div>';
//截图列表
//$ne = $con->query("select * from `file WHERE `ivent` = 1 order by rand() desc");
$ne = $con->query("SELECT * FROM `file` WHERE id >= (SELECT floor( RAND() * ((SELECT MAX(id) FROM `file`)-(SELECT MIN(id) FROM `file`)) + (SELECT MIN(id) FROM `file`)))  ORDER BY id desc");
//$ne = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 ORDER BY `id` DESC");
echo '<h2 class="topic bg-white">推荐</h2>';
echo '<div class="covers240 bg-white">';
while($mn = $ne->fetch_assoc()){
//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$mn['id']."' ORDER BY `id` ASC LIMIT 10")->
//fetch_assoc();
$ms = $con->query("SELECT * FROM `image` WHERE id >= (SELECT floor( RAND() * ((SELECT MAX(id) FROM `image`)-(SELECT MIN(id) FROM `image`)) + (SELECT MIN(id) FROM `image`))) and `id_file` = '".$mn['id']."' ORDER BY `id` DESC  LIMIT 10")->fetch_assoc();
if ($ms['id_file']){
//
echo '<a href="/file/'.$ms['id_file'].'"><img src="/down/images/'.$ms['url'].'" width="150" height="199" alt="截图" />';
if($name = $mn['zhcn'] ?: $mn['name']){
echo '<span>'.$name.'</span></a>';
}
}
}
echo '</div>';
//}
//截图列表结束
//$comment = $con->query("SELECT * FROM `comment` WHERE `id_obmen` ='{$file['id']}' ORDER BY `id` DESC LIMIT 5");
//while($comm = $comment->fetch_assoc()){
$com = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 10");
echo '<h2 class="topic bg-white">新评论</h2>';
echo '<ul class="list comment line padding bg-white" id="comment">';
while($c = $com->fetch_assoc()){
//<ul class="list comment line pad
echo '<li class="clearfix">
'.user($c['id_user']).'</a>'.text($c['text']).'</p>';
$mc = $con->query("SELECT * FROM `file` WHERE `id` = '".$c['id_obmen']."' ORDER BY `id` DESC");
while($cs = $mc->fetch_assoc()){
echo '<a href="file/'.$cs['id'].'">
<img src="/icon/'.$cs['id'].'" width="23" height="23" alt="图标" />';
if($name = $cs['zhcn'] ?: $cs['name']){
echo ''.$name.'</a>';
}
echo '<div class="small-font"><a href="/comments/reply/3079" class="right">回复</a>'.data($c['time']).'</div></li>';
}
}
echo '</ul></div>';


//$ms = $con->query("SELECT * FROM `user` ORDER BY `id` DESC LIMIT $start, 10");
//while($w = $ms->fetch_assoc()){
$users = $con->query("SELECT * FROM `user` ORDER BY `id` DESC LIMIT 30");
echo '<div id="aside">
<h2 class="topic margin-top bg-white">
<a href="/reg" class="right">我要加入</a>'.$users->num_rows.'位老铁</h2>
<div class="faces bg-white">';
while($n = $users->fetch_assoc()){
echo '<a href="/info/'.$n['id'].'">';
if ($n['baidu_pic']){
echo '<span class="user-img"><img class="Avatar" src="http://tb.himg.baidu.com/sys/portraitn/item/'.$n['baidu_pic'].'" alt="头像" width="24" height="24"></img>';
if ($n['v']>=1){
echo '<i class="m-icon m-icon-user m-icon-yellowv"></i></span>';
}
echo '</a>';
}
if ($n['qq']){
echo '<span class="user-img"><img class="Avatar" src="http://thirdqq.qlogo.cn/g?b=oidb&amp;nk='.$n['qq'].'&amp;s=40&amp;t='.$n['time'].'" alt="头像" width="24" height="24"></img>';
if ($n['v']>=1){
echo '<i class="m-icon m-icon-user m-icon-yellowv"></i></span>';
}
echo '</a>';
}
}
echo '</div>';
//while($comm = $comment->fetch_assoc()){
//echo '<h2 class="topic bg-white">新评论</h2><ul class="list comment line padding bg-white" id="comment">';
//echo '<li class="clearfix"><a href="/user/8220"><img src="https://himg.bdimg.com/sys/portraitn/item/5685706f73746261727573657273a259" width="46" height="46" alt="头像" /></a><div><p><a href="/user/8220">'.user($comm['id_user']).'</a>：'.text($comm['text']).'</p><div class="small-font"><a href="/comments/reply/2912" class="right">回复</a>1小时前</div></div></li>';
//echo '</ul></div>';
//}
//$me = $con->query("SELECT * FROM `user_file` WHERE `id` ORDER BY `id` DESC")->fetch_assoc();
//$y = $con->query("SELECT * FROM `file` WHERE `id` = '".$me['id_file']."' ORDER BY `id` DESC  LIMIT 10");
//echo '<h2 class="topic margin-top top-white">小伙伴们在玩</a></h2>';
//while($yy = $y->fetch_assoc()){
//echo '<ul class="list icon small line c">';

//echo '<li><a href="file/'.$yy['id'].'"><img src="/icon/'.$yy['id'].'" width="45" height="45" alt="图标" />';
//if($name = $yy['zhcn'] ?: $yy['name']){
//echo ''.$name.'</a>';
//}
//echo '</li>';
//}
//echo '</ul></div>';
$new = $con->query("SELECT * FROM `file` WHERE `ivent` = 1 ORDER BY `id` DESC LIMIT 10");
echo '<h2 class="topic margin-top bg-white"><a href="/games?order=id">新收录</a></h2>';
echo '<ul class="list icon small line1 bg-white">';
while($w = $new->fetch_assoc()){
echo '<li><a href="file/'.$w['id'].'"><img src="/icon/'.$w['id'].'" width="45" height="45" alt="图标" />';
if($name = $w['zhcn'] ?: $w['name']){
echo ''.$name.'</a>';
}
echo '</li>';
}
echo '</ul>';
echo '<h2 class="topic margin-top bg-white"><a href="/games">TOP10</a></h2>';
echo '<ul class="list small  icon line1 bg-white">';

while($w = $hot->fetch_assoc()){
echo '<li><a href="file/'.$w['id'].'">
<img src="/icon/'.$w['id'].'" width="45" height="45" alt="图标" />';
if($name = $w['zhcn'] ?: $w['name']){
echo ''.$name.'</a>';
}
echo '</li>';
}
echo '</ul>';
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

echo '</div></main>';
?>