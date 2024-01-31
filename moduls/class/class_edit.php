<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '编辑分类';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$title.'</h1></a>';

include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `class` WHERE `id` = '".$id."'")->fetch_assoc();
if($b){

if(isset($_POST['add'])){
//$info = filtr($_POST['info']);
$name = filtr($_POST['name']);
//if(mb_strlen($info) < '1' or mb_strlen($info) > '400') $err = 'Информация либо менее 1 либо более 400 символов';
if(mb_strlen($name) < '1' or mb_strlen($name) > '100') $err = 'Название либо менее 1 либо более 100 символов';
if($err){ 
err($err);
}else{
$con->query("UPDATE `class` SET `name` = '".$name."' WHERE `id` = '".$id."'");
header('Location: /class');
}
}
echo '
<span class="title">添加</span><div class="link"><form action="" method="post" enctype="multipart/form-data">
<b>分类</b></br>
<input type="text" name="name" value="'.$b['name'].'"><br/>
<input type="submit" name="add" value="确定" />
</form></div>';
//echo '<div class="link"><center>
//<form action="" method="POST">名称 :</br><input type="text" name="name" value="'.$b['name'].'"></br><br/><input type="submit" name="add" value="Изменить"></form></div>';


}else{

err('Комнат в чате еще нет');

}

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>