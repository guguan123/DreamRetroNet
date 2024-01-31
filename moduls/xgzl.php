<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '修改昵称';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
if(isset($_POST['submit'])){



$name = $_POST['name'];


//$ms = $con->query("SELECT * FROM `user` WHERE `id` = '".$user['id']."'")->fetch_assoc();

$con->query("UPDATE `user` SET `name` = '".$name."' WHERE `id` = '".$user['id']."'");


}else{
echo '<center><div class="other"><form action="" method="POST">
昵称:<br/>
<input type="text" name="name" value="'.$user['name'].'"><br/>

<br/>
<input type="submit" name="submit" value="修改"><br/></form></div> </center>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>