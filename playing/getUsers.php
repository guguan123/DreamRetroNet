<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id']));
$b = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();
if($b){
$new = $con->query("SELECT * FROM `game_download` WHERE `game_id` = '".$b['id']."' ORDER BY `id` DESC LIMIT 10");
}
//$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$new['id'].'"')->num_rows;
if ($id){
$str="";
foreach($new as $row){
$users = $con->query('SELECT * FROM `user` WHERE `id` = "'.$row['user_id'].'"')->fetch_assoc();
if($users['qq_avatar']){
$qq = ''.$users['qq_avatar'].'&s=40';
}
if($users['baidu_avatar']){
$baidu = 'https://himg.bdimg.com/sys/portrait/item/'.$users['baidu_avatar'].'';
}
if($avatar = $baidu ?: $qq){
     $rowArr = json_encode(array("id" => "".$users['id']."","nickname" => "".$users['name']."","avatar" => "".$avatar.""));
    $str=$str.$rowArr."###";
    }
}
$jsonArr=rtrim($str,"###");
echo "{\"users\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}