<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$bx = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
if ($bx){
if($name = $bx['cn'] ?: $bx['name']){
$title = ''.$name.'编辑';
echo '<title>'.$title.'</title>';
aut();
echo '<body class="subpage"><header><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="返回"></a>';
echo '<h2>'.$title.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">首页</a><a href="/games">列表</a>';
echo '<span>'.$name.'</span></div>';
}
}
echo '<main class="container"><div id="main">';

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
    //    echo($zip_file . "Archive File Cannot Be Opened"); 
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


//$x = $con->query("SELECT * FROM `files` WHERE `id` = '".$id."'")->fetch_assoc();
$b = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();
//$x = $con->query("SELECT * FROM `games` WHERE `id_game` = '".$id."' ORDER BY `id` ASC LIMIT 1")->fetch_assoc();
$size = getFilesizes($_SERVER['DOCUMENT_ROOT'].'/download/'.$b['down'].'');
if($b['id_user']==$user['id'] ?: $user['admin_level']=="管理员"){
$list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
    $ftext = readZipText("../download/".$b["down"]."" . $file, "META-INF/MANIFEST.MF"); 
    
if($b){
if(isset($_POST['add'])){
$raz = filtr($_POST['raz']);
$text = filtr($_POST['text']);
$author = filtr($_POST['author']);
$name = filtr($_POST['name']);
$cn = filtr($_POST['cn']);
$platform = filtr($_POST['platform']);
$id_user = filtr($_POST['id_user']);
$v = filtr($_POST['v']);
$dpi = filtr($_POST['dpi']);
$zh = filtr($_POST['zh']);
$DJ = filtr($_POST['DJ']);
$rek = filtr($_POST['rek']);
$ivent = filtr($_POST['ivent']);
$icon = filtr($_POST['icon']);
$sizes = filtr($_POST['sizes']);
$downs = abs(intval($_POST['downs']));
//if(mb_strlen($text) < '1' or mb_strlen($text) > '9900') $err = 'Текст либо менее 1 либо более 9900 символов';

if($err){ 
err($err);
}else{
$con->query("UPDATE `game` SET `text` = '".$text."', `raz` = '".$raz."', `cn` = '".$cn."', `platform` = '".$platform."', `zh` = '".$zh."', `DJ` = '".$DJ."', `dpi` = '".$dpi."' WHERE `id` = '".$id."'");
if($user['admin_level']=="管理员"){

$con->query("UPDATE `game` SET `id_user` = '".$id_user."', `name` = '".$name."', `author` = '".$author."', `v` = '".$v."', `icon` = '".$icon."', `size` = '".$sizes."' WHERE `id` = '".$id."'");
}
header('Location: /game/'.$b['id']);
}
}
//游戏名
$jar_name = ''.getJarIniName($ftext, "MIDlet-Name").'';
$names = trim($jar_name);
//供应商
$jar_vendor = ''.getJarIniName($ftext, "MIDlet-Vendor").'';
$vendor = trim($jar_vendor);
//版本
$jar_version = ''.getJarIniName($ftext, "MIDlet-Version").'';
$version = trim($jar_version);
//介绍
$jar_descr = ''.getJarIniName($ftext, "MIDlet-Description").'';
$descr = trim($jar_descr);
echo '<h2 class="topic">编辑游戏资料</h2>
<form action="" method="post" class="form bg-white"><div>';
if($user['admin_level']=="管理员"){
echo '
<label>用户id</label>
<input name="id_user" type="id_user"value="'.$b['id_user'].'">
</div><div>
<label>图标：</label>
<input type="text" name="icon" value="'.$b['icon'].'" >
</div><div>
<label>大小：</label>
<input type="text" name="sizes" value="'.$size.'" >
</div><div>';
}
echo '
<label>游戏名：</label>
<input type="text" name="name" value="'.$names.'" readonly="true" >
</div><div>
<label>中文名：</label>
<input type="text" name="cn" value="'.$b['cn'].'" /></div><div>
<label>平台：</label>
<select name="platform" required="required">
<option value="'.$b['platform'].'">'.$b['platform'].'</option>
<option value="J2ME">J2ME</option>
    <option value="S60V1">S60V1</option>
    <option value="S60V2">S60V2</option>
    <option value="S60V3">S60V3</option>
    <option value="S60V5">S60V5</option>
    <option value="Symbian3">Symbian3</option>
    <option value="N-Gage2">N-Gage</option>
</select></div><div>
<label>分辨率</label>
<select name="dpi" required="required" >
<option value="'.$b['dpi'].'">'.$b['dpi'].'</option>
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
<label>语言：</label>
<select name="zh" required="required">
<option value="'.$b['zh'].'">'.$b['zh'].'</option>
<option value="中文">中文</option>
<option value="英文">英文</option>
<option value="其他">其他</option>
</select></div><div>
<label>提供商：</label>
<input type="text" name="author" value="'.$vendor.'" readonly="true" >
</div><div>
<label>版本：</label>
<input type="text" name="v" value="'.$version.'" readonly="true">
</div><div>
<label>类型：</label>
<select name="raz" required="required">
	//$b = $con->query("SELECT * FROM `class`");
	//while($w = $b->fetch_assoc()) {
	<option value="'.$b['raz'].'">'.$b['raz'].'</option>
	<option value="ACT">ACT - 动作游戏</option>
	<option value="ARPG">ARPG - 动作角色扮演</option>
	<option value="AVG">AVG - 冒险游戏</option>
	<option value="ETC">ETC - 其他游戏</option>
	<option value="FPS">FPS - 第一人称射击</option>
	<option value="FTG">FTG - 格斗游戏</option>
	<option value="MUG">MUG - 音乐游戏</option>
	<option value="RAC">RAC - 赛车游戏</option>
	<option value="RPG">RPG - 角色扮演</option>
	<option value="RTS">RTS - 限时战略</option>
	<option value="SLG">SLG - 战略模拟</option>
	<option value="SPG">SPG - 体育游戏</option>
	<option value="STG">STG - 射击游戏</option>
	<option value="APP">APP - 应用软件</option>
	//}
	</select></div><div>
<label>单机联机：</label>
	<select name="DJ" required="required">
<option value="'.$b['DJ'].'">'.$b['DJ'].'</option>
<option value="单机">单机</option>
<option value="互联网">互联网</option>
<option value="局域网">局域网</option>
</select></div><div>';
if($text = $b['text'] ?: $descr ?: $names){
	echo '
<label>描述</label>
<textarea name="text" type="text" rows="5" cols="30" >'.$text.'</textarea>
</div><div></div><div>';
}
echo '<input type="submit" name="add" value="确定" /></div></form></div>';
//echo '<span class="title">编辑文件</span>
//<form action="" method="POST">名字</br><input type="text" name="name" value="'.$b['name'].'"><br/>
//描述</br><textarea name="text">'.$b['text'].'</textarea>
//<br/>下载次数</br><input type="text" name="downs" value="'.$b['downs'].'">
//<br/>审核<br><select name="ivent">
//<option selected value="0">否</option> 
//<option value="1">是</option></select>
//<br>添加到推荐？<br><select name="rek">
//<option selected value="0">否</option> 
//<option value="1">是</option></select>
//<br><input type="submit" name="add" value="保存"></form>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/foot.php';
?>