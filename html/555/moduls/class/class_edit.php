<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Редактирование раздела обменника';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `class` WHERE `id` = '".$id."'")->fetch_assoc();
if($b){

if(isset($_POST['add'])){
$info = filtr($_POST['info']);
$name = filtr($_POST['name']);
if(mb_strlen($info) < '1' or mb_strlen($info) > '400') $err = 'Информация либо менее 1 либо более 400 символов';
if(mb_strlen($name) < '1' or mb_strlen($name) > '100') $err = 'Название либо менее 1 либо более 100 символов';
if($err){ 
err($err);
}else{
$con->query("UPDATE `class` SET `info` = '".$info."', `name` = '".$name."' WHERE `id` = '".$id."'");
header('Location: /class');
}
}

echo '<div class="link"><center>
<form action="" method="POST">名称 :</br><input type="text" name="name" value="'.$b['name'].'"></br>描述 :</br><textarea name="info">'.$b['info'].'</textarea><br/><input type="submit" name="add" value="Изменить"></form></div>';


}else{

err('Комнат в чате еще нет');

}

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>