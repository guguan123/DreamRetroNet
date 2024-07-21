<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$bx = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();
if($bx){
if($name = $bx['cn'] ?: $bx['name']){
$title = ''.$name.'';
echo '<meta itemprop="name" content="《'.$name.'》Mobile game download developed by '.$bx['author'].'。" />
<meta name="description" itemprop="description" content="《'.$name.'》Mobile game download developed by '.$b['author'].'。" />
<meta name="KeyWords" content="'.$name.','.$name.' Mobile version,'.$name.'java,'.$bx['author'].',Code Farmer Li Bai '.$name.','.$name.' download">';
}
}

include_once $_SERVER["DOCUMENT_ROOT"].'/en/M/c/header.php';

echo '<body class="subpage"><header><a href="#back" onclick="history.back();" class="iconfont icon-fanhui" title="返回"></a>';
echo '<h2>'.$title.'</h2><a href="/"><img src="/favicon.ico" width="32" height="32" alt="续梦网logo" /><h1>'.$title2.'</h1>';
include_once $_SERVER["DOCUMENT_ROOT"] . '/en/M/c/user.php';
echo '<div id="nav" class="container"><a href="/">Home</a><a href="/games">list</a>';
if($name = $bx['cn'] ?: $bx['name']){
echo '<span>'.$name.'</span></div>';
}
echo '<main class="container"><div id="main">';


$b = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();
$x = $con->query("SELECT * FROM `games` WHERE `id_game` = '".$id."' ORDER BY `id` ASC LIMIT 1")->fetch_assoc();
//$g = $con->query("SELECT * FROM `games` WHERE `id` = '".$id."'")->
//fetch_assoc();

if($b){
if($b['id'] ->num_rows >0){
 echo '<body id="notice"><h2 class="topic">消息提示</h2><p>你防问的游戏不存在</p>';
echo '</p><p><a href="#back" class="button">返回</a></p>';
  exit;
}
$title = ''.$b['name'].'';

$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/download/'.$x['down'].'');

//echo '<div class="block"><div class="b_flex_down_l"><h1>'.$b['name'].'</h1>'; $msssa = $con->query("SELECT * FROM `class` WHERE `id` = '".$b['id_raz']."'"); while($wss = $msssa->fetch_assoc()){echo '<h2>'.$wss['name'].'</h2>';} echo '</div><div class="b_flex_down_r"><a href="/download/'.$b['id'].'"><button class="down">下载</button></a></div></div>';

//$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$b['id']."' ORDER BY `id` ASC LIMIT 10");
//if($ms){
//echo "还没有游戏截图！";
//}else{
//while($w = $ms->fetch_assoc()){
//echo '<div class="carousel-cell"><img class="img_rms" src="/down/images/'.$w['url'].'"></div>';
//}
//}
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
        //echo($zip_file . "Archive File Cannot Be Opened"); 
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


$s = $con->query('SELECT * FROM `image` WHERE `id_game` = "'.$id.'"')->fetch_assoc();
if($s['background']==1){
echo '<div class="game" style="background-image: url(/M/s/'.$s['url'].')" ><div><img src="/M/i/'.$b['icon'].'" width="46" height="46" alt="图标" /><div>';
}else{
//echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a><h1>'.$b['name'].'</h1>';
echo '<div class="game"><div><img src="/M/i/'.$b['icon'].'" width="46" height="46" alt="图标" /><div>';
}
if($name = $b['cn'] ?: $b['name']){
echo '<h3>'.$name.'</a></h3>';
}
echo '<div class=""><a href="/games?system='.$b['platform'].'">'.$b['platform'].'</a><a href="/games?category='.$b['id_raz'].'">'.$b['id_raz'].'</a><a href="/games?vendor='.$b['author'].'">'.$b['author'].'</a><span>'.$b['downs'].' downloads</span>';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
echo '<span>'.$number.' comments</span>';
$list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
    $ftext = readZipText("../../download/".$x["down"]."" . $file, "META-INF/MANIFEST.MF"); 
if($text = $b['text'] ?: getJarIniName($ftext, "MIDlet-Description") ?: getJarIniName($ftext, "MIDlet-Name")){
echo '<a href="/feedbacks/add?games_id=14184">举报</a></div><p>Introduction：'.$text.'</p></div></div></div>';
}
//$ms = $con->query("SELECT * FROM `image` WHERE `id_game` = '".$b['id']."' ORDER BY `id` ASC LIMIT 10");

echo '<div data-url="/packages/'.$b['id'].'" data-tpl="packagelist" class="margin-top"></div><div data-url="/screens/'.$b['id'].'" data-tpl="screenlist" class="margin-top"></div>';
//echo '<img class="img_rms" src="/M/s/'.$w['url'].'">';

echo '<h2 class="topic margin-top">';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
if ($number){
echo '<a href="/comments/'.$b['id'].'" class="right">View '.$number.'</a>';
}
echo 'View</h2>';
if($user){
echo '<form action="/comments/'.$b['id'].'" method="post"><div><textarea rows="2" cols="30" name="text" placeholder="这里填写内容……"></textarea><input type="submit" name="add" value="提交" /></div></form>';
}
echo '<ul data-url="/comments?games='.$b['id'].'" data-tpl="commentlist"></ul></div>';
//($number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
//echo '<div class="margin_site_title_file"><span class="title"><a href="/comment/'.$b['id'].'">评论</a>'.$number.'</span></div>';
 
echo '<div id="aside">';
echo '<div class="twobuttons"><a href="/games/upload" class="button green">Upload JAR</a><a href="/screens/upload/'.$b['id'].'" class="button green">upload screenshot</a></div>';
//echo '<div class="margin_site_title_file"><span class="title">类似的游戏</span></div><div class="block">';

echo '<h2 class="topic margin-top"><a href="/games?vendor='.$b['author'].'">Same factory</a></h2>';
echo '<ul data-url="/games?vendor='.$b['author'].'&amp;order=rnd&amp;pagesize=10" data-tpl="gamesimple"></ul>';

echo '<h2 class="topic margin-top"><a href="/games?category='.$b['id_raz'].'">similar</a></h2>';

echo '<ul data-url="/games?category='.$b['id_raz'].'&amp;order=rnd&amp;pagesize=10" data-tpl="gamesimple"></ul>';

echo '<h2 class="topic margin-top">people of the same taste</h2>';
echo '<div data-url="/playing/getUsers/'.$b['id'].'/1" data-tpl="facewall"></div></div>';
}
//echo '</div>';
if($user['id']==$b['id_user'] ?: $user['admin_level']>=3){
echo '<ul class="list list2 margin-top"><li><a href="/game/edit/'.$b['id'].'">edit</a></li></ul>';
echo'</div>';
}
echo'</main>';
include_once $_SERVER["DOCUMENT_ROOT"].'/en/M/c/foot.php';
?>