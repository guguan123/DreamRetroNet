<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$pagesize = abs(intval($_GET['pagesize']));
//$top = abs(intval($_GET['top'])); # 
$new = $con->query("SELECT * FROM `user` ORDER BY `id` DESC LIMIT 30");
//$number = $con->query('SELECT * FROM `comment` WHERE `id_obmen` = "'.$new['id'].'"')->num_rows;
if ($pagesize==30){
$str="";
foreach($new as $row){
     $rowArr = json_encode(array("id" => "".$row['id']."","nickname" => "".$row['name']."","avatar" => "".$row['avatar'].""));
    $str=$str.$rowArr."###";
}
$jsonArr=rtrim($str,"###");
echo "{\"users\":[".str_replace("###",",",$jsonArr)."]}";
exit();
}
?>