<?php
date_default_timezone_set("Asia/Shanghai");

function qu($qid) { # Если НЕ авторизирован
	global $qun; 
	//if($qun['qid']==$qid){
echo '<title>消息提示</title><link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>网站维护中......</p></body>';
exit();

}

function name($id_user){ // ФУНКЦИЯ ПОЛЬЗОВАТЕЛЯ

	global $con;
$id_user = intval($id_user);
	$us = $con->query("SELECT * FROM `user` WHERE `id` = '".$id_user."' LIMIT 1")->fetch_assoc();
	if ($us['baidu_pic']){ $pic  = '<span class="user-img"><img class="Avatar" src="http://tb.himg.baidu.com/sys/portraitn/item/'.$us['baidu_pic'].'" alt="头像" width="24" height="24"></img>'; }
	if ($us['github_avatar']){ $pic  = '<span class="user-img"><img class="Avatar" src="'.$us['github_avatar'].'" alt="头像" width="24" height="24"></img>'; }
	if ($us['pic']>=0){ $pic  = '<span class="user-img"><img class="Avatar" src="/M/u/'.$us['pic'].'" alt="头像" width="24" height="24"></img>'; }
	if ($us['pic']==0){ $pic  = '<span class="user-img"><img class="Avatar" src="/M/guest.png" alt="头像" width="24" height="24"></img>'; }
	if ($us['v']==0){ $v  = ''; }
	if ($us['v']>=1){ $v  = '<i class="m-icon m-icon-us m-icon-yellowv"></i></span>'; }
	return (empty($us)?'System':' <a href="/user/'.$us['id'].'" class="right" ">'.$pic.' '.$v.'</a>');
	}
	function avatar1($id_user){ 
	global $con;
$pic = intval($pic);
	$pics = $con->query("SELECT * FROM `user` WHERE `id` = '".$id_user."' LIMIT 1")->fetch_assoc();
	//$new = $con->query("SELECT * FROM `user` ORDER BY `id` DESC");
	if ($pics['qq_avatar']){$pic = ''.$pics['qq_avatar'].'&s=40'; }
	if ($pics['baidu_avatar']){$pic = 'https://himg.bdimg.com/sys/portrait/item/'.$pics['baidu_avatar'].'';}
	if ($pics['github_avatar']){$pic = ''.$pics['github_avatar'].''; }
return (empty($pics)?'system':''.$pic.'" ,');
}

	function uname($id_user){ 
	global $con;
$id_user = intval($id_user);
	$UID = $con->query("SELECT * FROM `user` WHERE `id`  = '".$id_user."'  LIMIT 1")->fetch_assoc();
	if($uname = $UID['name'] ?: $UID['login']){
	return (empty($UID)?'system':'"UID":"'.$uname.'分享" ,');
	}
	}
	
	function avatar($id){ 
	global $con;
$pic = intval($pic);
	$pics = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."' LIMIT 1")->fetch_assoc();
	//$new = $con->query("SELECT * FROM `user` ORDER BY `id` DESC");
	if ($pics['avatar']){$pic = '/M/u/'.$pics['avatar'].''; }else{$pic = '/M/guest.png';}
	if ($pics['baidu_avatar']){$pic = 'https://himg.bdimg.com/sys/portrait/item/'.$pics['baidu_avatar'].'';}
	if ($pics['github_avatar']){$pic = ''.$pics['github_avatar'].'';}
return (empty($pics)?'system':''.$pic.'" ,');
}
	
	
	$sett = $con->query("SELECT * FROM `settings` WHERE `id` = '1'")->fetch_assoc(); // НАСТРОЙКИ САЙТА


# Проверка на авторизацию

if(isset($_COOKIE['mail'])  && isset($_COOKIE['pass']))
//if(isset($_COOKIE['baidu_id']))  
{
$user = $con->query("SELECT * FROM `user` WHERE `qq` = '".htmlspecialchars($_COOKIE['mail'])."' && `pass` = '".htmlspecialchars($_COOKIE['pass'])."' LIMIT 1")->fetch_assoc();
}
if(isset($_COOKIE['BAEID'])){
$user = $con->query("SELECT * FROM `user` WHERE `qq` = '".htmlspecialchars($_COOKIE['BAEID'])."' or `baidu` = '".htmlspecialchars($_COOKIE['BAEID'])."' or `github` = '".htmlspecialchars($_COOKIE['BAEID'])."'  LIMIT 1")->fetch_assoc();
}
//$user = $con->query("SELECT * FROM `user` WHERE `baidu` = '".htmlspecialchars($_COOKIE['BAEID'])."' LIMIT 1")->fetch_assoc();


function filtr($text_filter)
{
    global $con;
    $text_filter = htmlspecialchars(trim($text_filter), ENT_QUOTES, 'UTF-8');
    $text_filter = $con->real_escape_string($text_filter);
    return $text_filter;
}



function bb_code($text){
$text = stripslashes($text);
$text = preg_replace('#\[cit\](.*?)\[/cit\]#si', '<div class="cit">\1</div>',$text);
$text = preg_replace('#\[b\](.*?)\[/b\]#si', '\1</a>：',$text);
$text = preg_replace('/\[url\s?=\s?([\'"]?)(?:http:\/\/)?(.*?)\1\](.*?)\[\/url\]/', ' <a href="http://$2"> $3 </a> ', $text);
$text = preg_replace('#\[black\](.*?)\[\/black\]#si', '<span style="color:#000000;">\1</span>', $text);
$text = preg_replace('#\[i\](.*?)\[\/i\]#si', '<i>\1</i>', $text);
$text = preg_replace('#\[u\](.*?)\[\/u\]#si', '<u>\1</u>', $text);
$text = preg_replace('#\[s\](.*?)\[\/s\]#si', '<s>\1</s>', $text);
return $text; 
}

function fh1() { # Если авторизирован
	global $user; 
if(!$user['fh']==1){
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>抱歉，你的封号大礼包已发放。</p>';
exit();
}
}

function upload() { # Если НЕ авторизирован
	global $con;
	if($file){ 
//$id = intval($id);
	//$fid = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."' LIMIT 1")->fetch_assoc();
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>安装包上传成功。</p>';
//return (empty($fid)?'</p><p><a href="/file/'.$fid['id'].'" class="button">返回</a></p>');
echo '</p><p><a href="/file/'.$fid['id'].'" class="button">返回</a></p>';
exit();
}
}

function no_upload() { # Если НЕ авторизирован
	global $file; 
if($file){
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>提交成功 应用审核中
我们将在24小时内审核结果</p>';
echo '</p><p><a href="#back" class="button">返回</a></p>';
exit();
}
}

function add_upload() { # Если НЕ авторизирован
	global $files; 
if($files){
//$f = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."' LIMIT 1")->fetch_assoc();
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>安装包上传成功。</p>';
echo '</p><p><a href="/file/'.$id.'" class="button">返回</a></p>';
exit();
}
}

function aut() { # Если авторизирован
	global $user; 
if(!$user){
echo '<link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>请登录之后再操作。</p>';
exit();
}
}

function uphold() { # Если НЕ авторизирован
	global $sett; 
if($sett['uphold']==1){
echo '<title>消息提示</title><link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>网站维护中......</p></body>';
exit();
}
}


$SITE = 'http://'.$_SERVER['HTTP_HOST'];


function ok($ok_text){

echo '<div class="ok"> '.$ok_text.' </div>';

}

function err($err_text){

echo '<div class="error"> '.$err_text.' </div>';

}


# ВЫВОД ВРЕМЕНИ

function  data($time=NULL){ 
    if ($time == NULL)$time = time(); 
    $timep="".date("Y-m-d  H:i", $time).""; 
    $time_p[0]=date("Y-m-d", $time); 
    $time_p[1]=date("H:i", $time); 
     
    if ($time_p[0] == date("j n Y"))$timep = date("H:i:s", $time); 
    if ($time_p[0] == date("j n Y", time()-60*60*24))$timep = "Вчера в $time_p[1]"; 
     
    return $timep; 
}

 if (!empty($_SERVER['HTTP_CLIENT_IP']))
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
if ($user) { // ОНЛАЙН
	global $con;
$con->query("UPDATE `user` SET `up_time` = '".time()."',`ip` = '".$ip."' WHERE `id` = '".$user['id']."'");
}


############################################
####     НАВИГАЦИЯ НЕЧЕГО НЕ ТРОГАТЬ    ####
############################################


function user($id_user){ // ФУНКЦИЯ ПОЛЬЗОВАТЕЛЯ

	global $con;
$id_user = intval($id_user);
	$us = $con->query("SELECT * FROM `user` WHERE `id` = '".$id_user."' LIMIT 1")->fetch_assoc();


if($us['up_time']+300 > time()){
$on_off = '<img src="/style/image/on_user.png" width="9px">'; 
}else{
$on_off = ''; 
}

if($us['admin_level'] == '0'){ $dol  = ''; }
	elseif($us['admin_level'] == '1'){ $dol = '<font color="green">[版主]</font>'; }
	elseif($us['admin_level'] == '2'){ $dol = '<font color="red">[管理员]</font>'; }
	elseif($us['admin_level'] == '3'){ $dol = '<font color="blue">[创始人]</font>'; }
	elseif($us['admin_level'] == '4'){ $dol = '<font color="blue">禁言</font>'; }
	
	if ($us['v']==0){ $v  = ''; }
	if ($us['v']>=1){ $v  = '<i class="m-icon m-icon-comment m-icon-yellowv"></i></span>'; }
	

return (empty($us)?'System':' <a href="/info/'.$us['id'].'"><span class="user-img"><img class="Avatar" src="http://thirdqq.qlogo.cn/g?b=oidb&amp;nk='.$us['qq'].'&amp;s=40&amp;t='.$us['up_time'].'" width="24" height="24" alt="头像" />'.$v.'</a><div><p><a href="/info/'.$us['id'].'">'.$us['name'].''.$on_off.''.$dol.'</p><div class="quote small-font"><a href="/info/'.$us['id'].'"></a>');
}



function cuser($id_user){ // ФУНКЦИЯ ПОЛЬЗОВАТЕЛЯ

	global $con;
$id_user = intval($id_user);
	$us = $con->query("SELECT * FROM `user` WHERE `id` = '".$id_user."' LIMIT 1")->fetch_assoc();


if($us['up_time']+300 > time()){
$on_off = '<img src="/style/image/on_user.png" width="9px">'; 
}else{
$on_off = ''; 
}

if($us['admin_level'] == '0'){ $dol  = ''; }
	elseif($us['admin_level'] == '1'){ $dol = '<font color="green">[版主]</font>'; }
	elseif($us['admin_level'] == '2'){ $dol = '<font color="red">[管理员]</font>'; }
	elseif($us['admin_level'] == '3'){ $dol = '<font color="blue">[创始人]</font>'; }
	elseif($us['admin_level'] == '4'){ $dol = '<font color="blue">禁言</font>'; }
	
	if ($us['v']==0){ $v  = ''; }
	if ($us['v']>=1){ $v  = '<i class="m-icon m-icon-comment m-icon-yellowv"></i></span>'; }
	

return (empty($us)?'System':' <a href="/user/'.$us['id'].'"><span class="user-img"><img class="Avatar" src="'.avatar($us['id']).'" width="24" height="24" alt="头像" />'.$v.'</a><div><p><a href="/user/'.$us['id'].'">'.$us['name'].''.$on_off.''.$dol.'');
}

//<div class="quote small-font"><a href="/info/'.$us['id'].'"> '.$on_off.' '.$dol.'


function text($text){

$text =  bb_code(nl2br($text));

return $text;
}


###################################
#####   УДАЛЕНИЕ ЖУРНАЛОВ    ######
###################################

$con->query("DELETE FROM `msg` WHERE `time`+'604800' < '".time()."'");

function format_file($format_file){ // ФОРМАТЫ ФАЙЛОВ

if($format_file == '.zip'){
$format = '<img src="/style/image/loads/zip.png">';
}elseif($format_file == '.rar'){
$format = '<img src="/style/image/loads/rar.png">';
}elseif($format_file == '.mp3'){
$format = '<img src="/style/image/loads/mp3.png">';
}elseif($format_file == '.mp4'){
$format = '<img src="/style/image/loads/mp4.png">';
}elseif($format_file == '.jpg'){
$format = '<img src="/style/image/loads/jpg.png">';
}elseif($format_file == '.jpeg'){
$format = '<img src="/style/image/loads/jpeg.png">';
}elseif($format_file == '.gif'){
$format = '<img src="/style/image/loads/gif.png">';
}elseif($format_file == '.3gp'){
$format = '<img src="/style/image/loads/3gp.png">';
}elseif($format_file == '.png'){
$format = '<img src="/style/image/loads/png.png">';
}

return $format;

}

function v($id){
switch($id){
case 1: $v = "管理员"; break;
case 2: $v = "创始人"; break;
case 3: $v = "创作者"; break;
default: $v = "未认证"; break;
}
return $v;
}

function fh($id){
switch($id){
case 0: $fh = "未发放"; break;
case 1: $fh = "已发放"; break;
default: $fh = "未发放"; break;
}
return $fh;
}



// аргумент функции это путь к файлу
function getFilesizes($file)
{
	// ошибка
	if(!file_exists($file)) return "文件已丢失！";


	$filesize = filesize($file);
	// Если размер больше 1 Кб
	if ($filesize >= 1073741824) {
    }
    return $filesize;
}

function getFilesize($file)
{
	// ошибка
	if(!file_exists($file)) return "文件已丢失！";


	$filesize = filesize($file);
	// Если размер больше 1 Кб
	if ($filesize >= 1073741824) {
        //转成GB
        $filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
    } elseif ($filesize >= 1048576) {
        //转成MB
        $filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
    } elseif ($filesize >= 1024) {
        //转成KB
        $filesize = round($filesize / 1024 * 100) / 100 . ' KB';
    } else {
        //不转换直接输出
        $filesize = $filesize . ' 0 B ';
    }
    return $filesize;
}

?>