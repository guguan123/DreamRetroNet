<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';
$title = '消息提示';
//include_once $_SERVER["DOCUMENT_ROOT"].'/M/c/header.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
//aut();
$b = $con->query("SELECT * FROM `game` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if($b['ivent']=="不通过"){
echo '<link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>此资源有问题，不提供下载。</p></body>';
exit();
}
  //  if($b['ivent']==0){
        //echo '该应用审核不通过！';
       // include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
      //  exit;
    //  }
 //   $list = get_file_folder_List("jar", 2, '*');
//foreach ($list as $i => $file) {
//$ftext = readZipText("../download/".$b['down']."". $file, "META-INF/MANIFEST.MF"); 
$file_url = '../../download/'.$b['down'].'';
//$file_names = ''.getJarIniName($ftext, "MIDlet-Name").'';
//$file_jar = trim($file_names);
//if($name=$d['cn'] ?: $file_jar){
//$file_name = ''.$b['down'].'';
//echo $file_name;

 if(!file_exists($file_url)) {
echo '<link rel="stylesheet" href="/M/c/notice.css">';
echo '<body id="notice"><h2 class="topic">消息提示</h2><p>该文件不存在</p></body>';
    // echo "不存在";

 }else{
$con->query("UPDATE `game` SET `downs` = `downs`+'1' WHERE `id` = '".$b['id']."'");
if ($user['id']){
$con->query("UPDATE `user` SET `downs` = `downs`+'1' WHERE `id` = '".$user['id']."'");

$down = $con->query(" SELECT * FROM `game_download` WHERE `user_id` = '".$user['id']."' AND `game_id` = '".$b['id']."'")->num_rows;
if ($down > 0){
$con->query("UPDATE `game_download` SET `downs` = `downs`+'1' WHERE `user_id` = '".$user['id']."' AND `game_id` = '".$b['id']."'");
}else{
$con->query("INSERT INTO `game_download` (`id`, `user_id`, `downs`, `game_id`) VALUES (NULL, '".$user['id']."', '1', '".$b['id']."')");
}
}

header('Accept-Ranges: bytes');

           header('Accept-Length: ' . filesize( $file_url ));

           header('Content-Transfer-Encoding: binary');

           header('Content-type: application/octet-stream');

           header('Content-Disposition: attachment; filename=' . $b['down']);

           header('Content-Type: application/octet-stream; name=' . $b['down']);
ob_end_clean();
           if(is_file($file_url) && is_readable($file_url)){

                $file = fopen($file_url, "r");

                 echo fread($file, filesize($file_url));

                 fclose($file);

            }
}
}

?>