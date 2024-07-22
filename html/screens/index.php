<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
$id = abs(intval($_GET['id']));
//$games = abs(intval($_GET['games'])); # 
//$new = $con->query("SELECT * FROM `games` ORDER BY `id` DESC");
$gam = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();
//$gam = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 4");
$new = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$gam['id']."'");
//$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$new['id'].'"')->num_rows;
if ($gam){
$str="";
foreach($new as $row){
//$users = $con->query("SELECT * FROM `user` WHERE `id` = '".$row['id_user']."'")->fetch_assoc();
     $rowArr = json_encode(array("id" => "".$row['id']."","game_id" => "".$row['id_game']."","resolution" => "240x320"));
    $str=$str.$rowArr."###";
}
$jsonArr=rtrim($str,"###");
echo "{\"screens\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}

$title = '截图';

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

//echo '<body class="subpage"><header><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="返回"></a>';
//echo '<h2>'.$title.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a>';
echo '<span>'.$title.'</span></div>';
echo '<main class="container"><div class="area"><form action="#delScreen">';
echo '<ul class="screens">';
$scr = $con->query("SELECT * FROM `image` ORDER BY `id` DESC LIMIT 15");
 while($w = $scr->fetch_assoc()){
echo '<li><img src="/M/s/'.$w['url'].'" data-games_id="1" /><span>240×320</span><a href="/screens/delete/'.$w['id'].'"></a><input type="checkbox" name="screen'.$w['id'].'" value="'.$w['id'].'" /></li>';
}
echo '</ul>';
echo '<input type="submit" value="批量删除" /></form>';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>



