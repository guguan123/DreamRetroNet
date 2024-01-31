<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Рассылка записей журнала';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if($user['admin_level']>=2){ 

if(isset($_POST['add'])){
$text = filtr($_POST['text']);
$otp = abs(intval($_POST['otp']));
	

if(mb_strlen($text) < '1' or mb_strlen($text) > '9000') $err = 'Текст либо менее 1 либо более 9000 символов';

if($err){ 
err($err);
}else{
	if($otp == 1){
$b = $con->query("SELECT * FROM `user`");
}elseif($otp == 2){
$b = $con->query("SELECT * FROM `user` WHERE `admin_level` = '1'");
}elseif($otp == 3){
$b = $con->query("SELECT * FROM `user` WHERE `admin_level` = '2'");
}elseif($otp == 4){
$b = $con->query("SELECT * FROM `user` WHERE `admin_level` = '3'");
}elseif($otp == 5){
$b = $con->query("SELECT * FROM `user` WHERE `pol` = '1'");
}elseif($otp == 6){
$b = $con->query("SELECT * FROM `user` WHERE `pol` = '2'");
}elseif($otp == 7){
$b = $con->query("SELECT * FROM `user` WHERE `admin_level` > '0'");
}else{
err('Ошибка');
}
if($b){
while($use = $b->fetch_assoc()){

$con->query("INSERT INTO `msg` (`text`, `time`, `id_user`) VALUES ('".$text."', '".time()."', '".$use['id']."')");


}
ok('Успешно');
}
}
}


	echo '<div class="link"><center>
<form action="" method="POST"><center>Здесь вы можете разослать записи в журналы пользователям</center></br></br>
Кому отправлять:<br />
<select name="otp"><option value="1">Всем пользователям</option><option value="2">Модераторам</option><option value="3">Администраторам</option>
<option value="4">Создателям</option><option value="5">Мужчинам</option><option value="6">Женщинам</option><option value="7">Всей администрации</option>
</select><br/></br>Текст :</br><textarea name="text"></textarea><br/>
<input type="submit" name="add" value="Разослать"></form></div>';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>