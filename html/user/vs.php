<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '修改昵称';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
//aut();
if(isset($_POST['submit'])){



$v = $_POST['v'];
$v_name = $_POST['v_name'];


//$ms = $con->query("SELECT * FROM `user` WHERE `id` = '".$user['id']."'")->fetch_assoc();

//$con->query("INSERT INTO `user` (`v`, `v_name`) VALUES 
//('".$v."', '".$v_name."')");

$con->query("UPDATE `user` SET `v` = '".$v."', `v_name` = '".$v_name."' WHERE `id` = '".$user['id']."'");


}else{
echo '<h2 class="topic">申请认证</h2>
	<form action="" method="post" enctype="multipart/form-data" class="form bg-white"><div>
	<label>认证类型：</label>
	<select name="v" required="required">
    <option value="2">创始人</option>
    <option value="3">创作者</option>
    </select></div><div>
<label>认证的昵称</label>
<textarea name="v_name" type="v_name" rows="5" cols="30" >
</textarea></div><div>
<input type="submit" name="submit" value="修改"><br/></form></div> </center>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>