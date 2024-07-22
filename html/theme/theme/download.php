<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
$title = 'Загрузка';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

//aut();
$b = $con->query("SELECT * FROM `theme` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
  //  if($b['ivent']==0){
        //echo '该应用审核不通过！';
       // include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
      //  exit;
    //  }
//$con->query("UPDATE `theme` SET `downs` = `downs`+'1' WHERE `id` = '".$b['id_game']."'");
if ($user['id']){
$con->query("UPDATE `user` SET `theme_downs` = `theme_downs`+'1' WHERE `id` = '".$user['id']."'");

$down = $con->query(" SELECT * FROM `theme_download` WHERE `user_id` = '".$user['id']."' AND `theme_id` = '".$b['id']."'")->num_rows;
if ($down > 0){
$con->query("UPDATE `theme_download` SET `downs` = `downs`+1 WHERE `user_id` = '".$user['id']."' AND `theme_id` = '".$b['id']."'");
}else{
$con->query("INSERT INTO `theme_download` (`id`, `user_id`, `downs`, `theme_id`) VALUES (NULL, '".$user['id']."', '1', '".$b['id']."')");
}
}
header("Location: /download/{$b['down']}");
}else{
eader('Location: /game/'.$b['gid']);
}


include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>