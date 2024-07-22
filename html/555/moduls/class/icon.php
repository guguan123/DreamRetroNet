<?php
error_reporting(E_ALL & ~E_NOTICE);
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/pclzip.lib.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$sql = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();
ob_clean();
$file = "../../down/files/".$sql["down"];
$q = array("icon15.png","icon.png","ico.png","i.png","icono.png","Icon.png","Ico.png","I.png","Icono.png","ICON.png","ICO.png","I.png","ICONO.png","ICON.PNG","ICO.PNG","I.PNG","ICONO.PNG","icons/icon.png","icons/ico.png","icons/i.png","icons/icono.png","i","I","i1.png","AppIcon01.png");	
$zip = new PclZip($file);	
$ar = $zip->extract(PCLZIP_OPT_BY_NAME,$q,PCLZIP_OPT_EXTRACT_IN_OUTPUT);

if(!empty($ar)) {
    
header("Content-type: image/png");
}else {
$cz=file_get_contents($_SERVER["DOCUMENT_ROOT"]."/style/image/jar.png");
header("Content-type: image/png");
echo $cz;
}