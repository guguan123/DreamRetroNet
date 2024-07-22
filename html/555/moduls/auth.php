<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '登录账号';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
no_aut();
$time_ban_auth = $sett['aut_ban_time']; // на сколько секунд давать бан
if(isset($_POST['auth'])){

############################################
#########   ОПРЕДЕЛЕНИЕ IP  ################
############################################

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


	if($_SESSION['time_ban_auth'] < time()){
$login = filtr($_POST['login']);
$pass = filtr($_POST['pass']);

$count = $con->query("SELECT * FROM `user` WHERE `login` = '".$login."' and `pass` = '".md5($pass)."'")->num_rows;
if($count < 1) {$err = '该用户不存在';

	$mss1 = $con->query("SELECT * FROM `user` WHERE `login` = '".$login."'")->fetch_assoc();
$con->query("INSERT INTO `log_auth` (`id_user`, `time`, `type`, `ip`) VALUES ('".$mss1['id']."', '".time()."', '0', '".$ip."')");

$_SESSION['err_auth'] = $_SESSION['err_auth']+1;
if($_SESSION['err_auth'] > 3){
$usersss = $con->query("SELECT * FROM `user` WHERE `login` = '".$login."'")->num_rows;
if($usersss > 0){
	$mss = $con->query("SELECT * FROM `user` WHERE `login` = '".$login."'")->fetch_assoc();
	$con->query("INSERT INTO `journal` (`text`, `time`, `id_user`) VALUES ('您的帐户发现了许多错误的密码输入！ 更改您的密码', '".time()."', '".$mss['id']."')");
}
$_SESSION['time_ban_auth'] = time()+$time_ban_auth;

err('您输入了3次错误的密码-被禁止'.$time_ban_auth.' 秒');
$_SESSION['err_auth'] = 0;
} }else{

setcookie('login', $login, time()+86400*365, '/'); 
setcookie('pass',md5($pass), time()+86400*365, '/');
	$mss2 = $con->query("SELECT * FROM `user` WHERE `login` = '".$login."'")->fetch_assoc();
$con->query("INSERT INTO `log_auth` (`id_user`, `time`, `type`, `ip`) VALUES ('".$mss2['id']."', '".time()."', '1', '".$ip."')");

header('Location: /');
}

}else{

err('您被禁止了，等到禁止到期 ('.$time_ban_auth.' 秒)');
}
if($err){
	err($err);
}
}
	if($_SESSION['time_ban_auth'] < time()){
echo'<center><div class="other"><form action="" method="POST">用户名:<br/>
<input type="text" name="login" value=""><br/>
密码:<br/>
<input type="password" name="pass" value="">
<br/><br/>
<input type="submit" name="auth" value="登录"><br/></form></div> </center>';
}else{

	err('您被禁止了，等到禁止到期 ('.$time_ban_auth.' 秒)');
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>