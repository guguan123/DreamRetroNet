<?php
//echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/M/s/0.png");
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$file = '../M/s/'.$id.'.png';
if(is_file($file)){

// 创建图像资源
$src_img = imagecreatefrompng('../M/s/'.$id.'.png');

// 设置新图片的宽高
$dst_w = 120;
$dst_h = 120;

// 重新采样
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($src_img), imagesy($src_img));
//list($dst_type) = getimagesize($src_img);
switch ($src_img) {
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
// 输出压缩后的图片
//header('Content-Type: image/png');
//imagepng($dst_img);

// 销毁图像资源
imagedestroy($src_img);
imagedestroy($dst_img);
}else{
header("Content-type: image/png");
echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/M/s/00.png");
}