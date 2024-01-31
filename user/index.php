<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
include "../M/c/function.php";
if(isset($_GET["local"])){
  $_SESSION["language"] = $_GET["local"];
}else{
  $_SESSION["language"] = getDefalutlanguage();
}
$language_name = getLanguageName($_SESSION["language"]);
if (!$language_name){
echo '<link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>我们没有找到语言包</p></body>';
exit();
}else{
include "../M/e/".$language_name.".inc";
}

  $language_array = array_language();
  foreach($language_array as $key => $value){
    if($_SESSION["language"] == $value){
      $selected = "selected = 'selected' ";
    }else{
      $selected = "";
    }
    }

  if($_GET["local"] == $value){
      //$selected = "selected = 'selected' ";
    }
    include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
echo $header;
?>

<meta itemprop="name" content="<?php $title ?>" />

<?php
$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc();
$f = $con->query("SELECT * FROM `game` WHERE `id_user` = '".$use['id']."'")->fetch_assoc();

$title = ''.$use['name'].'';
echo '<title>'.$title.'</title>';
echo '</head>'; 
echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="'.$exit.'"></a>';

echo '<h1>'.$title.'</h1><a href="/"><img src="/favicon.ico" width="32" height="32" alt="'.$title2.'logo" /><h1>'.$title2.'</h1>';

include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">'.$zhuye.'</a><span>'.$title.'</span></div>';

echo '<main class="container"><div id="main">';


//$arr_pol = array('1' => '♂', '2' => '♀');
//$arr_adm = array('' => '用户', '1' => '版主', '2' => '管理员', '3' => '<font color="red">创始人</font>', '4' => '禁言');

if($use['up_time']+300 > time()){
$on_off = ''.$line.''; 
}else{
$on_off = ''.$lines.''; 
}


if($use){
//echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a><h1>'.$use['name'].'</h1><div id="user">'
$file = $con->query("SELECT * FROM `game` WHERE `id_user` = '".$id."' ORDER BY `id` DESC LIMIT 10");
//if($use['id']==$f['id_user']){
if($name = $use['name'] ?: $use['login']){
echo '<h2 class="topic"><a href="/games?users_id='.$use['id'].''.$local2.'" class="right">'.$more.'</a>'.$name.''.$upload_user.'</h2>';
}
echo '<ul class="games">';
while($u = $file->fetch_assoc()){
if($name = $u['cn'] ?: $u['name']){
echo '<li><a href="/game/'.$u['id'].''.$local1.'"><img src="/M/i/'.$u['icon'].'" width="46" height="46" alt="'.$name.''.$icons.'" /></a><div>';
echo '<h3><a href="/game/'.$u['id'].''.$local1.'">'.$name.'</a></h3><div>';
}
echo '<span>'.$u['platform'].'</span><span>'.$u['id_raz'].'</span><span>'.$u['downs'].' '.$download_num.'</span>';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$u['id'].'"')->num_rows;
echo '<span>'.$number.' '.$number_num.'</span></div></div></li>';
}
echo '</ul>';

$dow = $con->query("SELECT * FROM `game` ORDER BY `id` DESC");
if($name = $use['name'] ?: $use['login']){
echo '<h2 class="topic">'.$name.''.$download_user.'</h2>';
}
echo '<ul class="games">';
while($do = $dow->fetch_assoc()){
$down = $con->query("SELECT * FROM `game_download` WHERE `game_id` = '".$do['id']."' AND `user_id` = '".$id."' ORDER BY `id` DESC LIMIT 10");
while($download = $down->fetch_assoc()){
if($name = $do['cn'] ?: $do['name']){
echo '<li><a href="/game/'.$do['id'].''.$local1.'"><img src="/M/i/'.$do['icon'].'" width="46" height="46" alt="'.$name.''.$icons.'" /></a><div>';
echo '<h3><a href="/game/'.$do['id'].''.$local1.'">'.$name.'</a></h3><div>';
}
echo '<span>'.$do['platform'].'</span><span>'.$download_num.'：'.$download['downs'].'</span></div></div></li>';
}
}
echo '</ul></div>';
//$uw = $con->query("SELECT * FROM `file` WHERE `id_user` = "'.$id.'" ORDER BY `id` DESC");
	
/**
 *$ip  string  必传
 *获取ip归属地
 *demo 四川省成都市 电信
 */
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
$uw = $con->query("SELECT * FROM `game` WHERE `id_user` = '".$id."' ORDER BY `id` DESC");
$uc = $con->query("SELECT * FROM `comment` WHERE `id_user` = '".$id."' ORDER BY `id` DESC");
if($use['qq_avatar']){
$qq = ''.$use['qq_avatar'].'&s=100&t='.$use['up_time'].'';
}
if($use['baidu_avatar']){
$baidu = 'https://himg.bdimg.com/sys/portrait/item/'.$use['baidu_avatar'].'';
    }
if ($avatar = $qq ?: $baidu){
if($name = $use['name'] ?: $use['login']){
echo '<div id="aside"><div class="info"><img src="'.$avatar.'" alt="头像" width="180" height="180" /><h2 class="'.$use['pol'].'">'.$name.'</h2>';
}
}
echo '<ul class="list list1">';
echo '<li>UID：'.$use['id'].'</li>';
$str = get_ip_city($use['ip']);
$str=str_replace('省','',$str);
echo '<li>'.$ip_s.'：'.$str.'</li>';
echo '<li>'.$onine.'：'.$on_off.'</li>';
echo '<li>'.$reg.'：'.data($use['data_reg']).'</li>';
echo '<li>'.$upload_games.'：'.$uw->num_rows.'</li>';
echo '<li>'.$download_nums.'：'.$use['downs'].'</li>';
echo '<li>'.$comments_user.'：'.$uc->num_rows.'</li>';
//echo '<li>封号大礼包：'.fh($use['fh']).'</li>';
echo '</ul></div>';
if($user['id']==$use['id']){
echo '<h2 class="topic margin-top">'.$use['admin_level'].''.$admin_user.'</h2>';
echo '<ul class="list list2">';
echo '<li><a href="/user/logout'.$local1.'" >'.$logouts.'</li>';
echo '<li><a href="/games/upload'.$local1.'" >'.$upload_games.'</li>';
echo '<li>'.$group.'：'.$use['admin_level'].'</li>';
echo '<li><a href="/log_login'.$local1.'">'.$login_num.'</li>';
//echo '<li><a href="/user/edit" >修改资料</li>';
//echo '<li><a href="/user/edit/pic" >修改头像</li>';
//echo '<li><a href="/user/edit/password" >修改密码</li>';
}
echo '</ul></div></main>';
//echo '<div class="link"><b>用户名</b> : '.$use['login'].'</div>';
//echo '<div class="link"><b>昵称</b> : '.$use['name'].'</div>';
//echo '<div class="link"><b>ID</b> : '.$use['id'].'</div>';
//echo '<div class="link"><b>性别</b> : '.$arr_pol{$use['pol']}.'</div>';
//echo '<div class="link"><b>注册时间</b> : '.data($use['data_reg']).'</div>';
//echo '<div class="link"><b>用户等级</b> : '.$arr_adm{$use['admin_level']}.'</div>';
//echo '<div class="link"><b>最近登录</b> : '.data($use['up_time']).'</div>';
}else{
//err('Ошибка');
}
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>