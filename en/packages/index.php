<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
$id = abs(intval($_GET['id']));
//$games = abs(intval($_GET['games'])); # 
//$new = $con->query("SELECT * FROM `games` ORDER BY `id` DESC");
$gam = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();
//$gam = $con->query("SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 4");
$new = $con->query("SELECT * FROM `games` WHERE `id_game` = '".$gam['id']."'");
//$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$new['id'].'"')->num_rows;
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
if ($gam){
$str="";
foreach($new as $row){
$users = $con->query("SELECT * FROM `user` WHERE `id` = '".$row['id_user']."'")->fetch_assoc();
$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/download/'.$row['down'].'');
$list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
    $ftext = readZipText("../../download/".$row["down"]."" . $file, "META-INF/MANIFEST.MF"); 
     $rowArr = json_encode(array("id" => "".$row['id']."","nickname" => "".$users['name']."","size" => "".$size."","version" => "" . getJarIniName($ftext, "MIDlet-Version") . "","lang" => "".$row['zh']."","resolution" => "".$row['dpi']."","online" => "".$row['DJ']."","format" => "".$row['format']."","users_id" => "".$row['id_user'].""));
    $str=$str.$rowArr."###";
}
$jsonArr=rtrim($str,"###");
echo "{\"packages\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}
?>

