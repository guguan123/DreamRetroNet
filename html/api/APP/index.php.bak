<meta charset="utf-8">
<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
$title = '续梦网APP主页';
//include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';
$new = $con->query("SELECT * FROM `game` ORDER BY `id` DESC LIMIT 20");
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
      //  echo($zip_file . "Archive File Cannot Be Opened"); 
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
$str="";
//$sto="";
foreach($new as $row){
$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$row['id'].'"')->num_rows;
$list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
    $ftext = readZipText("../../download/".$row["down"]."" . $file, "META-INF/MANIFEST.MF"); 
    $jar_name="" . getJarIniName($ftext, "MIDlet-Name") . "";
    $jar_text="" . getJarIniName($ftext, "MIDlet-Description") . "";
$size = getFilesize($_SERVER['DOCUMENT_ROOT'].'/download/'.$row['down'].'');
$name = $row['cn'] ?: $jar_name;
     $rowArr = json_encode(array("name" => "".$name."","apptu" => "https://jvzh.cn/M/i/".$row['icon']."","introduce" => "","system" => "".$row['platform']."","downs" => "".$row['downs']."","number" => "".$number."",
    "dpi" => "".$row['dpi']."","size" => "".$size."","address" => "https://jvzh.cn/download/".$row['down']."","tu1" => "","tu2" => "","tu3" => "","tu3" => "","tu4" => ""));
$ks = " <p dir=\"ltr\"  >";
$p = "</p>";
    $str=$str.$ks.$rowArr."###";
  }
    $jsonArr=rtrim($str,"###");
 echo " <p dir=\"ltr\"  ><br />{\"applist\":[</p>".str_replace("###",",",$jsonArr)." <p dir=\"ltr\"  >]}</p></div></div>";
 $jsonArr=rtrim($str,"###");
 //echo "{\"games\":[".str_replace("###",",",$jsonArr)."}]";
            
exit();