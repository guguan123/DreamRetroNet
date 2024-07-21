<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '注册 '.$user['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
no_aut();

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a>';
echo '<h1>'.$title.'</h1>';
echo '<div id="user">';
if(!$user){
echo '<a href="/login">登录</a></div></div>';
}else{
echo '<a href="/user">'.$user['name'].'</a>';
}
echo '</div></div>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/menu.php';
echo '<div id="nav"><span>位置：</span><span>'.$user['name'].'</span></div>';
echo '<div id="wrapper" class="clearfix"><div id="main">';

if($sett['reg_on'] == 1){
if(isset($_POST['reg'])){
$login = filtr($_POST['login']);
//$qq = filtr($_POST['qq']);
//$name = filtr($_POST['name']);
$pass2 = filtr($_POST['pass2']);
$pass = filtr($_POST['pass']);
$pol = intval($_POST['pol']);
if($pass != $pass2) $err = '两次密码不同';
if(mb_strlen($login) < '3' or mb_strlen($login) > '24') $err = '用户名长度大于3小于24';
if(mb_strlen($pass) < '4')  $err = '密码长度大于4';
$login_c = $con->query("SELECT * FROM `user` WHERE `login` = '".$login."'")->num_rows;
if($login_c > 0) {$err = '改用户以存在请注册其他用户'; }
if($err){
err($err);
}elseif(!$err){
ok('注册成功！');
$con->query("INSERT INTO `user` (`login`, `pass`, `pol`, `data_reg`) VALUES ('".$login."', '".md5($pass)."', '".$pol."', '".time()."')");
setcookie('login', $login, time()+86400*365, '/');
setcookie('pass',md5($pass), time()+86400*365, '/');
echo '<div class="other"><b>感谢您的注册 :</b></br>
登录名 : '.$login.'</br>
密码 : '.$pass.'</br>
<a href="/login">[ 登录 ]</a></div>'; 
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
exit();
}
}

echo '<h2 class="topic">注册</h2>
<form action="" method="post" class="form bg-white"><div>
<label>登录名：</label>
<input type="text" name="login" value="" required="required" >
</div><div>
<label>用户密码：</label>
<input type="password" name="pass" value="" required="required" >
</div><div>
<label>确认密码：</label>
<input type="password" name="pass2" value="" required="required" >
</div><div>
<label>性别：</label>
<select name="pol" required="required">
<option value="1">男</option>
<option value="2">女</option>
</select></div><div>
</div><div>
<input type="submit" name="reg" value="注册" /></div></form></div>';
//echo'<center><div class="other"><form action="" method="POST">用户名:<br/>
//<input type="text" name="login" value=""><br/>
//用户密码:<br/>
//<input type="password" name="pass" value=""><br/>
//确认密码:<br/>
//<input type="password" name="pass2" value=""><br/>
//性别:<br/>
//<select name="pol">
//<option value="1">男</option>
//<option value="2">女</option>
//</select>
//<br/><br/>
//<input type="submit" name="reg" value="注册"><br/></form></div> </center>';
}else{

	err('网站没有开放注册！');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>