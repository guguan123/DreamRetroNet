<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/system/base.php';
//include_once $_SERVER["DOCUMENT_ROOT"] . '/system/system.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$b = $con->query("SELECT * FROM `image` WHERE `id` = '".$id."'")->fetch_assoc();
//$ms = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$id."' ORDER BY `id` DESC");
//echo '<title>'.$id.'</title>';
//加水印
if($b['format'] == ".png" ?: $b['format'] == ".jpg"){
$file = '../../M/s/'.$id.''.$b['format'].'';
}
if(file_exists($file)){

$dst_path = $file;
//$dst_path = imagecreatefromjpeg('../../M/s/2.jpg');
//$src_path = '../M/o/99sjyx.cn.png';
//创建图片的实例

$dst = imagecreatefromstring(file_get_contents($dst_path));
//$dst = imagecreatefromjpeg($dst_path);
//打上文字

$font = './simsun.ttc';//字体

$black = imagecolorallocate($dst, 0xff, 0xff, 0xff);//字体颜色
list($dst_w, $dst_h, $dst_wh) = getimagesize($dst_path);
//$dst_wh =''.$dst_w.''.$dst_h.'';
$text = 'rmct.cn';
if ($dst_w == 240 & $dst_h == 320){
// 设置新图片的宽高
$dst_w = 120;
$dst_h = 160;
//分辨率
//list($dst_w, $dst_h, $dst_wh) = getimagesize($dst_path);
// 重新采样
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 14, 0, 150, 18, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 640 & $dst_h == 360){
$dst_w = 120;
$dst_h = 68;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 40, 0, 410, 50, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 360 & $dst_h == 640){
$dst_w = 120;
$dst_h = 214;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 8, 0, 650, 12, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 360 & $dst_h == 360){
$dst_w = 120;
$dst_h = 120;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 8, 0, 650, 12, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 96 & $dst_h == 65){
//$dst_w = 120;
//$dst_h = 120;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 8, 0, 650, 12, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 96 & $dst_h == 81){
//$dst_w = 120;
//$dst_h = 120;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 8, 0, 650, 12, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 101 & $dst_h == 63){
//$dst_w = 120;
//$dst_h = 120;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 8, 0, 650, 12, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 128 & $dst_h == 108){
//$dst_w = 120;
//$dst_h = 120;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 8, 0, 650, 12, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 176 & $dst_h == 204){
//$dst_w = 120;
//$dst_h = 120;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 8, 0, 650, 12, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 176 & $dst_h == 220){
$dst_w = 120;
$dst_h = 150;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 14, 0, 85, 18, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 320 & $dst_h == 240){
$dst_w = 120;
$dst_h = 90;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 20, 0, 195, 22, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 208 & $dst_h == 208){
$dst_w = 120;
$dst_h = 120;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 15, 0, 120, 18, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 128 & $dst_h == 160){
$dst_w = 120;
$dst_h = 150;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 12, 0, 55, 18, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 176 & $dst_h == 208){
$dst_w = 120;
$dst_h = 141;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 12, 0, 105, 18, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else if ($dst_w == 128 & $dst_h == 128){
$dst_w = 120;
$dst_h = 120;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagefttext($dst, 12, 0, 60, 15, $black, $font, $text);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
}else{
header("Content-type: image/png");
echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/M/s/".$id."".$b['format']."");
}
//输出图片

list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

switch ($dst_type) {
case 1://GIF

header('Content-Type: image/gif');

imagegif($dst_img);

break;

case 2://JPG

header('Content-Type: image/jpeg');

imagejpeg($dst_img);

break;

case 3://PNG

header('Content-Type: image/png');

imagepng($dst_img);

break;

default:

break;

}

}else if($b['format'] == ".gif"){
header("Content-type: image/png");
echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/M/s/".$b['id'].".gif");
}else{
header("Content-type: image/png");
echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/M/s/00.png");
}

//$srce = creatWaterMark('M/s/'.$id.'.png');