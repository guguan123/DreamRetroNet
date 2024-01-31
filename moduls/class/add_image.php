<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '添加屏幕截图| 管理面板';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();


$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();
if($b){
if(isset($_POST['submit'])){

    $filename = strtolower($_FILES['userfile']['name']); // имя и формат файла в нижнем регистре
    $t = preg_replace('#.[^.]*$#', NULL, $filename); // имя файла
    $f = str_replace($t, '', $filename); // формат файла
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/down/images/';
$rand=rand(111111111, 999999999);
if($f=='.jpeg' || $f=='.png' || $f=='.jpg'){
$t=$rand."_".basename($_FILES['userfile']['name']);

$uploadfile = $uploaddir . $rand.'_'. basename($_FILES['userfile']['name']);
}else{
    echo "<div class='err'>上传格式错误！只能为jpeg png jpg格式!</div>";
}
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
$name = filtr($_POST['name']);
$text = filtr($_POST['text']);

$con->query("INSERT INTO `image` (`id_user`, `time`, `id_file`, `url`, `format`) VALUES 
('".$user['id']."', '".time()."', '".$id."', '".$t."', '".$f."')");    

header('Location: /file/'.$id);
} else {
    err('Ошибка');
}
}

echo '
<span class="title">添加截图</span>
<div class="link"><center><form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="9000000000">
<input type="file" name="userfile" id="userfile"><br />
<input type="submit" name="submit" value="添加" />
</form>
</center></div>';
}else{
err('Ошибка');
}

$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$id."' ORDER BY `id` DESC LIMIT 5");
echo '<div id="screens">';
while($w = $ms->fetch_assoc()){
echo '<img class="img_rms" src="/down/images/'.$w['url'].'">';
}
echo '</div>';

} else { echo 'Спасибо что интересуетесь нашим сайтом.'; }
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>