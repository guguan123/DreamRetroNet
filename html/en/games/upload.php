<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
if($user['admin_level']>=4){
echo '<link rel="stylesheet" href="/M/c/notice.css">';
$title = '消息提示';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>请登录之后再操作</p></body>';
exit();
}
$title = '上传';
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

echo '<body class="subpage"><header><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="返回"></a>';
echo '<h2>'.$title.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><span>'.$title.'</span></div>';
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
			//$vv = filtr($_POST['vv']);
			//版本
			//$platform = filtr($_POST['platform']);
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
     //   echo($zip_file . "Archive File Cannot Be Opened"); 
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
//匹配jar图标名
function getJarIconName($text)
{  
    //读MIDlet-Icon图标  
   // $result = getJarIniName($text, "MIDlet-Icon");
    //echo "方式一：" . $result . "\n";
    
   // 如果读不到MIDlet-Icon，就读MIDlet-1，需要正则匹配
    if($result==false)
    {
        
        $pattern = "<,.*,>";
        $icon = getJarIniName($text, "MIDlet-1");
        if(preg_match($pattern, $icon, $result)<1)
            $result = false;
        else
        {
            $result = str_replace(",", "", implode("", $result));
            $result = str_replace(" ", "", $result);
        }
        //echo "方式二：" . $icon . "\n图标二：" . $result . "\n";
    }
    
    //如果MIDlet-1也读不到，就默认icon.png图标   
    if($result==false)
    {
        //echo "默认图标：icon.png\n";
        $result = "icon.png";
    }

    //返回图标名
    return str_replace("\n", "", $result);
}
$list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
    $ftext = readZipText("../download/".$rand."".$f."". $file, "META-INF/MANIFEST.MF"); 
    $ticon = readZipText("../download/".$rand."".$f."". $file, getJarIconName($ftext));
    $upload = $con->query("SELECT name, author FROM `game` WHERE `name` = '" . getJarIniName($ftext, "MIDlet-Name") . "' AND `author` = '" . getJarIniName($ftext, "MIDlet-Vendor") . "'")->fetch_assoc();
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
$con->query("INSERT INTO `games` (`id`, `id_game`, `id_user`, `down`, `zh`, `DJ`, `dpi`, `time`, `format`) VALUES (NULL, '$up', '{$user['id']}', '$rand$f', '{$zh}', '{$DJ}', '{$dpi}', '".time()."', '{$f}')");
//$con->query("UPDATE `games` SET `id_game` = '".$up."', `id_user` = '".$user['id']."', `baidu_pic` = '".$_SESSION['smallpic']."' WHERE `baidu_id` = '$baidu_id'"););
}else{
$file = "../download/".$rand."".$f."";
$outPath = "../M/jar/".$fid."/";
$zip = new ZipArchive();
$openRes = $zip->open($file);
if ($openRes === TRUE) {
  $zip->extractTo($outPath);
  $zip->close();
}

$file_path='../M/jar/'.$fid.'/' . getJarIconName($ftext) . '';
$to_file_path='../M/i/'.$fid.'.png';
if(copy($file_path,$to_file_path)){
  echo 'copy ok';
}else{
  echo 'error';
}
//echo copy("../download/".$fid."/" .getJarIconName($ftext) ."","../M/i/".$fid.".png"); 
$con->query("INSERT INTO `game` (`id_raz`, `id_user`, `name`, `author`, `icon`, `platform`) VALUES ('{$id_raz}', '{$user['id']}', '" . getJarIniName($ftext, "MIDlet-Name") . "', '" . getJarIniName($ftext, "MIDlet-Vendor") . "', '$fid.png', 'J2ME')");
$con->query("INSERT INTO `games` (`id`, `id_game`, `id_user`, `down`, `zh`, `DJ`, `dpi`, `time`, `format`) VALUES (NULL, '$fid', '{$user['id']}', '$rand$f', '{$zh}', '{$DJ}', '{$dpi}', '".time()."', '{$f}')");
}
//if ($con->query("INSERT INTO `games` (`id`, `id_game`, `id_user`, `down`, `zh`, `vv`, `DJ`, `pay`, `dpi`, `time`, `format`) VALUES (NULL, '$up', '{$user['id']}', '$rand$f', '{$zh}', '{$vv}', '{$DJ}',  '{$pay}', '{$dpi}', '".time()."', '{$f}')"); === TRUE) {
    //echo "新记录插入成功";
//} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
//}
echo '<title>消息提示</title><link rel="stylesheet" href="/M/c/notice.css">';
$bx = $con->query("SELECT * FROM `games` WHERE `id` = '".$gid."'")->fetch_assoc();
if($bx['id_game'] > 0){
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>安装成功。</p><p><a href="/game/'.$fid.'" class="button">返回</a></p></body>';
exit();
}else{
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>安装成功,你上传的安装包需要审核。</p></body>';
exit();
}

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
	echo '<h2 class="topic">上传游戏</h2>
	<form action="" method="post" enctype="multipart/form-data" class="form"><div>
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
    <label>单人多人：</label>
	<select name="DJ" required="required">
    <option value="单机">单机</option>
    <option value="互联网">互联网</option>
    <option value="局域网">局域网</option>
    </select></div><div>
	<label>JAR包：</label>
	<input type="file" name="userfile" required="required" id="userfile"></div><div>
	<input type="submit" name="submit" value="提交" /></div>
	</form></div>';
	echo '<div id="aside"><h2 class="topic">注意事项</h2><ul class="list list1"><li>1、请选择正确的分辨率和游戏类型</li><li>2、目前仅可上传JAR格式的手机游戏</li><li>3、SIS和Ngage格式<a href="/games/uploadGame"><em>点击这里</em></a></li><li>4、最大上传容量10MB</li></ul></div></main>';
	

} else {
echo '对不起！您没有有登录！';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>