<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';

$pagesize = abs(intval($_GET['pagesize']));
$package = abs(intval($_GET['package'])); # 

$new = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 10");
function get_ip_city($ip)
{
    $ch = curl_init();
    $url = 'https://whois.pconline.com.cn/ipJson.jsp?ip=' . $ip;
    //用curl发送接收数据
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //请求为https
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $location = curl_exec($ch);
    curl_close($ch);
    //转码
    $location = mb_convert_encoding($location, 'utf-8', 'GB2312');
    //var_dump($location);
    //截取{}中的字符串
    $location = substr($location, strlen('({') + strpos($location, '({'), (strlen($location) - strpos($location, '})')) * (-1));
    //将截取的字符串$location中的‘，’替换成‘&’   将字符串中的‘：‘替换成‘=’
    $location = str_replace('"', "", str_replace(":", "=", str_replace(",", "&", $location)));
    //php内置函数，将处理成类似于url参数的格式的字符串  转换成数组
    parse_str($location, $ip_location);
    return $ip_location['pro'];
}
//$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$new['id'].'"')->num_rows;
if ($pagesize==10){
$str="";
foreach($new as $row){
$users = $con->query("SELECT * FROM `user` WHERE `id` = '".$row['id_user']."'")->fetch_assoc();
$arr = get_ip_city($users['ip']);
$arr=str_replace('省','',$arr);

     $rowArr = json_encode(array("id" => "".$row['id']."","content" => "".$row['text']."","users_id" => "".$row['id_user']."","avatar" => "".avatar($users['id'])."","nickname" => "".$users['name']."","games_id" => "".$row['id_obmen']."","reply_uid" => null,"reply_nickname" => null,"reply_content" => null,"dateline" => "".data($row['time'])."","pro" => "".$arr.""));
    $str=$str.$rowArr."###";

}
$jsonArr=rtrim($str,"###");
echo "{\"game\": {\"id\": \"0\",\"name\": \"水晶之链\",\"chinese\": \"\"},\"comments\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}
$gam = $con->query("SELECT * FROM `package` WHERE `id` = '".$games."'")->fetch_assoc();
//$gam = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 4");
$num = $con->query("SELECT * FROM `comment` WHERE `id_obmen` = '".$gam['id']."'");
//$comg = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 10");
//$num = $con->query("SELECT * FROM `comment` ORDER BY `id_obmen` = '".$gam['id']."' DESC LIMIT 4");
if ($gam){
$sto="";
  $ro = json_encode(array("id" => "".$gam['id']."", "name" => "".$gam['name']."", "chinese" => "".$gam['cn'].""));
     $sto=$sto.$ro."###";
$jsona=rtrim($sto,"###");
echo "{\"game\":".str_replace("###",",",$jsona).",";
$str="";
foreach($num as $row){
$users = $con->query("SELECT * FROM `user` WHERE `id` = '".$row['id_user']."'")->fetch_assoc();
$arr = get_ip_city($users['ip']);
$arr=str_replace('省','',$arr);

if($users['baidu_avatar']){
$baidu = 'https://himg.bdimg.com/sys/portrait/item/'.$users['avatar'].'';
}
$avatar = $baidu;
     $rowArr = json_encode(array("id" => "".$row['id']."","content" => "".$row['text']."","users_id" => "".$row['id_user']."","avatar" => "".$avatar."","nickname" => "".$users['name']."","games_id" => "".$row['id_obmen']."","reply_uid" => "1","reply_nickname" => "1","reply_content" => "1","dateline" => "".data($row['time'])."","pro" => "".$arr.""));
    $str=$str.$rowArr."###";
}
$jsonArr=rtrim($str,"###");
//$games = $con->query('SELECT * FROM `game` WHERE `id` = "'.$row['id_user'].'"')->num_rows;
echo "\"comments\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$f = $con->query("SELECT * FROM `package` WHERE `id` = '".$id."'")->fetch_assoc();
if($name = $f['cn'] ?: $f['name']){
$title = ''.$name.'评论';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

//if($coun_komm<1){err('<body id="notice"><h2 class="topic">消息提示</h2><p>没有评论！</p></p><p><a href="/" class="button">返回</a></p>');}
if($user['admin_level']=="禁言"){
echo '<link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>请登录之后再操作</p></body>';
exit();
}
echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
if($name = $f['cn'] ?: $f['name']){
echo '<h1>'.$name.'评论</h1></a>';
}
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
if($name = $f['cn'] ?: $f['name']){
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$name.'评论</span></div>';
}
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';

$b = $con->query("SELECT * FROM `package` WHERE `id` = '".$id."'")->fetch_assoc();
$coun_komm = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$b['id'].'"')->num_rows;
if($b){
if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '2400') $err = '文字不少于1个或超过2400个字符';

if($err){ 
err($err);
}else{
$con->query("INSERT INTO `comment` (`text`, `id_obmen`, `id_user`, `time`) VALUES ('".$text."', '".$id."', '".$user['id']."', '".time()."')");    
header('Location: ?');
}
}

if(isset($_GET['del'])){
    if($user['admin_level']=="会员" ?: $user['admin_level']=="管理员"){
    $id_k = abs(intval($_GET['id_k']));
$k = $con->query('SELECT * FROM `comment` WHERE `id` = "'.$id_k.'"')->fetch_assoc();
if($k){
$con->query("DELETE FROM `comment` WHERE `id` = '".$id_k."'");
header('Location: ?');
}
}

}

//echo '</h2><form class="form bg-white" action="" method="post"><div><textarea rows="5" cols="30" name="text" placeholder="这里填写评论内容……"></textarea></div><div><input type="submit" name="add" value="提交" /></div></form><ul class="list comment line padding bg-white" id="comment">';

//echo '</h2><form class="form bg-white" action="" method="POST"><div><textarea rows="5 cols="30" name="text" placeholder="评论="></textarea><br/>
//<input type="submit" name="add" value="评论"></form></center></div>';
if($coun_komm<1){err('<h2 class="topic">消息提示</h2><p>没有评论！</p></p><p><a href="/" class="button">返回</a></p>');}

$k_post = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
        $ms = $con->query("SELECT * FROM `comment` WHERE `id_obmen` = '".$id."' ORDER BY `id` DESC LIMIT 10");
echo '<ul class="list comment line padding bg-white" id="comment">';
  while($w = $ms->fetch_assoc()){
  echo '<li class="clearfix"><a href="/user/16835"><img src="http://q1.qlogo.cn/g?b=qq&nk=945794520&s=100" width="46" height="46" alt="头像" /></a><div><p><a href="/user/16835">'.user($w['id_user']).'</a>：'.text($w['text']).'</p>';
echo '<div class="small-font"><a href="/reply/'.$w['id'].'" class="right">回复</a>'.data($w['time']).'</div></div></li>';

     // if($user['id'] != $w['id_user']) {$ot = '<a href="/reply/'.$w['id'].'">[回复]</a>';}else{$ot = '';}
//echo '<div class="komm_news">'.user($w['id_user']).' ('.data($w['time']).')</br>
//'.text($w['text']).'</br>'.$ot.'';
if($user['admin_level']>=1) echo '<a href="?del&id_k='.$w['id'].'"> [删除] </a> <a href="comment_edit/'.$w['id'].'"> [编辑] </a>';
echo '</div>';
  }
  
  echo '<div id="aside"><div class="game clearfix bg-white"><a href="/file/'.$b['id'].'"><img src="/icon/'.$b['id'].'" width="46" height="46" alt="图标" /></a><div><h3><a href="/file/'.$b['id'].'">';
  if($name = $b['cn'] ?: $b['name']){
  echo ''.$name.'';
  }
  echo '</a></h3><div class="small-font"><a href="/games?system="></a>&nbsp;'.$b['platform'].'</a>&nbsp;'.$b['downs'].'下载&nbsp;';
//  }
  $number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
  echo ''.$number.'评论</div></div></div>';

  if($k_post > '10') {  echo str('?',$k_page,$page.'');  }

}else{

    err('Ошибка');
}


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>



