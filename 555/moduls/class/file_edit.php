<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '文件编辑| 管理面板';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_POST['add'])){
$text = filtr($_POST['text']);
$name = filtr($_POST['name']);
$rek = filtr($_POST['rek']);
$ivent = filtr($_POST['ivent']);
$downs = abs(intval($_POST['downs']));
if(mb_strlen($text) < '1' or mb_strlen($text) > '9900') $err = 'Текст либо менее 1 либо более 9900 символов';

if($err){ 
err($err);
}else{
$con->query("UPDATE `file` SET `text` = '".$text."', `name` = '".$name."', `rek` = '".$rek."', `ivent` = '".$ivent."', `downs` = '".$downs."' WHERE `id` = '".$id."'");
header('Location: /file/'.$b['id']);
}
}

echo '<span class="title">编辑文件</span>
<form action="" method="POST">名字</br><input type="text" name="name" value="'.$b['name'].'"><br/>
描述</br><textarea name="text">'.$b['text'].'</textarea>
<br/>下载次数</br><input type="text" name="downs" value="'.$b['downs'].'">
<br/>审核<br><select name="ivent">
<option selected value="0">否</option> 
<option value="1">是</option></select>
<br>添加到推荐？<br><select name="rek">
<option selected value="0">否</option> 
<option value="1">是</option></select>
<br><input type="submit" name="add" value="保存"></form>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>