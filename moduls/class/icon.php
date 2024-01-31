<?php
error_reporting(E_ALL & ~E_NOTICE);
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/pclzip.lib.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ


ob_clean();
$sql = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();
ob_clean();
$file = "../../down/files/".$sql["down"];
$q = array("gameicon.png","icon.png","icon32.png","res/image2d/icon.png","icn.png","i.png","ic.png","image/icon.png","icons/icon.png","icon24_24.png","icons/ico.png","l.png","ICONO.png","ICON.PNG","ICO.PNG","I.png","ICONO.PNG","26x26.png","bin/icon.png","title/icon.png","icons/i.png","icon/icon.png","","i","I","i1.png","AppIcon01.png");

$str = 'MIDlet-Icon: ';
$zip = new PclZip($file);	
$ar = $zip->extract(PCLZIP_OPT_BY_NAME,$q,PCLZIP_OPT_EXTRACT_IN_OUTPUT);

if(!empty($ar)) {
    
header("Content-type: image/png");
}else {
$cz=file_get_contents($_SERVER["DOCUMENT_ROOT"]."/style/image/jar.png");
header("Content-type: image/png");
echo $cz;
}