<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';

$qid = abs(intval($_GET['qid']));
$qq = abs(intval($_GET['qq']));

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
echo '<form class="form bg-white" action="/chat/" method="post"><div><textarea rows="2" cols="30" name="text" placeholder="这里填写内容......"></textarea></div><div><input type="submit" name="add" value="发送" /></div></form>';