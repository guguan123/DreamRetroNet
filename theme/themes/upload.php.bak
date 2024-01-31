<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = '上传应用';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui title="返回""></a>';
echo '<h1>'.$title.'</h1></a>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
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
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/download/';
		$mds = $con->query("SELECT * FROM `games`  ORDER BY `id` DESC LIMIT 1")->fetch_assoc();
        $rand = $mds['id']+1;
		//$rand=rand(1000000000, 9999999999);
		if($f=='.jar') {
			$t=$rand.$f;
			//.basename($_FILES['userfile']['name']);
			$uploadfile = $uploaddir . $rand.$f;
			//.basename($_FILES['userfile']['name']);
		} else {
		no_upload();
			echo "<div class='err'>上传失败 !</div>";
		}
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		$fid = $con->query("SELECT * FROM `game`  ORDER BY `id` DESC LIMIT 1")->fetch_assoc();
		$fid = $fid['id']+1;
		
		$gid = $con->query("SELECT * FROM `games`  ORDER BY `id` DESC LIMIT 1")->fetch_assoc();
		$gid = $gid['id']+1;
		//$f = $fid['id'];
		    //$id = filtr($_POST['id']);
			$id_raz = filtr($_POST['id_raz']);
			//名字
			$name = filtr($_POST['name']);
			//中文名
			$zh = filtr($_POST['zh']);
			//语言
			//$v = filtr($_POST['v']);
			//版本号
			$vv = filtr($_POST['vv']);
			//版本
			$platform = filtr($_POST['platform']);
			//平台
			$author = filtr($_POST['author']);
			//提供商
			$DJ = filtr($_POST['DJ']);
			//单人联机
			$dpi = filtr($_POST['dpi']);
			//分辨率
			$pay = filtr($_POST['pay']);
			//扣费方式
			//$text500 = filtr($_POST['text500']);

			//介绍
			function get_basename($filename){
    return preg_replace('/^.+[\\\\\\/]/', '', $filename);
}

/**
 * 获取文件目录列表
 * @param string $pathname 路径
 * @param integer $fileFlag 文件列表 0所有文件列表,1只读文件夹,2是只读文件(不包含文件夹)
 * @param string $pathname 路径
 * @return array
 */
function get_file_folder_List($pathname,$fileFlag = 0, $pattern='*') {
    $fileArray = array();
    $pathname = rtrim($pathname,'/') . '/';
    $list   =   glob($pathname.$pattern);
    foreach ($list  as $i => $file) {
        switch ($fileFlag) {
            case 0:
                $fileArray[]=get_basename($file);
                break;
                
            case 1:
                if (is_dir($file)) {
                    $fileArray[]=get_basename($file);
                }
                break;

            case 2:
                if (is_file($file)) {
                    $fileArray[]=get_basename($file);
                }
                break;

            default:
                break;
        }
    }

    if(empty($fileArray)) $fileArray = NULL;
    return $fileArray;
}

//读取zip文件内文本
function readZipText($fpath, $fname)
{
    $result = "";
    $zip_file = zip_open($fpath); 
    if(is_resource($zip_file))  
    {
        while($zipfiles = zip_read($zip_file))
        {
            $file_name = zip_entry_name($zipfiles); 
            if(strcmp($fname, $file_name)==0)
            {
                $file_size = zip_entry_filesize($zipfiles);
                if(zip_entry_open($zip_file, $zipfiles))
                {
                    $result = zip_entry_read($zipfiles, $file_size);
                    zip_entry_close($zipfiles);
                }             
                break;
            }
        }
        zip_close($zip_file); 
    }  
    else
    {
        echo($zip_file . "Archive File Cannot Be Opened"); 
    }
    return $result;
}

//gbk转utf8
function gbk2utf8($str){ 
    $charset = mb_detect_encoding($str,array('UTF-8','GBK','GB2312')); 
    $charset = strtolower($charset); 
    if('cp936' == $charset){ 
        $charset='GBK'; 
    } 
    if("utf-8" != $charset){ 
        $str = iconv($charset,"UTF-8//IGNORE",$str); 
    } 
    return $str; 
}

//匹配类ini文本
function getJarIniName($text, $key)
{
    $name = "";
    $pattern = "<" . $key . ":.*>";
    preg_match($pattern, $text, $name);  
    $result = str_replace($key . ": ","", implode("",$name));
    return str_replace("\n", "", $result);
}
$list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
    $ftext = readZipText("../download/".$rand."".$f."" . $file, "META-INF/MANIFEST.MF"); 
    $upload = $con->query("SELECT name, author FROM `game` WHERE `name` = '" . getJarIniName($ftext, "MIDlet-Name") . "' AND `author` = '" . getJarIniName($ftext, "MIDlet-Vendor") . "'")->num_rows;
//    $key = getJarIniName($ftext, "MIDlet-Name");
//$uploads = $con->query("SELECT * FROM `game` WHERE `name` = '" . getJarIniName($ftext, "MIDlet-Name") . "' ORDER BY `id` DESC")->num_rows;
  //  $f = $upload['id'];
  $up = $upload['id'];
if ($upload > 0){
//if ($con->query("INSERT INTO `games` (`id`, `id_game`, `id_user`, `down`, `zh`, `vv`, `DJ`, `pay`, `dpi`, `time`, `format`) VALUES (NULL, '$up', '{$user['id']}', '$rand$f', '{$zh}', '{$vv}', '{$DJ}',  '{$pay}', '{$dpi}', '".time()."', '{$f}')") === TRUE) {
   // echo "新记录插入成功";
  //  echo ''.$up.'';
//} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
//}
$con->query("INSERT INTO `games` (`id`, `id_game`, `id_user`, `down`, `zh`, `vv`, `DJ`, `pay`, `dpi`, `time`, `format`) VALUES (NULL, '$up', '{$user['id']}', '$rand$f', '{$zh}', '{$vv}', '{$DJ}',  '{$pay}', '{$dpi}', '".time()."', '{$f}')");
//$con->query("UPDATE `games` SET `id_game` = '".$up."', `id_user` = '".$user['id']."', `baidu_pic` = '".$_SESSION['smallpic']."' WHERE `baidu_id` = '$baidu_id'"););
}else{
$con->query("INSERT INTO `game` (`id_raz`, `id_user`, `name`, `author`, `down`, `platform`) VALUES ('{$id_raz}', '{$user['id']}', '" . getJarIniName($ftext, "MIDlet-Name") . "', '" . getJarIniName($ftext, "MIDlet-Vendor") . "', '$rand$f', '{$platform}')");
$con->query("INSERT INTO `games` (`id`, `id_game`, `id_user`, `down`, `zh`, `vv`, `DJ`, `pay`, `dpi`, `time`, `format`) VALUES (NULL, '$fid', '{$user['id']}', '$rand$f', '{$zh}', '{$vv}', '{$DJ}',  '{$pay}', '{$dpi}', '".time()."', '{$f}')");
}
//if ($con->query("INSERT INTO `games` (`id`, `id_game`, `id_user`, `down`, `zh`, `vv`, `DJ`, `pay`, `dpi`, `time`, `format`) VALUES (NULL, '$up', '{$user['id']}', '$rand$f', '{$zh}', '{$vv}', '{$DJ}',  '{$pay}', '{$dpi}', '".time()."', '{$f}')"); === TRUE) {
    //echo "新记录插入成功";
//} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
//}

			//header('应用上传成功);
			header('Location: /games/uploads/'.$gid.'');
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
	echo '<h2 class="topic">上传游戏</h2>
	<form action="" method="post" enctype="multipart/form-data" class="form bg-white"><div>
	<label>分辨率：</label>
	<select name="dpi" required="required">
	<option value=""></option>
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
    <option value="flex">flex</option>
	</select></div><div>
	<label>系统：</label>
	<select name="platform" required="required">
	<option value="J2ME">J2ME</option>
    </select></div><div>
    <label>类型：</label>
	<select name="id_raz" required="required">
	<option value=""></option>
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
	<option value="APP">APP - 应用软件</option>
	</select></div><div>
	<label>语言：</label>
	<select name="zh" required="required">
    <option value="中文">中文</option>
    <option value="英文">英文</option>
    <option value="其他">其他</option>
    </select></div><div>
	<label>版本：</label>
	<select name="vv" required="required">
    <option value="完整">完整版</option>
    <option value="汉化">汉化版</option>
    <option value="BT">BT版</option>
    <option value="试玩">试玩版</option>
    </select></div><div>
    <label>单人多人：</label>
	<select name="DJ" required="required">
    <option value="单机">单机</option>
    <option value="互联网">互联网</option>
    <option value="局域网">局域网</option>
    </select></div><div>
    <label>扣费方式：</label>
	<select name="pay" required="required">
    <option value="免费">免费</option>
    <option value="短信扣费">短信扣费</option>
    <option value="连网扣费">连网扣费</option>
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
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>