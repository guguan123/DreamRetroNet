<?php
//include_once $_SERVER["DOCUMENT_ROOT"] . '/system/base.php';
//include_once $_SERVER["DOCUMENT_ROOT"] . '/system/system.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
//$b = $con->query("SELECT * FROM `image` WHERE `id` = '".$id."'")->fetch_assoc();
//$ms = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$id."' ORDER BY `id` DESC");
//echo '<title>'.$id.'</title>';
//加水印
$file = '../M/s/'.$id.'.png';

if(file_exists($file)){

$dst_path = '../M/s/'.$id.'.png';
//$src_path = '../M/o/99sjyx.cn.png';
//创建图片的实例

$dst = imagecreatefromstring(file_get_contents($dst_path));

//打上文字

$font = './simsun.ttc';//字体

$black = imagecolorallocate($dst, 0xff, 0xff, 0xff);//字体颜色
//分辨率
list($dst_w, $dst_h, $dst_wh) = getimagesize($dst_path);
//$dst_wh =''.$dst_w.''.$dst_h.'';
$text = '99sjyx.cn';
if ($dst_w == 240 & $dst_h == 320){
imagefttext($dst, 8, 0, 180, 12, $black, $font, $text);
}
if ($dst_w == 640 & $dst_h == 360){
imagefttext($dst, 8, 0, 650, 12, $black, $font, $text);
}
//输出图片

list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

switch ($dst_type) {
case 1://GIF

header('Content-Type: image/gif');

imagegif($dst);

break;

case 2://JPG

header('Content-Type: image/jpeg');

imagejpeg($dst);

break;

case 3://PNG

header('Content-Type: image/png');

imagepng($dst);

break;

default:

break;

}

}else{
header("Content-type: image/png");
echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/M/s/00.png");
}

//$srce = creatWaterMark('M/s/'.$id.'.png');