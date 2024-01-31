<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
$title = 'Загрузка';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

//aut();
$b = $con->query("SELECT * FROM `files` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
    if($b['ivent']==0){
        echo '该应用审核不通过！';
        include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
        exit;
      }
$con->query("UPDATE `file` SET `downs` = `downs`+'1' WHERE `id` = '".$b['id_file']."'");
if ($user['id']){
$con->query("UPDATE `user` SET `downs` = `downs`+'1' WHERE `id` = '".$user['id']."'");
}
header("Location: /down/files/{$b['down']}");
}else{
header('Location: /file/'.$b['id']);
}


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>