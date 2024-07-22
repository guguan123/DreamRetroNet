<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '上传应用';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$title.'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$title.'</span></div>';
echo '<div id="wrapper" class="clearfix"><main class="container"><div id="main">';


if($user) {
	if(isset($_POST['submit'])) {
		$filename = strtolower($_FILES['userfile']['name']);
		// имя и формат файла в нижнем регистре
		$t = preg_replace('#.[^.]*$#', NULL, $filename);
		// имя файла
		$f = str_replace($t, '', $filename);
		// формат файла
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/down/files/';
		$mds = $con->query("SELECT * FROM `files`  ORDER BY `id` DESC LIMIT 1")->fetch_assoc();
        $rand = $mds['id']+1;
		//$rand=rand(1000000000, 9999999999);
		if($f=='.jar' || $f=='.jad' || $f=='.sis' || $f=='.sisx') {
			$t=$rand.$f;
			//.basename($_FILES['userfile']['name']);
			$uploadfile = $uploaddir . $rand.$f;
			//.basename($_FILES['userfile']['name']);
		} else {
		no_upload();
			echo "<div class='err'>上传失败 !</div>";
		}
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		$fid = $con->query("SELECT * FROM `file`  ORDER BY `id` DESC LIMIT 1")->fetch_assoc();
		$fid = $fid['id']+1;
		    $id = filtr($_POST['class']);
			//$name = filtr($_POST['name']);
			//名字
			//$zhcn = filtr($_POST['zhcn']);
			//中文名
			$zh = filtr($_POST['zh']);
			//语言
			//$v = filtr($_POST['v']);
			//版本号
			$vv = filtr($_POST['vv']);
			//版本
			$platform = filtr($_POST['platform']);
			//平台
			//$author = filtr($_POST['author']);
			//提供商
			$DJ = filtr($_POST['DJ']);
			//单人联机
			$dpi = filtr($_POST['dpi']);
			//分辨率
			$pay = filtr($_POST['pay']);
			//扣费方式
			$text500 = filtr($_POST['text500']);
			//介绍
			$con->query("INSERT INTO `file` (`id`, `id_raz`, `id_user`, `down`, `platform`, `rek`, `ivent`) VALUES (NULL, '{$id}', '{$user['id']}', '$rand$f', '{$platform}', '0', '0')");
//
$con->query("INSERT INTO `files` (`id`, `id_file`, `id_user`, `down`, `text500`,  `zh`, `vv`, `DJ`, `pay`, `dpi`, `time`, `format`, `ivent`) VALUES (NULL, '$fid', '{$user['id']}', '$rand$f', '{$text500}', '{$zh}', '{$vv}', '{$DJ}',  '{$pay}', '{$dpi}', '".time()."', '{$f}', '1')");
upload();
			header('Location: /file/'.$fid['id']);
		} else {
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
	echo '<h2 class="topic">上传应用</h2>
	<form action="" method="post" enctype="multipart/form-data" class="form bg-white"><div>
	<label>语言：</label>
	<select name="zh" required="required">
	<option value=""></option>
    <option value="0">中文</option>
    <option value="1">英文</option>
    <option value="2">其他</option>
    </select></div><div>
	<label>平台：</label>
	<select name="platform" required="required">
	<option value="0">J2ME</option>
    <option value="1">S60V1</option>
    <option value="2">S60V2</option>
    <option value="3">S60V3</option>
    <option value="4">S60V5</option>
    <option value="5">Symbian3</option>
    </select></div><div>
    <label>类型：</label>
	<select name="class" required="required">
	$b = $con->query("SELECT * FROM `class`");
	while($w = $b->fetch_assoc()) {
	<option value=""></option>
	<option value="4">ACT - 动作游戏</option>
	<option value="1">ARPG - 动作角色扮演</option>
	<option value="6">AVG - 冒险游戏</option>
	<option value="15">ETC - 其它游戏</option>
	<option value="2">FPS - 第一人称射击</option>
	<option value="10">FTG - 格斗游戏</option>
	<option value="3">MUG - 音乐游戏</option>
	<option value="7">PUZ - 解谜游戏</option>
	<option value="5">RAC - 赛车游戏</option>
	<option value="12">RPG - 角色扮演</option>
	<option value="8">RTS - 即时战略</option>
	<option value="14">SLG - 战略模拟</option>
	<option value="9">SPG - 体育游戏</option>
	<option value="13">STG - 射击游戏</option>
	<option value="11">TAB - 桌面游戏</option>
	}
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
    <label>修改的内容(没有修改勿填)</label>
<textarea name="text500" type="text500" rows="5" cols="30" >
</textarea></div><div>
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