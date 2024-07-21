<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '修改资料';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
aut();
echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$user['name'].'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$use['name'].'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';
if(isset($_POST['submit'])){

$name = filtr($_POST['name']);
$login = filtr($_POST['login']);
$pol = filtr($_POST['pol']);


//$ms = $con->query("SELECT * FROM `user` WHERE `id` = '".$user['id']."'")->fetch_assoc();

$con->query("UPDATE `user` SET `name` = '".$name."', `login` = '".$login."', `pol` = '".$pol."' WHERE `id` = '".$user['id']."'");

}else{
echo '<h2 class="topic">'.$title.'</h2><form action="" method="post" class="form bg-white"><div>
<label>昵称：</label><input type="text" name="name" value="'.$user['name'].'" required="required" />
</div><div>
<label>登录名：</label><input type="text" name="login" value="'.$user['login'].'" required="required" />
</div><div>
<label>性别：</label>
	<select name="pol" required="required">
	<option value="'.$user['pol'].'">'.$user['pol'].'</option>
    <option value="1">男</option>
    <option value="2">女</option>
    </select></div><div>

<input type="submit" name="submit" value="提交" /></div>
</form></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>