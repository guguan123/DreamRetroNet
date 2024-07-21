<?php
date_default_timezone_set("Asia/Shanghai");


	$sett = $con->query("SELECT * FROM `settings` WHERE `id` = '1'")->fetch_assoc(); // НАСТРОЙКИ САЙТА


# Проверка на авторизацию

if(isset($_COOKIE['login'])  && isset($_COOKIE['pass'])) 
{
$user = $con->query("SELECT * FROM `user` WHERE `login` = '".htmlspecialchars($_COOKIE['login'])."' && `pass` = '".htmlspecialchars($_COOKIE['pass'])."' LIMIT 1")->fetch_assoc();
}


function filtr($text_filter)
{
    global $con;
    $text_filter = htmlspecialchars(trim($text_filter), ENT_QUOTES, 'UTF-8');
    $text_filter = $con->real_escape_string($text_filter);
    return $text_filter;
}



function bb_code($text){
$text = stripslashes($text);
$text = preg_replace('#\[cit\](.*?)\[/cit\]#si', '<div class="cit">\1</div>', $text);
$text = preg_replace('#\[b\](.*?)\[/b\]#si', '<span style="font-weight: bold;"> \1 </span>', $text);
$text = preg_replace('/\[url\s?=\s?([\'"]?)(?:http:\/\/)?(.*?)\1\](.*?)\[\/url\]/', ' <a href="http://$2"> $3 </a> ', $text);
$text = preg_replace('#\[black\](.*?)\[\/black\]#si', '<span style="color:#000000;">\1</span>', $text);
$text = preg_replace('#\[i\](.*?)\[\/i\]#si', '<i>\1</i>', $text);
$text = preg_replace('#\[u\](.*?)\[\/u\]#si', '<u>\1</u>', $text);
$text = preg_replace('#\[s\](.*?)\[\/s\]#si', '<s>\1</s>', $text);
return $text; 
}


function no_aut() { # Если НЕ авторизирован
	global $user; 
if($user){
echo '<div class="error"> 您没有登录 </div>';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
}

function aut() { # Если авторизирован
	global $user; 
if(!$user){
echo '<div class="error"> 您没有登录！ </div>';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
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
    $timep="".date("Y m d  H:i", $time).""; 
    $time_p[0]=date("Y m d", $time); 
    $time_p[1]=date("H:i", $time); 
     
    if ($time_p[0] == date("j n Y"))$timep = date("H:i:s", $time); 
    if ($time_p[0] == date("j n Y", time()-60*60*24))$timep = "Вчера в $time_p[1]"; 
     
    return $timep; 
}


if ($user) { // ОНЛАЙН
	global $con;
$con->query("UPDATE `user` SET `up_time` = '".time()."' WHERE `id` = '".$user['id']."'");
}


############################################
####     НАВИГАЦИЯ НЕЧЕГО НЕ ТРОГАТЬ    ####
############################################


function page($k_page=1){ // Выдает текущую страницу
$page=1;
if (isset($_GET['page'])){
if ($_GET['page']=='end')$page=intval($k_page);elseif(is_numeric($_GET['page'])) $page=intval($_GET['page']);}
if ($page<1)$page=1;
if ($page>$k_page)$page=$k_page;
return $page;}

function k_page($k_post=0,$k_p_str=10){ // Высчитывает количество страниц
if ($k_post!=0){$v_pages=ceil($k_post/$k_p_str);return $v_pages;}
else return 1;}

function str($link='?',$k_page=1,$page=1){ // Вывод номеров страниц (только на первый взгляд кажется сложно ;))
echo '<div class="navi">';

if ($page<1)$page=1;
if ($page!=1)echo "<a class='nav_btn' href=\"".$link."page=1\" title='第一页'>&lt;&lt;</a> ";
if ($page!=1)echo "<a class='nav_btn' href=\"".$link."page=1\" title='页 №1'>1</a> ";else echo "<span class='nav_btn'>1</span> ";
for ($ot=-3; $ot<=3; $ot++){
if ($page+$ot>1 && $page+$ot<$k_page){
if ($ot==-3 && $page+$ot>2)echo " ";
if ($ot!=0)echo "<a class='nav_btn' href=\"".$link."page=".($page+$ot)."\" title='页 №".($page+$ot)."'>".($page+$ot)."</a> ";else echo "<span class='nav_btn'>".($page+$ot)."</span> ";
if ($ot==3 && $page+$ot<$k_page-1)echo " ";}}
if ($page!=$k_page)echo "<a class='nav_btn' href=\"".$link."page=end\" title='页 №$k_page'>$k_page</a> ";elseif ($k_page>1)echo "<span class='nav_btn'>$k_page</span>";
if ($page!=$k_page)echo "<a class='nav_btn' href=\"".$link."page=end\" title='最后一页'> &gt;&gt;</a> ";
echo '</div>';

}

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
	elseif($us['admin_level'] == '3'){ $dol = '<font color="blue">[站长]</font>'; }
	

	return (empty($us)?'System':' <a href="/user_'.$us['id'].'">'.$us['login'].' '.$on_off.' '.$dol.'</a>');
}




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

function platform($id){
switch($id){
case 0: $platform = "J2ME"; break;
case 1: $platform = "S60V1"; break;
case 2: $platform = "S60V2"; break;
case 3: $platform = "S60V3"; break;
case 4: $platform = "S60V5"; break;
case 5: $platform = "Symbian3"; break;
default: $platform = "未知"; break;
}
return $platform;
}


function dpi($id){

switch($id){
case 0: $dpi="自适屏"; break;
case 1: $dpi ="128×160"; break;
case 2: $dpi ="132×176"; break;
case 3: $dpi ="175×220"; break;
case 4: $dpi ="176×208"; break;
case 5: $dpi ="176×220"; break;
case 6: $dpi ="176×240"; break;
case 7: $dpi ="208×208"; break;
case 8: $dpi ="208×320"; break;
case 9: $dpi ="240×240"; break;
case 10: $dpi ="240×320"; break;
case 11: $dpi ="240×400"; break;
case 12: $dpi ="240×432"; break;
case 13: $dpi ="320×240"; break;
case 14: $dpi ="320×480"; break;
case 15: $dpi ="360×640"; break;
case 16: $dpi ="480×640"; break;
case 17: $dpi ="480×700"; break;
case 18: $dpi ="480×720"; break;
case 19: $dpi ="480×800"; break;
default: $dpi ="未知"; break;

}
return $dpi;

}




// аргумент функции это путь к файлу
function getFilesize($file)
{
	// ошибка
	if(!file_exists($file)) return "该文件可能丢失了！";


	$filesize = filesize($file);
	// Если размер больше 1 Кб
	if($filesize > 1024)
	{
		$filesize = ($filesize/1024);
		// Если размер файла больше Килобайта
		// то лучше отобразить его в Мегабайтах. Пересчитываем в Мб
		if($filesize > 1024)
		{
			$filesize = ($filesize/1024);
			// А уж если файл больше 1 Мегабайта, то проверяем
			// Не больше ли он 1 Гигабайта
			if($filesize > 1024)
			{
				$filesize = ($filesize/1024);
				$filesize = round($filesize, 1);
				return $filesize." GB";
			}
			else
			{
				$filesize = round($filesize, 1);
				return $filesize." MB";
			}
		}
		else
		{
			$filesize = round($filesize, 1);
			return $filesize." KB";
		}
	}
	else
	{
		$filesize = round($filesize, 1);
		return $filesize." B";
	}
}

?>