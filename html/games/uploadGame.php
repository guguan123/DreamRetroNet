<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
if($user['admin_level']>=4){
echo '<link rel="stylesheet" href="/M/c/notice.css">';
$title = '消息提示';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>请登录之后再操作</p></body>';
exit();
}
$title = '上传SIS或N-Gage2游戏';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="'.$exit.'"></a>';

echo '<h1>'.$title.'</h1><a href="/"><img src="/favicon.ico" width="32" height="32" alt="'.$title2.'logo" /><h1>'.$title2.'</h1>';

include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><a href="/games">列表</a>';
echo '<span>'.$title.'</span></div>';
echo '<main class="container"><div id="main">';


if($user) {
	if(isset($_POST['submit'])) {
		$filename = strtolower($_FILES['userfile']['name']);
		// имя и формат файла в нижнем регистре
		$t = preg_replace('#.[^.]*$#', NULL, $filename);
		// имя файла
		$f = str_replace($t, '', $filename);
		// формат файла
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/download/';
		$mds = $con->query("SELECT * FROM `games`  ORDER BY `id` DESC LIMIT 1")->fetch_assoc();
        $rand = $mds['id']+1;
		//$rand=rand(1000000000, 9999999999);
		if($f=='.sisx' || $f=='.sis' || $f=='.n-gage') {
			$t=$rand.$f;
			//.basename($_FILES['userfile']['name']);
			$uploadfile = $uploaddir . $rand.$f;
			//.basename($_FILES['userfile']['name']);
		} else {
		no_upload();
			echo "<div class='err'>上传失败 !</div>";
		}
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		//$f = $fid['id'];
		    //$id = filtr($_POST['id']);
			//$id_raz = filtr($_POST['id_raz']);
			//名字
			//$name = filtr($_POST['name']);
			//中文名
			//$zh = filtr($_POST['zh']);
			//语言
			//$v = filtr($_POST['v']);
			//版本号
			//$vv = filtr($_POST['vv']);
			//版本
			//$platform = filtr($_POST['platform']);
			//平台
			//$author = filtr($_POST['author']);
			//提供商
			//$DJ = filtr($_POST['DJ']);
			//单人联机
			//$dpi = filtr($_POST['dpi']);
			//分辨率
			//$pay = filtr($_POST['pay']);
			//扣费方式
			//$text500 = filtr($_POST['text500']);

			//介绍
//    $key = getJarIniName($ftext, "MIDlet-Name");
//$uploads = $con->query("SELECT * FROM `game` WHERE `name` = '" . getJarIniName($ftext, "MIDlet-Name") . "' ORDER BY `id` DESC")->num_rows;
  //  $f = $upload['id'];
//if ($con->query("INSERT INTO `games` (`id`, `id_game`, `id_user`, `down`, `zh`, `vv`, `DJ`, `pay`, `dpi`, `time`, `format`) VALUES (NULL, '$up', '{$user['id']}', '$rand$f', '{$zh}', '{$vv}', '{$DJ}',  '{$pay}', '{$dpi}', '".time()."', '{$f}')") === TRUE) {
   // echo "新记录插入成功";
  //  echo ''.$up.'';
//} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
//};
$con->query("INSERT INTO `games` (`id`, `id_user`, `down`, `time`, `format`) VALUES (NULL, '{$user['id']}', '$rand$f', '".time()."', '{$f}')");
//if ($con->query("INSERT INTO `games` (`id`, `id_game`, `id_user`, `down`, `zh`, `vv`, `DJ`, `pay`, `dpi`, `time`, `format`) VALUES (NULL, '$up', '{$user['id']}', '$rand$f', '{$zh}', '{$vv}', '{$DJ}',  '{$pay}', '{$dpi}', '".time()."', '{$f}')"); === TRUE) {
    //echo "新记录插入成功";
//} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
//}
err('上传成功');
			//header('应用上传成功);
			//header('Location: /games/uploads/'.$gid.'');
			}else{
					err('上传出错');
		}
	}
	//echo '
//<span class="title">添加</span><div class="link">
//上传的应用需要审核过才能显示。
//<form action="" method="post" enctype="multipart/form-data">
//<b>分类</b></br><select name="class">';
//$b = $con->query("SELECT * FROM `class`");
	//while($w = $b->fetch_assoc()) {
	echo '<h2 class="topic">'.$title.'</h2>
	<form action="" method="post" enctype="multipart/form-data" class="form"><div>
	<label>请选择安装包：</label>
	<input type="file" name="userfile" id="userfile" multiple required /></div><div>
	<input type="submit" name="submit" value="上传" /></div>
	</form></div>';
	//echo '<label>语言：</label><select name="lang" required="required"><option value="中文">中文</option><option value="英文">英文</option><option value="其他">其他</option></select></div><div><label>单机多人：</label><select name="online" required="required"><option value="单机">单机</option><option value="互联网">互联网</option><option value="局域网">局域网</option></select></div><div>';
	

} else {
echo '对不起！您没有有登录！';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>