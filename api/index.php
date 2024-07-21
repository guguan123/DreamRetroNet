<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/config/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/config/system.php';

$pagesize = abs(intval($_GET['pagesize']));
$games = abs(intval($_GET['games'])); # 

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

if ($users['baidu_avatar']){
$baidu = 'https://himg.bdimg.com/sys/portrait/item/'.$users['baidu_avatar'].'';
}
$avatar = $baidu;
     $rowArr = json_encode(array("id" => "".$row['id']."","content" => "".$row['text']."","users_id" => "".$row['id_user']."","avatar" => "".$avatar."","nickname" => "".$users['name']."","games_id" => "".$row['id_obmen']."","reply_uid" => null,"reply_nickname" => null,"reply_content" => null,"dateline" => "".data($row['time'])."","pro" => "".$arr.""));
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