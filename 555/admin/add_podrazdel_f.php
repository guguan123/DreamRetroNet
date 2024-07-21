<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Создание раздела форума';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if($user['admin_level']>=2){ 

if(isset($_POST['add'])){

$name = filtr($_POST['name']);
$id_r = abs(intval($_POST['razdel'])); 

if(mb_strlen($name) < '1' or mb_strlen($name) > '100') $err = 'Текст либо менее 1 либо более 100 символов';
if($err){ 
err($err);
}else{
$con->query("INSERT INTO `forum_podrazdel` (`name`, `id_razdel`) VALUES ('".$name."', '".$id_r."')");

ok('Успешно');

}
}


	echo '<div class="link"><center>
<form action="" method="POST">Название :</br><input type="text" name="name" value=""></br>';
$b = $con->query("SELECT * FROM `forum_razdel`");
echo 'Выберите раздел :<br><select name="razdel">';
while($w = $b->fetch_assoc()){
echo '<option value="'.$w['id'].'">'.$w['name'].'</option>';
}
echo '</select><br>';
echo '<input type="submit" name="add" value="Создать"></form></div>';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>