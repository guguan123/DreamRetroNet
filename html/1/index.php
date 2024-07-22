<?php
$dst_path = '4.png';

//创建图片的实例

$dst = imagecreatefromstring(file_get_contents($dst_path));

//打上文字

$font = './simsun.ttc';//字体

$black = imagecolorallocate($dst, 0xff, 0xff, 0xff);//字体颜色
//分辨率
list($dst_w, $dst_h, $dst_wh) = getimagesize($dst_path);
//$dst_wh =''.$dst_w.''.$dst_h.'';
if ($dst_w == 640 & $dst_h == 360){
imagefttext($dst, 13, 0, 550, 20, $black, $font, '99sjyx.cn');
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

imagedestroy($dst);