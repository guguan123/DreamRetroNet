<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
$title = '塞班N-Gage上传';
echo '<title>'.$title.'</title>';    
	    if($user['admin_level']=="禁言"){
echo '<link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>请登录之后再操作</p></body>';
exit();
}
if($user) {
	if(isset($_POST['submit'])) {
		$filename = strtolower($_FILES['userfile']['name']);
		// имя и формат файла в нижнем регистре
		$t = preg_replace('#.[^.]*$#', NULL, $filename);
		// имя файла
		$f = str_replace($t, '', $filename);
		// формат файла
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/download/';
		$mds = $con->query("SELECT * FROM `game`  ORDER BY `id` DESC LIMIT 1")->fetch_assoc();
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
			$raz = filtr($_POST['raz']);
			//名字
			$name = filtr($_POST['name']);
			//中文名
			$zh = filtr($_POST['zh']);
			//语言
			//$v = filtr($_POST['v']);
			//版本号
			//$vv = filtr($_POST['vv']);
			//版本
			$platform = filtr($_POST['platform']);
			//平台
			$author = filtr($_POST['author']);
			//提供商
			$DJ = filtr($_POST['DJ']);
			//单人联机
			$dpi = filtr($_POST['dpi']);
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
$con->query("INSERT INTO `game` (`id`, `raz`, `id_user`, `name`, `author`, `platform`, `down`, `zh`, `size`, `DJ`, `dpi`, `time`, `format`) VALUES (NULL, '待审核', '".$user['id']."', '待审核', '待审核', '".$platform."', '".$rand.$f."', '".$zh."', '".$size."', '".$DJ."', '".$dpi."', '".time()."', '".$f."')");

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
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

	    include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
	echo '</header><div id="where"><a href="/">首页</a>'.$title.'</div>';
	
echo '<main class="container"><div id="main">';
	
	echo '<h2 class="topic">上传游戏</h2>
	<form action="" method="post" enctype="multipart/form-data" class="form"><div>
	<select name="platform" required="required">
	<option value="">系统</option>
    <option value="s60v3">s60v3</option>
    <option value="s60v5">s60v5</option>
    <option value="symbian3">symbian3</option>
    <option value="ngage2">ngage2</option>
	</select></div><div>
	<select name="dpi" required="required">
    <option value="">分辨率</option>
    <option value="96×65">96×65</option>
    <option value="128×108">128×108</option>
    <option value="128×128">128×128</option>
    <option value="128×160">128×160</option>
    <option value="132×176">132×176</option>
    <option value="175×220">175×220</option>
    <option value="175×315">175×315</option>
    <option value="176×176">176×176</option>
    <option value="176×208">176×208</option>
    <option value="176×220">176×220</option>
    <option value="176×240">176×240</option>
    <option value="180×320">180×320</option>
    <option value="208×208">208×208</option>
    <option value="208×320">208×320</option>
    <option value="282×320">282×320</option>
    <option value="240×240">240×240</option>
    <option value="240×320">240×320</option>
    <option value="240×400">240×400</option>
    <option value="240×432">240×432</option>
    <option value="320×240">320×240</option>
    <option value="320×480">320×480</option>
    <option value="352×416">352×416</option>
    <option value="360×360">360×360</option>
    <option value="360×640">360×640</option>
    <option value="480×640">480×640</option>
    <option value="480×700">480×700</option>
    <option value="480×720">480×720</option>
    <option value="480×800">480×800</option>
    <option value="640×360">640×360</option>
    <option value="640×480">640×480</option>
    <option value="flex">flex</option>
	</select></div><div>
	<select name="raz" required="required">
	<option value="">类型</option>
	<option value="GAL">GAL - 美少女游戏</option>
	<option value="ACT">ACT - 动作游戏</option>
	<option value="ARPG">ARPG - 动作角色扮演</option>
	<option value="AVG">AVG - 冒险游戏</option>
	<option value="ETC">ETC - 其它游戏</option>
	<option value="FPS">FPS - 第一人称射击</option>
	<option value="FTG">FTG - 格斗游戏</option>
	<option value="MUG">MUG - 音乐游戏</option>
	<option value="RAC">RAC - 赛车游戏</option>
	<option value="RPG">RPG - 角色扮演</option>
	<option value="RTS">RTS - 即时战略</option>
	<option value="SLG">SLG - 战略模拟</option>
	<option value="SPG">SPG - 体育游戏</option>
	<option value="STG">STG - 射击游戏</option>
    <option value="PUZ">PUZ - 益智游戏</option>
    <option value="TAB">TAB - 桌面游戏</option>
    <option value="APP">APP - 应用软件</option>
	</select></div><div>
	<select name="zh" required="required">
	<option value="">语言</option>
    <option value="中文">中文</option>
    <option value="英文">英文</option>
    <option value="其他">其他</option>
    </select></div><div>
	<select name="DJ" required="required">
	<option value="">单机联机</option>
    <option value="单机">单机</option>
    <option value="互联网">互联网</option>
    <option value="局域网">局域网</option>
    </select></div><div>
	<input type="file" name="userfile" id="userfile" multiple required /></div><div>
	<input type="submit" name="submit" value="上传" /></div>
	</form></div>';
	//echo '<label>语言：</label><select name="lang" required="required"><option value="中文">中文</option><option value="英文">英文</option><option value="其他">其他</option></select></div><div><label>单机多人：</label><select name="online" required="required"><option value="单机">单机</option><option value="互联网">互联网</option><option value="局域网">局域网</option></select></div><div>';
	

} else {
echo '对不起！您没有有登录！';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>