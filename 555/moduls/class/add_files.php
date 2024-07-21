<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '添加文件 管理面板';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();


$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `class` WHERE `id` = '".$id."'")->fetch_assoc();
if($b){
if(isset($_POST['submit'])){

    $filename = strtolower($_FILES['userfile']['name']); // имя и формат файла в нижнем регистре
    $t = preg_replace('#.[^.]*$#', NULL, $filename); // имя файла
    $f = str_replace($t, '', $filename); // формат файла
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/down/files/';
$rand=rand(100000000, 999999999);
if($f=='.jar' || $f=='.jad'){
$t=$rand.$f;
//.basename($_FILES['userfile']['name']);

$uploadfile = $uploaddir . $rand.$f;
//.basename($_FILES['userfile']['name']);
}else{
    echo "<div class='err'>Неверный Формат!</div>";
}
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
$name = filtr($_POST['name']);//名字
$platform = filtr($_POST['platform']);//平台
$dpi = filtr($_POST['dpi']);//分辨率
$text = filtr($_POST['text']);//介绍

$con->query("INSERT INTO `file` (`name`, `text`, `id_user`, `time`, `id_raz`, `down`, `format`) VALUES 
('".$name."', '".$text."', '".$user['id']."', '".time()."', '".$id."', '".$t."', '".$f."')");  

header('Location: /class/'.$id);
} else {
    err('Ошибка');
}
}

echo '
<span class="title">添加</span><div class="link"><form action="" method="post" enctype="multipart/form-data">
<b>名字</b></br>
<input type="text" name="name" value=""><br/>
<b>平台</b></br>
<select name="platfrom"><br/>
<option value="J2ME">J2ME</option>
<option value="S60V1">S60V1</option>
<option value="S60V2">S60V2</option>
<option value="S60V3">S60V3</option>
<option value="S60V5">S60V5</option>
<option value="Symbian3">Symbian3</option>
</select>
<b>分辨率</b></br>
<select name="dpi">
<option value="128×128">128×128</option>
<option value="128×160">128×160</option>
<option value="132×176">132×176</option>
<option value="175×220">175×220</option>
<option value="176×208">176×208</option>
<option value="176×220">176×220</option>
<option value="176×240">176×240</option>
<option value="208×208">208×208</option>
<option value="208×320">208×320</option>
<option value="240×240">240×240</option>
<option value="240×320">240×320</option>
<option value="240×400">240×400</option>
<option value="240×432">240×432</option>
<option value="320×240">320×240</option>
<option value="320×480">320×480</option>
<option value="360×640">360×640</option>
<option value="480×640">480×640</option>
<option value="480×700">480×700</option>
<option value="480×720">480×720</option>
<option value="480×800">480×800</option>
<option value="null">未知</option>
</select><br/>
<b>描述</b></br>
<textarea name="text"></textarea></br></br>
<b>选择一个文件</b></br>
 <input type="hidden" name="MAX_FILE_SIZE" value="9000000000">
<input type="file" name="userfile" id="userfile"><br />
<input type="submit" name="submit" value="添加" />
</form></div>';
}else{
err('Ошибка');
}
} else { echo 'Спасибо что интересуетесь нашим сайтом.'; }
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>