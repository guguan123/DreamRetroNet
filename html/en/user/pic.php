<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '添加屏幕截图| 管理面板';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
aut();

if($user['admin_level']){
$b = $con->query("SELECT * FROM `user` WHERE `id` = '".$user['id']."'")->fetch_assoc();
if($b){
if(isset($_POST['submit'])){

    $filename = strtolower($_FILES['userfile']['name']); // имя и формат файла в нижнем регистре
    $t = preg_replace('#.[^.]*$#', NULL, $filename); // имя файла
    $f = str_replace($t, '', $filename); // формат файла
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/M/u/';
$rand = $user['id'];
if($f=='.jpeg' || $f=='.png' || $f=='.jpg'){
$t=$rand.$f;

$uploadfile = $uploaddir . $rand.$f;
}else{
    echo "<div class='err'>上传格式错误！只能为jpeg png jpg格式!</div>";
}
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
$pic = filtr($_POST['pic']);

$con->query("UPDATE `user` SET `pic` = '".$t."' WHERE `id` = '".$user['id']."'");

header('Location: /user/edit/'.$id);

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

$ms = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."' ORDER BY `id` DESC LIMIT 1");
echo '<div id="screens">';
while($w = $ms->fetch_assoc()){
echo '<img class="img_rms" src="/M/u/'.$w['pic'].'">';
}
echo '</div>';

} else { echo '出现错误.'; }
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>