<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
//$title = '搜索';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
//aut();
//echo '<div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a>';
//echo '<h1>续梦网</h1>';
//echo '<div id="user">';
//if(!$user){
//echo '<a href="/auth">登录</a></div></div>';
//}else{
//echo '<a href="/user">'.$user['name'].'</a>';
//}
//echo '</div></div>';
//include_once $_SERVER["DOCUMENT_ROOT"] . '/style/menu.php';
//echo '<div id="nav"><span>位置：</span><span>'.$title.'</span></div>';
//echo '<div id="wrapper" class="clearfix"><div id="main">';
/**

 * Created by PhpStorm.
 * User: tao
 * Date: 2016-09-13
 * Time: 20:50
 */
session_start();
require_once 'baidu/config.php';
require_once 'baidu/dohttps.php';
$code = $_GET['code'];
if($code){
    $getaccesstoken_url = "https://openapi.baidu.com/oauth/2.0/token?grant_type=authorization_code&code=$code&client_id=$api_key&client_secret=$serect_key&redirect_uri=$redirect_url";
    $httpsobj = new doHttps();
    $https_res = $httpsobj->getdata($getaccesstoken_url);
    $accesstoken = $https_res['access_token'];
    $userinfo_url = $apibase_url.'passport/users/getLoggedInUser'.'?access_token='.$accesstoken;
    $user_res = $httpsobj->getdata($userinfo_url);
    $smallpic = $user_res['portrait'];
    $nickname = $user_res['uname'];
    $baidu_id = $user_res['openid'];
    $_SESSION['accesstoken'] = $accesstoken;
    $_SESSION['nickname'] = $nickname;
    $_SESSION['smallpic'] = $smallpic;
    $_SESSION['baidu_id'] = $baidu_id;
}else{

    echo "<javascript>alert('授权失败')</javascript>";
}
//header("Location: ".'index.php');


?>
<?php
session_start();
require_once 'baidu/config.php';
$accesstoken = $_SESSION['accesstoken'];
$logout_url = "https://openapi.baidu.com/connect/2.0/logout?access_token=$accesstoken&next=$logout";

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>index</title>
</head>
<?php
$baidu = md5($_SESSION['baidu_id']);
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

if ($baidu){
 $user_num = $con->query(" SELECT * FROM `user` WHERE `baidu` = '$baidu'")->num_rows;
 $user_mss = $con->query(" SELECT * FROM `user` WHERE `baidu` = '$baidu'")->num_rows;
 //var_dump($_SESSION['baidu_uid']);
// var_dump($baidu_id);
//var_dump($user_num);
    if ($user_num > 0){
    $con->query("UPDATE `user` SET `name` = '".$_SESSION['nickname']."', `baidu_avatar` = '".$_SESSION['smallpic']."', `pol` = '未知' WHERE `baidu` = '$baidu'");
     setcookie('BAEID', $baidu, time()+86400*365, '/');  
$user_mss = $con->query(" SELECT * FROM `user` WHERE `baidu` = '$baidu'")->fetch_assoc();
     $con->query("INSERT INTO `log_auth` (`id_user`, `time`, `type`, `ip`) VALUES ('".$user_mss['id']."', '".time()."', '1', '".$ip."')");
    }else{
      $us = $con->query("INSERT INTO `user` (`id`, `baidu`, `name`, `baidu_avatar`, `pol`, `data_reg`) VALUES (NULL, '{$baidu}', '{$_SESSION['nickname']}', '{$_SESSION['smallpic']}', '未知', '".time()."')");
      setcookie('BAEID', $baidu, time()+86400*365, '/');  
      $con->query("INSERT INTO `log_auth` (`id_user`, `time`, `type`, `ip`) VALUES ('".$us['id']."', '".time()."', '1', '".$ip."')");

 }             
    }  
    
header("Location: ".'/');
?>

