
<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '增加安装包';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a>';
echo '<h1>'.$title.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav"><span>位置：</span><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><div id="main">';
$b = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();

if($user) {
	if(isset($_POST['submit'])) {
		$filename = strtolower($_FILES['userfile']['name']);
		// имя и формат файла в нижнем регистре
		$t = preg_replace('#.[^.]*$#', NULL, $filename);
		// имя файла
		$f = str_replace($t, '', $filename);
		// формат файла
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/down/files/';
		$x = $con->query("SELECT * FROM `files`  ORDER BY `id` DESC LIMIT 1")->fetch_assoc();
		$rand = $x['id']+1;
		//$rand=rand(1000000000, 9999999999);
		if($f=='.jar' || $f=='.jad' || $f=='.sis' || $f=='.sisx') {
			$t=$rand.$f;
			//.basename($_FILES['userfile']['name']);
			$uploadfile = $uploaddir . $rand.$f;
			//.basename($_FILES['userfile']['name']);
		} else {
			echo "<div class='err'>上传失败 !</div>";
		}
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		    $id = filtr($_POST['id']);
			$id_file = filtr($_POST['id_file']);
			//应用详情
			//$zhcn = filtr($_POST['zhcn']);
			//中文名
			$zh = filtr($_POST['zh']);
			//语言
			//$id_user = filtr($_POST['id_user']);
			//版本号
			$vv = filtr($_POST['vv']);
			//版本
			//$platform = filtr($_POST['platform']);
			//平台
			//$author = filtr($_POST['author']);
			//提供商
			$DJ = filtr($_POST['DJ']);
			//单人联机
			$dpi = filtr($_POST['dpi']);
			//分辨率
			$pay = filtr($_POST['pay']);
			//扣费方式
			//$text = filtr($_POST['text']);
			//介绍
			//$con->query("update `file` set `id_user`) VALUES 
//('{$fuser['id']}')");
			$con->query("INSERT INTO `files` (`id_file`, `zh`, `vv`, `DJ`, `dpi`, `pay`, `id_user`, `time`, `down`, `format`) VALUES 
('{$b['id']}', '{$zh}', '{$vv}', '{$DJ}', '{$dpi}', '{$pay}', '{$user['id']}', '".time()."', '".$rand.$f."', '{$f}')");
add_upload();
			//header('Location: /file/'.$id);
			header("Location: add_upload();");
			
		} else {
		no_upload();
			err('Ошибка');
		}
	}
	//echo '
//<span class="title">添加</span><div class="link">
//上传的应用需要审核过才能显示。
//<form action="" method="post" enctype="multipart/form-data">
//<b>分类</b></br><select name="class">';
//$b = $con->query("SELECT * FROM `class`");
	//while($w = $b->fetch_assoc()) {
	$a = $con->query("SELECT * FROM `files` WHERE `id_file` = '".$b['id']."'");
echo '<h2 class="topic">'.$b['name'].'文件列表</h2>';
while($apps=$a->fetch_assoc()){
		echo "{$apps['down']}";
	}
	echo '<h2 class="topic">增加应用</h2>
	<form action="" method="post" enctype="multipart/form-data" class="form bg-white"><div>
	<label>语言：</label>
	<select name="zh" required="required">
	<option value=""></option>
    <option value="0">中文</option>
    <option value="1">英文</option>
    <option value="2">其他</option>
    </select></div><div>
	<label>分辨率：</label>
	<select name="dpi" required="required">
	<option value=""></option>
    <option value="1">128×160</option>
    <option value="2">132×176</option>
    <option value="3">175×220</option>
    <option value="4">176×208</option>
    <option value="5">176×220</option>
    <option value="6">176×240</option>
    <option value="7">208×208</option>
    <option value="8">208×320</option>
    <option value="9">240×240</option>
    <option value="10">240×320</option>
    <option value="11">240×400</option>
    <option value="12">240×432</option>
    <option value="13">320×240</option>
    <option value="14">320×480</option>
    <option value="15">360×640</option>
    <option value="16">480×640</option>
    <option value="17">480×700</option>
    <option value="18">480×720</option>
    <option value="19">480×800</option>
    <option value="0">自适屏</option>
	</select></div><div>
	<label>版本：</label>
	<select name="vv" required="required">
	<option value=""></option>
    <option value="0">完整版</option>
    <option value="1">汉化版</option>
    <option value="2">BT版</option>
    <option value="3">试玩版</option>
    </select></div><div>
    <label>单人联机：</label>
	<select name="DJ" required="required">
	<option value=""></option>
    <option value="0">单机</option>
    <option value="1">互联网</option>
    <option value="2">局域网</option>
    </select></div><div>
    <label>扣费方式：</label>
	<select name="pay" required="required">
	<option value=""></option>
    <option value="0">免费</option>
    <option value="1">短信扣费</option>
    <option value="2">连网扣费</option>
    </select></div><div>
	<label>JAR包：</label>
	<input type="hidden" name="MAX_FILE_SIZE" value="9000000000" required="required" /></div><div>
	<input type="file" name="userfile" id="userfile"></div><div>
	<input type="submit" name="submit" value="提交" /></div>
	</form></div>';
	//echo '<label>语言：</label><select name="lang" required="required"><option value="中文">中文</option><option value="英文">英文</option><option value="其他">其他</option></select></div><div><label>单机多人：</label><select name="online" required="required"><option value="单机">单机</option><option value="互联网">互联网</option><option value="局域网">局域网</option></select></div><div>';
	

} else {
echo '对不起！您没有有登录！';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>