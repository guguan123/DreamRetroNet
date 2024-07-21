<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '绑定 '.$user['name'].'的续梦号';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
//no_aut();

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a>';
echo '<h1>'.$title.'</h1>';
echo '<div id="user">';
if(!$user){
echo '<a href="/auth">登录</a></div></div>';
}else{
echo '<a href="/user">'.$user['name'].'</a>';
}
echo '</div></div>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/menu.php';
echo '<div id="nav"><span>位置：</span><span>'.$user['name'].'</span></div>';
echo '<div id="wrapper" class="clearfix"><div id="main">';

if(isset($_POST['bdxm'])){
$xm = filtr($_POST['xm']);
if(mb_strlen($xm) < '6' or mb_strlen($xm) > '12') $err = '续梦号长度大于6小于12';
$login_c = $con->query("SELECT * FROM `user` WHERE `xm` = '".$xm."'")->num_rows;
if($login_c > 0) {$err = '续梦号以存在请使用其他续梦号'; }
if($err){
err($err);
}elseif(!$err){
ok('注册成功！');
$con->query("UPDATE `user` SET `xm` = '".$xm."' WHERE `id` = '".$user['id']."'");
//$con->query("INSERT INTO `user` (`login`, `name`, `qq`, `pass`, `pol`, `data_reg`) VALUES ('".$login."', '".$name."', '".$qq."', '".md5($pass)."', '".$pol."', '".time()."')");
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
}

echo '<h2 class="topic">注册</h2>
<form action="" method="post" class="form bg-white"><div>
<label>续梦号：</label>
<input type="text" name="xm" value="" required="required" >
</div><div>
<input type="submit" name="bdxm" value="绑定" /></div></form></div>';
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

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>