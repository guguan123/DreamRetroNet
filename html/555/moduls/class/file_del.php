<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '删除文件| 管理面板';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_GET['yes'])){
$con->query("DELETE FROM `file` WHERE `id` = '".$id."'");
header('Location: /class');
}


echo '<span class="title">删除文件</span><br>删除文件 <b>'.$b['name'].'</b><br>
<div class="a_p"><a href=?yes>确定</a> <a href="/file/'.$b['id'].'">取消</a></div>';

}else{

	err('错误');
}
}else{
	err('删除失败');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>