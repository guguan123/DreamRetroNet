<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$bx = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();
if($bx){
if($name = $bx['zhcn'] ?: $bx['name']){
$title = ''.$name.'';
}
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a>';
if($name = $bx['zhcn'] ?: $bx['name']){
echo '<h1>'.$name.'</h1>';
}
include_once $_SERVER["DOCUMENT_ROOT"] . '/style/user.php';
echo '<div id="nav"><a href="/">首页</a>';
if($name = $bx['zhcn'] ?: $bx['name']){
echo '<span>'.$name.'</span></div>';
}
echo '<main class="container"><div id="main">';



$b = $con->query("SELECT * FROM `file` WHERE `id` = '".$id."'")->fetch_assoc();
$x = $con->query("SELECT * FROM `files` WHERE `id` = '".$id."'")->
fetch_assoc();
$g = $con->query("SELECT * FROM `games` WHERE `id` = '".$id."'")->
fetch_assoc();
//$s = $con->query("SELECT * FROM `user` WHERE `id` = '".$x['id_user']."'")->fetch_assoc();
$us = $con->query("SELECT * FROM `user` WHERE `id` = '".$x['id_user']."'")->
fetch_assoc();
if($b){
if($b['ivent']==0){
  echo '该应用审核不通过！';
  include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
  exit;
}
$title = ''.$b['name'].'';

$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/down/files/'.$x['down'].'');

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


//echo '<body class="subpage"><div id="header"><a href="#back" onclick="history.back();" class="iconfont icon-fanhui"></a><h1>'.$b['name'].'</h1>';
echo '<div class="game clearfix bg-white"><a href="/file/'.$b['id'].'"><img src="/icon/'.$b['id'].'" width="46" height="46" alt="图标" /></a><div><h3><a href="/file/'.$b['id'].'">';
if($name = $b['zhcn'] ?: $b['name']){
echo ''.$name.'</a></h3>';
}
echo '<div class="small-font">'.platform($b['platform']).'</a>&nbsp;';
$msssa = $con->query("SELECT * FROM `class` WHERE `id` = '".$b['id_raz']."'"); 
while($wss = $msssa->fetch_assoc()){
echo '<a href="/class/'.$wss['id'].'">'.$wss['name'].'</a>&nbsp;<a href="/author?vendor='.$b['author'].'">'.$b['author'].'</a>&nbsp;'.$b['downs'].'下载&nbsp;';
}
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
echo ''.$number.'评论';
echo '</div></div></div>';

$ms = $con->query("SELECT * FROM `image` WHERE `id_file` = '".$b['id']."' ORDER BY `id` ASC LIMIT 10");
if($ms){
echo '<div id="screens">';
while($w = $ms->fetch_assoc()){
echo '<img class="img_rms" src="/down/images/'.$w['url'].'">';
}
echo '</div>';
}

echo '<h2 class="topic margin-top bg-white">下载</h2>';
$files = $con->query("SELECT * FROM `files` WHERE `id_file` = '".$b['id']."' ORDER BY `id` DESC");
echo '<ul class="list line padding bg-white">';
while($x = $files->fetch_assoc()){

$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/down/files/'.$x['down'].'');
$list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
    $ftext = readZipText("../../down/files/".$x["down"]."" . $file, "META-INF/MANIFEST.MF"); 
echo '<li>'.name($x['id_user']).'<a href="/download/'.$x['id'].'">'.dpi($x['dpi']).'</a><div class="small-font">' . getJarIniName($ftext, "MIDlet-Version") . '&nbsp;&nbsp;'.$size.'&nbsp;&nbsp;'.zh($x['zh']).'&nbsp;&nbsp;'.DJ($x['DJ']).'&nbsp;&nbsp;'.pay($x['pay']).'&nbsp;&nbsp;'.vv($x['vv']).'';
if ($x['text500']){
//$games = $con->query("SELECT * FROM `games` WHERE `id_files` = '".$x['id']."' ORDER BY `id` DESC");
//while($g = $games->fetch_assoc()){
echo '&nbsp;&nbsp'.$x['text500'].'';
//}
}
echo '</li>';
}

echo '</ul>';
echo '<h2 class="topic margin-top bg-white">';
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
if ($number){
echo '<a href="/comment/'.$b['id'].'" class="right">查看'.$number.'条</a>';
}
echo '评论</h2>';
if ($user['id']){
echo '<form class="form bg-white" action="/comment/'.$b['id'].'" method="post"><div><textarea rows="5" cols="30" name="text" placeholder="这里填写评论内容……"></textarea></div><div><input type="submit" name="add" value="提交" /></div></form>';
}
echo '<ul class="list comment line padding bg-white" id="comment">';
//($number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
//echo '<div class="margin_site_title_file"><span class="title"><a href="/comment/'.$b['id'].'">评论</a>'.$number.'</span></div>';
$comment = $con->query("SELECT * FROM `comment` WHERE `id_obmen` = '".$id."' ORDER BY `id` DESC LIMIT 5");
while($comm = $comment->fetch_assoc()){
echo '<li class="clearfix">'.user($comm['id_user']).'</a>'.text($comm['text']).'</p>';
//}else{
//echo '<div class="quote small-font"><a href="/user/17173">'.user($comm['id_user']).'</a>：'.text($comm['text']).'</div>';
//}
echo '<div class="small-font"><a href="/reply/'.$comm['id'].'" class="right">回复</a>'.data($comm['time']).'</div></div></li>';

//echo '<li class="clearfix"></a><div><p><a href="/info/'.$b['id_user'].'">'.user($comm['id_user']).'</a>：'.text($comm['text']).'</p>';
//}else{
//echo '<div class="quote small-font"><a href="/user/17173">'.user($comm['id_user']).'</a>：'.text($comm['text']).'</div>';
//}

//echo '<div class="margin_site_title_file"><span class="title_file">描述</span></div> '.text($b['text']).' 
//<div class="margin_site_title_file"><span class="title_file">信息</span></div>
//<b>上传者</b>: <a href="/info/'.$b['id_user'].'">'.$us['login'].'</a></br>
//<b>分辨率</b>:'.dpi($b['dpi']).'<br>';
//<b>平台</b>:'.platform($b['platform']).'<br>
//<b>格式</b>:  '.$b['format'].'<br> 
//<b>大小</b>: '.$size.' ';
//if($user['admin_level']>=2){
//echo '<div class="a_p"><a href="/file_del/'.$b['id'].'">删除</a> <a href="/file_edit/'.$b['id'].'">编辑</a> 
//<a href="/add_image/'.$b['id'].'">添加截图</a></div>';
//}
//$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$id.'"')->num_rows;
//echo '<div class="margin_site_title_file"><span class="title"><a href="/comment/'.$b['id'].'">评论</a>'.$number.'</span></div>';
//$comment = $con->query("SELECT * FROM `comment` WHERE `id_obmen` = '".$id."' ORDER BY `id` DESC LIMIT 5");
//while($comm = $comment->fetch_assoc()){
//if($user['id'] != $comm['id_user']) {$ot = '<a href="/reply/'.$comm['id'].'">[回复]</a>';}else{$ot = '';}
//echo '<div class="komm_news">'.user($comm['id_user']).' ('.data($comm['time']).')</br>
//'.text($comm['text']).'</br>'.$ot.'';
if($user['admin_level']>=1) echo '<a href="/comment/'.$comm['id'].'&del&id_k='.$comm['id'].'"> [删除] </a> <a href="/comment_edit/'.$comm['id'].'"> [编辑] </a>';
}
echo '</ul></div>';
 
echo '<div id="aside">';
//echo '<div class="margin_site_title_file"><span class="title">类似的游戏</span></div><div class="block">';
$mda = $con->query("SELECT * FROM `file` WHERE id>= (SELECT floor(RAND() * (SELECT MAX(id) FROM file))) AND `author` = '".$b['author']."' AND `ivent` = 1 ORDER BY `id` DESC LIMIT 5");
//$ma = $con->query("SELECT * FROM `file` WHERE `id` = '".$b['author']."'"); 
//while($s = $ma->fetch_assoc()){
echo '<h2 class="topic margin-top bg-white"><a href="/author?vendor='.$b['author'].'">同厂应用</a></h2>';
echo '<ul class="list icon small line1 c">';
while($aa = $mda->fetch_assoc()){
echo '<li><a href="/file/'.$aa['id'].'">
<img src="/icon/'.$aa['id'].'" width="45" height="45" alt="图标" />';
if($name = $aa['zhcn'] ?: $aa['name']){
echo ''.$name.'</a></li>';
}
}
echo'</ul>';
//}

$mds = $con->query("SELECT * FROM `file` WHERE id>= (SELECT floor(RAND() * (SELECT MAX(id) FROM file))) AND `id_raz` = '".$b['id_raz']."' AND `ivent` = 1 ORDER BY `id` DESC LIMIT 5");
$msssa = $con->query("SELECT * FROM `class` WHERE `id` = '".$b['id_raz']."'"); 
while($wss = $msssa->fetch_assoc()){
echo '<h2 class="topic margin-top bg-white"><a href="/class/'.$wss['id'].'">同类应用</a></h2>';
echo '<ul class="list icon small line1 c">';
while($aaw = $mds->fetch_assoc()){
echo '<li><a href="/file/'.$aaw['id'].'">
<img src="/icon/'.$aaw['id'].'" width="45" height="45" alt="图标" />';
if($name = $aaw['zhcn'] ?: $aaw['name']){
echo ''.$name.'</a></li>';
}
}
echo'</ul>';
//echo '<div class="link_game"><a href="/file/'.$aaw['id'].'"> <div class="example3">
//<img class="img_rms" src="/icon/'.$aaw['id'].'"> <div class="example_text"><h6>'.$aaw['name'].'</h6><span><i class="fas fa-file-download ic"></i> 下载: '.$aaw['downs'].' 次.</span></div></div></a></div>';

}
}
//echo '</div>';
if($user['id']==$b['id_user'] ?: $user['admin_level']>=3){
echo '<ul class="list icon small line bg-white margin-top"><li><a href="/file_edit/'.$b['id'].'">编辑此应用</a></li></ul>';
echo'</div></div>';
}
echo'</main>';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
