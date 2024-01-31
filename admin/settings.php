<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Настройки сайта';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if($user['admin_level']>=2){ 
$b = $con->query("SELECT * FROM `settings` WHERE `id` = '1'")->fetch_assoc();


if(isset($_POST['edit'])){
$index_forum = abs(intval($_POST['index_forum']));
$reg_on = abs(intval($_POST['reg_on']));
$ban = abs(intval($_POST['ban']));
if(mb_strlen($ban) < '1' or mb_strlen($ban) > '6') $err = 'Время бана либо менее 1 либо более 6 символов';
if($index_forum >= 20) $err = 'Слишком много тем на главной';
if($err){
err($err);
}else{
if($reg_on == 2){
$con->query("UPDATE `settings` SET `aut_ban_time` = '".$ban."' WHERE `id` = '1'");
}else{
$con->query("UPDATE `settings` SET `aut_ban_time` = '".$ban."',  `reg_on` = '".$reg_on."' WHERE `id` = '1'");
}
header('Location: /admin');
}

}


if($b['reg_on'] == 1){$reg_on_echo = 'Открыта';}elseif ($b['reg_on'] == 0) {$reg_on_echo = 'Закрыта';}

echo '<div class="link"><center>';
echo '<form action="" method="POST">';
echo '<b>Регистрация </b>(Сейчас : '.$reg_on_echo.') : </br>
<select name="reg_on"><option value="2">Не изменять</option><option value="1">Открыта</option><option value="0">Закрыта</option></select></br>
<b>Бан при неверно введенном пароле 3 раза* (Только числа) : </b><br>
<input type="text" name="ban" value="'.$b['aut_ban_time'].'"><br/>
<b>Количество тем форума на главной</b><br><input type="text" name="index_forum" value="'.$b['index_forum'].'"><br/>
';
echo '<input type="submit" name="edit" value="Изменить"></font>';
echo '</center></div>';
echo '<div class="other"><center>* При авторизации выскакивает бан если ввести пароль более 3-ёх раз подряд (неверно)</center></div>';
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>