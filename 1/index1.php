<?php
$dst_path = '4.png';
$src_path = '1.png';
//创建图片的实例
$dst = imagecreatefromstring(file_get_contents($dst_path));
$src = imagecreatefromstring(file_get_contents($src_path));
$dst_pathWH = getimagesize($dst_path);
$src_pathWH = getimagesize($src_path);
//获取水印图片的宽高=
list($src_w, $src_h) = getimagesize($src_path);
//将水印图片复制到目标图片上，最后个参数80是设置透明度，这里实现半透明效果
//imagecopymerge($dst, $src, 10, 10, 0, 0, $src_w, $src_h, 80);
//如果水印图片本身带透明色，则使用imagecopy方法
switch ($postion) {
case 1:
               //水印居中
            $y = $img_pathWH[0]/2-$logo_pathWH[0]/2;
            $x = $img_pathWH[1]/2-$logo_pathWH[1]/2;
            break;
        case 2:
            //水印在左上角
            $y = 30;
            $x = 20;
            break;
        case 3:
            //水印在右上角
            $y = $img_pathWH[0]-$logo_pathWH[0]-30;
            $x = 20;
            break;
        case 4:
            //水印在左下角
            $y = 30;
            $x = $img_pathWH[1]-$logo_pathWH[1]-20;
            break;
        case 5:
            //水印在右下角
            $y = $img_pathWH[0]-$logo_pathWH[0]-30;
            $x = $img_pathWH[1]-$logo_pathWH[1]-20;
            break;
        default:
            //水印在右下角
             $src_y = $dst_pathWH[0]-$src_pathWH[0]-5;
            $src_x = 5;
            break;
}
//imagecopymerge($dst, $src, $src_y, $src_x, 0, 0, $src_w, $src_h, 50);
imagecopy($dst, $src, $src_y, $src_x, 0, 0, $src_w, $src_h);
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
imagedestroy($src);

$dst_w = 120;
$dst_h = 160;
$dst_img = imagecreatetruecolor($dst_w, $dst_h);
imagecopyresampled($dst_img, $dst, 0, 0, 0, 0, $dst_w, $dst_h, imagesx($dst), imagesy($dst));
//输出图片
//list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

switch ($dst_img) {
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


