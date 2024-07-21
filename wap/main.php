<?php
echo '</head><body>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
$qiqi = filter_var($_GET['qiqi']);
$iniche = filter_var($_GET['iniche']);
$jvgm = filter_var($_GET['jvgm']);
$nkey = filter_var($_GET['nkey']);
if ($qiqi == "本站搜索"){
header('Location: /search?keyword='.$nkey.'');
}
if ($iniche == "小众搜索"){
header('location: //wap.iniche.cn/search?keyword='.$nkey.'');
}
if ($jvgm == "乐园搜索"){
header('location: //jvgm.cn/search?key='.$nkey.'');
}

echo '<br><a href="#">设置机型</a> <a href="#">书签</a>
<br><img src="/M/o/m.png">
<br><a href="/games">游戏</a> <a href="/search">搜索</a>';
echo '<form action="/jump" method="get">

<input type="text" name="q" placeholder="输入号码">

<select name="system">

<option value="game">本站</option>

<option value="iniche">小众</option>

<option value="jvgm">乐园</option>

</select>

<input type="submit" value="搜索">

</form>

<form action="" method="GET">
  <input type="text" size="23" name="nkey" value=""  placeholder="输入游戏软件"><br/>
  <input type="submit" name="qiqi" value="本站搜索">
  <input type="submit" name="iniche" value="小众搜索">
  <input type="submit" name="jvgm" value="乐园搜索">
  </form>
';

echo '<br><a href="/chat">在线聊天室</a>';
$ch = $con->query("SELECT * FROM `chat` WHERE `id` ORDER BY `id` DESC limit 5");
while($c = $ch->fetch_assoc()){
$users = $con->query("SELECT * FROM `user` WHERE `id` = '".$c['user_id']."'")->fetch_assoc();
  echo '<br><a href="/user/'.$c['user_id'].'">'.$users['name'].'</a><br>'.$c['text'].'<br>'.data($c['time']).' 
 ';
echo ' <a href="/reply/'.$c['id'].'">回复</a>';
}

$comm = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 5");
echo '<br>评论';
while($w = $comm->fetch_assoc()){
$users = $con->query("SELECT * FROM `user` WHERE `id` = '".$w['id_user']."'")->fetch_assoc();
$pack = $con->query('SELECT * FROM `game` WHERE `id` = "'.$w['id_obmen'].'"')->fetch_assoc();

echo '<br><a href="/user/'.$w['id_user'].'">'.$users['name'].'</a><br>'.$w['text'].'<br>'.data($w['time']).' <a href="/game/'.$w['id_obmen'].'">查看游戏</a>';
}
$new = $con->query("SELECT * FROM `game` ORDER BY `id` DESC LIMIT 5");
while($w = $new->fetch_assoc()){
$mu = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$w['id']."' ORDER BY `id` ASC limit 1")->fetch_assoc();
if($mu > 0){
$image = $mu['id'];
}else{
$image = '0';
}
echo '<br><a href="/game/'.$w['id'].'"><img src="/jietu/'.$image.'" width="80" height="80">';
if($name = $w['cn'] ?: $w['name']){
echo ''.$name.'</a>';
}
}
//echo '</ul>';

?>