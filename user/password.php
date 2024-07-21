<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '修改密码';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
aut();
echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$title.'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';
//echo '<div class="title">修改密码</div>';
if(isset($_POST['submit'])){



$oldpass = filtr($_POST['oldpass']);
$pass1 = filtr($_POST['pass1']);
$pass2 = filtr($_POST['pass2']);


$ms = $con->query("SELECT * FROM `user` WHERE `id` = '".$user['id']."'")->fetch_assoc();
if(md5($oldpass)==$ms['pass']){
if($pass1==$pass2){
$con->query("UPDATE `user` SET `pass` = '".md5($pass1)."' WHERE `id` = '".$user['id']."'");

header('Location: /');
}else{
err("两次密码不一样！");
}
}else{
err("输入密码不正确");
}

}else{
echo '<h2 class="topic">'.$title.'</h2><form action="" method="post" class="form bg-white"><div>
<label>旧密码：</label>
<input type="password" name="oldpass" required="required" />
</div><div>
<label>新密码：</label>
<input type="password" name="pass1" required="required" />
</div><div>
<label>确认密码：</label>
<input type="password" name="pass2" required="required" />
</div><div>
<input type="submit" name="submit" value="提交" /></div>
</form>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>