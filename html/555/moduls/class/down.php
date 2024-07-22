<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Загрузка';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$b = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
    if($b['ivent']==0){
        echo '该应用审核不通过！';
        include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
        exit;
      }
$con->query("UPDATE `file` SET `downs` = `downs`+'1' WHERE `id` = '".$id."'");
header("Location: /down/files/{$b['down']}");
}else{
header('Location: /file/'.$b['id']);
}


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>