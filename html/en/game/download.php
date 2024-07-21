<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
$title = 'Загрузка';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

//aut();
$b = $con->query("SELECT * FROM `games` WHERE `id` = '".$id."'")->fetch_assoc();
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
    $result = str_replace($key . ":", "", implode("", $name));
    return str_replace("\n", "", $result);
}
if($b){
  //  if($b['ivent']==0){
        //echo '该应用审核不通过！';
       // include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
      //  exit;
    //  }
    $d = $con->query("SELECT * FROM `game` WHERE `id` = '".$b['id_game']."'")->fetch_assoc();
    $list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
$ftext = readZipText("../../download/".$b['down']."". $file, "META-INF/MANIFEST.MF"); 
$file_url = '../../download/'.$b['down'].'';
$file_names = ''.getJarIniName($ftext, "MIDlet-Name").'';
$file_jar = trim($file_names);
if($name=$d['cn'] ?: $file_jar){
$file_name = ''.$name.''.$b['format'].'';
}
//echo $file_name;

 if(!file_exists($file_url)) {

     echo "不存在";

 }else{
$con->query("UPDATE `game` SET `downs` = `downs`+'1' WHERE `id` = '".$b['id_game']."'");
if ($user['id']){
$con->query("UPDATE `user` SET `downs` = `downs`+'1' WHERE `id` = '".$user['id']."'");

$down = $con->query(" SELECT * FROM `game_download` WHERE `user_id` = '".$user['id']."' AND `game_id` = '".$b['id_game']."'")->num_rows;
if ($down > 0){
$con->query("UPDATE `game_download` SET `downs` = `downs`+'1' WHERE `user_id` = '".$user['id']."' AND `game_id` = '".$b['id_game']."'");
}else{
$con->query("INSERT INTO `game_download` (`id`, `user_id`, `downs`, `game_id`) VALUES (NULL, '".$user['id']."', '1', '".$b['id_game']."')");
}
}

header('Accept-Ranges: bytes');

           header('Accept-Length: ' . filesize( $file_url ));

           header('Content-Transfer-Encoding: binary');

           header('Content-type: application/octet-stream');

           header('Content-Disposition: attachment; filename=' . $file_name);

           header('Content-Type: application/octet-stream; name=' . $file_name);
ob_end_clean();
           if(is_file($file_url) && is_readable($file_url)){

                $file = fopen($file_url, "r");

                 echo fread($file, filesize($file_url));

                 fclose($file);

            }
}
}

?>