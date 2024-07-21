<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
/*
 *调用接口代码
 *
 **/
require_once("../../API/qqConnectAPI.php");
$qc = new QC();
$arr = $qc->get_user_info();
$qq = $qc->get_openid();

if (!empty($_SERVER['HTTP_CLIENT_IP']))
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
  
if ($qq){
 $user_num = $con->query(" SELECT * FROM `user` WHERE `qq` = '$qq'")->num_rows;
 //$user_avatar = $con->query(" SELECT * FROM `user` WHERE `qq` = '$qq'")->fetch_assoc();
 $str = $arr["figureurl_qq"];
$str=str_replace('/0','',$str);
//$str = substr($str,0,strlen($str)-10);
   if ($user_num > 0){
    $con->query("UPDATE `user` SET `name` = '".$arr['nickname']."', `qq_avatar` = '".$str."', `pol` = '".$arr['gender']."' WHERE `qq` = '$qq'");
     setcookie('BAEID', $qq, time()+86400*365, '/', 'rmct.cn');  
     $user_mss = $con->query(" SELECT * FROM `user` WHERE `qq` = '$qq'")->fetch_assoc();
     $con->query("INSERT INTO `log_auth` (`id_user`, `time`, `type`, `ip`) VALUES ('".$user_mss['id']."', '".time()."', '1', '".$ip."')");
    }else{
      $us = $con->query("INSERT INTO `user` (`id`, `qq`, `name`, `qq_avatar`, `pol`, `data_reg`) VALUES (NULL, '{$qq}', '{$arr['nickname']}', '{$str}', '{$arr['gender']}', '".time()."')");
setcookie('BAEID', $qq, time()+86400*365, '/', 'rmct.cn');  
$con->query("INSERT INTO `log_auth` (`id_user`, `time`, `type`, `ip`) VALUES ('".$us['id']."', '".time()."', '1', '".$ip."')");
 }             
    }   
header("Location: ".'/');
?>
