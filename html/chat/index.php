<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/system/base.php';
  include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
$title = '在线聊天室';
  echo '<title>'.$title.'</title>';
echo '<body class="subpage"><header><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="返回"></a>';
echo '<h2>'.$title.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><a href="/games">列表</a>';
echo '<span>'.$name.'</span></div>';
echo '<main class="container"><div id="main">';
if(isset($_POST['add'])){
aut();
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '2400') $err = '文字不少于1个或超过2400个字符';

if($err){ 
err($err);
}else{
$con->query("INSERT INTO `chat` (`text`, `user_id`, `time`) VALUES ('".$text."', '".$user['id']."', '".time()."')");    
header('Location: ?');
}
}

if(isset($_GET['del'])){
aut();
    if($user['admin_level']=="会员"){
    $id_k = abs(intval($_GET['id_k']));
$k = $con->query('SELECT * FROM `chat` WHERE `id` = "'.$id_k.'"')->fetch_assoc();
if($k){
$con->query("DELETE FROM `chat` WHERE `id` = '".$id_k."'");
header('Location: ?');
}
}

}
$users = $con->query("SELECT * FROM `user`  WHERE `up_time` = '".time()."' ORDER BY `id` DESC");
if($users+300 > time()){
$on_off = '在线'; 
}else{
$on_off = '离线'; 
}
echo '<h2 class="topic bg-white"><a href="/online" class="right">在线'.$users->num_rows.'人</a>在线聊天室</h2>';
echo '<form class="form bg-white" action="/chat" method="post"><div><textarea rows="2" cols="30" name="text" placeholder="这里填写内容......"></textarea></div><div><input type="submit" name="add" value="发送" /></div></form>';

$ms = $con->query("SELECT * FROM `chat` WHERE `id` ORDER BY `id` DESC");
echo '<ul class="list comment line padding bg-white" id="comment">';
while($w = $ms->fetch_assoc()){
  echo '<li class="clearfix">'.cuser($w['user_id']).'</a>'.text($w['text']).'</p>';
echo '<div class="small-font"><a href="/reply/'.$w['id'].'" class="right">回复</a>'.data($w['time']).'</div></div></li>';

     // if($user['id'] != $w['id_user']) {$ot = '<a href="/reply/'.$w['id'].'">[回复]</a>';}else{$ot = '';}
//echo '<div class="komm_news">'.user($w['id_user']).' ('.data($w['time']).')</br>
//'.text($w['text']).'</br>'.$ot.'';
//if($user['admin_level']>=1) echo '<a href="?del&id_k='.$w['id'].'"> [删除] </a> <a href="comment_edit/'.$w['id'].'"> [编辑] </a>';
}
echo '</div>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/foot.php';
