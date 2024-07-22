
<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '登录';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a>';
echo '<h1>'.$title.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav"><span>位置：</span><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><div id="main">';

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
echo '<h2 class="topic">消息提示</h2><p>';
if($count < 1) {$err = '没有这个用户名</p>';
//echo '</p><p><a href="/auth" class="button">返回</a></p>';

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
echo '<form action="" method="post" class="form bg-white"><div>
<label>用户名：</label><input type="text" name="login" required="required" />
</div><div>
<label>密码：</label>
<input type="password" name="pass" required="required" />
</div><div>
<input type="submit" name="auth" value="提交" /></div>
</form>
<ul class="list icon line margin-top bg-white">
<li><a href="#">QQ登录</a></li>
<li><a href="#">微博登录</a></li>';
?>
<html>
<li><a href="<?php echo $getcode_url ?>">百度登录</a></li>
</html>
<?php
echo '<li><a href="#">github登录</a></li>
<li><a href="/register">注册</a></li>
</ul>
<div class="message bg-white margin-top">访问本站即视为您同意<a href="/info/1">免责声明</a>
</div></div>
<div id="aside">
<div class="message bg-white">智能机和电脑可以直接访问<a href="https://jvzh.cn">https://jvzh.cn</a>功能机需要先用智能机或电脑通过上述域名登录后在个人页面获取用户名。之后功能机可以凭借获取登录填写的用户名和密码在<a href="http://wap.jvzh.cn">http://wap.jvzh.cn</a>域名登录。
</div></div></div>';
//echo'<center><div class="other"><form action="" method="POST">用户名:<br/>
//<input type="text" name="login" value=""><br/>
//密码:<br/>
//<input type="password" name="pass" value="">
//<br/><br/>
//<input type="submit" name="auth" value="登录"><br/></form></div> </center>';
}else{

	err('您被禁止了，等到禁止到期 ('.$time_ban_auth.' 秒)');
}
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>